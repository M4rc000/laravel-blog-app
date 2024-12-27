<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('Asia/Jakarta');

class UserController extends Controller
{
    public function index(){
        return view('user.user', [
            'title' => 'User profile',
            'menu' => 'User',   
            'submenu' => 'Profile',
            'categories' => Category::withCount('posts')->get()
        ]);
    }

    public function update_user(Request $request)
    {
        // Validation rules
        $rules = [
            'picture' => 'image|file|max:5000',
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users,username,' . auth()->id()],
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ];

        if ($request->password) {
            $rules['password'] = 'required|min:5|max:255';
        }

        $validatedData = $request->validate($rules);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $currentPicture = auth()->user()->picture;
            if ($currentPicture && $currentPicture != 'profile-img/default.jpg') {
                Storage::delete($currentPicture); // Delete the existing picture if it's not the default
            }
            $validatedData['picture'] = $request->file('picture')->store('profile-img');
        }

        // Hash password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $validatedData['gender'] = $request->gender;
        $validatedData['country'] = $request->country;
        $validatedData['place_of_birth'] = $request->place_of_birth;
        $validatedData['birth_of_date'] = $request->birth_of_date;

        // Update user data
        $result = User::where('id', $request->user_id)->update($validatedData);

        // Redirect with success message
        if ($result) {
            return redirect('/user/profile')->with('success_update', 'Profile has been updated!');
        }
        else{
            return redirect('/user/profile')->with('failed_update', 'Failed to update profile!');
        }
    }


    public function show_a_user_post(User $user){
        return view('user_post', [
            'title' => $user->name,
            'name' => $user->name,
            'posts' => $user->posts
        ]);
    }
    
    public function settings(){
        return view('user/settings', [
            'title' => 'Settings',
            'menu' => 'User',   
            'submenu' => 'Settings',
            'categories' => Category::withCount('posts')->get()
        ]);
    }
}
