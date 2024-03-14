<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EmpController::class, 'index']);
Route::post('emp-reorder', [EmpController::class, 'reorder']);
Route::post('emp-store', [EmpController::class, 'store'])->name('emp-store');
Route::post('emp-delete', [EmpController::class, 'delete'])->name('emp-delete');
Route::get('emp-edit', [EmpController::class, 'edit'])->name('emp-edit');
Route::post('emp-update', [EmpController::class, 'update'])->name('emp-update');

