<?php


/**
 * Class PhotographerBankAccountDetails
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerBankAccountDetails model",
 *     title="PhotographerBankAccountDetails Object Representation",
 *     @OA\Xml(
 *         name="PhotographerBankAccountDetails"
 *     )
 * )
 */

class PhotographerBankAccountDetails{
//'first_name','last_name','bank_name','account_number'
    /**
     * @OA\Property(
     *     format="int64",
     *     description="Photographer Id",
     *     title="Id",
     * )
     *
     * @var integer
     */
    private $photographer_id;

    /**
     * @OA\Property(
     *     description="First Name on Bank",
     *     title="User Id",
     * )
     *
     * @var string
     */
    private $first_name;

    /**
     * @OA\Property(
     *     description="Last Name on Bank",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $last_name;

    /**
     * @OA\Property(
     *     description="Bank Name",
     *     title="",
     * )
     *
     * @var string
     */
    private $bank_name;

    /**
     * @OA\Property(
     *     description="Bank's account number",
     *     title="account Number",
     * )
     *
     * @var string
     */
    private $account_number;

}