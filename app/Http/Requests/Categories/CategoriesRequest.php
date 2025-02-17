<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		$rules = [
			'name' => 'required|string|max:255',
			'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
		];

		if ($this->isMethod('patch') || $this->isMethod('put')) {
			$rules['image'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		return $rules;
    }
}
