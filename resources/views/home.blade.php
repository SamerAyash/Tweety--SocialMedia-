@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-between">
        <div class="col-lg-3">
            @include('_sidebar-links')
        </div>
        <div class="col-lg-7 mr-5" style="max-width: 700px">
            @include('_publish_tweet_panel')
            <div class="border" style="border-radius: 10px ;border-color: darkgray;">
                @foreach($tweets as $tweet)
                    @include('_tweet')
                @endforeach
            </div>
        </div>
        <div class="col-lg-2">
            @include('_friend-list')
        </div>
    </div>
@endsection
