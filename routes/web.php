<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;



Route::get('/', [StudentController::class, 'index'])->name('home');
Route::post('/add-student', [StudentController::class, 'addStudent'])->name('addStudent');

Route::post('/delete-student/{id}', [StudentController::class, 'delete'])->name('delete.Student');
