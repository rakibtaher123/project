<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.welcome');
// });


// frontend
Route::get('/', [HomeController::class,'index']);


// backend
Route::get('/admin', [AdminController::class,'index']);
Route::get('/dashboard', [AdminController::class,'dashboard']);
Route::post('/admin-dashboard', [AdminController::class,'show_dashboard']);
Route::get('/logout', [AdminController::class,'logout']);

Route::resource('categories', CategoryController::class);
Route::get('/categories/{category}', [CategoryController::class,'change_status']);


Route::resource('subcategories', SubCategoryController::class);
Route::get('/subcategories/{subcategory}', [SubCategoryController::class,'change_status']);


Route::resource('brands', BrandController::class);
Route::get('/brands/{brand}', [BrandController::class,'change_status']);

Route::resource('units', UnitController::class);
Route::get('/units/{unit}', [UnitController::class,'change_status']);

Route::resource('sizes', SizeController::class);
Route::get('/sizes/{size}', [SizeController::class,'change_status']);

Route::resource('colors', ColorController::class);
Route::get('/colors/{color}', [ColorController::class,'change_status']);


Route::resource('products', ProductController::class);
Route::get('/products/{product}', [ProductController::class,'change_status']);



