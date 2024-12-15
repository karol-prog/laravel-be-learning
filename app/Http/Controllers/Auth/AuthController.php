<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function register(AuthRegisterRequest $request) {

		$newUser = $request->validated();

		$user = User::create([
			'name' => $newUser['name'],
			'email' => $newUser['email'],
			'password' => Hash::make($newUser['password'])
		]);

		return response()->json([
			'status' => 'success',
			'message' => 'User registered',
			'user' => $user,
		], 200);
	}

	public function login(AuthLoginRequest $request)
	{
		$userLogin = $request->validated();

		$user = User::where('email', $userLogin['email'])->first();

		if (!$user || !Hash::check($userLogin['password'], $user->password)) {
			return response()->json([
				'status' => 'error',
				'message' => 'Invalid email or password'
			], 400);
		}

		$token = $user->createToken('token')->plainTextToken;

		return response()->json([
			'status' => 'success',
			'message' => 'User logged in',
			'user' => $user,
			'token' => $token
		], 200);
	}
}