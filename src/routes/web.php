<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index']);

Route::post('/confirm', [ContactController::class, 'confirm']);

Route::post('/back', [ContactController::class, 'back']);

Route::post('/thanks', [ContactController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth');

Route::get('/admin/export', [AdminController::class, 'export'])
    ->middleware('auth');

Route::delete('/admin/delete/{contact}', [AdminController::class, 'destroy'])
    ->middleware('auth');
