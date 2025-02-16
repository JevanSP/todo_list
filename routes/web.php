<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;


Route::get('/', [TodoListController::class, 'index']);
Route::post('/todo/store', [TodoListController::class, 'store'])->name('todo.store');
Route::put('/todo/update/{id}', [TodoListController::class, 'update'])->name('todo.update');
Route::delete('/todo/destroy/{id}', [TodoListController::class, 'destroy'])->name('todo.destroy');
Route::put('/todo/selesai/{id}', [TodoListController::class, 'Done'])->name('todo.done');
Route::put('/todo/kembalikan/{id}', [TodoListController::class, 'Undone'])->name('todo.undo');
