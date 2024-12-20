<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ROOT
Route::get('/', function () {
    return redirect('auth');
});


// USER NOT AUTHENTICATE
Route::middleware('guest')->group(function (){
    Route::get('auth/', [AuthController::class, 'index'])->name('login');

    Route::post('auth/login', [AuthController::class, 'authenticate']);

    Route::get('auth/register', [AuthController::class, 'register']);

});

Route::post('auth/register', [AuthController::class, 'store']);

Route::post('auth/logout', [AuthController::class, 'logout']);


// USER AUTHENTICATE
Route::middleware('auth')->group(function (){
    Route::get('home', [HomeController::class, 'index']); 
    
    Route::get('about', [UserController::class, 'about']);
        
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

    Route::get('blog', [PostController::class, 'index']);
    
    Route::get('blog/{post:slug}', [PostController::class, 'show']);
    
    Route::get('my-post/detail/{post:slug}', [PostController::class, 'show']);
    
    Route::get('categories/', [CategoryController::class, 'show_categories']);
});












// Route::get('categories/{category:slug}', [CategoryController::class, 'show_a_category']);

// Route::get('users/{user:username}', [UserController::class, 'show_a_user_post']);