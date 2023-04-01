<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'
], function ($router) {
    /**
     * Auth management route
     */
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::group([
        'middleware' => 'auth:api',
    ], function ($router) {

        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('verify_token', [AuthController::class, 'verify_token']);
        Route::get('userinfo', [AuthController::class, 'userinfo']);
        Route::post('userinfo', [AuthController::class, 'update_userinfo']);
 
});
// frontend
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
});