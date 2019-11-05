<?php

namespace App\Http\Controllers\Modules\Photographer;

use App\Photographer;
use App\UtilityModels\Booking\BookingTypeManager;
use App\UtilityModels\Photographer\PhotographerManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotographerProfileImagesController extends Controller
{
    private $photographerManager;
    private $bookingTypeManager;

    public function __construct(PhotographerManager $photographerManager,BookingTypeManager $bookingTypeManager)
    {
        $this->photographerManager=$photographerManager;
        $this->bookingTypeManager=$bookingTypeManager;
    }

    /**
     * @OA\GET(
     *     path="/api/photographer/{photographer_id}/portfolio/images/{category_key}",
     *     tags={"photographer"},
     *     summary="Gets a photographer's portfolio images for a given category.
     *     Categories include WDNG(Wedding), EVNT(Event) ..... Use the /api/bookings/types to fetch the Portfolio types. .
     *     ",
     *     operationId="getPhotographerPortfolioImages",
     *      @OA\Parameter(
     *         name="photographer_id",
     *         in="path",
     *         description="Id of the Photographer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="category_key",
     *         in="path",
     *         description="The key of the category to fetch",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getPhotographerPortfolioImages(Request $request)
    {
        try{
            $response=  $this->photographerManager->getPortfolioImages(''.$request->photographer_id,''.$request->category_key);
            return response()->json(['status'=>200,'message'=>'Portfolio Images fetched successfully','data'=>$response]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/photographer/{photographer_id}/profile/images/{category_key}",
     *     tags={"photographer"},
     *     summary="Gets a photographer's profile images for a given category.
     *     Categories include PCI (Photographer Cover Image) and HPSI (Homepage Slider Image).
     *     ",
     *     operationId="getPhotographerProfileImages",
     *      @OA\Parameter(
     *         name="photographer_id",
     *         in="path",
     *         description="Id of the Photographer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="category_key",
     *         in="path",
     *         description="The key of the category to fetch",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getPhotographerProfileImages(Request $request)
    {

        try{
            $response=  $this->photographerManager->getPhotographerProfileImages(''.$request->photographer_id,''.$request->category_key);
            return response()->json(['status'=>200,'message'=>'Portfolio Images fetched successfully','data'=>$response]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }


    /**
     * @OA\POST(
     *     path="/api/photographer/profile/images",
     *     tags={"photographer"},
     *     summary="Adds an image's url to the list of a Photographer's profile Images in a category",
     *     operationId="addPhotographerProfileImages",
     *     @OA\RequestBody(
     *         description="Photographer Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PhotographerProfileImage")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile images fetched successfully"
     *     ),
     *      security={
     *         {"api_key_scheme": {}}
     *     }
     * )
     */
    public function addPhotographerProfileImages(Request $request){
        try{
            $user = \auth()->user();
            if(!is_array($request->image_url) ) {
                if(!is_string($request->image_url)){
                    throw new \Exception('Invalid image url value',400);
                }
                $request->image_url = [$request->image_url];
            }
            $data=$this->photographerManager->addPhotographerImages($user,$request->image_url,''.$request->image_section);
            return response()->json(['status'=>200,'message'=>'Portfolio images added successfully','data'=>$data]);
        }catch (\Exception $e){
            return response()->json(['status'=>400,'message'=>$e->getMessage(),'data'=>null]);
        }
    }


    /**
     * @OA\GET(
     *     path="/api/photographer/{photographer_id}/categories/images",
     *     tags={"photographer"},
     *     summary="Gets a photographer's categories images",
     *     operationId="getPhotographerCategoriesImages",
     *      @OA\Parameter(
     *         name="photographer_id",
     *         in="path",
     *         description="Id of the Photographer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getPhotographerCategoriesImages(Request $request)
    {

        try{
            $response = $this->photographerManager->getPhotographerCategories($request->photographer_id);
            return response()->json(['status'=>200,'message'=>'Category Images fetched successfully','data'=>$response]);
        }catch (\Exception $e){
            return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        }

    }

    /**
     * @OA\GET(
     *     path="/api/photographer/categories/images/hpsi/random/{count}",
     *     tags={"photographer"},
     *     summary="Gets a photographer's categories images",
     *     operationId="getRandomHPSIImages",
     *      @OA\Parameter(
     *         name="count",
     *         in="path",
     *         description="Number of images to fetch",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     )
     * )
     */
    public function getRandomHPSIImages(Request $request)
    {
          $response = $this->photographerManager->getRandomPhotographerHPSIImages($request->count);
          return response()->json(['status'=>200,'message'=>'Category Images fetched successfully','data'=>$response]);
 
        // $randomPhotograhers = Photographer::or
        // try{
        //     $response = $this->photographerManager->getRandomPhotographerHPSIImages($request->count);
        //     return response()->json(['status'=>200,'message'=>'Category Images fetched successfully','data'=>$response]);
        // }catch (\Exception $e){
        //     return response()->json(['status'=>$e->getCode(),'message'=>$e->getMessage(),'data'=>null]);
        // }

    }



}
