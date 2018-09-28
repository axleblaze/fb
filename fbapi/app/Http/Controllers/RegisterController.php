<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     
public function register(Request $request){
    
    $rules = [
        'username' => 'required|min:3|max:10',
        'gender'=>'required',
        'dob'=>'required',
        'email' => 'required|email',
        'password' => 'required|min:8|max:20'
        
    ];

    $customMgs = [
        'required' => 'Please fill attribute :attribute',
        'username.min' => 'Name must be at least 3 characters.',
        'username.max' => 'Name should not be greater than 10 characters.',
        'email.email'=>'email must be of email type',
        'password.min' => 'password must be at least 8 characters.',
        'password.max' => 'password should not be greater than 12 characters.',
    
    ];

    return User::create([
        'username' => $request->input('username'),
        'gender' => $request->input('gender'),
        'dob' => $request->input('dob'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'api_token' => app('hash')->make('hahahahahahahahahahahahahahha'),
    ]);
}

public function login(){
        return "Thank You! You have Successfully Logged In";
    }
}
