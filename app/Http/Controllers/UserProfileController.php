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

    public function show()
    {
        return Auth::user();
    }
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        // add validate
        $attribute = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        Auth::user()->update($attribute);
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
