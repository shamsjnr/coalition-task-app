<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('/task')->group(function () {
    Route::post('', [TaskController::class, 'store'])->name('task.create');
    Route::put('/{task}', [TaskController::class, 'update']);
    Route::put('/order/{task}', [TaskController::class, 'reorder'])->name('task.order');
    Route::get('/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::delete('/{task}', [TaskController::class, 'destroy']);
});

Route::prefix('/project')->group(function () {
    Route::post('', [ProjectController::class, 'store'])->name('project.create');
    Route::get('', [ProjectController::class, 'index']);
    Route::put('/{project}', [ProjectController::class, 'update']);
    Route::get('/{project}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::delete('/{project}', [ProjectController::class, 'destroy']);
});

Route::get('/{project?}', [TaskController::class, 'index'])->name('home');
