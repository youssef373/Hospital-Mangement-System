<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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

Route::get('/home', [HomeController::class, 'redirect'])
        ->middleware('auth', 'verified');
Route::get('/', [HomeController::class, 'index']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class, 'addDoctorView']);
Route::match(['get', 'post'],'/add_doctor', [AdminController::class, 'addDoctor']);
Route::get('/show_doctors_view', [AdminController::class, 'showDoctorsView']);
Route::get('/update_doctor_view/{id}', [AdminController::class, 'updateDoctorView']);
Route::match(['get','post'],'/update_doctor/{id}', [AdminController::class, 'updateDoctor']);
Route::get('/delete_doctor/{id}', [AdminController::class, 'deleteDoctor']);
Route::get('/show_appointments_admin', [AdminController::class, 'showAppointments']);
Route::get('/approve_appointment/{id}', [AdminController::class, 'approveAppointment']);
Route::get('/cancel_appointment/{id}', [AdminController::class, 'cancelAppointment']);
Route::get('/email_view/{id}', [AdminController::class, 'sendEmailView']);
Route::match(['get', 'post'],'/send_email/{id}', [AdminController::class, 'sendEmail']);

Route::get('/doctors_view', [HomeController::class, 'doctorsView']);
Route::match(['get', 'post'],'/create_appoint', [HomeController::class, 'makeAppointment']);
Route::get('/show_appointments', [HomeController::class, 'showUserAppointments']);
Route::get('/delete_appointment/{id}', [HomeController::class, 'deleteAppointment']);












