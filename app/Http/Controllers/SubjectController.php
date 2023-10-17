<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function showSubjects(Request $request)
    {

        if (Auth::check()) {
            $user = Auth::user();


            if (Auth::check() && Auth::user()->admin && $user->admin->is_admin === 1) {
                $subjects = Subject::all();

                return view('subjects.subjects', compact('subjects'));
            } else {

                return redirect()->back()->with('message', 'You are not authorized to access this page.');
            }
        } else {

            return redirect()->route('login');
        }
    }

    public function viewSubject(Subject $subject_id)
    {
        $user = Auth::user();
        $subject = Subject::find($subject_id)->first();
        if ($user->admin->is_admin === 1) {
            return view('subjects.viewSubject', compact('subject'));
        } else {
            return redirect()->back()->with('message', 'You are not authorized to access this page.');
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (Auth::check() && Auth::user()->admin && $user->admin->is_admin === 1) {
                   // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'subject_code' => 'required|max:255',
        ]);

        // Create a new subject based on the form data
        Subject::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'subject_code' => $request->input('subject_code'),
        ]);

        // Redirect to the subjects page or wherever you want
        return redirect()->route('subject-page')->with('success', 'Subject added successfully');
        } else {
            return redirect()->back()->with('message', 'You are not authorized to access this page.');
        }

    }

    public function editSubject(Request $request, Subject $subject)
    {
        $user = Auth::user();
        if (Auth::check() && Auth::user()->admin && $user->admin->is_admin === 1) {

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'subject_code' => 'nullable|string|max:255',
            ]);


            $subject->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'subject_code' => $request->input('subject_code'),
            ]);


            return redirect()->route('subject.view', ['subject_id' => $subject->id])->with('success', 'Subject updated successfully.');
        } else {
            return redirect()->back()->with('message', 'You are not authorized to access this page.');
        }
    }
}
