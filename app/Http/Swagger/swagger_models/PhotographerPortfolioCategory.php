<?php


/**
 * Class PhotographerPortfolioCategory
 *
 * @package  App\Http\Swagger\swagger_models
 *
 * @author  Nwanna Joseph <2handheld@gmail.com>
 *
 * @OA\Schema(
 *     description="PhotographerPortfolioCategory model",
 *     title="PhotographerPortfolioCategory Object Representation",
 *     @OA\Xml(
 *         name="PhotographerPortfolioCategory"
 *     )
 * )
 */

class PhotographerPortfolioCategory{

    /**
     * @OA\Property(
     *     description="The Title of the Category, ie Profile Images, Home page Slider ",
     *     title="Title",
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     description="A unique key to identify this category",
     *     title="Category Key",
     * )
     *
     * @var string
     */
    private $category_key;

    /**
     * @OA\Property(
     *     description="Active",
     *     title="Active",
     * )
     *
     * @var boolean
     */
    private $active;

}