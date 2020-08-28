<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids=auth()->user()->follows->pluck('id');

        $tweets =Tweet::whereIn('user_id',$ids)
            ->orWhere('user_id',auth()->id())
            ->withLikes()
            ->latest()
            ->paginate(50);

        return view('tweet.home',['tweets'=>$tweets]);
    }

    public function getTweets(Request $request){
        $tweets='';
        if ($request['tweet_profile'] && $request['user_id']){
            $tweets=Tweet::with('user')
                ->where('user_id',$request['user_id'])
                ->withLikes()
                ->latest()
                ->paginate(5);
        }
        else{

            $ids=auth()->user()->follows->pluck('id');
            $tweets =Tweet::with('user')
                ->whereIn('user_id',$ids)
                ->orWhere('user_id',auth()->id())
                ->withLikes()
                ->latest()
                ->paginate(50);
        }
        return response()->json($tweets,Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required|max:255'
        ]);
        Tweet::create([
            'user_id'=>auth()->id(),
            'body'=>$request->body,
        ]);

        return redirect()->back();
    }

}
