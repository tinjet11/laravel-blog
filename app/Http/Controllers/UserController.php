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
        try {
            if (request()->has('image')) {
                //$imagePath = request()->file('image')->store('profile', 'public');

                // Store the image directly to S3
                $imagePath = request()->file('image')->store('profile', 's3');

                $validated['image'] = $imagePath;

                //Storage::disk('public')->delete($user->image ?? '');

                if ($user->image && Storage::disk('s3')->exists($user->image)) {
                    Storage::disk('s3')->delete($user->image);
                }
            }
        } catch (\Exception $e) {
            Log::error("Image upload failed");
            return back()->withErrors(['error' => 'Image upload failed.']);
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

    public function userImage(User $user)
    {
        // Get the image path from the user model
        $imagePath = $user->image;

        // Check if the image exists in S3
        if (Storage::disk('s3')->exists($imagePath)) {
            // Get the image content
            $image = Storage::disk('s3')->get($imagePath);

            // Determine the MIME type manually
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($image);

            // Return the image with the correct content type
            return response($image)->header('Content-Type', $mimeType);
        } else {
            abort(404, 'Image not found.');
        }
    }
}
