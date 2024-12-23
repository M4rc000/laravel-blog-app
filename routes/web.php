<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ROOT
Route::get('/', function () {
    return redirect('auth');
});

// USER NOT AUTHENTICATED
Route::middleware(['guest'])->group(function () {
    Route::get('auth/', [AuthController::class, 'index'])->name('login');

    Route::post('auth/login', [AuthController::class, 'authenticate']);

    Route::get('auth/register', [AuthController::class, 'register']);
});

Route::post('auth/register', [AuthController::class, 'store']);

Route::post('auth/logout', [AuthController::class, 'logout']);


// USER AUTHENTICATED
Route::middleware('auth')->group(function () {
    Route::get('/user', function () {
        return redirect('/user/profile');
    });

    Route::get('home', [HomeController::class, 'index']);

    Route::get('my-post/all', [PostController::class, 'personal_post']);

    Route::get('my-post/newPost', [PostController::class, 'new_post']);

    Route::get('my-post/editPost/{post:slug}', [PostController::class, 'edit_post']);
    
    Route::post('my-post/updatePost/{post:slug}', [PostController::class, 'update_post']);
    
    Route::get('my-post/saveEditPost', [PostController::class, 'save_edit_post']);
    
    Route::post('my-post/createPost', [PostController::class, 'create_post']);

    Route::post('my-post/deletePost/{post:slug}', [PostController::class, 'delete_post']);
    
    Route::get('my-post/createSlug', [PostController::class, 'checkSlug']);

    Route::get('my-post/{category:slug}', [PostController::class, 'personal_post_per_category']);

    Route::get('user/profile', [UserController::class, 'index']);

    Route::post('user/edit', [UserController::class, 'update_user']);

    Route::get('blog', [PostController::class, 'index']);
    
    Route::get('blog/{post:slug}', [PostController::class, 'show']);
    
    Route::get('my-post/detail/{post:slug}', [PostController::class, 'show']);
    
    Route::get('categories/', [CategoryController::class, 'show_categories']);

    Route::get('settings/', [UserController::class, 'settings']);

    Route::get('explore/all', [PostController::class, 'explore_all']);

    Route::get('explore/{category:slug}', [PostController::class, 'explore_per_category']);
});
