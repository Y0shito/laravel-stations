<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;

/*
|-------------------------------------------------------------------------
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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);

Route::get('/getPractice', [PracticeController::class, 'getPractice']);

Route::get('/movies', [MovieController::class, 'index'])->name('index');

Route::get('/admin/movies', [MovieController::class, 'showAdmin'])->name('adminMovies');

Route::get('/admin/movies/create', [MovieController::class, 'showCreate']);

Route::post('/admin/movies/store', [MovieController::class, 'store'])->name('store');
Route::get('/admin/movies/store', [MovieController::class, 'showStore'])->name('showStore');

Route::get('/admin/movies/{id}/edit/', [MovieController::class, 'edit'])->name('edit');

Route::patch('/admin/movies/{id}/update/', [MovieController::class, 'update'])->name('update');

Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'delete'])->name('destroy');
Route::get('/admin/movies/{id}/destroy', [MovieController::class, 'delete']);

Route::get('/admin/schedules', [ScheduleController::class, 'showSchedules'])->name('schedules');
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'showScheduleManage'])->name('scheduleManage');

Route::get('/sheets', [SheetController::class, 'showSheetsPage'])->name('sheets');

Route::get('/movies/{id}', [MovieController::class, 'showMovie'])->name('movie');
