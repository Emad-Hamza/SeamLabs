<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Customer login
     * @OA\Post(
     *     path="/login",
     *     tags={"login"},
     *     summary="Authenticates customer and returns token.",
     *
     *     @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *          @OA\Property(property="email", type="email",example="emad.aldin.hamza@gmail.com"),
     *          @OA\Property(property="password", type="password",example="123456789"),
     *          @OA\Property(property="device_name", type="string",example="self"),
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
     */
    public function login(Request $request)
    {
//        $user = new User();
//        $user->password = Hash::make('123456789');
//        $user->email = 'emad.aldin.hamza@gmail.com';
//        $user->name = 'Emad';
//        $user->save();


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            ]);

        $user = User::where('email', $request->email)->first();
//        dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {

            return new JsonResponse(['message' => 'The provided credentials are incorrect.'], 401);

//            throw ValidationException::withMessages([
//                'email' => ['The provided credentials are incorrect.'],
//            ]);

        }

        return ['token' => $user->createToken($request->device_name)->plainTextToken];
    }


}
