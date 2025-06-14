<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Shoe;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.comments.create', compact('shoes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ], [
            'content.required' => 'Please enter the content',
        ]);

        $comments = new Comment();
        $comments->content = $request->input('content');
        $comments->user_id = $request->input('user_id');
        $comments->shoe_id = $request->input('shoe_id');
        $comments->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment created successfully.');
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
    public function edit(Comment $comment)
    {
        $shoes = Shoe::all();
        $users = User::all();

        return view('admin.comments.edit', compact('shoes', 'users', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ], [
            'content.required' => 'Please enter the content',
        ]);

        $comment1 = Comment::find($comment->id);
        $comment1->content = $request->input('content');
        $comment1->user_id = $request->input('user_id');
        $comment1->shoe_id = $request->input('shoe_id');
        $comment1->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment changed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
