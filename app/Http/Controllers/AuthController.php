<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
			'message' => 'User registered'
		], 201);
	}
}
