<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    //

    public function show(Idea $idea)
    {

        /* shorter version
         return view('ideas.show',compact('idea'));
         */
        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    public function store()
    {
        request()->validate([
            'content' => 'required | min:3 | max:240',
        ]);

        Idea::create([
            "content" => request()->get('content', ""),
        ]);

        return redirect()->route("dashboard")->with('success', 'Idea created succesfully');
    }

    public function edit(Idea $idea)
    {
        $editing = true;
        return view('ideas.show', compact('idea','editing'));
    }

    public function update(Idea $idea)
    {
        request()->validate([
            'content' => 'required | min:3 | max:240',
        ]);

        $idea->content = request()->get('content','');
        $idea->save();

        return redirect()->route("ideas.show",$idea->id)->with('success', 'Idea updated succesfully');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        /* 
        Idea::where('id', $id)->firstOrFail()->delete(); 
        */

        /* longer version       
        $idea = Idea::where('id',$id)->firstOrFail()
        $idea->delete(); 
        */

        return redirect()->route("dashboard")->with('success', 'Idea deleted succesfully');
    }
}
