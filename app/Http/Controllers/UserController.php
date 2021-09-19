<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('home', ['resumes' => auth()->user()->resumes]);
    }

    public function usernameExists(Request $request)
    {
        $query = User::where('username', $request->username);

        if (auth()->check()) {
            $query->where('username', '!=', auth()->user()->username);
        }

        return $query->first() !== null;
    }
}
