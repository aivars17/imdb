<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;

class FacebookController extends Controller
{
    public function view()
    {
        return view('fb');
    }
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        if (!empty(User::where('fb_id', $user->id))){
            Auth::login(User::where('fb_id', $user->id)->first());
            return redirect()->route('home');
        }else{
            $loged = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'fb_id' => $user->id,
            'role' => 'user',
            ]);
            Auth::login($loged);
        }
    }
}
