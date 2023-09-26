<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/users/create', [RegisteredUserController::class, 'create'])
    ->name('register');

    Route::post('/users/create', [RegisteredUserController::class, 'store']);    

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

    Route::get('/movies',[MovieController::class,'index']);
    Route::get('/movies/{id}',[MovieController::class,'detail'])->name('movies.detail');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

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
    Route::post('/admin/reservations',[ReservationController::class,'admStore'])->name('adm.reserv.store');
    Route::get('/admin/reservations/{id}/edit',[ReservationController::class,'admDetail'])->name('adm.reserv.detail');
    Route::get('/admin/reservations/{id}',[ReservationController::class,'admDetail'])->name('adm.reserv.edit');
    Route::patch('/admin/reservations/{id}',[ReservationController::class,'admUpdate'])->name('adm.reserv.update');
    Route::delete('/admin/reservations/{id}',[ReservationController::class,'admDestory'])->name('adm.reserv.destory');
            
});
