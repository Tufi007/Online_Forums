<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:255',
            'alternate_phone_number' => 'required|string|max:255',
        ]);

        // Create a new user record - This code sends form data into database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'phone_number' => $validatedData['phone_number'],
            'alternate_phone_number' => $validatedData['alternate_phone_number'],
        ]);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user using username and password
        $credentials = [
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed
            // Redirect to the appropriate page
            return redirect()->route('home');
        } else {
            // Authentication failed
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function updateUserData(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            // 'username' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'alternate_phone_number' => 'required|string|max:20',
            // Add other user fields here...
        ]);

        // Get the currently logged-in user
        $user = User::find(Auth::id());

        // Update the user data
        $user->update($validatedData);

        // Redirect back to the profile edit page with a success message
        return redirect()->back()->with('success', 'User data updated successfully!');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Incorrect current password']);
        }

        // Update the password attribute with the new hashed password
        $user->password = Hash::make($request->new_password);
        $user->save(); // Save the updated user model to the database

        return redirect()->route('my_profile')->with('success', 'Password changed successfully!');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
