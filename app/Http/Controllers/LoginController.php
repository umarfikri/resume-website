<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function loginPage()
    {                
        return view('loginResume');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session([
                'is_logged_in' => true,
                'user_id' => $user->id,
                'userLevel' => $user->userLevel,
                'username' => $user->username,
            ]);
            // dd(session('userLevel'), $roles);
            return redirect()->intended('/cms')->with('success', 'Welcome back ' . $user->username . '!');
        }        

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->forget('is_logged_in');
        return redirect()->route('loginPage')->with('success', 'You have been logged out.');
    }

}
