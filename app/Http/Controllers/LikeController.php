<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id){
        $tweet= Tweet::whereId($id)->first();
        $user= auth()->user();
        if($tweet->isLikedBy($user)){
            $user->likes()
                ->where('user_id',$user->id)
                ->where('tweet_id',$tweet->id)
                ->delete();
        }
        else{
            $tweet->like();
        }
        return redirect()->back();
    }

    public function dislike($id){
        $tweet= Tweet::whereId($id)->first();
        $user= auth()->user();
        if($tweet->isDislikedBy($user)){
            $user->likes()
                ->where('user_id',$user->id)
                ->where('tweet_id',$tweet->id)
                ->delete();
        }
        else{
            $tweet->dislike();
        }
        return redirect()->back();
    }
}
