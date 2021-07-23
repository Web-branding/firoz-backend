<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MarriageController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\OtherController;

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

//education
Route::get('education-list', [EducationController::class, 'education'])->name('education.view');
Route::get('ed-update&{id}', [EducationController::class, 'edit'])->name('education.edit');
Route::post('ed-update', [EducationController::class, 'update'])->name('education.update');
Route::get('ed-details&{id}', [EducationController::class, 'show'])->name('education.show');
Route::post('ed-accept-reject', [EducationController::class, 'accept'])->name('education.accept');
Route::delete('ed-delete', [EducationController::class, 'destroy'])->name('education.destroy');
Route::match(['get', 'post'],'ed-search', [EducationController::class, 'search'])->name('education.id');
Route::match(['get', 'post'],'ed-sort', [EducationController::class, 'sort'])->name('education.sort');
//marriage
Route::get('marriage-list', [MarriageController::class, 'marriage'])->name('marriage.view');
Route::get('m-update&{id}', [MarriageController::class, 'edit'])->name('marriage.edit');
Route::post('m-update', [MarriageController::class, 'update'])->name('marriage.update');
Route::get('m-details&{id}', [MarriageController::class, 'show'])->name('marriage.show');
Route::post('m-accept-reject', [MarriageController::class, 'accept'])->name('marriage.accept');
Route::delete('m-delete', [MarriageController::class, 'destroy'])->name('marriage.destroy');
Route::match(['get', 'post'],'m-search', [MarriageController::class, 'search'])->name('marriage.id');
Route::match(['get', 'post'],'m-sort', [MarriageController::class, 'sort'])->name('marriage.sort');
//treatment
Route::get('treatment-list', [TreatmentController::class, 'treatment'])->name('treatment.view');
Route::get('trt-update&{id}', [TreatmentController::class, 'edit'])->name('treatment.edit');
Route::post('trt-update', [TreatmentController::class, 'update'])->name('treatment.update');
Route::get('trt-details&{id}', [TreatmentController::class, 'show'])->name('treatment.show');
Route::post('trt-accept-reject', [TreatmentController::class, 'accept'])->name('treatment.accept');
Route::delete('trt-delete', [TreatmentController::class, 'destroy'])->name('treatment.destroy');
Route::match(['get', 'post'],'trt-search', [TreatmentController::class, 'search'])->name('treatment.id');
Route::match(['get', 'post'],'trt-sort', [TreatmentController::class, 'sort'])->name('treatment.sort');
//others
Route::get('other-list', [OtherController::class, 'other'])->name('other.view');
Route::get('oth-update&{id}', [OtherController::class, 'edit'])->name('other.edit');
Route::post('oth-update', [OtherController::class, 'update'])->name('other.update');
Route::get('oth-details&{id}', [OtherController::class, 'show'])->name('other.show');
Route::post('oth-accept-reject', [OtherController::class, 'accept'])->name('other.accept');
Route::delete('oth-delete', [OtherController::class, 'destroy'])->name('other.destroy');
Route::match(['get', 'post'],'oth-search', [OtherController::class, 'search'])->name('other.id');
Route::match(['get', 'post'],'oth-sort', [OtherController::class, 'sort'])->name('other.sort');

// Route::get('add', [ApplicationController::class, 'add_fn'])->name('add.applicant');
// Route::post('add', [ApplicationController::class, 'add'])->name('applicant.add');

// Route::get('application-list', [ApplicationController::class, 'index'])->name('application.view');
// Route::get('update&{id}', [ApplicationController::class, 'edit'])->name('applicant.edit');
// Route::post('update', [ApplicationController::class, 'update'])->name('applicant.update');
// Route::get('details&{id}', [ApplicationController::class, 'show'])->name('applicant.show');
// Route::post('accept-reject', [ApplicationController::class, 'accept'])->name('accept.reject');
// Route::delete('delete', [ApplicationController::class, 'destroy'])->name('applicant.destroy');
// Route::match(['get', 'post'],'search', [ApplicationController::class, 'search'])->name('search.id');
// Route::match(['get', 'post'],'sort', [ApplicationController::class, 'sort'])->name('sort.view');

Route::get('download&{file}',[ApplicationController::class,'download'])->name('file.download');
Route::get('view&{id}',[ApplicationController::class,'view'])->name('file.view');

Route::get('slide-list', [ApplicationController::class, 'index'])->name('slides.view');
Route::get('slide', [ApplicationController::class, 'slide'])->name('add.slide');
Route::post('slide', [ApplicationController::class, 'add_slide'])->name('slide.add');
Route::delete('delete-slide', [ApplicationController::class, 'destroy_slide'])->name('slide.destroy');