<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('passwordHashing')->only(['update']);
    }

    public function show()
    {
        Auth::user()->delete();
        return Auth::user();
    }
    
    public function edit()
    {
        return Auth::user();
    }

    public function update(Request $request)
    {
        $attribute = $request->validate([
            'email' => ['required', 'email'],
        ]);
        Auth::user()->update($attribute);
        return back();
    }

    public function destroy()
    {
        if (Auth::user()->delete()) {
            Session::flush();
            redirect('/');
        } else {
            back();
        }
    }
}
