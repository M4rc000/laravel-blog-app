<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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

        return view('my-post/my_post', [
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

        return view('my-post/my_post', [
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
    
    public function new_post()
    {
        return view('my-post/new_post', [
            'title' => 'My posts',
            'categories' => Category::withCount('posts')->get()
        ]);
    }

    public function create_post(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'body' => 'required',
            'picture' => 'image|file|max:5000'
        ]);

        if ($request->hasFile('picture')) {
            $filePath = $request->file('picture')->store('post-img');
            $validatedData['picture'] = $filePath;
        }
        else{
            $validatedData['picture'] = 'no-preview.png'; 
        }
        
        
        $validatedData['visibility'] = $request->status;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['category_id'] = $request->category;
        $validatedData['exerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validatedData);

        return redirect('/my-post/all')->with('success_create', 'New post has been added!');
    }

    public function edit_post(Post $post)
    {
        return view('my-post/edit_post', [
            'title' => 'My posts',
            'post'=> $post,
            'categories' => Category::withCount('posts')->get()
        ]);
    }

    public function update_post(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'picture' => 'image|file|max:5000',
            'body' => 'required',
        ];

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        } 

        $validatedData = $request->validate($rules);

        if ($request->hasFile('picture')) {
            if($request->oldPostImage){
                Storage::delete($request->oldPostImage);
            }
            $filePath = $request->file('picture')->store('post-img');
            $validatedData['picture'] = $filePath;
        }


        $validatedData['visibility'] = $request->status;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['category_id'] = $request->category;
        $validatedData['exerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/my-post/all')->with('success_update', 'Post has been updated!');
    }

    public function delete_post(Post $post)
    {
        if($post->picture){
            Storage::delete($post->picture);
        }
        Post::destroy($post->id);
        return redirect('/my-post/all')->with('success_delete', 'Post has been deleted');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title); 
        return response()->json(['slug' => $slug]);   
    }
}
