<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

Route::get('/', [IndexController::class,"index"])->name('home');
Route::get('/add-student', [IndexController::class,"addStudent"])->name('add.student');
Route::post('/add-student', [IndexController::class,"saveStudent"]);
Route::get('/edit-student/{id}', [IndexController::class,"editStudent"])->name('edit.student');
Route::post('/update-student/{id}', [IndexController::class,"updateStudent"])->name('update.student');
Route::post('/delete-student', [IndexController::class,"deleteStudent"])->name('delete.student');


Route::get('view-student-mark', [IndexController::class,"viewStudentMark"])->name('view.student.mark');
Route::get('/add-student-mark', [IndexController::class,"addStudentMark"])->name('add.student.mark');
Route::post('/add-student-mark', [IndexController::class,"saveStudentMark"]);
Route::get('/edit-student-mark/{id}', [IndexController::class,"editStudentMark"])->name('edit.student.mark');
Route::post('/update-student-mark/{id}', [IndexController::class,"updateStudentMark"])->name('update.student.mark');
Route::post('/delete-student-mark', [IndexController::class,"deleteStudentMark"])->name('delete.student.mark');

