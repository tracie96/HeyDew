<?php

namespace App\Http\Controllers\Modules\FindMyFace;

use App\Album;
use App\Http\Controllers\Controller;
use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FindMyFaceController extends Controller
{
    /**
     * @OA\POST(
     *     path="/api/findmyface/",
     *     tags={"findmyface"},
     *     summary="Searches for the face of a user",
     *     operationId="FindMyFace",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="image to upload",
     *                     property="file",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function FindMyFace(Request $request){
        $aws_credentials=[
            'region'=>env('PEEXOO_AWS_S3_REGION','eu-west-1'),
            'version'=>env('PEEXOO_AWS_S3_VERSION','2006-03-01'),
            'credentials'=>[
                'key'=>env('PEEXOO_AWS_S3_KEY','AKIAWINNKIDGTTCFNUUI'),
                'secret'=>env('PEEXOO_AWS_S3_SECRET','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')
            ],
            'http'=>[
                'verify'=>false
            ]
        ];
        $peexoo_temp_bucket=env('PEEXOO_AWS_S3_TEMP_BUCKET','peexootempbucket');
        $peexoo_perm_bucket=env('PEEXOO_AWS_S3_PERM_BUCKET','peexoopermbucket');

        //start a cron job, return an endpoint to check on the progress. endpoint should contain a flag if search is complete
        $image='';
        $request->validate([
            'file' => 'required|image|max:3000',
        ]);

        if(!$request->hasFile('file')){
            return response()->json(['status'=>404,'message'=>'Upload a file using key \'file\'','data'=>[]]);
        }

        //$request->file->store('public/images_uploaded_for_fmf'); //public uri
       //$file_local_path= $request->file->store('images_uploaded_for_fmf'); //private uri
//        $path = Storage::disk('s3')->put('images/originals', $request->file);
        //return response()->json(['status'=>404,'message'=>'x x x','data'=>$request->file->hashName()]);
        $s3=null;
        try{
            $aws_credentials['version']=env('PEEXOO_AWS_S3_VERSION','2006-03-01');
            $s3=new S3Client($aws_credentials);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to initialize S3 credentials','data'=>$e->getMessage(),'info'=>$aws_credentials]);
        }

        try{
                $should_create_bucket = false;
                if (!$s3->doesBucketExist('' . $peexoo_temp_bucket)) {
                    $should_create_bucket = true;
                }
                if ($should_create_bucket) {
                    $s3->createBucket(['Bucket' => '' . $peexoo_temp_bucket, 'ACL' => 'public-read']);
                }
                if (!$s3->getBucketLocation(['Bucket' => '' . $peexoo_temp_bucket])) {
                    return response()->json(['status' => 404, 'message' => 'Failed to initialize S3 bucket', 'data' => []]);
                }
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to initialize S3 bucket','data'=>$e->getMessage()]);
        }

        $unique_s3_file_name=$request->file->hashName();
        try{
            $s3->putObject([
                'Bucket'=>$peexoo_temp_bucket,
                'Key'=>$unique_s3_file_name,
                'SourceFile'=>$request->file->path(),
                'ACL'=>'public-read'
            ]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to put object into S3 bucket','data'=>$e]);
        }

        $rekognition=null;
        try{
            $aws_credentials['version']=env('PEEXOO_AWS_REKOGNITION_VERSION','2016-06-27');
            $rekognition=new RekognitionClient($aws_credentials);
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>'Failed to initialize Rekognition credentials','data'=>$e->getMessage()]);
        }

        try{
            $collection=$rekognition->describeCollection(['CollectionId'=>$peexoo_perm_bucket]);
            if(!isset($collection['CollectionARN'])){
                return response()->json(['status'=>404,'message'=>'Rekognition does not exist. Upload an image to Rekognition!','data'=>[]]);
            }
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>'Failed to describe Rekognition Credentials','data'=>$e->getMessage()]);
        }
        $search_results=[];
        try{
            $search_results=$rekognition->searchFacesByImage([
                'CollectionId'=>$peexoo_perm_bucket,
                'FaceMatchThreshold'=>80,
                'Image'=>[
                    'S3Object'=>[
                        'Bucket'=>$peexoo_temp_bucket,
                        'Name'=>$unique_s3_file_name
                    ]
                ]
            ]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Rekognition search Failed','data'=>$e]);
        }

        if(!isset($search_results['FaceMatches'])){
            return response()->json(['status'=>400,'message'=>'No Face Match returned','data'=>$search_results]);
        }

        $urls=[];
        foreach ($search_results['FaceMatches'] as $face){
            $urls[]='http://'.$peexoo_perm_bucket.'.s3-'.$aws_credentials['region'].'.amazonaws.com/'.$face['Face']['ExternalImageId'];
        }

        $albums=[];
        for($i=0;$i<5;$i+=1){
            $albums[]=['images'=>40,'title'=>'','user_has_album'=>true];
        }

        return response()->json(['status'=>200,'message'=>'Recognition returned','data'=>$urls,'album'=>$albums]);

    }

    /**
     * @OA\POST(
     *     path="/api/findmyface/train",
     *     tags={"findmyface"},
     *     summary="Trains uploaded images for recognition",
     *     operationId="indexFindMyFace",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="image to upload",
     *                     property="file",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function indexFindMyFace(Request $request){
        $aws_credentials=[
            'region'=>env('PEEXOO_AWS_S3_REGION','eu-west-1'),
            'version'=>env('PEEXOO_AWS_S3_VERSION','2006-03-01'),
            'credentials'=>[
                'key'=>env('PEEXOO_AWS_S3_KEY','AKIAWINNKIDGTTCFNUUI'),
                'secret'=>env('PEEXOO_AWS_S3_SECRET','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')
            ],
            'http'=>[
                'verify'=>false
            ]
        ];
        $peexoo_temp_bucket=env('PEEXOO_AWS_S3_TEMP_BUCKET','peexootempbucket');
        $peexoo_perm_bucket=env('PEEXOO_AWS_S3_PERM_BUCKET','peexoopermbucket');

        //start a cron job, return an endpoint to check on the progress. endpoint should contain a flag if search is complete
        $image='';
        $request->validate([
            'file' => 'required|image|max:3000',
        ]);

        if(!$request->hasFile('file')){
            return response()->json(['status'=>404,'message'=>'Upload a file using key \'file\'','data'=>[]]);
        }

        //$request->file->store('public/images_uploaded_for_fmf'); //public uri
        //$file_local_path= $request->file->store('images_uploaded_for_fmf'); //private uri
//        $path = Storage::disk('s3')->put('images/originals', $request->file);
        //return response()->json(['status'=>404,'message'=>'x x x','data'=>$request->file->hashName()]);
        $s3=null;
        try{
            $aws_credentials['version']=env('PEEXOO_AWS_S3_VERSION','2006-03-01');
            $s3=new S3Client($aws_credentials);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to initialize S3 credentials','data'=>$e->getMessage(),'info'=>$aws_credentials]);
        }

        try{
            $should_create_bucket = false;
            if (!$s3->doesBucketExist('' . $peexoo_perm_bucket)) {
                $should_create_bucket = true;
            }
            if ($should_create_bucket) {
                $s3->createBucket(['Bucket' => '' . $peexoo_perm_bucket, 'ACL' => 'public-read']);
            }
            if (!$s3->getBucketLocation(['Bucket' => '' . $peexoo_perm_bucket])) {
                return response()->json(['status' => 404, 'message' => 'Failed to initialize S3 bucket', 'data' => []]);
            }
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to initialize S3 bucket','data'=>$e->getMessage()]);
        }

        $unique_s3_file_name=$request->file->hashName();
        try{
            $s3->putObject([
                'Bucket'=>$peexoo_perm_bucket,
                'Key'=>$unique_s3_file_name,
                'SourceFile'=>$request->file->path(),
                'ACL'=>'public-read'
            ]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Failed to put object into S3 bucket','data'=>$e->getMessage()]);
        }

        $rekognition=null;
        try{
            $aws_credentials['version']=env('PEEXOO_AWS_REKOGNITION_VERSION','2016-06-27');
            $rekognition=new RekognitionClient($aws_credentials);
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>'Failed to initialize Rekognition credentials','data'=>$e->getMessage()]);
        }
        $collection=null;
        try{
            $collection=$rekognition->describeCollection(['CollectionId'=>$peexoo_perm_bucket]);
            if(!isset($collection['CollectionARN'])){
                return response()->json(['status'=>404,'message'=>'Rekognition does not exist. Upload an image to Rekognition!','data'=>[]]);
            }
        }catch (\Exception $e){
           // return response()->json(['status'=>400,'message'=>'Failed to describe Rekognition Credentials','data'=>$e->getMessage()]);
        }

        if(!isset($collection['CollectionARN'])){
            try {
                $rekognition->createCollection(['CollectionId' =>$peexoo_perm_bucket]);
            }catch (\Exception $e){
                return response()->json(['status'=>400,'message'=>'Failed to create Rekognition Collection','data'=>$e->getMessage()]);
            }
        }

        try{
            $rekognition->indexFaces([
                'CollectionId'=>$peexoo_perm_bucket,
                'ExternalImageId'=>$unique_s3_file_name,
                'Image'=>[
                    'S3Object'=>[
                        'Bucket'=>$peexoo_perm_bucket,
                        'Name'=>$unique_s3_file_name
                    ]
                ]
            ]);
        }catch (\Exception $e){
            return response()->json(['status'=>404,'message'=>'Rekognition indexing Failed','data'=>$e->getMessage()]);
        }

        return response()->json(['status'=>200,'message'=>'Recognition Indexing Successful','data'=>[]]);

    }

    /**
     * @OA\PUT(
     *     path="/api/findmyface/",
     *     tags={"findmyface"},
     *     summary="Downloads the album to the user's FindMyFace Album Collection",
     *     operationId="download",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function download(Request $request){
        $find_my_face_album_id='';
        $user=null; //from auth

        $userface_isIn_album_cache=true;//We also store records of albums that a user's face has been recognized in

        $findmyface_album_is_purchased=false;

        $is_user_subscribed_to_findmyface_actively=true;

        if( !($findmyface_album_is_purchased || $is_user_subscribed_to_findmyface_actively )){
            //generate payment url and send back response
        }

        $add_findmyface_album_to_userAlbums=true;
        $new_findmyface_album_details=new Album([
            'title','email','type'=>Album::$FIND_MY_FACE,'archived','source','privacy','status','album_hash'
        ]);

        if(!$add_findmyface_album_to_userAlbums){

        }

        return response()->json(['status'=>200,'message'=>'FindMyFace Album succesfully downloaded','data'=>null]);
    }


    /**
     * @OA\GET(
     *     path="/api/findmyface/subscribe",
     *     tags={"findmyface"},
     *     summary="Subscribe to FindMyFace",
     *     operationId="subscribe",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function subscribe(){
        $data=[];
        return response()->json(['status'=>200,'message'=>'Subcription Successfull','data'=>$data]);
    }

}
