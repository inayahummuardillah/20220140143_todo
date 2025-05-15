<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/todo', [TodoController::class, 'index']) ->name('todo.index');
    Route::get('todo/create', [TodoController::class, 'create']) ->name('todo.create');
    Route::get('todo/edit', [TodoController::class, 'edit']) ->name('todo.edit');

    //Edit Data – Todo
    Route::get('todo/{todo}/edit', [TodoController::class, 'edit']) ->name('todo.edit');
    Route::patch('todo/{todo}', [TodoController::class, 'update']) ->name('todo.update');

    //Update Data – Complete dan Incomplete Todo
    Route::patch('todo/{todo}/complete', [TodoController::class, 'complete']) ->name('todo.complete');
    Route::patch('todo/{todo}/incomplete', [TodoController::class, 'uncomplete']) ->name('todo.uncomplete');

    //Delete Data – Todo
    Route::delete('todo/{todo}', [TodoController::class, 'destroy']) ->name('todo.destroy');
    Route::delete('/todo', [TodoController::class, 'destroyCompleted'])->name('todo.deleteallcompleted');

    //Delete Data – User
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // //Update Data – Make Admin dan Remove Admin
    // Route::patch('user/{user}/makeadmin', [UserController::class, 'makeadmin']) ->name('user.makeadmin');
    // Route::patch('user/{user}/removeadmin', [UserController::class, 'removeadmin']) ->name('user.removeadmin');

    Route::get('/user',[UserController::class, 'index'])-> name('user.index');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class)->except(['show']);
    Route::patch('user/{user}/makeadmin', [UserController::class, 'makeadmin']) ->name('user.makeadmin');
    Route::patch('user/{user}/removeadmin', [UserController::class, 'removeadmin']) ->name('user.removeadmin');
});

require __DIR__.'/auth.php';