<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [FormController::class, 'index'])->name('form.index');
Route::post('/submit', [FormController::class, 'store'])->name('form.store');
