<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('home');

Route::prefix('/task')->group(function () {
    Route::post('', [TaskController::class, 'store'])->name('task.create');
    Route::put('/{task}', [TaskController::class, 'update']);
    Route::put('/order/{task}', [TaskController::class, 'reorder'])->name('task.order');
    Route::get('/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::delete('/{task}', [TaskController::class, 'destroy']);
});
