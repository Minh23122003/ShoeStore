<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;

class ShoeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shoes",
     *     summary="Lấy danh sách sản phẩm",
     *     tags={"Shoes"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Tên sản phẩm",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="min_price",
     *         in="query",
     *         required=false,
     *         description="Giá sản phẩm tối thiểu",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="max_price",
     *         in="query",
     *         required=false,
     *         description="Giá sản phẩm tối đa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         required=false,
     *         description="Danh mục của sản phẩm",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Trang hiện tại",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Danh sách sản phẩm"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Shoe::query();

        if ($request->has('name') && $request->name != null) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('min_price') && $request->min_price != null) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != null) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('category_id') && $request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }

        $shoes = $query->with('category')->paginate(4);

        return response()->json($shoes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/shoes/{id}",
     *     summary="Lấy thông tin của 1 sản phẩm",
     *     tags={"Shoes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã sản phẩm",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Thông tin sản phẩm"
     *     )
     * )
     */
    public function show(string $id)
    {
        $shoe = Shoe::find($id);

        return response()->json($shoe, 200);
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
