<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rating = Rating::where('user_id', $request->user()->id)->where('shoe_id', $request->shoe_id)->first();

        if ($rating != null){
            $rating->star = $request->star;
            $rating->content = $request->content;
            $rating->save();
        }else{
                $rating = new Rating();
                $rating->star = $request->star;
                $rating->content = $request->content;
                $rating->user_id = $request->user()->id;
                $rating->shoe_id = $request->shoe_id;
                $rating->save();
        }

        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
