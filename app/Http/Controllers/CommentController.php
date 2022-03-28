<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'isbn' => ['required']
        ]);
        $comments = Comment::where('isbn', $request->isbn)->get();
        return response()->json([
            'message' => 'success fetching comments',
            'data' => $comments
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'isbn' => ['required'],
            'ip_address' => ['required'],
            'comment' => ['string', 'required', 'max:500']
        ]);

        $comment = Comment::create($request->only('isbn', 'ip_address', 'comment'));
        return response()->json([
            'message' => 'success creating comment',
            'data' => $comment
        ]);
    }
}
