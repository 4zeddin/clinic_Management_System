<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth','verified');
Route::get('/add_doctor', [AdminController::class, 'index']);
Route::post('/add_doctor', [AdminController::class, 'store'])->name('doctor.store');
Route::post('/home', [HomeController::class, 'StoreAppointments'])->name('appointment.store');
Route::get('/home/appointments', [HomeController::class, 'ShowAppointments'])->name('appointments.show');
Route::get('/cancel/{id}', [HomeController::class, 'DeleteAppointments'])->name('appointments.delete');
Route::get('/showappointments', [AdminController::class, 'showAppointments'])->name('showappointments');
Route::get('/notify/{id}', [AdminController::class, 'notify'])->name('notify');
Route::post('/send/{id}', [AdminController::class, 'sendEmail'])->name('email.send');
Route::get('/approved/{id}', [AdminController::class, 'approved'])->name('approved');
Route::get('/canceled/{id}', [AdminController::class, 'canceled'])->name('canceled');
Route::get('/showdoctors', [AdminController::class, 'showDoctors'])->name('show.doctors');
Route::get('/delete/{id}', [AdminController::class, 'deleteDoctors'])->name('doctor.delete');
Route::get('/edit/{id}', [AdminController::class, 'editDoctors'])->name('doctor.edit');
Route::post('/update/{id}', [AdminController::class, 'updateDoctors'])->name('doctor.update');
// Route::get('/doctor/{id}', [AdminController::class, 'showDoctor'])->name('doctor.show');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
