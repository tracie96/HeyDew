<?php

namespace App\Http\Swagger\swagger_models;

/**
 * Class UserPayment
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="UserPayment model",
 *     title="UserPayment Object Representation",
 *     required={"email", "password"},
 *     @OA\Xml(
 *         name="UserPayment"
 *     )
 * )
 */

class UserPayment
{

    /**
     * @OA\Property(
     *     format="int64",
     *     description="UserPayment Id",
     *     title="Id",
     * )
     *
     * @var integer
     */
    private $id;
    /**
     * @OA\Property(
     *     description="User id",
     *     title="User id",
     * )
     *
     * @var integer
     */
    private $user_id;
    /**
     * @OA\Property(
     *     description="UserPayment Title",
     *     title="Title",
     * )
     *
     * @var string
     */
    private $title;
    /**
     * @OA\Property(
     *     description="User password",
     *     title="UserPayment Type",
     *     format="Type"
     * )
     *
     * @var string
     */
    private $type;
    /**
     * @OA\Property(
     *     description="UserPayment Date",
     *     title="Payment Date",
     * )
     *
     * @var datetime
     */
    private $payment_date;
    /**
     * @OA\Property(
     *     description="Charge Amount",
     *     title="Amount",
     * )
     *
     * @var double
     */
    private $amount;

}