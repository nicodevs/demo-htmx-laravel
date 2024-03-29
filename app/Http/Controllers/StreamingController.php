<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class StreamingController extends Controller
{
    public function __invoke(Request $request)
    {
        $comments = Comment::with('user')->latest()->get();
        if ($comments->isNotEmpty()) {
            session(['last_comment_read' => $comments->first()->id]);
        }
        return view('streaming', compact('comments'));
    }
}
