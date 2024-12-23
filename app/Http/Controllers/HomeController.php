<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        
        return view('home/home', [
            'title' => 'Home',
            'menu' => 'Home',
            'submenu' => '',
            'post_count' => Post::latest()->filter(request(['search', 'category', 'user'])),
            'posts' => Post::latest()->filter(request(['search', 'category', 'user']))->paginate(7)->withQueryString(),
            'categories' => Category::withCount('posts')->get()
        ]);
    }
}
