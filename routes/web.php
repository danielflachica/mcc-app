<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        $posts = [];
        // if (Auth::check()) { // Check if user is authenticated
        //     $posts = Auth::user()->posts()->latest()->get();
        if (Auth::check()) { // Check if user is authenticated
            $posts = Auth::user()->posts()->latest()->get();
        }
        return view('/landing', ['posts' => $posts]);
    })->name('home');

    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');

    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::get('/create-user', [AdminController::class, 'create'])->name('create');
    Route::post('/create-user', [AdminController::class, 'store'])->name('store');
    Route::get('/edit-user/{user}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/edit-user/{user}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete-user/{user}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'role:provider'])->prefix('/provider')->name('provider.')->group(function () {
    Route::get('', [ProviderController::class, 'index'])->name('index');

    Route::name('schedule.')->prefix('/schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('create');
        Route::post('/create', [ScheduleController::class, 'store'])->name('store');
        Route::get('/edit/{schedule}', [ScheduleController::class, 'edit'])->name('edit');
        Route::put('/edit/{schedule}', [ScheduleController::class, 'update'])->name('update');
        Route::delete('/delete/{schedule}', [ScheduleController::class, 'destroy'])->name('destroy');
    });

    Route::name('appointment.')->group(function () {
        Route::get('/appointments', function () {
            return 'Provider Appointments';
        })->name('index');
    });
});

Route::middleware(['auth', 'role:client'])->prefix('/client')->name('client.')->group(function () {
    Route::get('', [ClientController::class, 'index'])->name('index');

    Route::name('appointment.')->group(function () {
        Route::get('/appointments', function () {
            return 'My Appointments';
        })->name('index');
    });

    // Route::post('/create-post', [PostController::class, 'create'])->name('create');
    // Route::get('/edit-post/{post}', [PostController::class, 'edit'])->name('edit');
    // Route::put('/edit-post/{post}', [PostController::class, 'update'])->name('update');
    // Route::delete('/delete-post/{post}', [PostController::class, 'destroy'])->name('destroy');
});
