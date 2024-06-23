<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\PublicPostController;
// Authentication routes


// Public routes
Route::get('/', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PublicPostController::class, 'show'])->name('posts.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Moderator routes
    Route::middleware('role:moderator')->group(function () {
        Route::resource('moderator/posts', AdminPostController::class)->except(['create', 'store', 'destroy'])->names('moderator.posts');
    });

    // Administrator routes
    Route::middleware('role:administrator')->group(function () {
        Route::resource('admin/posts', AdminPostController::class)->names('admin.posts');
        Route::resource('admin/categories', AdminCategoryController::class)->names('admin.categories');
    });
});

require __DIR__.'/auth.php';
