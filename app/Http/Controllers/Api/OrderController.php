<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Create delivery order
     * @OA\Post(
     *     path="/orders/new/delivery",
     *     tags={"restaurant"},
     *     summary="Create a new delivery order",
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          @OA\Property(property="customer_name", type="string",example="Emad"),
     *          @OA\Property(property="customer_phone_number", type="string", example="+01312312123"),
     *          @OA\Property(property="items", type="array",
     *              @OA\Items(
     *               type="integer"
     *              ),
     *          ),
     *          @OA\Property(property="delivery_fees", type="number", format="float"),
     *     )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Returns a success message",
     *     @OA\JsonContent(
     *          @OA\Property(property="id", type="integer"),
     *          @OA\Property(property="customer_name", type="string",example="Emad"),
     *          @OA\Property(property="customer_phone_number", type="string", example="+01312312123"),
     *                @OA\Property(
     *                property="items",
     *                type="array",
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *
     *                      @OA\Property(
     *                         property="price",
     *                         type="double",
     *                      ),
     *
     *                ),
     *             ),
     *          @OA\Property(property="items_total_price", type="number", format="float"),
     *          @OA\Property(property="delivery_fees", type="number", format="float"),
     *          @OA\Property(property="total", type="number", format="float"),
     *     )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     * )
     *
     *
     *
     */
    public function store(Request $request)
    {
        print_r('asd');
        return ['name' => $request->get('customer_name')];
    }

    /**
     * Create dine-in order
     * @OA\Post(
     *     path="/orders/new/dine-in",
     *     tags={"restaurant"},
     *     summary="Create a new dine in order",
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          @OA\Property(property="table_number", type="integer",example="22"),
     *          @OA\Property(property="waiter_name", type="string", example="Dina"),
     *          @OA\Property(property="items", type="array",
     *              @OA\Items(
     *               type="integer"
     *              ),
     *          ),
     *          @OA\Property(property="service_charge", type="number", format="float"),
     *     )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Returns a success message",
     *     @OA\JsonContent(
     *          @OA\Property(property="id", type="integer"),
     *          @OA\Property(property="table_number", type="string",example="Emad"),
     *          @OA\Property(property="waiter_name", type="string", example="+01312312123"),
     *                @OA\Property(
     *                property="items",
     *                type="array",
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *
     *                      @OA\Property(
     *                         property="price",
     *                         type="double",
     *                      ),
     *
     *                ),
     *             ),
     *          @OA\Property(property="items_total_price", type="number", format="float"),
     *          @OA\Property(property="service_charge", type="number", format="float"),
     *          @OA\Property(property="total", type="number", format="float"),
     *     )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     * )
     *
     *
     *
     */
    public function storeDineIn(Request $request)
    {
        //
    }

    /**
     * Create takeaway order
     * @OA\Post(
     *     path="/orders/new/takeaway",
     *     tags={"restaurant"},
     *     summary="Create a new takeaway order",
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          @OA\Property(property="items", type="array",
     *              @OA\Items(
     *               type="integer"
     *              ),
     *          ),
     *     )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Returns a success message",
     *     @OA\JsonContent(
     *          @OA\Property(property="id", type="integer"),
     *                @OA\Property(
     *                property="items",
     *                type="array",
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *
     *                      @OA\Property(
     *                         property="price",
     *                         type="double",
     *                      ),
     *
     *                ),
     *             ),
     *          @OA\Property(property="items_total_price", type="number", format="float"),
     *          @OA\Property(property="total", type="number", format="float"),
     *     )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     * )
     *
     *
     *
     */
    public function storeTakeaway(Request $request)
    {
        //
    }



        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
