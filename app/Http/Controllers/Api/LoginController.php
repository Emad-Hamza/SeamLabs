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
