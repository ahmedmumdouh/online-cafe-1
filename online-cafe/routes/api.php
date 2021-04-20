<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\OrderController;
use App\Models\Order;

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

Route::middleware('auth:sanctum')->get('/testapi', function (Request $request) {
    return response()->json(["message" => "New post added successfully"]);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::apiResource('projects', 'ProjectsApiController');
    Route::apiResource("/categories", CategoryController::class);



    Route::apiResource('/order', OrderController::class);


    // ... Other routes
});
