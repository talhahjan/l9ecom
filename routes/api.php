<?php

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

    Route::group(['as' => 'api.', 'prefix' => '/','middleware'=>'auth:api'], function () {
    Route::get('user/cart',['App\Http\Controllers\Api\UserController', 'cart'])->name('user.cart');
    Route::get('user/favorites',['App\Http\Controllers\Api\UserController', 'favorites'])->name('user.favorites');
    Route::get("user/profile", ['App\Http\Controllers\Api\UserController', 'profile'])->name('user.profile');
    Route::post("user/profile/edit", ['App\Http\Controllers\Api\UserController', 'updateProfile'])->name('update.profile');
    });
    
    Route::group(['as' => 'api.', 'prefix' => '/'], function () {
    Route::get("sections", ['App\Http\Controllers\Api\ApiController', 'fetchSections'])->name('sections');
    Route::get("product/{slug}", ['App\Http\Controllers\Api\ApiController', 'fetchProduct'])->name('product');
    Route::get("section/{section}", ['App\Http\Controllers\Api\ApiController', 'fetchSection'])->name('section');
    Route::get("category/{category}", ['App\Http\Controllers\Api\ApiController', 'fetchCategory'])->name('category');
    Route::get("brands", ['App\Http\Controllers\Api\ApiController', 'fetchBrands'])->name('brands');
    Route::get("brands/popular", ['App\Http\Controllers\Api\ApiController', 'BrandsWithLogoes'])->name('popular-brands');
    Route::get("products/latest", ['App\Http\Controllers\Api\ApiController', 'getLatestProduct'])->name('latest-products');
    Route::get("products/featured", ['App\Http\Controllers\Api\ApiController', 'getFeaturedProduct'])->name('featured-products');
    Route::post("login", ['App\Http\Controllers\Api\AuthController', 'login'])->name('login');
    Route::post("register", ['App\Http\Controllers\Api\AuthController', 'register'])->name('register');
    });
