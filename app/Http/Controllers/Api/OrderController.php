<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryOrderResource;
use App\Http\Resources\DineInOrderResource;
use App\Http\Resources\TakeawayOrderResource;
use App\Models\DeliveryOrder;
use App\Models\DineInOrder;
use App\Models\Item;
use App\Models\ItemOrder;
use App\Models\Order;
use App\Models\TakeawayOrder;
use Illuminate\Http\JsonResponse;
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
     *         description="Returns the created Delivery Order object.",
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
     *          @OA\Property(property="message", type="string",example="Missing parameters."),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="validation error"),
     *          @OA\Property(property="errors", type="object"),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="Url does not exist"),
     *     )
     *     ),
     *
     * )
     *
     *
     *
     */
    public function store(Request $request, $type)
    {

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*' => 'required|integer',
        ]);

        $itemsTableIds = Item::all()->modelKeys();

        foreach ($request->get('items') as $item) {
            if (in_array($item, $itemsTableIds)) {
                continue;
            } else {
                return new JsonResponse(['message' => "there no valid food for the selected id $item."], 400);
            }
        }

        $orderId = 0;
        $orderObject = null;

        if ($type == Order::TYPE_delivery) {

            $request->validate([
                'customer_name' => 'required|string',
                'customer_phone_number' => 'required|string',
                'delivery_fees' => 'required|numeric',
            ]);

            $deliveryOrder = new DeliveryOrder();
            $deliveryOrder->delivery_fees = $request->get('delivery_fees');
            $deliveryOrder->customer_name = $request->get('customer_name');
            $deliveryOrder->customer_phone_number = $request->get('customer_phone_number');
            $deliveryOrder->save();
            $orderId = $deliveryOrder->id;
            $orderObject = new DeliveryOrderResource($deliveryOrder);
        }
        elseif ($type == Order::TYPE_dine_in) {

            $request->validate([
                'table_number' => 'required|numeric',
                'service_charge' => 'required|numeric',
                'waiter_name' => 'required|string',
            ]);

            $dineInOrder = new DineInOrder();
            $dineInOrder->table_number = $request->get('table_number');
            $dineInOrder->service_charge = $request->get('service_charge');
            $dineInOrder->waiter_name = $request->get('waiter_name');
            $dineInOrder->save();
            $orderId = $dineInOrder->id;
            $orderObject = new DineInOrderResource($dineInOrder);
        }

        elseif ($type == Order::TYPE_takeaway) {

            $takeawayOrder = new TakeawayOrder();
            $takeawayOrder->save();
            $orderId = $takeawayOrder->id;
            $orderObject = new TakeawayOrderResource($takeawayOrder);
        }
        else{
            return new JsonResponse(['message' => "there no valid food valid order type $type."], 404);
        }

        foreach ($request->get('items') as $item) {
            if (Item::find($item)->first() instanceof Item) {
                $itemOrder = new ItemOrder();
                $itemOrder->item_id = $item;
                $itemOrder->order_id = $orderId;
                $itemOrder->save();
            }
        }

        return $orderObject;


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
     *         description="Returns the created Dine in Order object.",
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
     *          @OA\Property(property="message", type="string",example="Missing parameters"),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="validation error"),
     *          @OA\Property(property="errors", type="object"),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="Url does not exist"),
     *     )
     *     ),
     *
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
     *         description="Returns the created Takeaway Order object.",
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
     *          @OA\Property(property="message", type="string",example="Missing parameters."),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="validation error"),
     *          @OA\Property(property="errors", type="object"),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="Url does not exist"),
     *     )
     *     ),
     *
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
