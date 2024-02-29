<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "phone_number" => "required",
            "password" => "required|confirmed"
        ]);

        $request->password = bcrypt($request->password);

        $registrationData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "password" => $request->password
        ];


       if(! $this->user->create($registrationData)){
         return [
            'status' => 'Failed',
            'status_code' => 400,
            'message' => 'The user registration failed'
         ];
       };

       return [
            'status' => 'Success',
            'status_code' => 200,
            'message' => 'The user registration was succesfsul'
        ];

    }

    public function login(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(Auth::attempt($credentials)){
            $user = $this->user->where('email', $request->email)->first();
            // $token = $user->createToken('myapptoken')->plainTextToken;
            return [
                'status' => 'successful',
                'status_code' => 200,
                'message' => 'User logged in successfully',
                'data' => $user,
                // 'token' => $token,
            ];
        }

        return [
            'status' => 'failed',
            'status_code' => 400,
            'message' => 'User could not login'
        ];
    }

    public function logout(){
        $loggedoutSuccessfully = Auth::logout();

        if(!$loggedoutSuccessfully){
            return ['bad'];
        }
        return [
            'Good'
        ];
        // if(!Auth::logout()){
        //     return [
        //         'status' => 'failed',
        //         'status_code' => 400,
        //         'message' => 'Failed to logout user'
        //     ];
        // }

        // return [
        //     'status' => 'success',
        //     'status_code' => 200,
        //     'message' => 'User has been logged out successfully'
        // ];

    }
}
