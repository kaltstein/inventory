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
    return redirect()->route('login');
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
Route::post('/hardware/create', [\App\Http\Controllers\HardwareController::class, 'create'])->name('hardware.create');
Route::get('/hardware/edit/{id}', [\App\Http\Controllers\HardwareController::class, 'edit'])->name('hardware.edit');
// Route::get('/hardware/destroy/{id}', [\App\Http\Controllers\HardwareController::class, 'destroy'])->name('hardware.destroy');
Route::post('/hardware/update', [\App\Http\Controllers\HardwareController::class, 'update'])->name('hardware.update');

//SOFTWARES
Route::get('/softwares', [\App\Http\Controllers\SoftwareController::class, 'index'])->name('software');
Route::get('/softwares/list', [\App\Http\Controllers\SoftwareController::class, 'list'])->name('software.list');
Route::get('/softwares/details/{id}', [\App\Http\Controllers\SoftwareController::class, 'show'])->name('software.details');
Route::post('/softwares/create', [\App\Http\Controllers\SoftwareController::class, 'create'])->name('software.create');
Route::get('/softwares/edit/{id}', [\App\Http\Controllers\SoftwareController::class, 'edit'])->name('software.edit');
// Route::get('/softwares/destroy/{id}', [\App\Http\Controllers\SoftwareController::class, 'destroy'])->name('software.destroy');
Route::post('/softwares/update', [\App\Http\Controllers\SoftwareController::class, 'update'])->name('software.update');
Route::post('/softwares/assign', [\App\Http\Controllers\SoftwareController::class, 'assign'])->name('software.assign');

//MAC
Route::get('/mac', [\App\Http\Controllers\MACController::class, 'index'])->name('mac');
Route::get('/mac/list', [\App\Http\Controllers\MACController::class, 'list'])->name('mac.list');
Route::post('/mac/create', [\App\Http\Controllers\MACController::class, 'create'])->name('mac.create');
Route::get('/mac/edit/{id}', [\App\Http\Controllers\MACController::class, 'edit'])->name('mac.edit');
Route::get('/mac/details/{id}', [\App\Http\Controllers\MACController::class, 'show'])->name('mac.details');
// Route::get('/hardware/destroy/{id}', [\App\Http\Controllers\HardwareController::class, 'destroy'])->name('hardware.destroy');
Route::post('/mac/update', [\App\Http\Controllers\MACController::class, 'update'])->name('mac.update');


//MAC
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/list', [\App\Http\Controllers\DashboardController::class, 'list'])->name('dashboard.list');
