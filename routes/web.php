<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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

Route::resource('students',StudentController::class);
Route::patch('statuschange',[StudentController::class,'statuschange']);

Route::get('addsubject/{id}',[StudentController::class,'addsubject'])->name('addsubject');
Route::post('subjectstore',[StudentController::class,'subjectstore'])->name('subjectstore');

