<?php


namespace App;

trait Followable
{
    public function follow(User $user){
        return $this->follows()->save($user);
    }

    public function unFollow(User $user){
        return $this->follows()->detach($user);
    }
    public function follows(){
        return $this->belongsToMany('App\User','follows','user_id','following_user_id');
    }
    public function following(User $user){
        return $this->follows()
            ->where('following_user_id',$user->id)
            ->exists();
    }

    public function toggleFollow(User $user){
        $this->follows()->toggle($user);
//        if ($this->following($user)){
//            return $this->unFollow($user);
//        }
//
//        return $this->follow($user);
    }

}
