<?php

use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageHomeController::class, 'index'])->name('home');
