<?php


/**
 * Class PhotographerSearchParams
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerSearchParams model",
 *     title="PhotographerSearchParams Object Representation",
 *     required={"user_id", "password"},
 *     @OA\Xml(
 *         name="PhotographerSearchParams"
 *     )
 * )
 */

class PhotographerSearchParams{

    /**
     * @OA\Property(
     *     description="Comma seperated values of booking types",
     *     title="categories",
     * )
     *
     * @var string
     */
    private $categories;

    /**
     * @OA\Property(
     *     description="Comma seperated Photographer types",
     *     title="type",
     * )
     *
     * @var string
     */
    private $type;

    /**
     * @OA\Property(
     *     description="Comma seperated values of regions",
     *     title="region",
     * )
     *
     * @var string
     */
    private $region;

    /**
     * @OA\Property(
     *     description="Availability date range",
     *     title="availability",
     * )
     *
     * @var string
     */
    private $availability;

    /**
     * @OA\Property(
     *     description="Photographer price range",
     *     title="price",
     * )
     *
     * @var string
     */
    private $price;

}