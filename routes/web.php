<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function() {

    /**
     * Login
     */
    Route::get('login', [App\Http\Controllers\AuthAdmin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\AuthAdmin\LoginController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout/', [App\Http\Controllers\AuthAdmin\LoginController::class, 'logout'])->name('admin.logout');
        Route::resource('/inquiries',InquiryController::class);
        Route::resource('/packages', PackageController::class);
        Route::resource('/photos', PhotoController::class);
        Route::resource('/comments', CommentController::class);
        Route::get('/comments/{package_id}/show', [CommentController::class, 'showRelatedComments'])->name('admin.showRelatedComments');
        Route::resource('/bookings', BookingController::class);
        Route::get('/users', [App\Http\Controllers\Admin\DashboardController::class, 'showUsers'])->name('admin.showUsers');
    });
});