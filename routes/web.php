<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('newstudent', [App\Http\Controllers\StudentController::class, 'newstudent'])->name('newstudent');
Route::get('studentlist', [App\Http\Controllers\StudentController::class, 'studentlist'])->name('studentlist');
Route::get('marklist', [App\Http\Controllers\StudentController::class, 'marklist'])->name('marklist');
Route::get('ajaxstudentslist', [App\Http\Controllers\StudentController::class, 'ajaxstudentslist'])->name('ajaxstudentslist');
Route::get('ajaxmarklist', [App\Http\Controllers\StudentController::class, 'ajaxmarklist'])->name('ajaxmarklist');
Route::get('newstudentmark', [App\Http\Controllers\StudentController::class, 'newstudentmark'])->name('newstudentmark');


Route::post('add_student', [App\Http\Controllers\StudentController::class, 'add_student'])->name('add_student');
Route::post('student_details', [App\Http\Controllers\StudentController::class, 'student_details'])->name('student_details');
Route::post('student_delete', [App\Http\Controllers\StudentController::class, 'student_delete'])->name('student_delete');
Route::post('student_update', [App\Http\Controllers\StudentController::class, 'student_update'])->name('student_update');
Route::post('add_studentmark', [App\Http\Controllers\StudentController::class, 'add_studentmark'])->name('add_studentmark');
Route::post('studentmark_delete', [App\Http\Controllers\StudentController::class, 'studentmark_delete'])->name('studentmark_delete');
Route::post('studentmark_details', [App\Http\Controllers\StudentController::class, 'studentmark_details'])->name('studentmark_details');
Route::post('studentmark_update', [App\Http\Controllers\StudentController::class, 'studentmark_update'])->name('studentmark_update');
