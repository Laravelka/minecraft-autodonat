<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->get('email'))
            ->first();

        if ($user && Hash::check($request->get('password'), $user->password)) {
            $token = $user->createToken('login', ['*'], $request->remember ? now()->addWeeks(2) : null)->plainTextToken;

            return response()->json([
                'user' => UserResource::make($user),
                'token' => $token,
                'message' => 'Вы вошли успешно.'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Ошибка, пароль или email введен неверно.'
        ], 401);
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = (new User())->create(
            array_merge($request->all(), [
                'password' => Hash::make($request->get('password'))
            ])
        );
        event(new Registered($user));
        $token = $user->createToken('register')->plainTextToken;

        return response()->json([
            'user' => UserResource::make($user),
            'token' => $token,
            'message' => 'Вы успешно зарегистрированы.'
        ]);
    }
}
