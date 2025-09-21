<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('update/{id}', [AuthController::class, 'update']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('profile-avatar', [AuthController::class, 'avatar']);
    Route::get('provinces', [ProvinceController::class, 'index']);
    Route::get('cities/{id}', [CityController::class, 'find']);
    Route::post('address', [AddressController::class, 'create']);
    Route::get('user-address/{id}', [AddressController::class, 'find']);
});
