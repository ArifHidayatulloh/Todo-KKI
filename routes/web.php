<?php

use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\DepartemenUserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


Route::get("/", [IndexController::class, 'login']);
Route::post("/loginAction", [IndexController::class, 'loginAction']);

Route::middleware(['auth.user'])->group(function () {

    Route::get("/logout", [IndexController::class, 'logout']);

    Route::get("/dashboard", [IndexController::class, 'dashboard']);
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
    // Routes/web.php
    Route::get('/notifications/fetch', [NotificationController::class, 'fetchNotifications']);


        Route::controller(DepartemenController::class)->prefix('departemen')->group(function () {
            Route::get('/index','index');
            Route::get('/create','create');
            Route::post('/store','store');
            Route::get('/edit/{departemen}','edit');
            Route::post('/update/{departemen}','update');
            Route::get('/destroy/{departemen}','destroy');
        });

        Route::controller(DepartemenUserController::class)->prefix('departemen_user')->group(function () {
            Route::get('/index','index');
            Route::get('/create','create');
            Route::post('/store','store');
            Route::get('/edit/{departemenUser}','edit');
            Route::post('/update/{departemenUser}','update');
            Route::get('/destroy/{departemenUser}','destroy');
        });

        Route::controller(KaryawanController::class)->prefix('karyawan')->group(function () {
            Route::get('/index','index');
            Route::get('/create','create');
            Route::post('/store','store');
            Route::get('/edit/{karyawan}','edit');
            Route::post('/update/{karyawan}','update');
            Route::get('/destroy/{karyawan}','destroy');
        });


    Route::controller(TodoController::class)->prefix('todo')->group(function () {
        Route::get('/index','index');
        Route::get('/create','create')->middleware('check.level:1,2');
        Route::post('/store','store')->middleware('check.level:1,2');
        Route::get('/filterStatus','filterStatus');
        Route::get('/edit/{todo}','edit')->middleware('check.level:1,2');
        Route::post('/update/{todo}','update')->middleware('check.level:1,2');
        Route::post('/updatePIC/{todo}','updatePIC');
        Route::get('/destroy/{todo}','destroy')->middleware('check.level:1,2');
        Route::get('/export', 'export');
        Route::get('/request', 'request');
        Route::get('/requestActionPic/{todo}','requestActionPic');
        Route::get('/approve/{todo}','approve');
        Route::post('/reject/{todo}','reject');
    });
});
