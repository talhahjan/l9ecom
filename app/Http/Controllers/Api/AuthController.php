<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;







class AuthController extends Controller
{
    

 public function login(Request $request){
  $request->validate([
    'email' => 'required|string|email',
    'password' => 'required|string',
]);
$credentials = $request->only('email', 'password');

$token = Auth::attempt($credentials);



if (!$token) {
    return response()->json([
        'statusText' => 'error',
        'message' => 'Unauthorized',
    ], 401);
}

$user = Auth::user();
return response()->json([
  'user'=>[
    'id'=>1,
    'first_name'=>'Muhammad',
    'last_name'=>'Khalid',
  ],
  'statusText'=>'ok',
   'message'=>'Login Successfully',
   'avatar'=>$user->profile->avatar,
   'authorisation' => [
    'token'=>$token,
    'type'=>'brearer',
   ],             

 ], 200);

 }



public function register(Request $request){
    $validator = Validator::make($request->all(),[
        'first_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        

        if($validator->fails())
        return response()->json([
          'status'=>201,
          'validation_errors'=>$validator->messages()
        ],201);
        
        
        
        
                $user =User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                
                if ($user) {
                   $profile= Profile::create([
                  'user_id'=>$user->id,
                  'first_name'=>$request->first_name,
                  'last_name'=>$request->last_name
              ]);
                
              $credentials = $request->only('email', 'password');

              $token = Auth::attempt($credentials);
              
                    return response()->json([
                     'status'=>200,
                     'statusText'=>'ok',
                     'authorisation' => [
                      'token'=>$token,
                      'type'=>'brearer',
                     ],                    
                    ], 200);
                }
}



public function refresh()
{
    return response()->json([
        'statusText' => 'ok',
        'message' => 'Token refresh successfully',
        'authorisation' => [
            'token' => Auth::refresh(),
            'type' => 'bearer',
        ]
    ],200);
}

 
}
