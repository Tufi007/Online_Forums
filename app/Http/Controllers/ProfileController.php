<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = User::with('questions', 'answers', 'comments', 'profiles')->find(Auth::id());
        return view('my_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'street_address' => 'required',
            'state_city' => 'required',
            'country' => 'required',
            'date_of_birth' => 'required|date',
            'academic_qualification' => 'required',
            'work_experience' => 'required',
            'about_you' => 'required',
        ]);

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Find the user's existing profile, if it exists
        $profile = Profile::where('user_id', $userId)->first();

        // If the user has an existing profile, update the data
        if ($profile) {
            $profile->street_address = $request->input('street_address');
            $profile->state_city = $request->input('state_city');
            $profile->country = $request->input('country');
            $profile->date_of_birth = $request->input('date_of_birth');
            $profile->academic_qualification = $request->input('academic_qualification');
            $profile->work_experience = $request->input('work_experience');
            $profile->about_you = $request->input('about_you');

            // Handle the profile picture upload, if provided
            if ($request->hasFile('profile_picture')) {
                // Delete the existing profile picture from the server and the database
                if ($profile->profile_picture) {
                    unlink(public_path($profile->profile_picture));
                }

                // Upload the new profile picture
                $profilePicture = $request->file('profile_picture');
                $imageName = time() . '_' . $profilePicture->getClientOriginalName();
                $profilePicture->move(public_path('profilePictures'), $imageName);
                $profile->profile_picture = 'profilePictures/' . $imageName;
            }

            // Save the updated profile
            $profile->save();

            return redirect()->back()->with('success', 'Profile data updated successfully!');
        }

        return redirect()->back()->with('error', 'No profile data found!');
    }


    public function createProfile(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'street_address' => 'required',
        'state_city' => 'required',
        'country' => 'required',
        'date_of_birth' => 'required|date',
        'academic_qualification' => 'required',
        'work_experience' => 'required',
        'about_you' => 'required',
    ]);

    // Get the currently logged in user's ID
    $userId = Auth::id();

    // Create a new profile instance and fill the data
    $profile = new Profile();
    $profile->user_id = $userId;
    $profile->street_address = $request->input('street_address');
    $profile->state_city = $request->input('state_city');
    $profile->country = $request->input('country');
    $profile->date_of_birth = $request->input('date_of_birth');
    $profile->academic_qualification = $request->input('academic_qualification');
    $profile->work_experience = $request->input('work_experience');
    $profile->about_you = $request->input('about_you');

      // Handle the profile picture upload, if provided
      if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');
        $imageName = time() . '_' . $profilePicture->getClientOriginalName();
        $profilePicture->move(public_path('profilePictures'), $imageName);
        $profile->profile_picture = 'profilePictures/' . $imageName;
    }

    // Save the profile
    if ($profile->save()) {
        return redirect()->back()->with('success', 'Profile created successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to create the profile. Please try again.');
    }
}

}
