<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
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


//Route::group([
//    'middleware' => 'auth:api',
//    'prefix' => 'site'
//], function (){
//    Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Route::get('/change_password', [UserController::class, 'index']);
//Route::post('/change_password/update_password', [UserController::class, 'store'])->name('update_password');
////Route::get('/my_register', function () {
////    return view('auth.register');
////});
////Route::post('/my_register/submit', [UserController::class, 'register'])->name('my_register');
//
//Route::get('/product', [ProductController::class, 'index']);
//Route::get('/product/create', [ProductController::class, 'create']);
//Route::post('/product/create/submit', [ProductController::class, 'store'])->name('create-product');
//});
//
//Route::post('register', [RegisterController::class, 'register'])->name('register');
//Route::get('login', [LoginController::class, 'login'])->name('login');
