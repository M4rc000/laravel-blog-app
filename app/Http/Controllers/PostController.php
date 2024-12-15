<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){
        
        return view('blog', [
            'title' => 'Blog',
            'post_count' => Post::latest()->filter(request(['search', 'category', 'user']))->count(),
            'posts' => Post::latest()->filter(request(['search', 'category', 'user']))->paginate(7)->withQueryString(),
            'categories' => Category::withCount('posts')->get()
        ]);
    }

    public function personal_post()
    {
        $user_id = auth()->user()->id;

        // Filter posts for the authenticated user
        $query = Post::latest()
            ->where('user_id', $user_id)
            ->personalFilter(request(['search', 'category']));

        return view('my_post', [
            'title' => 'My Posts',
            'post_count' => $query->count(),
            'posts' => $query->paginate(7)->withQueryString(),
            'category' => 'all',
            'categories' => Category::withCount('posts')->get()
        ]);
    }
    
    public function personal_post_per_category(Category $category)
    {
        $user_id = auth()->user()->id;

        // Fetch posts by category slug and user
        $query = Post::with(['user', 'category'])
            ->where('user_id', $user_id)
            ->where('category_id', $category->id)
            ->postFilterCategory(request(['search']));

        return view('my_post', [
            'title' => 'My Posts',
            'posts' => $query->paginate(7)->withQueryString(),
            'category' => $category,
            'categories' => Category::withCount('posts')->get()
        ]);
    }
   
    public function show(Post $post){
        return view('ablog',[
            'title' => 'Single Blog',
            'post' => $post,
            'categories' => Category::withCount('posts')->get()
        ]);
    }
}
