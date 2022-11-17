<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class ProblemController extends Controller
{

    /**
     * First problem
     * @OA\Post(
     *     path="/problems/first",
     *     tags={"problems"},
     *     summary="First problem",
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
     *         description="Returns the smallest missing integer",
     *     ),
     *
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

    /**
     * Second problem
     * @OA\Get(
     *     path="/problems/second/{start}/{end}",
     *     tags={"problems"},
     *     summary="Second problem",
     *     @OA\Parameter(
     *         name="start",
     *         in="path",
     *         description="start integer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="end",
     *         in="path",
     *         description="end integer",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns count of all number except numbers that include the digit 5",
     *     ),
     *
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error/missing parameters",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided parameters are incorrect."),
     *     )
     *     ),
     *
     * )
     * @param Request $request
     * @param $first
     * @param $second
     * @return int
     */
    public function second(Request $request, int $first, int $second)
    {

        $counter = 0;
        for ($i = $first; $i < $second + 1; $i++) {
            if (!(str_contains("$i", "5"))) {
                $counter++;
            }
        }
        return $counter;

    }

    /**
     * Third problem
     * @OA\Get(
     *     path="/problems/third/{str}",
     *     tags={"problems"},
     *     summary="Third problem",
     *     @OA\Parameter(
     *         name="str",
     *         in="path",
     *         description="start integer",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="BFG"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns the alphabetic index of the string",
     *     ),
     *
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error/missing parameters",
     *     @OA\JsonContent(
     *          @OA\Property(property="message", type="string",example="The provided parameters are incorrect."),
     *     )
     *     ),
     *
     * )
     * @param Request $request
     * @param String $str
     * @return int
     */
    public function third(Request $request, String $str)
    {

        $sum = 0;
        $chars = str_split($str);
        for ($i = 0; $i < count($chars); $i++) {
            //using ascii value of individual letters to get its index
            $charIndex = ord(strtoupper($chars[$i])) - ord('A') + 1;

            //adding that letter's index based on its order in the string
            $sum = $sum * 26 + $charIndex;
        }
        return $sum;
    }

    /**
     * Fourth problem
     * @OA\Post(
     *     path="/problems/fourth",
     *     tags={"problems"},
     *     summary="Fourth problem",
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          @OA\Property(property="N", type="integer",example="1"),
     *          @OA\Property(property="Q", type="array",
     *          @OA\Items(
     *               type="integer"
     *     ),
     *     ),
     *     )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *
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
     * @return array|JsonResponse
     */
    public function fourth(Request $request)
    {

        $N = $request->get('N');
        $Q = $request->get('Q');

        if (count($Q) == $N) {
            $movesArr = [];

            foreach ($Q as $x) {
                $moves = 0;
                while ($x > 0){
                    $x = $this->minimizeInteger($x);
                    $moves++;
                }
                array_push($movesArr, $moves);
            }

            return $movesArr;


        } else {
            return new JsonResponse(['message' => "The size of the array Q does not equal N."], 422);
        }
    }

    public function minimizeInteger($x)
    {
//        $counter = 0;

        if (!$this->is_prime($x)) {
//            $counter++;
//            print_r($counter);
            $startingDivider = 2;
            while ($startingDivider<$x){
                if ($x % $startingDivider==0){
                    $x = $x / $startingDivider;
                    return $x;
                }
                else{
                    $startingDivider++;
                }
            }
        } else {
            $x--;
            return $x;
        }
    }

    function is_prime($num)
    {
        if ($num == 1)
            return 0;
        for ($i = 2; $i <= $num/2; $i++)
        {
            if ($num % $i == 0)
                return 0;
        }
        return 1;
    }



}
