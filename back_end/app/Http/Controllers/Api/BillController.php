<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/user/bills",
     *     summary="Lấy danh sách đơn hàng của người dùng",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Danh sách đơn hàng của người dùng"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $bills = Bill::where('user_id', $request->user()->id)->with('shoe')->get();

        return response()->json($bills, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/bills",
     *     summary="Tạo hóa đơn",
     *     tags={"Bills"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"quantity", "size", "shoe_id"},
     *             @OA\Property(property="quantity", type="integer", example=1),
     *             @OA\Property(property="size", type="interger", example=40),
     *             @OA\Property(property="shoe_id", type="integer", example=2),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tạo thành công"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $bill = new Bill();
        $bill->quantity = $request->quantity;
        $bill->size = $request->size;
        $bill->shoe_id = $request->shoe_id;
        $bill->user_id = $request->user()->id;
        $bill->payment_at = null;
        $bill->save();

        return response()->json([], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/bills/{id}",
     *     summary="Lấy thông tin hóa đơn",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã đơn hàng",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Thông tin hóa đơn"
     *     )
     * )
     */
    public function show(string $id)
    {
        $bill = Bill::with('shoe')->find($id);

        return response()->json($bill, 200);
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
     *     path="/api/bills/{id}",
     *     summary="Xóa hóa đơn chưa thanh toán",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã đơn hàng",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Xóa thành công"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);
        $bill->delete();
        return response()->json([], 204);
    }

    /**
     * @OA\Post(
     *     path="/api/bills/{id}/pay",
     *     summary="Thanh toán hóa đơn",
     *     tags={"Bills"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mã đơn hàng",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Thanh toán thành công"
     *     )
     * )
     */
    public function pay(string $id)
    {
        $bill = Bill::find($id);
        $bill->payment_at = now();
        $bill->save();
        return response()->json([], 200);
    }
}
