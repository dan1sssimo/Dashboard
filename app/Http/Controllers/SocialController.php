<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Socialite;
use Auth;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id', $user->id)->first();
            $email = User::where('email', $user->email)->first();

            if ($isUser)
            {
                Auth::login($isUser);
                return redirect('/home');
            }

            else if($email)
            {
                Auth::login($email);
                return redirect('/home');
            }

            else
            {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => 'user',
                ]);

                Auth::login($createUser);

                return redirect('/home');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

}
