<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: Use middleware
        $users = User::orderBy('user_role_id')->get();
        // $users = User::all();

        // return view('admin.index', ['users' => $users]);
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo 'create user';
        //
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
    public function edit(User $user)
    {
        // if (Auth::user()) { // TODO: Use middleware for this
        //     return redirect('/');
        // }

        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // if (Auth::user() && Auth::user()->id === $post->user_id) { // TODO: Use middleware for this
        $user->delete();
        // }

        return redirect('/admin');
    }
}
