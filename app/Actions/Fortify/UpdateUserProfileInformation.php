<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */

    // update profile information and profile picture
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            if($user!=null) {
                if($input['image'] ?? '' ){
                    if(auth()->user()->profile_picture != NULL){
                        Storage::delete('public/profilepicture/'.auth()->user()->profile_picture);
                    }
                    $profilePicture = time().'_'.auth()->user()->username. '_' . $input['image']->getClientOriginalName();
                    $input['image']->storeAs('public/profilepicture/', $profilePicture);  // public/folderName if using diff folder
                }
            }

            if($input['image'] ?? '' ){
                $user->forceFill([
                    'fullname'          => $input['name'],
                    'username'          => $input['username'],
                    'phone_no'          => $input['phoneno'],
                    'email'             => $input['email'],
                    'location'          => $input['userlocation'],
                    'website'           => $input['userwebsite'],
                    'profile_picture'   => $profilePicture,
                ])->save();    
            }else {
                $user->forceFill([
                    'fullname'          => $input['name'],
                    'username'          => $input['username'],
                    'phone_no'          => $input['phoneno'],
                    'email'             => $input['email'],
                    'location'          => $input['userlocation'],
                    'website'           => $input['userwebsite'],
                ])->save();    
            }

            request()->session()->flash('success', 'Profile information updated.');
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'fullname' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
