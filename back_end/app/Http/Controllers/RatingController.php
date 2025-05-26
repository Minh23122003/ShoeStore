<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;
use App\Models\Shoe;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all();
        return view('admin.ratings.index', compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.ratings.create', compact('shoes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'star' => 'required|integer|min:0|max:5',
            'content' => 'required|string',
        ], [
            'star.required' => 'Please enter the star',
            'star.min' => 'Minimum star is 0',
            'star.max' => 'Maximum star is 5',
            'content.required' => 'Please enter the content',
        ]);

        $rating = new Rating();
        $rating->star = $request->input('star');
        $rating->content = $request->input('content');
        $rating->user_id = $request->input('user_id');
        $rating->shoe_id = $request->input('shoe_id');
        $rating->save();

        return redirect()->route('admin.ratings.index')->with('success', 'Rating created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.ratings.edit', compact('shoes', 'users', 'rating'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'star' => 'required|integer|min:0|max:5',
            'content' => 'required|string',
        ], [
            'star.required' => 'Please enter the star',
            'star.min' => 'Minimum star is 0',
            'star.max' => 'Maximum star is 5',
            'content.required' => 'Please enter the content',
        ]);

        $rating1 = Rating::find($rating->id);
        $rating1->star = $request->input('star');
        $rating1->content = $request->input('content');
        $rating1->user_id = $request->input('user_id');
        $rating1->shoe_id = $request->input('shoe_id');
        $rating1->save();

        return redirect()->route('admin.ratings.index')->with('success', 'Rating changed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('admin.ratings.index')->with('success', 'Rating deleted successfully.');
    }
}
