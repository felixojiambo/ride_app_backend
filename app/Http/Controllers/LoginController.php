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


    }
}
