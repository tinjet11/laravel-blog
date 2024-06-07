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
        $validated = request()->validate([
            'content' => 'required | min:3 | max:240',
        ]);

        $validated['user_id'] = auth()->id();

        Idea::create($validated);

        return redirect()->route("dashboard")->with('success', 'Idea created succesfully');
    }

    public function edit(Idea $idea)
    {
        if (auth()->id() != $idea->user_id) {
            abort(404);
        }
        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {

        if (auth()->id() != $idea->user_id) {
            abort(404);
        }
        $validated = request()->validate([
            'content' => 'required | min:3 | max:240',
        ]);

        $idea->update($validated);

        return redirect()->route("ideas.show", $idea->id)->with('success', 'Idea updated succesfully');
    }

    public function destroy(Idea $idea)
    {
        if (auth()->id() != $idea->user_id) {
            abort(404);
        }

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
