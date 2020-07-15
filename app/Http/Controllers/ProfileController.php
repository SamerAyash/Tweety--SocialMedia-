<?php

namespace App\Http\Controllers;

use App\Tweet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
class ProfileController extends Controller
{

    public function show(User $user){
        $tweets=Tweet::where('user_id',$user->id)
            ->withLikes()
            ->latest()
            ->paginate(5);
        return view('profile.index',compact(['user','tweets']));
    }

    public function edit(User $user){

        //$this->authorize('edit',$user->name);
        return view('profile.edit',compact(['user']));
    }

    public function update(Request $request){
        $id=auth()->id();
        $attributes=$request->validate([
            'username' => [
                'required', 'string', 'max:255','alpha_dash',
                'unique:users,username,'.$id. ',id',
            ],
            'name' => ['required', 'string', 'max:255'],
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id. ',id',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($request->hasFile('avatar')){
            $attributes['avatar'] = $request['avatar']->store('avatars','public');
            $image = Image::make(public_path('storage/'.$attributes['avatar']))->fit(200,200);
            $image->save();
            \File::delete(public_path('storage/'.auth()->user()->avatar));
        }
        auth()->user()->update($attributes);
        return redirect(route('profile.show',auth()->user()->username));
    }
}
