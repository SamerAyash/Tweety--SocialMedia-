@extends('layouts.app')

@section('content')
    @foreach($users as $user)
        <a href="{{route('profile.show',$user->username)}}" class="d-flex align-items-center mb-4">
            <img src="{{$user->getAvatar($user->avatar)}}" width="60" class="mr-2 rounded">
            <h6 class="font-weight-bold">
                {{'@'.$user->username}}
            </h6>
        </a>
    @endforeach
    <div class="d-flex justify-content-center">
        {{$users->links()}}
    </div>
@endsection
