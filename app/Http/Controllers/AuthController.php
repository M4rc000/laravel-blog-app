<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function index(){
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function register()
    {
        return view('auth/register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validated_data['password'] = bcrypt($validated_data['password']);

        $user = User::create($validated_data);

        if($user){
            return redirect()->route('login')->with('success_registration', 'Registration successful! Please verify your email address.');
        }
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();   
        return redirect('/');
    }


    // EMAIL VERIFICATION
    // public function show()
    // {
    //     return view('auth.verify');
    // }

    // public function verify($id, $hash)
    // {
    //     $user = User::findOrFail($id);

    //     if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
    //         throw new \Illuminate\Validation\ValidationException('Email verification failed.');
    //     }

    //     $user->markEmailAsVerified();
    //     event(new Verified($user));

    //     return redirect('/home')->with('status', 'Email verified successfully!');
    // }
}