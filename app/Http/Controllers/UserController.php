<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $ideas = $user->ideas()->paginate(3);
        return view("users.show", compact("user", "ideas"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $ideas = $user->ideas()->paginate(3);
        return view("users.edit", compact("user", "ideas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        //
        $validated = request()->validate([
            "bio" => "nullable| min:1|max:240",
            "image" => "image",
            "name" => "required|min:3|max:40",
        ]);

        if (request()->has('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validated);
        Log::info("user profile updated");
        return redirect()->route("profile")->withErrors($validated);
    }

    public function profile()
    {
        //
        return $this->show(auth()->user());
    }
}
