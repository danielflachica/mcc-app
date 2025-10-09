<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedFields = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);

        $validatedFields['password'] = bcrypt($validatedFields['password']);

        $user = User::create($validatedFields);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $validatedFields = $request->validate([
            'loginEmail' => 'required',
            'loginPassword' => 'required'
        ]);

        if (Auth::attempt(['email' => $validatedFields['loginEmail'], 'password' => $validatedFields['loginPassword']])) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->user_role_id) {
                case 1:
                    return redirect('/admin');
                case 2:
                    return redirect('/doctor');
                case 3:
                    return redirect('/patient');
                default:
                    return redirect('/');
            }
        }

        // return back()->withErrors([
        //     'loginEmail' => 'Invalid credentials.',
        // ]);
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
