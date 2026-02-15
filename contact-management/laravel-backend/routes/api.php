<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthApiKey;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'register'])->name('register');
Route::post('/users/login', [UserController::class, 'login'])->name('login');

Route::middleware(AuthApiKey::class)->group(function () {
    Route::get('/users/current', [UserController::class, 'current'])->name('user.current');
    Route::patch('/users/current', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/contacts', [ContactController::class, 'create'])->name('contact.create');
    Route::get('/contacts', [ContactController::class, 'search'])->name('contact.search');
    Route::get('/contacts/{contact:id}', [ContactController::class, 'get'])->name('contact.get');
    Route::patch('/contacts/{contact:id}', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contacts/{contact:id}', [ContactController::class, 'delete'])->name('contact.delete');
    Route::post('/contacts/{contact:id}/addresses', [AddressController::class, 'create'])->name('address.create');
    Route::get('/contacts/{contact:id}/addresses', [AddressController::class, 'index'])->name('address.index');
    Route::get('/contacts/{contact:id}/addresses/{address:id}', [AddressController::class, 'get'])->name('address.get');
    Route::patch('/contacts/{contact:id}/addresses/{address:id}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/contacts/{contact:id}/addresses/{address:id}', [AddressController::class, 'delete'])->name('address.delete');
});
