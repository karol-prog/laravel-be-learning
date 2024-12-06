<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function register(AuthRequest $request) {

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
		], 201);
	}

	public function login(Request $request)
	{
		$request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		// Find user by email
		$user = User::where('email', $request->email)->first();

		if (!$user || !Hash::check($request->password, $user->password)) {
			return response()->json([
				'status' => 'error',
				'message' => 'Invalid email or password'
			], 401);
		}

		$token = $user->createToken($request->token_name ?? 'default_token');

		return response()->json([
			'status' => 'success',
			'message' => 'User logged in',
			'user' => $user,
			'token' => $token->plainTextToken
		], 201);
	}
}