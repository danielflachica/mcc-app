<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validatedFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // Prevent storage of HTML tags in the incoming request fields
        $validatedFields['title'] = strip_tags($validatedFields['title']);
        $validatedFields['body'] = strip_tags($validatedFields['body']);
        // Get authenticated user's ID
        $validatedFields['user_id'] = Auth::id();

        Post::create($validatedFields);

        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user() && Auth::user()->id !== $post->user_id) { // TODO: Use middleware for this
            return redirect()->route('home');
        }

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, Request $request)
    {
        if (Auth::user() && Auth::user()->id !== $post->user_id) { // TODO: Use middleware for this
            return redirect()->route('home');
        }

        $validatedFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // Prevent storage of HTML tags in the incoming request fields
        $validatedFields['title'] = strip_tags($validatedFields['title']);
        $validatedFields['body'] = strip_tags($validatedFields['body']);

        $post->update($validatedFields);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::user() && Auth::user()->id === $post->user_id) { // TODO: Use middleware for this
            $post->delete();
        }

        return redirect()->route('home');
    }
}
