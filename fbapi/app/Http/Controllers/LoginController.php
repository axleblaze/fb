<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\User;


class LoginController extends Controller
{
    
    public function login(Request $request)
    {
        $userObj = User::first();
        $data = [
            'fromEmail'=>'saurabh.singh@kelltontech.com',
            'fromName' => 'Your Application',
            'toEmail' => 'saurabhpsit2k17@gmail.com',
            'toName' => 'test',
            'subject' => 'This is test email !',
        ];
        $bodyData = ['link'=>'http://localhost:4200/login','name'=>'Go to Google Page'];
        Mail::send('emails.test',$bodyData,function ($m) use($data){
            $m->from($data['fromEmail'], $data['fromName']);
            $m->to($data['toEmail'], $data['toName'])->subject($data['subject']);
        });
    $rules = [
    //'email' => 'required',
    'password' => 'required'
    ];
    
    $customMessages = [
    'required' => ':attribute'
    ];
   
    $this->validate($request, $rules, $customMessages);

    $email = $request->input('email');

    $email = $request->input('username');
    try {
    $login = User::where('person','=','0')->where('email', $email)->orWhere('username',$email)->first();
    if ($login) {

        
    if ($login->count() > 0) {
    if (Hash::check($request->input('password'), $login->password)) {
    try {
    $api_token = sha1($login->id_user.time());
    
    $create_token = User::where('id', $login->id_user)->update(['api_token' => $api_token]);
    $res['status'] = true;
    $res['message'] = 'Success login';
    $res['data'] = $login;
    $res['api_token'] = $api_token;
    $login()->last_logged_in = new \DateTime();
    $login->save();
    return response($res, 200);
    
    
    } catch (\Illuminate\Database\QueryException $ex) {
    $res['status'] = false;
    $res['message'] = $ex->getMessage();
    return response($res, 500);
    }
    } else {
    $res['success'] = false;
    $res['message'] = 'Username / email / password not found';
    return response($res, 401);
    }
    } else {
    $res['success'] = false;
    $res['message'] = 'Username / email / password not found';
    return response($res, 401);
    }
    } else {
    $res['success'] = false;
    $res['message'] = 'Username / email / password not found';
    return response($res, 401);
    }
    } catch (\Illuminate\Database\QueryException $ex) {
    $res['success'] = false;
    $res['message'] = $ex->getMessage();
    return response($res, 500);
    }
    }
    public function showUser($id){
        
        return response()->json(User::find($id));
        

    }
    
}