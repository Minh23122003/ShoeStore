<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0",
 *     description="Tài liệu API",
 *     @OA\Contact(
 *         email="minhminhb2vtt@gmail.com.com"
 *     )
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Lấy danh sách danh mục",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Danh sách danh mục"
     *     )
     * )
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
