<?php


/**
 * Class Photographer
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="Photographer model",
 *     title="Photographer Object Representation",
 *     required={"user_id", "password"},
 *     @OA\Xml(
 *         name="Photographer"
 *     )
 * )
 */

class Booking{

    /**
     * @OA\Property(
     *     format="int64",
     *     description="Booking Id",
     *     title="The id of the booking",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="User's Id",
     *     title="The Id of the user for this booking",
     * )
     *
     * @var integer
     */
    private $user_id;

    /**
     * @OA\Property(
     *     description="The Id of the photographer for this booking.",
     *     title="Photographer's Id",
     * )
     *
     * @var integer
     */
    private $photographer_id;

    /**
     * @OA\Property(
     *     description="The Id of the category that the booking belongs to",
     *     title="Booking Category Id",
     * )
     *
     * @var integer
     */
    private $booking_category_id;

    /**
     * @OA\Property(
     *     description="The title for this booking. This is optional",
     *     title="Title",
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     description="Additional Text provided by the user",
     *     title="Extra message",
     * )
     *
     * @var string
     */
    private $extra_message;

    /**
     * @OA\Property(
     *     description="The country for the booking's shoot",
     *     title="Country",
     * )
     *
     * @var string
     */
    private $country;

    /**
     * @OA\Property(
     *     description="The state in the country for the booking's shoot",
     *     title="State",
     * )
     *
     * @var string
     */
    private $state;

    /**
     * @OA\Property(
     *     description="The User's first Address",
     *     title="Address 1",
     * )
     *
     * @var string
     */
    private $address1;

    /**
     * @OA\Property(
     *     description="The User's second Address ????????",
     *     title="Address 2",
     * )
     *
     * @var string
     */
    private $address2;

    /**
     * @OA\Property(
     *     description="The Type of Booking. This is optional",
     *     title="Type",
     * )
     *
     * @var string
     */
    private $type;

    /**
     * @OA\Property(
     *     description="The start date of the shoot for this booking",
     *     title="Start Date",
     * )
     *
     * @var string
     */
    private $shoot_start_date;

    /**
     * @OA\Property(
     *     description="The end date of the shoot for this booking",
     *     title="End Date",
     * )
     *
     * @var string
     */
    private $shoot_end_date;

    /**
     * @OA\Property(
     *     description="The Date for delivery of the booking's shoot. Defaults to shoot end date if not set.",
     *     title="Delivery date",
     * )
     *
     * @var string
     */
    private $delivery_date;

    /**
     * @OA\Property(
     *     description="The current status os the booking. This is set by the backend",
     *     title="Status",
     * )
     *
     * @var string
     */
    private $status;

    /**
     * @OA\Property(
     *     description="The name of the package the booking belongs to",
     *     title="Package Name",
     * )
     *
     * @var string
     */
    private $package_name;
}