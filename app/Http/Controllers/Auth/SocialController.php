<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use phpDocumentor\Reflection\Types\Object_;
use function GuzzleHttp\Psr7\str;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provide)
    {
        return Socialite::driver($provide)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Object_::class;
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }
        $userd = User::where('provider_id', $socialUser->getId())->first();
        $randomStr=Str::random(12);
        try {
            if (!$userd) {
            $fileContents = file_get_contents($socialUser->getAvatar());
            File::put(public_path('storage/avatars/').'avatar'.$randomStr.'.jpg'.'', $fileContents);
            }
            else{
                Auth::login($userd, true);
                return redirect()->route('home');
            }
        }
        catch (\Exception $e){
        }
        // add user to database
        $user = User::create([
            'email' => $socialUser->getEmail(),
            'username' => $socialUser->getNickname()?strtolower($socialUser->getNickname()):str_replace(' ','_',strtolower($socialUser->getName())).rand(10,100),
            'name' => $socialUser->getName()?$socialUser->getName():$socialUser->getNickname(),
            'avatar' => 'avatars/avatar'.$randomStr.'.jpg',
            'password' => encrypt(Str::random(24)),
            'provider_id' => $socialUser->getId(),
        ]);
        // login the user
        Auth::login($user, true);
        return redirect()->route('home');
    }

}
