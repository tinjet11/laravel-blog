<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function store(Idea $idea){

        Comment::create([
            "content" => request()->get('content'),
            "idea_id"=> $idea->id,
        ]);

        return redirect()->route("ideas.show",$idea->id)->with('success', 'Comment added succesfully');
    } 
}
