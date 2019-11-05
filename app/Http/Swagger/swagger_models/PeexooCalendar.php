<?php


/**
 * Class PeexooCalendar
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PeexooCalendar model",
 *     title="PeexooCalendar Object Representation",
 *     @OA\Xml(
 *         name="PeexooCalendar"
 *     )
 * )
 */

class PeexooCalendar{

    /**
     * @OA\Property(
     *     description="The Id of the User",
     *     title="User Id",
     * )
     *
     * @var integer
     */
    private $user_id;

    /**
     * @OA\Property(
     *     description="The Calendar start date",
     *     title="Start Date",
     * )
     *
     * @var string
     */
    private $start_date;

    /**
     * @OA\Property(
     *     description="The calendar end date",
     *     title="End Date",
     * )
     *
     * @var string
     */
    private $end_date;

    /**
     * @OA\Property(
     *     description="The description for this event",
     *     title="Description",
     * )
     *
     * @var string
     */
    private $description;

}