<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Brands\BrandsController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Location\LocationController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1/auth')->group(function () {
	Route::post('/register', [AuthController::class, 'register']);
	Route::post('/login', [AuthController::class, 'login']);
});

//BRANDS
Route::middleware('auth:sanctum')->group(function () {
	Route::prefix('v1/brands')->controller(BrandsController::class)->group(function () {
		Route::get('/allBrands', 'index');
		Route::get('/brand/{id}', 'show');
		Route::post('/addNewBrand', 'store');
		Route::put('/updateBrand/{id}', 'updateBrand');
		Route::delete('/deleteBrand/{id}', 'deleteBrand');
	});
});

//CATEGORIES
Route::middleware('auth:sanctum')->group(function (): void {
	Route::prefix('v1/categories')->controller(CategoriesController::class)->group(function () {
		Route::get('/allCategories', 'index');
		Route::get('/category/{id}', 'show');
		Route::post('/addNewCategory', 'store');
		Route::post('/updateCategory/{id}', 'updateCategory');
		Route::delete('/deleteCategory/{id}', 'deleteCategory');
	});
});

//LOCATIONS
Route::middleware('auth:sanctum')->group(function () {
	Route::prefix('v1/locations')->controller(LocationController::class)->group(function () {
		// Route::get('/allLocations', 'index');
		// Route::get('/location/{id}', 'show');
		Route::post('/addNewLocation', 'store');
		Route::put('/updateLocation/{id}', 'updateLocation');
		Route::delete('/deleteLocation/{id}', 'deleteLocation');
	});
});