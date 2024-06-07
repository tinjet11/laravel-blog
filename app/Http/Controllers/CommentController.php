<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function store(Idea $idea)
    {

        $validated = request()->validate([
            'comment' => 'required',
        ]);

        Comment::create([
            "content" => $validated['comment'],
            "idea_id" => $idea->id,
            "user_id" => auth()->id(),
        ]);

        return redirect()->route("ideas.show", $idea->id)->with('success', 'Comment added succesfully');
    }
}
