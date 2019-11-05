<?php

namespace App\Http\Controllers\Modules\Image;

use App\Album;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //

    /**
     * @OA\GET(
     *     path="/api/images/random/{count}",
     *     tags={"user"},
     *     summary="Fetches {count} Random Images",
     *     operationId="getRandomImages",
     *     @OA\Parameter(
     *         name="count",
     *         in="path",
     *         description="Maximum number of random images to fetch",
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
    public function getRandomImages(){
        //got to photographer profiles and get Images

    }


    /**
     * @OA\POST(
     *     path="/api/images/explore/{count}",
     *     tags={"user"},
     *     summary="Fetches {count} Random Images",
     *     operationId="getRandomImages",
     *     @OA\Parameter(
     *         name="count",
     *         in="path",
     *         description="Maximum number of random images to fetch",
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
    public function getExploreImages(Request $request){
        $sort='desc';
        $start=0;
        $limit=100;

        //filter by categories
        $categories=explode($request->category);

        //filter by region
        $regions=explode($request->region);

        // filter by shoot date range
        $shoot_date_start=explode($request->shoot_date_start);
        $shoot_date_end=explode($request->shoot_date_end);

        //shoot type
        $shoot_type=explode($request->shoot_type);


        //get All albums that fit search categories and are public limit size
        $matching_albums=Album::whereIn('category',$categories)->whereIn('',$regions)
            ->whereDate('shoot_date_start',$shoot_date_start)
            ->whereDate('shoot_date_end',$shoot_date_end)
            ->whereIn('$shoot_type',$shoot_type)->limit($limit)->pluck('id');

        //get all images in albums limit sizes
        $images=Image::whereIn('album_id',$matching_albums)
            ->orderBy('id',$sort)
            ->offset($start)
            ->limit($limit);
    }

}
