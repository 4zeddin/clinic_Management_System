<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Home Routes
Route::prefix('home')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Home route
    Route::get('/', [HomeController::class, 'redirect'])->name('home');

    // Appointments routes
    Route::prefix('/appointments')->group(function () {
        Route::get('/', [HomeController::class, 'ShowAppointments'])->name('appointments.home.index');
        Route::post('/', [HomeController::class, 'StoreAppointments'])->name('appointments.home.store');
        Route::delete('/{id}', [HomeController::class, 'DeleteAppointments'])->name('appointments.home.destroy');
    });
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/make_appointment', [HomeController::class, 'indexAppointment'])->name('appointment.make');

// Admin Routes
Route::prefix('/admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::post('/add_doctor', [AdminController::class, 'store'])->name('doctor.store');
    Route::get('/add_doctor', [AdminController::class, 'index'])->name('doctor.add');
    Route::get('/notify/{id}', [AdminController::class, 'notify'])->name('notify');
    Route::post('/send/{id}', [AdminController::class, 'sendEmail'])->name('email.send');
    Route::get('/approved/{id}', [AdminController::class, 'approved'])->name('approved');
    Route::get('/canceled/{id}', [AdminController::class, 'canceled'])->name('canceled');
    Route::get('/showdoctors', [AdminController::class, 'showDoctors'])->name('doctors.index');
    Route::get('/delete/{id}', [AdminController::class, 'deleteDoctors'])->name('doctor.delete');
    Route::get('/edit/{id}', [AdminController::class, 'editDoctors'])->name('doctor.edit');
    Route::post('/update/{id}', [AdminController::class, 'updateDoctors'])->name('doctor.update');
    Route::get('/vacation-requests', [AdminController::class, 'viewVacationRequests'])->name('vacation.index');
    Route::get('/vacations-requests/approve/{id}', [AdminController::class, 'approveRequest'])->name('req.approved');
    Route::get('/vacations-requests/reject/{id}', [AdminController::class, 'rejectRequest'])->name('req.canceled');
});

// Doctor Routes
Route::prefix('doctor')->group(function () {
    // Display the doctor login form
    Route::get('/login', function () {
        return view('doctor.login');
    })->name('doctor.login.form');

    // Handle doctor login
    Route::post('/login', [DoctorController::class, 'login'])->name('doctor.login');

    Route::middleware('auth:doctor')->group(function () {
        Route::get('/home', [DoctorController::class, 'index'])->name('doctor.home');

        // Appointments
        Route::get('/appointments', [DoctorController::class, 'AllAppointments'])->name('doctor.appointments');
        Route::get('/approved/{id}', [DoctorController::class, 'approved'])->name('doctor.approved');
        Route::get('/canceled/{id}', [DoctorController::class, 'canceled'])->name('doctor.canceled');

        // Vacation Requests
        Route::get('/vacation', [DoctorController::class, 'showVacationForm'])->name('doctor.vacation.form');
        Route::post('/vacation', [DoctorController::class, 'submitVacationRequest'])->name('doctor.vacation.submit');
        Route::get('/vacations', [DoctorController::class, 'viewVacationRequests'])->name('doctor.vacations');

        // Profile
        Route::get('/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
        Route::post('/edit', [DoctorController::class, 'updateProfile'])->name('doctor.profile.edit');
        Route::post('/logout', [DoctorController::class, 'logout'])->name('doctor.profile.logout');
    });
});
