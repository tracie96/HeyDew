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

class Photographer{

    /**
     * @OA\Property(
     *     format="int64",
     *     description="Photographer Id",
     *     title="Id",
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="User's Id",
     *     title="User Id",
     * )
     *
     * @var integer
     */
    private $user_id;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $about_us;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $category;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $photography_type;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $region;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $business_name;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $verified;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $archived;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $bvn;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $bvn_verified;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $id_card;

    /**
     * @OA\Property(
     *     description="A Brief Description.",
     *     title="Introduction Text",
     * )
     *
     * @var string
     */
    private $id_card_verified;

}