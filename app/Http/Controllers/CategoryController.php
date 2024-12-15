<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show_categories()
    {
        return view('categories', [
            'title' => 'Categories',
            'categories' => Category::withCount('posts')->get()
        ]);
    }

    public function show_a_category(Category $category){
        return view('category', [
            'title' => $category->name,
            'posts' => $category->posts,
            'category' => $category->name
        ]);
    }
}
