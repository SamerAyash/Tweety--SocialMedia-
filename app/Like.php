<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
/*    protected $fillable = ['liked', 'user_id', 'tweet_id'];*/
    protected $guarded=[];

    public function tweet(){
        $this->belongsTo('App\Tweet','tweet_id','id');
    }
    public function user(){
        $this->belongsTo('App\User','user_id','id');
    }
}
