<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')
            ->where('id', '>', session('last_comment_read', 0))
            ->get();

        if ($comments->isEmpty()) {
            return response()->noContent();
        }

        session(['last_comment_read' => $comments->last()->id]);
        return view('streaming', compact('comments'))->fragment('comments');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['text' => 'string|required']);
        $request->user()->comments()->create($validated);

        if ($request->hasHeader('hx-request')) {
            return view('streaming')->fragment('comment-form');
        }

        return back();
    }
}
