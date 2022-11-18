<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of items.
     * @OA\Get(
     *     path="/items",
     *     tags={"restaurant"},
     *     summary="Menu items list",
     *
     *
     *     @OA\Response(
     *         response=200,
     *         description="Returns list of available items on the menu",
     *        @OA\JsonContent(
     *             type="object",
     *                @OA\Property(
     *                property="data",
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
     *             ),
     *     ),
     *
     * )
     */
    public function index()
    {
        return ItemResource::collection(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
