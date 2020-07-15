@extends('layouts.app')

@section('content')
    <header class="mb-5">
        <div class="mb-2 position-relative">
            <img style="border-radius: 20px;width: 100%;height: 330px" class="img-fluid"
                 src="{{asset('images/laravel.jpeg')}}">
            <img
                class="position-absolute rounded-circle fixed-bottom"
                style="
                left: calc(50% - 75px);
                transform:translateY(50%)"
                width="150"
                height="150"
                src="{{$user->getAvatar($user->avatar)}}"
            />
        </div>
        <div class="mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bolder">{{$user->name}}</h4>
                <h6 class="text-muted small">{{$user->created_at->diffForHumans()}}</h6>
            </div>
            <div class="d-flex">

                @if(auth()->user()->is($user))
                    <a href="{{route('profile.edit',$user->username)}}"
                       class="btn btn-light rounded-pill px-4 border font-weight-bolder mr-2"
                       type="submit" style="border-color: gray">
                        Edit Profile
                    </a>
                @endif

                    @if(auth()->user()->isNot($user))
                        <form method="POST" action="{{route('followMe',[$user->username])}}">
                            @csrf
                            <button class="btn btn-primary rounded-pill px-4 font-weight-bolder" type="submit">
                                {{auth()->user()->following($user)? 'Unfollow Me':'Follow Me'}}
                            </button>
                        </form>
                    @endif

            </div>
        </div>
        <p>
            Lorem Ipsum is simply dummy text of the printing and
            typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a
            type specimen book. It has survived not only five centuries,
            but also the leap into electronic typesetting,
            remaining essentially unchanged.

        </p>
    </header>
    @if(auth()->user()->is($user))
    @include('_publish_tweet_panel')
    @endif
    @include('_timeLine',['tweets'=>$tweets])
@endsection
