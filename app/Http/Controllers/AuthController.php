<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Session;

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

    public function store(Request $request) {
        $validated_data = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
    
        $validated_data['password'] = bcrypt($validated_data['password']);
        $validated_data['picture'] = 'profile-img/default.jpg';
        $validated_data['remember_token'] = random_int(1000, 9999);
    
        $user = User::create($validated_data);
    
        if ($user) {
            $email_data = [
                'subject' => 'Email Verification OTP',
                'title' => 'Please Verify Your Email',
                'body' => 'Thank you for registering! Please verify your email address by clicking the link sent to your inbox.',
                'otp' => $user->remember_token
            ];
    
            // Send verification email
            Mail::to($user->email)->send(new SendEmail($email_data));
    
            // Store user ID or remember token in the session
            session(['user_id' => $user->id]);
    
            // Redirect to the verification page with a success message
            return redirect('auth/verification-email')->with('success_registration', $user->email);
        }
        else{
            // Handle registration failure (optional)
            return back()->withErrors(['registration_failed' => 'Registration failed. Please try again.']);
        }
    }    

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();   
        return redirect('/');
    }



    // EMAIL VERIFICATION
    public function email_verification() {
        // Retrieve user ID or remember_token from the session
        $user_id = session('user_id');
        $remember_token = session('remember_token');
    
        // Optionally, you can get the full user data if needed
        $user = User::find($user_id);
    
        // Return the view with the user data
        return view('auth.verify-email', [
            'user' => $user,
            'remember_token' => $remember_token
        ]);
    }

    public function email_verification_otp(Request $request){
        $otp = $request->input('input-satu') . $request->input('input-dua') . $request->input('input-tiga') . $request->input('input-empat');

        // Retrieve the user from the session
        $user_id = session('user_id');
        $user = User::find($user_id);

        // Check if the OTP matches
        if ($otp != $user->remember_token) {
            // OTP is incorrect
            return redirect()->route('auth.email_verification')->withErrors(['otp_invalid' => 'Invalid OTP. Please try again.']);
        }

        // OTP is correct - proceed to verification success (e.g., mark user as verified)
        $user->email_verified_at = now(); // Example: Mark user email as verified
        $user->save();

        session(['username' => $user->username]);

        // Redirect to success page
        return redirect()->route('login')->with('success_registration', 'Email successfully verified, please login here :)');
    }

    // Method to handle OTP resend
    public function resend_otp(Request $request){
        // Retrieve user from session
        $user_id = $request->user_id;
        $user = User::find($user_id);


        // Generate a new OTP and update the remember_token
        $newOtp = random_int(1000, 9999);
        $user->remember_token = $newOtp;
        $user->save();

        // Resend the OTP to the user's email
        Mail::to($user->email)->send(new SendEmail([
            'subject' => 'Email Verification OTP',
            'title' => 'Please Verify Your Email',
            'body' => 'Thank you for registering! Please verify your email address by clicking the link sent to your inbox.',
            'otp' => $newOtp
        ]));


        return response()->json(['status' => 'success_resend_otp', 'message' => 'A new OTP has been sent to your email.']);
    }
}