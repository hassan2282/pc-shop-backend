<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdmNotificationController;
use App\Http\Controllers\Admin\AdmPermissionController;
use App\Http\Controllers\Admin\AdmRoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Support\Facades\Route;


Route::group([], function () {
    Route::get('productsForHome', [\App\Http\Controllers\ProductController::class, 'productsForHome']);
    Route::get('productsWithFilters', [\App\Http\Controllers\ProductController::class, 'productsWithFilters']);
    Route::get('singleProduct/{id}', [\App\Http\Controllers\ProductController::class, 'singleProduct']);
    Route::get('blogShow', [\App\Http\Controllers\ArticleController::class, 'blogShow']);
    Route::get('allBlogs', [\App\Http\Controllers\ArticleController::class, 'index']);
    Route::get('singleBlog/{id}', [\App\Http\Controllers\ArticleController::class, 'singleBlog']);
    Route::get('/category/all', [\App\Http\Controllers\Admin\AdmCategoryController::class, 'all']);
    Route::apiResource('userTicket', TicketController::class);
});

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
    Route::post('phone-verify', [VerificationCodeController::class, 'store']);
    Route::post('check-verify', [VerificationCodeController::class, 'checkVerify']);
    Route::post('forget-password', [VerificationCodeController::class, 'forgetPassword']);
    Route::post('email-verify', [VerificationCodeController::class, 'checkEmailCode']);
    Route::post('new-pass', [VerificationCodeController::class, 'setNewPassword']);
    Route::post('rm-code', [VerificationCodeController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('profile-avatar', [AuthController::class, 'avatar']);
    Route::get('user-notify', [AuthController::class, 'userNotify']);
    Route::get('provinces', [ProvinceController::class, 'index']);
    Route::get('cities/{id}', [CityController::class, 'find']);
    Route::post('address', [AddressController::class, 'create']);
    Route::get('user-address/{id}', [AddressController::class, 'find']);
    Route::delete('delete-address/{id}', [AddressController::class, 'delete']);
    Route::apiResource('orders', OrderController::class);
    Route::post('order/user-info', [OrderController::class, 'userInfo']);
    Route::get('last-order', [OrderController::class, 'lastOrder']);
});

// Start Admin Panel Routes

Route::group([
    'middleware' => ['api', 'admin'],
    'prefix' => 'admin'
], function () {
    Route::middleware('can:superAdmin')->apiResource('admGate', \App\Http\Controllers\Admin\AdmGateController::class);
    Route::post('gateGuard', [\App\Http\Controllers\Admin\AdmGateController::class, 'gateGuard']);
    Route::middleware('can:users')->apiResource('users', \App\Http\Controllers\Admin\AdmUserController::class);
    Route::post('users/changeStatus/{id}', [\App\Http\Controllers\Admin\AdmUserController::class, 'changeStatus']);
    Route::middleware('can:permissions')->apiResource('roles', \App\Http\Controllers\Admin\AdmRoleController::class);
    Route::middleware('can:permissions')->get('/role/all', [AdmRoleController::class, 'all']);
    Route::middleware('can:permissions')->apiResource('permissions', \App\Http\Controllers\Admin\AdmPermissionController::class);
    Route::middleware('can:permissions')->get('/permission/all', [AdmPermissionController::class, 'all']);
    Route::apiResource('categories', \App\Http\Controllers\Admin\AdmCategoryController::class);
    Route::middleware('can:articles')->apiResource('articles', \App\Http\Controllers\Admin\AdmArticleController::class);
    Route::middleware('can:products')->apiResource('products', \App\Http\Controllers\Admin\AdmProductController::class);
    Route::delete('removeProductPic/{id}', [\App\Http\Controllers\Admin\AdmProductController::class, 'removeProductPic']);
    Route::apiResource('tickets', \App\Http\Controllers\Admin\AdmTicketController::class);
    Route::apiResource('conversations', \App\Http\Controllers\Admin\AdmConversationController::class);
    Route::apiResource('tags', \App\Http\Controllers\Admin\AdmTagController::class);
    Route::post('/articles/editor', [\App\Http\Controllers\Admin\AdmEditorMediaController::class, 'store']);
    Route::delete('/articles/delete-image/{id}', [\App\Http\Controllers\Admin\AdmEditorMediaController::class, 'destroy']);
    Route::apiResource('orders', \App\Http\Controllers\Admin\AdmOrderController::class);
    Route::apiResource('transactions', \App\Http\Controllers\TransactionController::class);
    Route::get('getRole', [AdmRoleController::class, 'getRole']);
    Route::get('/notifications/all', [AdmNotificationController::class, 'all']);
    Route::get('/notifications/show', [AdmNotificationController::class, 'show']);
});

// End Admin Panel Routes
