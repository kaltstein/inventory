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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

//EMPLOYEES
Route::get('/employee', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/list', [\App\Http\Controllers\EmployeeController::class, 'list'])->name('employee.list');
Route::get('/employee/details/{id}', [\App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.details');

//HARDWARES
Route::get('/hardwares', [\App\Http\Controllers\HardwareController::class, 'index'])->name('hardware');
Route::get('/hardware/list', [\App\Http\Controllers\HardwareController::class, 'list'])->name('hardware.list');

//SOFTWARES
//HARDWARES
Route::get('/softwares', [\App\Http\Controllers\SoftwareController::class, 'index'])->name('software');
Route::get('/softwares/list', [\App\Http\Controllers\SoftwareController::class, 'list'])->name('software.list');
