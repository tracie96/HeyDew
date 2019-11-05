<?php


/**
 * Class PhotographerCardDetails
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerCardDetails model",
 *     title="PhotographerCardDetails Object Representation",
 *     @OA\Xml(
 *         name="PhotographerCardDetails"
 *     )
 * )
 */

class PhotographerCardDetails{

    /**
     * @OA\Property(
     *     description="Id of the Photographer",
     *     title="Photographer Id",
     * )
     *
     * @var integer
     */
    private $photographer_id;

    /**
     * @OA\Property(
     *     description="First name on the card",
     *     title="First Name",
     * )
     *
     * @var string
     */
    private $first_name;

    /**
     * @OA\Property(
     *     description="Last Name on the card",
     *     title="Last Name",
     * )
     *
     * @var string
     */
    private $last_name;

    /**
     * @OA\Property(
     *     description="The Card's number",
     *     title="Card number",
     * )
     *
     * @var string
     */
    private $card_number;

    /**
     * @OA\Property(
     *     description="Expiry MM/YY on the Card",
     *     title="MM/YY",
     * )
     *
     * @var string
     */
    private $mmyy;

    /**
     * @OA\Property(
     *     description="CVV on the card",
     *     title="CVV",
     * )
     *
     * @var string
     */
    private $cvv;

    /**
     * @OA\Property(
     *     description="Should payments from the card be automatically deducted",
     *     title="Auto Charge",
     * )
     *
     * @var boolean
     */
    private $auto_charge;
}