<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;

class CommentController extends Controller
{
    public function store(Request $request, $newsId)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $news = News::findOrFail($newsId);

        $comment = new Comment([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        $news->comments()->save($comment);

        return back()->with('success', 'Comment added successfully.');
    }
}
