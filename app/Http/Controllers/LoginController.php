<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use App\Notifications\LoginNeedsVerification;

class LoginController extends Controller
{
    public function submit(Request  $request )
    {
        
        //validate phone number
  $request->validate([
 'phone'=>'required|numeric|min:10'
  ]);


        //find or create a user model
$user=User::firstOrCreate([
    'phone'=> $request->phone
]);
if(!$user){
    return response()->json(['message'=>'Could not process a user with that phone number.'],402);
}

        //send a user one time code for use

$user->notify(new LoginNeedsVerification());
        //reurn back a response

return response()->json(['message'=> 'Text message notification sent '],200);
    }
    public function verify(Request $request){
        //validate incomming request
     $request->validate([
    'phone'=> 'required|numeric|min:10',
    'login_code'=>'required|numeric|between:111111,999999'
]);
        //find user 
$user=User::where('phone', $request->phone)->where('login_code',$request->login_code)->first();
        //is the code provided the same as one saved 

        //if so, return  back an auth token
if($user){return $user->createToken($request->login_code)->plainTextToken;}
        // if not return back a message
    }
}
