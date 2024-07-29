<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the user after registration
        Auth::login($user);

        return response()->json(['message' => 'User created and logged in successfully!']);
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication passed
        $user = Auth::user(); // Get the authenticated user
        return response()->json([
            'message' => 'Login successful!',
            'user' => $user // Return user data
        ]);
        return redirect('/')->with('message', 'Login successful!');
    } else {
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials.'], 401);
    }
}


    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}
