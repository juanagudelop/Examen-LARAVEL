<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para el dashboard, protegido por autenticación
Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rutas relacionadas con tareas
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::post('dashboard/add', [TaskController::class, 'createTask'])->name('createTask');
    Route::get('dashboard/show/{id}', [TaskController::class, 'showTask'])->name('showTask');
    Route::put('dashboard/edit/{id}', [TaskController::class, 'updateTask'])->name('editTask');
    Route::put('/dashboard/complete/{id}', [TaskController::class, 'markAsCompleted'])->name('completeTask');
    Route::get('dashboard/delete/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');
});

// Rutas relacionadas con categorías
Route::prefix('categories')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('categories/add', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('categories/show/{id}', [CategoryController::class, 'showCategory'])->name('showCategory');
    Route::put('categories/edit/{id}', [CategoryController::class, 'setCategory'])->name('editCategory');
    Route::get('categories/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});

// Rutas relacionadas con el perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
