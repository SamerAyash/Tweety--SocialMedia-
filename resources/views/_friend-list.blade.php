<div class="p-3" style="background-color: rgba(135,206,250,0.2);border-radius: 20px">
    <h4 class="font-weight-bolder mb-3">Following</h4>

    <ul class="p-0" style="list-style-type: none">
        @forelse(auth()->user()->follows as $user)
            <li class="{{$loop->last?'':'mb-2'}}">
                <div>
                    <a href="{{$user->profilePath()}}">
                        <img src="{{$user->getAvatar($user->avatar)}}" width="40" class="rounded-circle mr-2">
                        <span class="font-weight-bolder small">{{$user->name}}</span>
                    </a>
                </div>
            </li>
        @empty
            <p class="font-weight-bolder">No friends yet!</p>
        @endforelse
    </ul>
</div>
