<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/shoes/{id}/comments",
     *     summary="Tạo bình luận cho sản phẩm",
     *     tags={"Shoes"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã sản phẩm",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"content"},
     *             @OA\Property(property="content", type="string", example="Good"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tạo bình luận thành công"
     *     )
     * )
     */
    public function store(Request $request, string $id)
    {
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->shoe_id = $id;
        $comment->user_id = $request->user()->id;
        $comment->save();

        return response()->json([], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/shoes/{id}/comments",
     *     summary="Lấy danh sách bình luận của sản phẩm",
     *     tags={"Shoes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã sản phẩm",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Trang hiện tại",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Danh sách các bình luận"
     *     )
     * )
     */
    public function show(Request $request, string $id)
    {
        $comments = Comment::where('shoe_id', $id)->with('user')->orderBy('created_at', 'desc')->paginate(4);

        return response()->json($comments, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Xóa bình luận",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã bình luận",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Xóa bình luận thành công"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        
        return response()->json([], 204);
    }
}
