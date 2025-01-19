<?php

namespace App\Http\Controllers\Categories;

use App\Http\Requests\Categories\CategoriesRequest;
use App\Models\Categories;

use Illuminate\Routing\Controller;


class CategoriesController extends Controller
{
	public function index()
	{
		try {
			$categories = Categories::all();
			if ($categories->isEmpty()) {
				return response()->json(['data' => []], 200);
			}
			return response()->json(['data' => $categories], 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}

	public function show($id) {
		$category = Categories::find($id);
		if ($category) return response()->json($category, 200);
		else return response()->json(['message' => 'Category not found'], 404);
	}

	public function store(CategoriesRequest $request) {
		try {
			$validatedData = $request->validated();

			$categoryName = $validatedData['name'];
			$categoryImage = $request->file('image');

			$category = new Categories();
			$category->name = $categoryName;

			if ($categoryImage) {
				$imagePath = $categoryImage->store('images', 'public');
				$category->image = $imagePath;
			}

			$category->save();

			return response()->json([ 'message' => 'New category was added'], 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}

	public function updateCategory($id, CategoriesRequest $request) {
		try {
			$validatedData = $request->validated();

			$category = Categories::find($id);

			if (!$category) {
				return response()->json(['message' => 'Category not found'], 404);
			}

			$category->name = $validatedData['name'];

			if ($request->hasFile('image')) {
				$imagePath = $request->file('image')->store('images', 'public');
				$category->image = $imagePath;
			}

			$category->save();

			return response()->json(['message' => 'Category updated successfully'], 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}


	public function deleteCategory($id) {
		try {
			$category = Categories::find($id);
			if (!$category) {
				return response()->json(['message' => 'Category not found'], 404);
			}
			$category->delete();
			return response()->json('Category deleted', 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}
}
