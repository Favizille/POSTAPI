<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $profile;

    public function __construct(Profile $profile){
        $this->profile = $profile;
    }

    public function createProfile(Request $request){

        $profileDetails = $request->validate([
            'sex' => 'required',
            'dob' => 'required',
            'hobby' => 'required',
            'status'  => 'required',
            'occupation'  => 'required'
        ]);

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
}
