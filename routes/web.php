<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::group([
    'prefix' => 'payments'
], function () {
    Route::get('/pay', [\App\Http\Controllers\PesapalController::class, 'payment'])->name('payments.pay');
    Route::get('donepayment', ['as' => 'paymentsuccess', 'uses'=>'PesapalController@paymentsuccess']);
    Route::get('paymentconfirmation', 'PesapalController@paymentconfirmation');
});

Route::group([
    'prefix' => 'notifications'
], function () {
    Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['admin']
], function () {
    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    });
});
