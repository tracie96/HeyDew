<?php


/**
 * Class PhotographerPricingPackage
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerPricingPackage model",
 *     title="PhotographerPricingPackage Object Representation",
 *     @OA\Xml(
 *         name="PhotographerPricingPackage"
 *     )
 * )
 */

class PhotographerPricingPackage{

    /**
     * @OA\Property(
     *     description="Unique integer to identify the pricing Package",
     *     title="id",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="The id of the photographer for this package",
     *     title="photographerId",
     * )
     *
     * @var integer
     */
    private $photographerId;

    /**
     * @OA\Property(
     *     description="Title of the pricing package",
     *     title="title",
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     description="The id of the booking type for this booking",
     *     title="bookingTypeId",
     * )
     *
     * @var integer
     */
    private $bookingTypeId;

    /**
     * @OA\Property(
     *     description="The id of the booking type for this booking",
     *     title="bookingPrice",
     * )
     *
     * @var integer
     */
    private $bookingPrice;

    /**
     * @OA\Property(
     *     description="",
     *     title="is_active",
     * )
     *
     * @var integer
     */
    private $is_active;
}