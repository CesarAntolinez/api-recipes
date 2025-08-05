<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::query()->firstWhere('email', $request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => 'Unauthorized'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response([
            'data' => [
                'attributes' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ],
                'token_type' => 'bearer',
                'access_token' => $token,
            ]
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
