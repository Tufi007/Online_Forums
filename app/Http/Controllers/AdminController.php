<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function promoteToAdmin()
    {
        $users = User::all();

        foreach ($users as $user) {
            $questionCount = $user->questions->count();
            $answerCount = $user->answers->count();

            if ($questionCount >= 100 && $answerCount >= 500) {
                // Check if the user is not already an admin
                if (!$user->isAdmin()) {
                    Admin::create([
                        'user_id' => $user->id,
                        'is_admin' => true,
                    ]);
                }
            }
        }

        return redirect()->route('admin.index')->with('success', 'Users have been promoted to admins as per criteria.');
    }

    public function makeAdmin(Request $request, $user_id)
{
    $user = User::findOrFail($user_id);
    $admin = User::findOrFail(auth()->user()->id);

    // Check if the authenticated user is an admin and verify the password
    if ($admin->isAdmin() && Hash::check($request->admin_password, auth()->user()->password)) {
        // Make the user an admin and add privileges
        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->is_admin = true;
        $admin->privileges = json_encode(['editor', 'reviewer', 'remover']);
        $admin->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User has been made an administrator.');
    } else {
        // Redirect back with an error message if the password is incorrect
        return redirect()->back()->with('error', 'Password is incorrect.');
    }
}

}
