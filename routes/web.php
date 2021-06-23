<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\AdminController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/change_password', [UserController::class, 'index']);
Route::post('/change_password/update_password', [UserController::class, 'store'])->name('update_password');



Route::post('/product/create/submit', [ProductController::class, 'store'])->name('create-product');
Route::post('/product/update/data/{id}', [ProductController::class, 'update']);
Route::get('product/display/{id}', [ProductController::class,'show']);
Route::resource('product', ProductController::class);

Route::post('/product/update/image/{productId}/{imageId}', [ImagesController::class, 'update']);
Route::post('/product/delete/image/{imageId}', [ImagesController::class, 'delete']);
//Route::get('/admin_page', [AdminController::class, 'log_in']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin-page');
Route::post('/admin/login', [AdminController::class, 'log_in'])->name('admin-login');

Route::resource('admin/color', ColorController::class);
