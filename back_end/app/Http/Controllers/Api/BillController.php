<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bills = Bill::where('user_id', $request->user()->id)->with('shoe')->get();

        return response()->json($bills);
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);
        $bill->delete();
        return response()->json([], 204);
    }

    public function pay(string $id)
    {
        $bill = Bill::find($id);
        $bill->payment_at = now();
        $bill->save();
        return response()->json([], 200);
    }
}
