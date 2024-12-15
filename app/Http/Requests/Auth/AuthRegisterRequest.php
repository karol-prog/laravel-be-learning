<?php namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest {

	public function authorize() {
		return true;
	}

	public function rules() {
		return [
			'name' => 'required|string',
			'email' => 'required|email|unique:users',
			'password' => 'required|string|min:8'
		];
	}
}