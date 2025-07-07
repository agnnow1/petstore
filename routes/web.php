<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', fn () => view('home'))->name('home');

Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');

Route::get('/pets/search-by-status', [PetController::class, 'findByStatus'])->name('pets.findByStatus');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'editPost'])->name('pets.update');
Route::get('/pets/search-by-id', [PetController::class, 'findById'])->name('pets.findById');
Route::delete('/pets', [PetController::class, 'delete'])->name('pets.delete');
Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::post('/pets/create', [PetController::class, 'createPost'])->name('pets.store');


