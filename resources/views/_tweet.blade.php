@push('style')
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <style>
        .fa-thumbs{
            color: darkgray;
        }
        .submitBut{
            background: transparent;
            box-shadow: 0px 0px 0px transparent;
            border: 0px solid transparent;
            text-shadow: 0px 0px 0px transparent;

        }
    </style>
@endpush
<div class="d-flex p-3 border-bottom ">
    <div class="px-4">
        <a href="{{$tweet->user->profilePath()}}">
            <img src="{{$tweet->user->getAvatar($tweet->user->avatar)}}" width="50" class="rounded-circle">
        </a>
    </div>
    <div>
        <div class=" mb-2">
            <a href="{{$tweet->user->profilePath()}}">
                <h5 class="font-weight-bolder">{{$tweet->user->name}}</h5>
            </a>
            <h6 class="small text-muted">{{$tweet->created_at->diffForHumans()}}</h6>
        </div>
        <p class="pr-4" style="word-break: break-word;font-size: 12px;font-weight: 600">
            {{$tweet->body}}
        </p>
        <div class="d-flex justify-content-start">
            <span class="mr-4">
                <form action="{{route('like',$tweet->id)}}" method="POST">
                    @csrf
                <button class="submitBut" type="submit">
                    <i class="fa fa-thumbs fa-thumbs-up
                    <?php $tweet->isLikedBy(auth()->user())?print 'text-primary':''?>">
                        {{$tweet->likes? $tweet->likes:0}}
                    </i>
                </button>
                </form>
            </span>
            <span>
                <form action="{{route('dislike',$tweet->id)}}" method="POST">
                    @csrf
                <button class="submitBut" type="submit">
                    <i class="fa fa-thumbs fa-thumbs-down
                    <?php $tweet->isDislikedBy(auth()->user())?print 'text-danger':''?>">
                        {{$tweet->dislikes?$tweet->dislikes:0}}
                    </i>
                </button>
                </form>
            </span>
        </div>
    </div>
</div>
