<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
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

Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('index');
    Route::get('/admin/create-user', [AdminController::class, 'create'])->name('create');
    Route::post('/admin/create-user', [AdminController::class, 'store'])->name('store');
    Route::get('/admin/edit-user/{user}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/admin/edit-user/{user}', [AdminController::class, 'update'])->name('update');
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'role:doctor'])->name('doctor.')->group(function () {
    // Route::get('/doctor', [DoctorController::class, 'index']);
});

Route::middleware(['auth', 'role:patient'])->name('patient.')->group(function () {
    Route::get('/patient', [PostController::class, 'index'])->name('index');
    Route::post('/create-post', [PostController::class, 'create'])->name('create');
    Route::get('/edit-post/{post}', [PostController::class, 'edit'])->name('edit');
    Route::put('/edit-post/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/delete-post/{post}', [PostController::class, 'destroy'])->name('destroy');
});
