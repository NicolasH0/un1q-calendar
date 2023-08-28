<?php

use App\Domains\EventsApi\Http\Controllers\EventsApiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events',  [EventsApiController::class, 'getEvents'])->name('events');
Route::delete('/delete/{id}',  [EventsApiController::class, 'delete'])->name('delete');
Route::get('/create',  [EventsApiController::class, 'store'])->name('store');
Route::patch('/update',  [EventsApiController::class, 'update'])->name('update');
