<?php

namespace App\Http\Swagger\swagger_models;

/**
 * Class User
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="User model",
 *     title="User Object Representation",
 *     required={"email", "password"},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */

class User
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="User Id",
     *     title="Id",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     description="User Last Name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $last_name;

    /**
     * @OA\Property(
     *     description="User First Name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $first_name;

    /**
     * @OA\Property(
     *     description="User Email",
     *     title="Email",
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     description="User Tel number",
     *     title="Tel Number",
     * )
     *
     * @var string
     */
    private $tel_number;

    /**
     * @OA\Property(
     *     description="User password",
     *     title="password",
     *     format="password"
     * )
     *
     * @var string
     */
    private $password;

    /**
     * @OA\Property(
     *     description="User Profile Picture. This is a url to the image. ",
     *     title="Profile Picture",
     * )
     *
     * @var string
     */
    private $profile_image;

    /**
     * @OA\Property(
     *     description="The person's Job Description in a word!!",
     *     title="Job Description",
     * )
     *
     * @var string
     */
    private $job_description;


}