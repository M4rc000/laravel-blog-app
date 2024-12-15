<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show_a_user_post(User $user){
        return view('user_post', [
            'title' => $user->name,
            'name' => $user->name,
            'posts' => $user->posts
        ]);
    }
    
    public function about(){
        
        return view('about',[
            'title' => 'About',
            'user' => User::first(),
            'studentID' => '001202100075',
            'email' => 'marcoantoniomadgaskar@gmail.com',
            'major' => 'IT',
            'categories' => Category::withCount('posts')->get()
        ]);
    }
}
