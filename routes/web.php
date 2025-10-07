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
    });

    Route::get('/login', function () {
        return view('/login');
    });

    Route::get('/register', function () {
        return view('/register');
    });

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});

Route::post('/logout', [UserController::class, 'logout']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/create-user', [AdminController::class, 'create']);
    Route::get('/admin/edit-user/{user}', [AdminController::class, 'edit']);
    Route::put('/admin/edit-user/{user}', [AdminController::class, 'update']);
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'destroy']);
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    // Route::get('/doctor', [DoctorController::class, 'index']);
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    // Route::get('/patient', [PatientController::class, 'index']);
    Route::post('/create-post', [PostController::class, 'create']);
    Route::get('/edit-post/{post}', [PostController::class, 'edit']);
    Route::put('/edit-post/{post}', [PostController::class, 'update']);
    Route::delete('/delete-post/{post}', [PostController::class, 'destroy']);
});
