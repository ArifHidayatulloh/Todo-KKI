<?php

use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RelatedPicController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get("/", [IndexController::class, 'login']);
Route::post("/loginAction", [IndexController::class, 'loginAction']);
Route::get("/logout", [IndexController::class, 'logout']);
Route::get("/dashboard", [IndexController::class, 'dashboard']);

Route::controller(DepartemenController::class)->prefix('departemen')->group(function () {
    Route::get('/index','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{departemen}','edit');
    Route::post('/update/{departemen}','update');
    Route::get('/destroy/{departemen}','destroy');
});

Route::controller(KaryawanController::class)->prefix('karyawan')->group(function () {
    Route::get('/index','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{karyawan}','edit');
    Route::post('/update/{karyawan}','update');
    Route::get('/destroy/{karyawan}','destroy');
});

Route::controller(TerminalController::class)->prefix('terminal')->group(function () {
    Route::get('/index','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{terminal}','edit');
    Route::post('/update/{terminal}','update');
    Route::get('/destroy/{terminal}','destroy');
});

Route::controller(RelatedPicController::class)->prefix('relatedpic')->group(function () {
    Route::get('/index','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/edit/{relatedpic}','edit');
    Route::post('/update/{relatedpic}','update');
    Route::get('/destroy/{relatedpic}','destroy');
});

Route::controller(TodoController::class)->prefix('todo')->group(function () {
    Route::get('/index','index');
    Route::get('/create','create');
    Route::post('/store','store');
    Route::get('/filterStatus','filterStatus');
    Route::get('/edit/{todo}','edit');
    Route::post('/update/{todo}','update');
    Route::post('/updatePIC/{todo}','updatePIC');
    Route::get('/destroy/{todo}','destroy');
    Route::get('/export', 'export');
});
