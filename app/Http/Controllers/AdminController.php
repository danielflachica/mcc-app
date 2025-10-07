<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\UserRole;
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
        $userRoles = UserRole::all();

        return view('admin.users.create', compact('userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'user_role_id' => 'required|integer',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);

        $validatedFields['name'] = strip_tags($validatedFields['name']);
        $validatedFields['password'] = bcrypt($validatedFields['password']);

        User::create($validatedFields);

        return redirect('/');
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
