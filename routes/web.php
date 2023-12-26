<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });

Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('tags', \App\Http\Controllers\TagController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('product_tag', \App\Http\Controllers\Product_tagController::class);



Route::resource('groups', GroupController::class);
Route::get('/detail/{id}', [GroupController::class, 'detail'])->name('group.detail');
Route::put('/group_detail/{id}', [GroupController::class, 'group_detail'])->name('group.group_detail');
Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
Route::delete('destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/checklogin', [LoginController::class, 'checklogin'])->name('checklogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::get('/forget-password', [LoginController::class, 'forgetPass'])->name('user.forgetPass');
Route::post('/forget-password', [LoginController::class, 'postForgetPass']);
Route::get('/get-password/{user}/{token}', [LoginController::class, 'getPass'])->name('user.getPass');
Route::post('/get-password/{user}/{token}', [LoginController::class, 'postGetPass']);


