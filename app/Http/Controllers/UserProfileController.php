<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('passwordHashing')->only(['update']);
    }

    public function show(User $user)
    {
        return $user;
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
        //
    }
}
