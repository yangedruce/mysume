<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // home
    public function home(Request $request) {
        $resume = Resume::where('user_id', auth()->user()->id)
                        ->get();

        return view('home')
                ->with([
                    'resumes' => $resume
                ]);
    }

    // check username
    public function checkUsername(Request $request) {
        $user = User::where('username', $request->username)
                    ->first();

        if($user==null) {
            return false;
        }else {
            return true;
        }
    }

    // Check username profile
    public function checkUsernameProfile(Request $request) {
        $user = User::where('username', $request->username)
                    ->where('username', '!=', auth()->user()->username)
                    ->first();

        if($user==null) {
            return false;
        }else {
            return true;
        }
    } 
}
