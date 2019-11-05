<?php

namespace App;

use Aws\Rekognition\RekognitionClient;
use Aws\S3\S3Client;
use Illuminate\Database\Eloquent\Model;

class AIRecognition extends Model
{

    //composer require aws/aws-sdk-php

     //https://github.com/aws/aws-sdk-php-laravel

    //https://packagist.org/packages/aws/aws-sdk-php

    public static function trainUserRcognition($images,$event){
            $s3=new S3Client(
                [
                    'region'=>env('PEEXOO_AWS_S3_REGION'),
                    'version'=>env('PEEXOO_AWS_S3_VERSION','2006-03-01'),
                    'credentials'=>[
                        'key'=>env('PEEXOO_AWS_S3_KEY'),
                        'secret'=>env('PEEXOO_AWS_S3_SECRET'),
                    ],
                    'http'=>[
                        'verify'=>false,
                    ],
                ]
            );

            $event_bucket_exists=$s3->doesBucketExist($event);
            if(!$event_bucket_exists){
                $create_bucket=$s3->createBucket([
                    'Bucket'=>$event,
                    'ACL'=>'public-read',
                ]);
                $new_bucket_location=$s3->getBucketLocation(['Bucket'=>$event]);
                if(!$new_bucket_location){

                }
            }

            $uploaded_files=[];

            $add_to_bucket=$s3->putObject([
                'Bucket'=>$event,
                'Key'=>'',
                'SourceFile'=>'',
                'ACL'=>'public-read'
            ]);

            $client=new RekognitionClient(
                [
                    'region'=>env('PEEXOO_AWS_REKOGNITION_REGION'),
                    'version'=>env('PEEXOO_AWS_REKOGNITION_VERSION','2016-06-27'),
                    'credentials'=>[
                        'key'=>env('PEEXOO_AWS_REKOGNITION_KEY'),
                        'secret'=>env('PEEXOO_AWS_REKOGNITION_SECRET'),
                    ],
                    'http'=>[
                        'verify'=>false,
                    ],
                ]
            );

            $collection=$client->describeCollection(['CollectionId'=>$event,]);//Bucket Name == Collection name

        if(!isset($collection['CollectionARN'])){
            $client->createCollection(['CollectionId'=>$event]);
        }

        foreach([] as $file_data){
           $client->indexFaces([
               'CollectionId'=>$event,
               'ExternalImageId'=>$file_data,
               'Image'=>[
                   'S3Object'=>[
                       'Bucket'=>$event,
                       'Name'=>$file_data
                   ]
               ]
           ]);
        }

    }

    public static function recognizeUser($event,$user_image_url){
        $recognition_repo_bucket='';
        $s3=new S3Client(
            [
                'region'=>env('PEEXOO_AWS_S3_REGION'),
                'version'=>env('PEEXOO_AWS_S3_VERSION','2006-03-01'),
                'credentials'=>[
                    'key'=>env('PEEXOO_AWS_S3_KEY'),
                    'secret'=>env('PEEXOO_AWS_S3_SECRET'),
                ],
                'http'=>[
                    'verify'=>false,
                ],
            ]
        );

        $event_bucket_exists=$s3->doesBucketExist('');
        if(!$event_bucket_exists){
            $create_bucket=$s3->createBucket([
                'Bucket'=>'',
                'ACL'=>'public-read',
            ]);
            $new_bucket_location=$s3->getBucketLocation(['Bucket'=>'']);
            if(!$new_bucket_location){

            }
        }

        $uploaded_files=[];

        $add_to_bucket=$s3->putObject([
            'Bucket'=>'',
            'Key'=>'',
            'SourceFile'=>'',
            'ACL'=>'public-read'
        ]);

        $client=new RekognitionClient([
            'region'=>'',
            'version'=>'',
            'credentials'=>[
                'key'=>'',
                'secret'=>''
            ],
            'http'=>[
                'verify'=>false
            ]
        ]);

        $collection=$client->describeCollection(['CollectionId'=>'']);//Bucket Name == Collection name

        if(!isset($collection['CollectionARN'])){
         //   $client->createCollection(['CollectionId'=>'']);
        }

        $search_results=$client->searchFacesByImage([
            'CollectionId'=>'',
            'FaceMatchThreshold'=>80,
            'Image'=>[
                'S3Object'=>[
                    'Bucket'=>'',
                    'Name'=>''
                ]
            ]
        ]);

        $image_urls=[];
        foreach ($search_results['FaceMatches'] as $image){
            $image_urls[]='http://'.'bucket'.'s3-region.amazonaws.com/'.$image['Face']['ExternalImageId'];
        }

        return response()->json(['data'=>200,'message'=>'','data'=>$image_urls]);
    }

}
