<?php

namespace App\Http\Controllers\Location;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Locations\LocationRequest;

use Illuminate\Routing\Controller;

use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
		try {
			$validated = $request->validated();

			Location::create([
				'street' => $validated['street'],
				'building' => $validated['building'],
				'area' => $validated['area'],
				'user_id' => Auth::id()
			]);

			return response()->json([
				'message' => 'Location added successfully'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'Error adding location'
			], 500);
		}
	}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}