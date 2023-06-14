<?php

use App\Http\Controllers\dep_fac_stu_subController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students_marksController;
use App\Http\Controllers\sub_markController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/',[Students_marksController::class, 'index']);

Route::resource('/', Students_marksController::class);

//Route::get('edit/{roll_num}',[Students_marksController::class, 'edit']);
//Route::put('update-edit/{roll_num}',[Students_marksController::class, 'update']);
//Route::get('create', [Students_marksController::class, 'create']);
Route::post('create', [Students_marksController::class, 'store']);
Route::get('update-edit/{roll_num}', [Students_marksController::class, 'edit'])->name('update-edit');
Route::post('update-edit/{roll_num}',[Students_marksController::class, 'update'])->name('update-edit');
Route::get('contact-view/{roll_num}',[Students_marksController::class, 'show'])->name('contact-view');
Route::delete('/{roll_num}', [Students_marksController::class, 'destroy'])->name('students.destroy');
Route::get('/search',[Students_marksController::class, 'search']);
Route::post('add-marks/{roll_num}', [Students_marksController::class, 'addMarks'])->name('add-marks');







//Route::get('/edit{roll_num}',[Students_marksController::class, 'edit']);
//Route::get('/edit{roll_num}', 'App\Http\Controllers\Students_marksController@edit');
//Route::put('/edit{roll_num}', 'App\Http\Controllers\Students_marksController@updateByRollNum')->name('students.updateByRollNum');




//Route::get('/store',[Students_marksController::class, 'create']);
//Route::get('college',[sub_markController::class, 'index']);
//Route::get('college',[dep_fac_stu_subController::class, 'index']);