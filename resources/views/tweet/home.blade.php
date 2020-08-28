@extends('layouts.app')

@section('content')
    {{--<tweet-component
        v-bind:tweet_profile="false" v-bind:user_id="{{auth()->id()}}">
    </tweet-component>--}}
    @include('_publish_tweet_panel')
    @include('_timeLine')
@endsection
@push('mix')
    <script src="{{mix('js/app.js')}}"></script>
@endpush
