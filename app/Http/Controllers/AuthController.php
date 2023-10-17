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
        return view('authentication.signup');
    }

    public function signup(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:255',
        ]);

        try {

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'country_code' => $validatedData['country_code'],
                'phone_number' => $validatedData['phone_number'],
            ]);


            return redirect()->route('home')->with('success', 'Registration successful!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }



    public function showLoginForm()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        $field = filter_var($validatedData['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


        $credentials = [
            $field => $validatedData['username'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {


            $user = $request->user();
            if ($user->delete_requested_at) {
                $user->update(['delete_requested_at' => null]);
            }
            return redirect()->route('home');
        } else {


            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }


    public function updateUserData(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',


            'phone_number' => 'required|string|max:20',
            'country_code' => 'required|string|max:20',
        ]);


        $user = User::find(Auth::id());


        $user->update($validatedData);


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


        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('my_profile')->with('success', 'Password changed successfully!');
    }


    public function deleteAccount(Request $request)
    {
        $user = User::find(Auth::id());


        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('my_profile')->with('error', 'Incorrect password. Account deletion request canceled.');
        }


        $user->update(['delete_requested_at' => now()]);

        return redirect()->route('my_profile')->with('success', 'Account deletion requested. You have 10 days to cancel the request by logging in again.');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
