<?php

namespace App\Http\Controllers\Brands;

use App\Models\Brands;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Brands\BrandsRequest;
use Illuminate\Support\Facades\Log;

class BrandsController extends Controller
{
	public function index()
	{
		if (!Auth::check()) {
			return response()->json(['message' => 'Unauthorized'], 403);
		}

		$brands = Brands::paginate(10);
		return response()->json($brands, 200);
	}

	public function show($id) {
		if (!Auth::check()) {
			return response()->json(['message' => 'Unauthorized'], 403);
		}

		$brand = Brands::find($id);
		if ($brand) return response()->json($brand, 200);
		else return response()->json(['message' => 'Brand not found'], 404);
	}

	public function store(BrandsRequest $request) {
		try {
			$brandName = $request->validated();

			$brand = new Brands();
			$brand->name = $brandName['name'];
			$brand->save();

			return response()->json('new brand was added', 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}

	public function updateBrand($id, BrandsRequest $request) {
		try {
			$brandName = $request->validated();

			Brands::where('id', $id)->update(['name' => $brandName['name']]);
			return response()->json('Brand updated', 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}

	public function deleteBrand($id) {
		if (!Auth::check()) {
			return response()->json(['message' => 'Unauthorized'], 403);
		}

		try {
			Brands::find($id)->delete();
			return response()->json('Brand deleted', 200);
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 500);
		}
	}
}
