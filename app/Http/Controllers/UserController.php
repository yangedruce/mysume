<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function home(Request $request) {
        $resume = Resume::where('user_id', auth()->user()->id)
                        ->get();

        return view('home')
                ->with([
                    'resumes' => $resume
                ]);
    }

    public function checkUsername(Request $request) {
        $user = User::where('username', $request->username)
                    ->first();

        if($user==null) {
            return false;
        }else {
            return true;
        }
    }

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

    public function uploadProfilePicture(Request $request) {
        $user = User::where('id', auth()->user()->id)
                    ->first();

        if($user!=null) {
            if($request->image!=null){
                if(auth()->user()->profile_picture != NULL){
                    Storage::delete('public/profilepicture/'.auth()->user()->profile_picture);
                }
                $profilePicture = time().'_'.auth()->user()->username. '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/profilepicture/', $profilePicture);  // public/folderName if using diff folder
                $user->profile_picture = $profilePicture;
            }
            $user->save();
        }

        $request->session()->flash('success', 'Profile picture has been uploaded.');
        return redirect()->back();
    }
}
