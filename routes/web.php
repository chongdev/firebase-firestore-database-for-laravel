<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\FirebaseController::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\FirebaseController::class, 'store'])->name('contact.store');
Route::get('/create', [App\Http\Controllers\FirebaseController::class, 'create'])->name('contact.create');
Route::delete('/{id}', [App\Http\Controllers\FirebaseController::class, 'destroy'])->name('contact.destroy');
Route::get('/{id}', [App\Http\Controllers\FirebaseController::class, 'edit'])->name('contact.edit');
Route::put('/{id}', [App\Http\Controllers\FirebaseController::class, 'update'])->name('contact.update');
