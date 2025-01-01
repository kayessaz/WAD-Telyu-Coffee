<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Display all reviews
    public function index()
    {
        $reviews = Review::with('user')->get(); // Get all reviews along with user data
        return view('reviews.all', compact('reviews')); // Pass reviews data to the view
    }

    // Display reviews made by the authenticated user
    public function yourReview()
    {
        $user = Auth::user();
        $reviews = $user->reviews; // Get all reviews associated with the authenticated user
        return view('reviews.index', compact('reviews')); // Pass the user's reviews to the view
    }

    // Show the form to create a new review
    public function create()
    {
        return view('reviews.add');
    }

    // Store a new review in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Create a new review and set its attributes
        $review = new Review();
        $review->first_name = $validated['first_name'];
        $review->last_name = $validated['last_name'];
        $review->rating = $validated['rating'];
        $review->phone = $validated['phone'];
        $review->email = $validated['email'];
        $review->message = $validated['message'];
        $review->user_id = $user->id; // Assign the review to the authenticated user

        // Save the review to the database
        $review->save();

        // Redirect to the reviews index page with a success message
        return redirect()->route('reviews.index')->with('success', 'Review submitted successfully!');
    }

    // Display a specific review by its ID
    public function show($id)
    {
        $review = Review::findOrFail($id); // Find the review by ID or fail
        return view('reviews.show', compact('review')); // Pass the review to the view
    }

    // Show the form to edit a review
    public function edit($id)
    {
        $user = Auth::user(); // Get the authenticated user
        $review = Review::findOrFail($id); // Find the review by ID or fail

        // Check if the review belongs to the authenticated user
        if ($review->user->id != $user->id) {
            return redirect()->route('reviews.index')->with('error', 'Not allowed to edit someone\'s review!');
        }

        return view('reviews.edit', compact('review')); // Pass the review to the edit view
    }

    // Update the review in the database
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id); // Find the review by ID or fail

        $user = Auth::user(); // Get the authenticated user

        // Check if the review belongs to the authenticated user
        if ($review->user->id != $user->id) {
            return redirect()->route('reviews.index')->with('error', 'Not allowed to update someone\'s review!');
        }

        // Validate the incoming data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'rating' => 'required|integer|between:1,10',
            'message' => 'required|string',
        ]);

        // Update the review with the validated data
        $review->update($validated);

        // Redirect to the reviews index page with a success message
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully');
    }

    // Delete a review from the database
    public function destroy($id)
    {
        $review = Review::findOrFail($id); // Find the review by ID or fail
        $user = Auth::user(); // Get the authenticated user

        // Check if the user is an admin or the owner of the review
        if ($user->email == 'admin@gmail.com' || $review->user_id == $user->id) {
            $review->delete(); // Delete the review

            // Redirect with a success message
            return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
        }

        // If the user is not authorized, redirect with an error message
        return redirect()->route('reviews.index')->with('error', 'You are not authorized to delete this review.');
    }
}
