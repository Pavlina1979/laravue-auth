<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
  ]);
})->name('home');

Route::get('dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/ukoly', [TaskController::class, 'index'])->middleware('auth')->name('tasks.index');
Route::post('/ukoly', [TaskController::class, 'store'])->middleware('auth')->name('tasks.store');
Route::get('/ukoly/vytvorit', [TaskController::class, 'create'])->middleware('auth')->name('tasks.create');
Route::get('/ukoly/hotove', [TaskController::class, 'filtrHotove'])->middleware('auth')->name('tasks.hotove');
Route::get('/ukoly/nehotove', [TaskController::class, 'filtrNehotove'])->middleware('auth')->name('tasks.nehotove');
// Route::get('/{id}', [TaskController::class, 'show'])->middleware('auth')->name('tasks.show');
Route::get('/ukoly/{id}/upravit', [TaskController::class, 'edit'])->middleware('auth')->name('tasks.edit');
Route::put('/ukoly/{id}', [TaskController::class, 'update'])->middleware('auth')->name('tasks.update');
Route::delete('/ukoly/{id}/delete', [TaskController::class, 'destroy'])->middleware('auth')->name('tasks.destroy');

require __DIR__ . '/settings.php';
