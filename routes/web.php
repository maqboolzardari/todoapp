<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/{id?}' , [TodoController::class , 'ShowTodo'])->name('todoapp');
Route::post('savetodoitem', [TodoController::class , 'SaveTodo'])->name('saveTodo');
Route::put('saveColor/{id}' , [TodoController::class , 'TodoSaveColor'])->name('todocolor');
Route::get('todoDone/{id}' , [TodoController::class , 'TodoUpdateStatus'])->name('todoUpdateStatus');
Route::get('deleteTodo/{id}' , [TodoController::class, 'Tododelete'])->name('deleteTodoItem');