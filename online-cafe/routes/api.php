<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ChecksController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\RoomController;
use App\Models\User;
use App\Http\Controllers\api\ProductController;
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

Route::get('/abobakr', function (Request $request) {
    return response()->json(["data" => "test"]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->get('/testapi', function (Request $request) {
    return response()->json(["message" => "New post added successfully"]);
});


Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::get("/order/latest", [OrderController::class, 'latest'])->name('latestOrder');
    Route::get("/order/cancel/{id}", [OrderController::class, 'cancelOrder'])->name('latestOrder');
    Route::get("/order/products/{id}", [OrderController::class, 'getOrderProducts'])->name('orderProducts');
    Route::apiResource('/order', OrderController::class);

    Route::get("/users", function () {
        return User::all();
    });

    Route::apiResource('/rooms', RoomController::class);
    Route::apiResource("/products", ProductController::class);
    Route::apiResource("/categories", CategoryController::class);
    Route::put("/products/available/{product}", [ProductController::class, 'available']);
    // ... Other routes
});

//Route::apiResource("/checks",ChecksController::class);
Route::post('/checks', [ChecksController::class, 'store']);
Route::get('/checks', [ChecksController::class, 'index']);


Route::post('/checks/products', [ChecksController::class, 'getProducts']);
