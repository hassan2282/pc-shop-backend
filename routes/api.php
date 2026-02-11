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
    Route::post('update-password', [AuthController::class, 'update_password']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');;
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
    Route::delete('delete-address/{id}', [AddressController::class, 'delete']);
});

// Start Admin Panel Routes

Route::group([
    'middleware' => ['api', 'admin'],
    'prefix' => 'admin'
], function ()
{
    Route::apiResource('admGate', \App\Http\Controllers\Admin\AdmGateController::class);
    Route::post('gateGuard', [\App\Http\Controllers\Admin\AdmGateController::class, 'gateGuard']);
    Route::apiResource('users', \App\Http\Controllers\Admin\AdmUserController::class);
    Route::post('users/changeStatus/{id}', [\App\Http\Controllers\Admin\AdmUserController::class, 'changeStatus']);
    Route::apiResource('roles', \App\Http\Controllers\Admin\AdmRoleController::class);
    Route::apiResource('permissions', \App\Http\Controllers\Admin\AdmPermissionController::class);
    Route::apiResource('categories', \App\Http\Controllers\Admin\AdmCategoryController::class);
    Route::apiResource('articles', \App\Http\Controllers\Admin\AdmArticleController::class);
    Route::apiResource('products', \App\Http\Controllers\Admin\AdmProductController::class);
    Route::apiResource('tickets', \App\Http\Controllers\Admin\AdmTicketController::class);
    Route::apiResource('conversations', \App\Http\Controllers\Admin\AdmConversationController::class);
    Route::apiResource('tags', \App\Http\Controllers\Admin\AdmTagController::class);
    Route::post('/articles/editor', [\App\Http\Controllers\Admin\AdmEditorMediaController::class, 'store']);
    Route::delete('/articles/delete-image/{id}', [\App\Http\Controllers\Admin\AdmEditorMediaController::class, 'destroy']);
});

// End Admin Panel Routes
