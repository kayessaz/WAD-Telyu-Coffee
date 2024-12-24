<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    // Store a new review
    public function index()
    {
        $reviews = Review::with('user')->get(); // Get all reviews from the database
        return view('reviews.all', compact('reviews')); // Return the view with the reviews data
    }

    public function yourReview() {
        $user = Auth::user();

        $reviews = $user->reviews;

        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.add');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Create a new review instance and assign values
        $review = new Review();
        $review->first_name = $validated['first_name'];
        $review->last_name = $validated['last_name'];
        $review->rating = $validated['rating'];
        $review->phone = $validated['phone'];
        $review->email = $validated['email'];
        $review->message = $validated['message'];
        $review->user_id = $user->id;

        // Save the review to the database
        $review->save();

        // Redirect or return a response
        return redirect()->route('reviews.index')->with('success', 'Review submitted successfully!');
    }

    // Show the review
    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
    }

public function edit($id)
{
        $user = Auth::user();
        $review = Review::findOrFail($id);

        if($review->user->id != $user->id) {
            return redirect()->route('reviews.index', $review->id)->with('error', 'Not allowed to edit someone\'s review!');
        }

        return view('reviews.edit', compact('review'));
    }


public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $user = Auth::user();

        if($review->user->id != $user->id) {
            return redirect()->route('reviews.index', $review->id)->with('error', 'Not Allowed');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'rating' => 'required|integer|between:1,10',
            'message' => 'required|string',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.index', $review->id)->with('success', 'Review updated successfully');
    }

public function destroy($id)
    {
        $user = Auth::user();
        $review = Review::findOrFail($id);

        if($review->user->id != $user->id) {
            return redirect()->route('reviews.index', $review->id)->with('error', 'Not allowed to delete someone\'s review!');
        }
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }
}
