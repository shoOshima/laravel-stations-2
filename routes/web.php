<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;

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

Route::get('/practice', [PracticeController::class,'sample']);
Route::get('/practice2', [PracticeController::class,'sample2']);
Route::get('/practice3', [PracticeController::class,'sample3']);
Route::get('/getPractice', [PracticeController::class,'getPractice']);
Route::get('/movies',[MovieController::class,'index']);
Route::get('/movies/{id}',[MovieController::class,'detail'])->name('movies.detail');
Route::get('/admin/movies',[MovieController::class,'admin_movies'])->name('movies');


Route::get('/admin/movies/{id}/edit',[MovieController::class,'edit'])->name('movies.edit');
Route::patch('/admin/movies/{id}/update',[MovieController::class,'update'])->name('movies.update');
Route::get('/admin/movies/create',[MovieController::class,'create']);
Route::get('/admin/movies/{id}',[MovieController::class,'admin_movie_detail'])->name('admin.movie');

Route::get('/sheets',[SheetController::class,'index']);

Route::post('/admin/movies/store',[MovieController::class,'store'])->name('movie.store');
Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'destroy'])->name('movies.destroy');

Route::post('/admin/movies/{id}/schedules/store',[ScheduleController::class,'store'])->name('admin.sch.store');
Route::get('/admin/schedules',[ScheduleController::class,'index']);
Route::get('/admin/schedules/{id}',[ScheduleController::class,'schedulesForMovie'])->name('admin.sch.detail');
Route::get('/admin/movies/{id}/schedules/create',[ScheduleController::class,'create'])->name('admin.sch.create');
Route::get('/admin/schedules/{scheduleId}/edit',[ScheduleController::class,'edit'])->name('admin.sch.edit');
Route::patch('/admin/schedules/{id}/update',[ScheduleController::class,'update']);
Route::delete('/admin/schedules/{id}/destroy',[ScheduleController::class,'destroy'])->name('admin.sch.destory');

Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets',[ReservationController::class,'index'])->name('reserv.showsheet');
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create',[ReservationController::class,'create'])->name('reserv.create');
Route::post('/reservations/store',[ReservationController::class,'store'])->name('reserv.store');

Route::get('/admin/reservations/',[ReservationController::class,'admIndex'])->name('adm.reserv.index');
Route::get('/admin/reservations/create',[ReservationController::class,'admCreate'])->name('adm.reserv.create');
Route::post('/admin/reservations',[ReservationController::class,'admStore'])->name('adm.reserv.adm.reserv.store');
Route::get('/admin/reservations/{id}',[ReservationController::class,'admDetail'])->name('adm.reserv.detail');
Route::put('/admin/reservations/{id}',[ReservationController::class,'admUpdate'])->name('adm.reserv.update');
Route::delete('/admin/reservations/{id}',[ReservationController::class,'admDestory'])->name('adm.reserv.destory');