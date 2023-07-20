<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = User::with('questions', 'answers', 'comments')->find(Auth::id());

        return view('my_profile', compact('user'));
    }
}
