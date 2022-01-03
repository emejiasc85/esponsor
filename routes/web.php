<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegistrationController::class, 'create'])->name('register');

Route::post('/register', [RegistrationController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/mis-productos', function () {
        return view('my_products');
    })->name('my-products');
});





