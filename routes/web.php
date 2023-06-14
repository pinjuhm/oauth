<?php

use App\Http\Controllers\dep_fac_stu_subController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students_marksController;
use App\Http\Controllers\sub_markController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return Redirect::route('login');
});



Route::middleware('auth')->resource('/', Students_marksController::class);

//Route::resource('/', Students_marksController::class);


Route::post('create', [Students_marksController::class, 'store']);
Route::get('update-edit/{roll_num}', [Students_marksController::class, 'edit'])->name('update-edit');
Route::post('update-edit/{roll_num}',[Students_marksController::class, 'update'])->name('update-edit');
Route::get('contact-view/{roll_num}',[Students_marksController::class, 'show'])->name('contact-view');
Route::delete('/{roll_num}', [Students_marksController::class, 'destroy'])->name('students.destroy');
Route::get('/search',[Students_marksController::class, 'search']);
Route::post('add-marks/{roll_num}', [Students_marksController::class, 'addMarks'])->name('add-marks');
//nesto moje
Route::get('/login', [Students_marksController::class, 'showLoginForm'])->name('login');
Route::post('/login', [Students_marksController::class, 'login']);
Route::get('/logout',[Students_marksController::class, 'logout'])->name('logout');
//registracija
Route::get('/registration', [Students_marksController::class, 'registration'])->name('register-user');
Route::post('/custom-registration', [Students_marksController::class, 'customRegistration'])->name('register.custom');
//ovo je za admina
Route::get('/loginadmin', [Students_marksController::class, 'showLoginFormadmin'])->name('loginadmin');
Route::post('/loginadmin', [Students_marksController::class, 'loginadmin']);
Route::get('/index', [Students_marksController::class, 'index'])->name('index');


 






