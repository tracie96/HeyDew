<?php


/**
 * Class FAQ
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="FAQ model",
 *     title="FAQ Object Representation",
 *     @OA\Xml(
 *         name="FAQ"
 *     )
 * )
 */

class FAQ{

    /**
     * @OA\Property(
     *     description="Question",
     *     title="Question",
     * )
     *
     * @var string
     */
    private $question;

    /**
     * @OA\Property(
     *     description="Answer",
     *     title="Answer",
     * )
     *
     * @var string
     */
    private $answer;

    /**
     * @OA\Property(
     *     description="Status",
     *     title="status",
     * )
     *
     * @var boolean
     */
    private $status;

}