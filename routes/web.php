<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
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
Route::get('/', [HomeController::class, 'index']);
Route::get('/view-detials/{id}', [HomeController::class, 'view_details']);
Route::get('/product-by-cat/{id}', [HomeController::class, 'product_by_cat']);
Route::get('/product-by-subcat/{id}', [HomeController::class, 'product_by_subcat']);
Route::get('/product-by-brand/{id}', [HomeController::class, 'product_by_brand']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/product-list', [HomeController::class, 'productAjax']);
Route::post('/add-to-cart', [CardController::class, 'add_to_cart']);
Route::get('/delete-cart/{id}', [CardController::class, 'delete']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::get('/login-check', [CheckoutController::class, 'login_chcek']);
Route::post('/shiping-address', [CheckoutController::class, 'shiping_address']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/customer-login', [CustomerController::class, 'login']);
Route::post('/customer-registration', [CustomerController::class, 'registration']);
Route::get('/customer-logout', [CustomerController::class, 'logout']);


// backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin-dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);

Route::resource('categories', CategoryController::class);
Route::get('/categories/{category}', [CategoryController::class, 'change_status']);


Route::resource('subcategories', SubCategoryController::class);
Route::get('/subcategories/{subcategory}', [SubCategoryController::class, 'change_status']);


Route::resource('brands', BrandController::class);
Route::get('/brands/{brand}', [BrandController::class, 'change_status']);

Route::resource('units', UnitController::class);
Route::get('/units/{unit}', [UnitController::class, 'change_status']);

Route::resource('sizes', SizeController::class);
Route::get('/sizes/{size}', [SizeController::class, 'change_status']);

Route::resource('colors', ColorController::class);
Route::get('/colors/{color}', [ColorController::class, 'change_status']);


Route::resource('products', ProductController::class);
Route::get('/products/{product}', [ProductController::class, 'change_status']);


Route::resource('banners', BannerController::class);
Route::get('/banners/{banner}', [BannerController::class, 'change_status']);


// order related routes
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{id}', [OrderController::class, 'view_order']);
Route::get('/manage-order/{id}', [OrderController::class, 'change_status']);
Route::delete('/manage-order/{id}', [OrderController::class, 'destroy'])->name('manage-order.destroy');
