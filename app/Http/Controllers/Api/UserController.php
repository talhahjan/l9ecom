<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;



class UserController extends Controller
{




  function __construct() {
 Auth::refresh();
  }



    public function profile(){
        $userId = Auth::user()['id'];
        $userInfo=User::where('id', $userId)->with('profile')->first();
        return response()->json($userInfo);
        }
    
    
    
        public function updateProfile(Request $request){
        
      $userId=Auth::user()['id'];
      $updateProfile=Profile::where('user_id',$userId)->update([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
         'phone'=>$request->mobile,
        'country'=>$request->country,
        'state'=>$request->state,
        'address'=>$request->address,
      ]);
    
    
    if($updateProfile)
        return response()->json([
            'status'=>201,
            'statusText'=>'Error Updating Profile'
        ]);
    
    
    return response()->json([
        'status'=>200,
        'statusText'=>'ok'
    ]);
    
    
    
        }
    
    
    
    
        public function favorites(){
          $userId = Auth::user()['id'];
         
      $cart=User::with('favorites')->where('id', $userId)->first();
       return response()->json(
       $cart->favorites
        );
          }
      
          
          public function Cart(Request $request){
            $userId = Auth::user()['id'];
               
            $cart=User::find($userId)->with('cart')->first();
          
          return response()->json(
          $cart
          );
          }
    
}
