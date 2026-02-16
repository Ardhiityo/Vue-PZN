<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        unset($data['password_confirmation']);

        $data['username'] = Str::slug($data['username']);

        $user = User::create($data);

        return new UserResource($user)
            ->response()->setStatusCode(201);
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = User::where('username', $data['username'])->first();
            $user->token = Str::uuid()->toString();
            $user->save();

            return new UserResource($user);
        }

        throw new HttpResponseException(response([
            'username' => ['Username or password is wrong']
        ], 400));
    }

    public function current(Request $request)
    {
        $user = User::where('token', Auth::user()->token)->first();
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $data['password'] = isset($data['password']) ? Hash::make($data['password']) :  $user->username;

        $user->update($data);

        return new UserResource($user);
    }

    public function logout()
    {
        $user = Auth::user();

        $user->token = null;

        $user->save();

        return response()->json([
            'data' => true
        ]);
    }
}
