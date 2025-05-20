<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\User;
use App\Models\Shoe;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.bills.create', compact('shoes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'required|integer|max:45|min:30',
        ], [
            'quantity.required' => 'Please enter the quantity',
            'quantity.min' => 'Minimum quantity is 1',
            'size.required' => 'Please enter the size',
            'size.min' => 'Minimum size is 30',
            'size.max' => 'Maximum size is 45',
        ]);

        $bill = new Bill();
        $bill->quantity = $request->input('quantity');
        $bill->size = $request->input('size');
        $bill->user_id = $request->input('user_id');
        $bill->shoe_id = $request->input('shoe_id');
        $bill->payment_at = null;
        $bill->save();

        return redirect()->route('admin.bills.index')->with('success', 'Bill created successfully.');
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
    public function edit(Bill $bill)
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.bills.edit', compact('shoes', 'users', 'bill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'required|integer|max:45|min:30',
        ], [
            'quantity.required' => 'Please enter the quantity',
            'quantity.min' => 'Minimum quantity is 1',
            'size.required' => 'Please enter the size',
            'size.min' => 'Minimum size is 30',
            'size.max' => 'Maximum size is 45',
        ]);

        $bill1 = Bill::find($bill->id);
        $bill1->quantity = $request->input('quantity');
        $bill1->size = $request->input('size');
        $bill1->user_id = $request->input('user_id');
        $bill1->shoe_id = $request->input('shoe_id');
        $bill1->save();

        return redirect()->route('admin.bills.index')->with('success', 'Bill changed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')->with('success', 'Bill deleted successfully.');
    }
}
