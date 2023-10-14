<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    
    public function signup() {
        return view('auth.signup');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'fname' => 'required'
        ]);

        $address = [
            'unit_number' => $request->unumber,
            'address' => $request->address,
            'city' => $request->city,
            'region' => $request->region,
            'postal_code' => $request->postal,
            'country' => $request->country
        ];

        $addr = Address::create($address);

        $user = [
            'email' => $request->email,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address_id' => $addr->id
        ];

        $us = User::create($user);

        return redirect('/login');
    }

    public function authenticate(Request $request) {
        $credential = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:255'
        ]);

        if(Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('login', 'Login failed!!!');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
