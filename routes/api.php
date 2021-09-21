<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// create customers
Route::post('register', [AuthController::class, 'register']);

// logout

// authenticated route
Route::group(['middleware' => ['auth:sanctum']], function () {
    // get all customers
    Route::get('customers', [CustomerController::class, 'index']);
    // get a single customer
    Route::get('customers/{customer}', [CustomerController::class, 'show']);

    // all trnsactions
    Route::get('transactions', [TransactionController::class, 'index']);
    // single transactions
    Route::get('transactions/{transaction}', [TransactionController::class, 'show']);

    // send money
    Route::post('transactions/{send}', [TransactionController::class, 'store']);

    // logout
    Route::post('logout', [AuthController::class, 'logout']);
});
