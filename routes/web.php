<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ApplicationController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('change-password', [ChangePasswordController::class, 'index'])->name('password.change');
Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
//applications
Route::get('application-list', [ApplicationController::class, 'application'])->name('application.view');
Route::get('update&{id}', [ApplicationController::class, 'edit'])->name('application.edit');
Route::post('update', [ApplicationController::class, 'update'])->name('application.update');
Route::get('details&{id}', [ApplicationController::class, 'show'])->name('application.show');
Route::post('accept-reject', [ApplicationController::class, 'accept'])->name('application.accept');
Route::delete('delete', [ApplicationController::class, 'destroy'])->name('application.destroy');

Route::match(['get', 'post'],'search', [ApplicationController::class, 'search'])->name('search.id');
Route::match(['get', 'post'],'sort', [ApplicationController::class, 'sort'])->name('sort.view');

Route::get('download&{file}',[ApplicationController::class,'download'])->name('file.download');
Route::get('view&{id}',[ApplicationController::class,'view'])->name('file.view');

Route::get('slide-list', [ApplicationController::class, 'index'])->name('slides.view');
Route::get('slide', [ApplicationController::class, 'slide'])->name('add.slide');
Route::post('slide', [ApplicationController::class, 'add_slide'])->name('slide.add');
Route::delete('delete-slide', [ApplicationController::class, 'destroy_slide'])->name('slide.destroy');

Route::get('video-list', [ApplicationController::class, 'videolist'])->name('video.view');
Route::get('video', [ApplicationController::class, 'video'])->name('add.video');
Route::post('video', [ApplicationController::class, 'add_video'])->name('video.add');
Route::delete('delete-video', [ApplicationController::class, 'destroy_video'])->name('video.destroy');
Route::get('display&{id}',[ApplicationController::class,'display'])->name('file.display');

Route::get('searchs&{id}', [ApplicationController::class, 'searchs_id'])->name('searchs.appid');

Route::get('/markAsRead',function(){
    auth()->user()->unreadNotifications->markAsRead();
});