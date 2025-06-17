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
     * @OA\Post(
     *     path="/api/ratings",
     *     summary="Tạo đánh giá",
     *     tags={"Ratings"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"content", "star", "shoe_id"},
     *             @OA\Property(property="content", type="string", example="Good"),
     *             @OA\Property(property="star", type="integer", example=5),
     *             @OA\Property(property="shoe_id", type="integer", example=2),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tạo đánh giá thành công"
     *     )
     * )
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

        return response()->json([], 201);
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
