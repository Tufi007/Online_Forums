<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

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
}
