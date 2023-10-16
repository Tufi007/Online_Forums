<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    public function showAnsForm($questionId)
    {
        $question = Question::find($questionId);
        return view('answers.answer_form', compact('question'));
    }

    public function submitAnswer(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'answer_text' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'reference_links' => 'nullable|url',
            'q_id' => 'required|exists:questions,q_id',
        ]);

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Handle the image uploads, if provided
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $images[] = 'images/' . $imageName;
            }
        }


        // Create a new answer instance and fill the data
        $answer = new Answer();
        $answer->user_id = $userId;
        $answer->answer_text = $request->input('answer_text');
        if (!empty($images)) {
            $answer->image = json_encode($images);
        } else {
            $answer->image = NULL;
        }
        $answer->date_time = now();
        $answer->reference_links = $request->input('reference_links');
        $answer->q_id = $request->input('q_id');

        // Save the answer
        if ($answer->save()) {
            Session::flash('success', 'Answer submitted successfully!');
        } else {
            Session::flash('error', 'Failed to submit the answer. Please try again.');
        }
        return redirect()->back();
    }

    public function editAnswer($answer_id)
{
    $answer = Answer::find($answer_id);
    // Additional logic for editing the answer
    return view('answers.edit_answer', compact('answer'));
}
public function updateAnswer(Request $request, $answer_id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'answer_text' => 'required',
        // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'deleted_images' => 'nullable|array',
        // 'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'reference_links' => 'nullable|url',
    ]);

    // Get the answer to update
    $answer = Answer::find($answer_id);

    // Initialize image field as an empty array if it is null
    $answer->image = $answer->image ? json_decode($answer->image, true) : [];

    // Handle new images
    if ($request->hasFile('new_images')) {
        $newImages = [];
        foreach ($request->file('new_images') as $newImage) {
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move(public_path('images'), $imageName);
            $newImages[] = 'images/' . $imageName;
        }
        $currentImages = $answer->image;
        $allImages = array_merge($currentImages, $newImages);
        $answer->image = json_encode($allImages);
    }

     // Handle deleted images
     if ($request->has('deleted_images')) {
        $deletedImages = json_decode($request->input('deleted_images'), true);
        if (!empty($deletedImages)) {
            if($request->hasFile('new_images')){
                $currentImages = $allImages;
            } else {
                $currentImages = $answer->image;
            }
            $updatedImages = array_diff($currentImages, $deletedImages);
            $answer->image = !empty($updatedImages) ? json_encode($updatedImages) : null;

             // Delete the image files from the server
             foreach ($deletedImages as $deletedImage) {
                if (file_exists(public_path($deletedImage))) {
                    unlink(public_path($deletedImage));
                }
            }
        }
    }

    // Update the answer data
    $answer->answer_text = $request->input('answer_text');
    $answer->reference_links = $request->input('reference_links');
    // Add other fields here...

    // Save the updated answer
    $answer->save();

    // Redirect to the user's profile page after successful update
    return redirect()->route('my_profile')->with('success', 'Answer updated successfully!');
}




}
