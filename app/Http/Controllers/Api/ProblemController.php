<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemController extends Controller
{

    /**
     * First problem
     * @OA\Post(
     *     path="/problems/first",
     *     tags={"problems"},
     *     summary="First problem",
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          type="array",
     *          @OA\Items( type="integer"),
     *     example="[5,-9,-8,4,-9,4,7,10,7]",
     *     )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns a user token",
     *     @OA\JsonContent(
     *          @OA\Property(property="token", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Returns a error message",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error/missing parameters",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided credentials are incorrect."),
     *     )
     *     ),
     *
     * )
     * @param Request $request
     * @return int
     */
    public function first(Request $request)
    {

        $arr = $request->all();
        if (is_array($arr)) {
            sort($arr);

            for ($i = 0; $i < count($arr); $i++) {
                if ($arr[$i] < 0) {

                    unset($arr[$i]);
                } else {
                    $arr = array_values($arr);
                    break;
                }
            }

            $smallestPositiveInt = $arr[0];

            for ($i = 1; $i < count($arr); $i++) {
                //if it's a duplicate
                if ($arr[$i] == $smallestPositiveInt) {
                    continue;
                } //if it's in sequence
                elseif ($arr[$i] == $smallestPositiveInt + 1) {
                    $smallestPositiveInt++;
                    continue;
                } elseif ($arr[$i] > $smallestPositiveInt + 1) {
                    $smallestPositiveInt++;
                    break;
                }
            }

            //if nothing is missing from sequence, return a possible extra integer
            if ($smallestPositiveInt == end($arr)) {
                $smallestPositiveInt++;
            }

            return $smallestPositiveInt;
        }


    }
}
