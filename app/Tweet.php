<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use Likable;
    protected $guarded=[];

    public function likes(){
        $this->hasMany('App\Like');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
