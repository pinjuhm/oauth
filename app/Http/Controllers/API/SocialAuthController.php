<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    //

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function GoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/index');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('test123')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/index');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

