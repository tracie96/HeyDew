<?php


/**
 * Class PhotographerProfileImage
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerProfileImage model",
 *     title="PhotographerProfileImage Object Representation",
 *     @OA\Xml(
 *         name="PhotographerProfileImage"
 *     )
 * )
 */

class PhotographerProfileImage{

    /**
     * @OA\Property(
     *     description="",
     *     title="Photographer Id",
     * )
     *
     * @var integer
     */
    private $photographer_id;

    /**
     * @OA\Property(
     *     description="",
     *     title="Image URL",
     * )
     *
     * @var string
     */
    private $image_url;

    /**
     * @OA\Property(
     *     description="",
     *     title="Image Section",
     * )
     *
     * @var string
     */
    private $image_section;

    /**
     * @OA\Property(
     *     description="",
     *     title="Is Active",
     * )
     *
     * @var boolean
     */
    private $is_active;
}