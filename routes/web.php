<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;

Route::get('/tool', [ToolController::class, 'index'])->name('KDTool');

Route::get('/', function () {
    return view('welcome');
})->name('home');
