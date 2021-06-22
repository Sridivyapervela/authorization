<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        \Log::info("entered");
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        \Log::info("user created");
        $token = $user->createToken("LaravelAuthApp")->accessToken;

        return response()->json(["token" => $token], 200);
    }
}
