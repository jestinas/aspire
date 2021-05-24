<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::post('process-loan', [LoanController::class, 'process_loan'])->name('process-loan.api');
    Route::get('loans', [LoanController::class, 'get_loans'])->name('get-loans.api');
    Route::get('loans/{loan_id}', [LoanController::class, 'get_loans_details'])->name('get-loan-details.api');
    Route::post('loans/payment/{loan_id}', [LoanController::class, 'make_loan_payment'])->name('loan-payment.api');
});
