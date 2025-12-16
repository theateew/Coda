<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Notes
    Route::resource('notes', NoteController::class);
    Route::post('/notes/{note}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.toggle-pin');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Settings - TAMBAHKAN INI
    Route::get('/settings', [App\Http\Controllers\UserSettingsController::class, 'index'])->name('user.settings');
    Route::put('/settings/profile', [App\Http\Controllers\UserSettingsController::class, 'updateProfile'])->name('user.settings.profile');
    Route::put('/settings/password', [App\Http\Controllers\UserSettingsController::class, 'updatePassword'])->name('user.settings.password');
    
    // Notes
    Route::resource('notes', NoteController::class);
    Route::post('/notes/{note}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.toggle-pin');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
    });
});

