<?php


namespace App;


use Illuminate\Database\Eloquent\Builder;

trait Likable
{
    public function scopeWithLikes(Builder $builder){
         $builder->leftJoinSub(
            'select tweet_id,sum(liked) likes , sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function like($user0= null ,$liked= true){
        $user =$user0 ? $user0 : auth()->user();
        $user->likes()->updateOrCreate([
            'user_id'=> $user->id,
            'tweet_id'=>$this->id,
        ],[
            'liked'=>$liked,
        ]);
    }
    public function dislike($user= null){
        $this->like($user,false);
    }

    public function isLikedBy(User $user){
        return (bool) $user->likes()
            ->where('tweet_id',$this->id)
            ->where('liked',true)
            ->count();
    }

    public function isDislikedBy(User $user){
        return (bool) $user->likes()
            ->where('tweet_id',$this->id)
            ->where('liked',false)
            ->count();
    }
}
