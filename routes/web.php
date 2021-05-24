<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthenticationController;
use \App\Http\Controllers\LoanController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('login', [AuthenticationController::class, 'index'])->name('login');
    Route::get('register', [AuthenticationController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthenticationController::class, 'process_registration'])->name('register.api');
});

Route::group(['middleware' => ['guest']], function(){
    Route::post('post-login', [AuthenticationController::class, 'process_login'])->name('login.api');
});

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('dashboard', [AuthenticationController::class, 'dashboard'])->name('dashboard');
    Route::get('process-loan', [LoanController::class, 'loan_view'])->name('process-loan');
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});







