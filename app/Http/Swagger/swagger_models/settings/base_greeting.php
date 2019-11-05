<?php

class SampleController //This is a sample laravel Controller

{

    /**

     * @OA\GET(

     *     path="/api/greet",

     *     tags={"greeting"},

     *     summary="Returns a Peexoo Greeting",

     *     description="A sample Peexoo greeting to test out the API",

     *     operationId="sampleFunctionWithDoc",

     *     @OA\Response(

     *         response="default",

     *         description="successful operation"

     *     )
     * )

     */

    public function sampleFunctionWithDoc()

    {

    }



}

