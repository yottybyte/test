<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegistrationRequest;
use App\Http\Services\Logging;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function registration(RegistrationRequest $request, Logging $logging)
    {
        $payload = $request->validated();

        $user = User::create($payload);
        $token = $user->createToken('auth');

        $logging->authLog([
            'status' => true
        ]);
        return response()
            ->json(['success' => true, 'token' => $token->plainTextToken], 200)
            ->withCookie(cookie('token', $token->plainTextToken));
    }
    public function login(LoginRequest $request, Logging $logging)
    {
        $payload = $request->validated();

        if(!Auth::attempt($payload)) {
            $logging->authLog([
                'status' => false
            ]);

            return response()
                ->json([
                "errors" => [
                    "auth" => [
                        "Указаны неверные учетные данные"
                    ]
                ]
            ], 422);
        }

        $token = Auth::user()->createToken('auth');

        $logging->authLog([
            'status' => true
        ]);

        return response()
            ->json(['success' => true, 'token' => $token->plainTextToken], 200)
            ->withCookie(cookie('token', $token->plainTextToken));
    }
}
