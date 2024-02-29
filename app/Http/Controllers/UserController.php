<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $profile;
    protected $user;

    public function __construct(Profile $profile, User $user){
        $this->profile = $profile;
        $this->user = $user;
    }

    public function createProfile(Request $request){

        $request->validate([
            'sex' => 'required',
            'dob' => 'required',
            'hobby' => 'required',
            'status'  => 'required',
            'occupation'  => 'required',
            'user_id'  => 'required'
        ]);

        $profileDetails = [
            'sex' => $request->input('sex'),
            'dob' => $request->input('dob'),
            'hobby' => $request->input('hobby'),
            'status' => $request->input('status'),
            'occupation' => $request->input('occupation'),
            'user_id' => $request->input('user_id')
        ];

        if(!$this->profile->create($profileDetails)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Profile was not created'
            ];
        }

        // $this->profile->name = $request->input('dob');
        // $this->profile->description = $request->input('sex');
        // $this->profile->price = $request->input('image');

        // if($request->hasfile('image')){
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time(). '.' .$extension;
        //     $file->move('uploads/users/', $filename);
        //     $this->profile->image = $filename;
        // }else{
        //     return $request;
        //     $this->profile->image = '';
        // }

        // if(!$this->profile->save()){
        //     return [
        //         'status' => 'failed',
        //         'status_code' => 400,
        //         'message' => 'Profile was not created'
        //     ];
        // }

        return [
            'status' => 'success',
            'status_code' => 201,
            'message' => 'Profile created successfully'
        ];
    }


    public function getProfile($profileId){

        if(!$profile = $this->profile->find($profileId)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Could not get User Profile'
            ];
        }

        return [
            'status' => 'success',
            'status_code' => 200,
            'data' => $profile
        ];
    }

    public function updateProfile($profileId, Request $request){
        if(!$profile = $this->profile->find($profileId)){
            return [
                'status' =>'failed',
                'status_code' => 400,
                'message' => 'Failed to Update',
            ];
        }

        $profileDetails = [
            'sex'=> $request->sex,
            'dob'=> $request->dob,
            'hobby'=> $request->hobby,
            'status'=> $request->status,
            'occupation'=> $request->occupation,
        ];


        $profile->update($profileDetails);
        return [
            'status' =>'success',
            'status_code' => 200,
            'data' => $profile,
        ];
    }

    public function deleteProfile($profileId){
        $profile = $this->profile->find($profileId);

        if(!$profile){
            return [
                'status' =>'failed',
                'message' => 'Could not find Profile',
            ];
        }

        $profile->delete();

        return [
            'status' =>'success',
            'status_code' => 200,
            'message' => 'Profile Deleted',
        ];
    }

}
