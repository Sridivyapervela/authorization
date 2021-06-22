<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()
                ->user()
                ->createToken("LaravelAuthorization")->accessToken;
            return response()->json(["token" => $token], 200);
        } else {
            return response()->json(["error" => "Unauthorised"], 401);
        }
    }
}
