<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index'])->name('index');
Route::get('/movies/{id}', [MovieController::class, 'showMovie'])->name('movie');

Route::get('/admin/movies', [MovieController::class, 'showAdmin'])->name('adminMovies');

Route::get('/admin/movies/create', [MovieController::class, 'showCreate'])->name('showCreate');
Route::post('/admin/movies/store', [MovieController::class, 'store'])->name('store');
Route::get('/admin/movies/store', [MovieController::class, 'showStore'])->name('showStore');

Route::get('/admin/movies/{id}', [MovieController::class, 'showAdminMovie'])->name('adminMovieId');
Route::get('/admin/movies/{id}/edit/', [MovieController::class, 'edit'])->name('edit');
Route::patch('/admin/movies/{id}/update/', [MovieController::class, 'update'])->name('update');
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'delete'])->name('destroy');
Route::get('/admin/movies/{id}/destroy', [MovieController::class, 'delete']);
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'scheduleCreate'])->name('scheduleCreate');
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'scheduleStore'])->name('scheduleStore');

Route::get('/admin/schedules', [ScheduleController::class, 'showSchedules'])->name('schedules');
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'showScheduleManage'])->name('scheduleManage');
Route::get('/admin/schedules/{scheduleId}/edit', [ScheduleController::class, 'showScheduleEdit'])->name('scheduleEdit');
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'ScheduleUpdate'])->name('scheduleUpdate');
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'scheduleDelete'])->name('scheduleDestroy');

Route::get('/sheets', [SheetController::class, 'showSheetsPage'])->name('sheets');

Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [ReservationController::class, 'showSheets'])->name('reserveSheet');
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'showReserveCreate'])->name('reserveCreate');

Route::post('/reservations/store', [ReservationController::class, 'reserveStore'])->name('reserveStore');

Route::get('/admin/reservations', [ReservationController::class, 'showReservations'])->name('adminReservations');
Route::post('/admin/reservations/create', [ReservationController::class, 'showReservationsCreate'])->name('valueToReservationCreate');
Route::get('/admin/reservations/create', [ReservationController::class, 'showReservationsCreate'])->name('adminReservationsCreate');
Route::post('/admin/reservations/store', [ReservationController::class, 'adminReservationsStore'])->name('adminReservationsStore');
Route::get('/admin/reservations/{id}/pre-edit', [ReservationController::class, 'showAdminReservationsPreEdit'])->name('adminReservationsPreEdit');
Route::post('/admin/reservations/{id}/edit', [ReservationController::class, 'showAdminReservationsEdit'])->name('adminReservationsEdit');
Route::get('/admin/reservations/{id}/edit', [ReservationController::class, 'showAdminReservationsEdit']);
Route::patch('/admin/reservations/{id}', [ReservationController::class, 'adminReservationUpdate'])->name('adminReservationUpdate');
Route::delete('/admin/reservations/{id}', [ReservationController::class, 'ReservationDelete'])->name('ReservationDelete');

Route::get('/users/create',[UserController::class,'showSignInPage'])->name('signIn');
Route::post('/users/create',[UserController::class,'userRegister'])->name('register');
