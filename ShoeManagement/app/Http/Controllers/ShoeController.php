<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Category;
use Illuminate\Validation\Rule;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoes = Shoe::all();
        return view('admin.shoes.index', compact('shoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.shoes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:shoes,name',
            'information' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'note' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Please enter the shoe name!',
            'name.unique' => 'Shoe name already exists!',
            'information.required' => 'Please enter the information',
            'quantity.required' => 'Please enter the quantity',
            'quantity.min' => 'Minimum quantity is 1',
            'price.required' => 'Please enter the price',
            'price.min' => 'Minimum price is 1',
            'note.required' => 'Please enter the note',
            'image.required' => 'Please choose the image',
        ]);

        $shoe = new Shoe();
        $shoe->name = $request->input('name');
        $shoe->information = $request->input('information');
        $shoe->quantity = $request->input('quantity');
        $shoe->price = $request->input('price');
        $shoe->note = $request->input('note');
        $shoe->category_id = $request->input('category_id');
        if ($request->hasFile('image')) {
            $shoe->image = $request->file('image')->store('shoes', 'public');
        }
        $shoe->save();

        return redirect()->route('admin.shoes.index')->with('success', 'Shoe created successfully.');
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
    public function edit(Shoe $shoe)
    {
        $categories = Category::all();

        return view('admin.shoes.edit', compact('shoe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shoe $shoe)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('shoes')->ignore($shoe->id)],
            'information' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'note' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Please enter the shoe name!',
            'name.unique' => 'Shoe name already exists!',
            'information.required' => 'Please enter the information',
            'quantity.required' => 'Please enter the quantity',
            'quantity.min' => 'Minimum quantity is 1',
            'price.required' => 'Please enter the price',
            'price.min' => 'Minimum price is 1',
            'note.required' => 'Please enter the note',
        ]);

        $shoe1 = Shoe::find($shoe->id);
        $shoe1->name = $request->input('name');
        $shoe1->information = $request->input('information');
        $shoe1->quantity = $request->input('quantity');
        $shoe1->price = $request->input('price');
        $shoe1->note = $request->input('note');
        $shoe1->category_id = $request->input('category_id');
        if ($request->hasFile('image')) {
            $shoe1->image = $request->file('image')->store('shoes', 'public');
        }
        $shoe1->save();

        return redirect()->route('admin.shoes.index')->with('success', 'Shoe changed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shoe $shoe)
    {
        $shoe->delete();
        return redirect()->route('admin.shoes.index')->with('success', 'Shoe deleted successfully.');
    }
}
