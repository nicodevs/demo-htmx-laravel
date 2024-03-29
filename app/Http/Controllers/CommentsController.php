<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\CommentSent;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')
            ->where('id', '>', session('last_comment_read', 0))
            ->latest()
            ->get();

        if ($comments->isEmpty()) {
            return response()->noContent();
        }

        session(['last_comment_read' => $comments->first()->id]);
        return view('streaming', compact('comments'))->fragment('comments');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['text' => 'string|required']);
        $request->user()->comments()->create($validated);

        event(new CommentSent());

        if ($request->hasHeader('hx-request')) {
            return view('streaming')->fragment('comment-form');
        }

        return back();
    }
}
