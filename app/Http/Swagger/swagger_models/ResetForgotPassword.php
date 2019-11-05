<?php


/**
 * Class ResetForgotPassword
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="ResetForgotPassword model",
 *     title="ResetForgotPassword Object Representation",
 *     required={"user_id", "password"},
 *     @OA\Xml(
 *         name="ResetForgotPassword"
 *     )
 * )
 */

class ResetForgotPassword{

    /**
     * @OA\Property(
     *     description="",
     *     title="Email",
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     description="",
     *     title="Reset Token",
     * )
     *
     * @var string
     */
    private $resetToken;

    /**
     * @OA\Property(
     *     description="",
     *     title="New Password",
     * )
     *
     * @var string
     */
    private $new_password;

    /**
     * @OA\Property(
     *     description="",
     *     title="Repeat New Password",
     * )
     *
     * @var string
     */
    private $repeat_new_password;

}