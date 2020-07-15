@push('style')
    <style>
        ul{
            list-style-type: none
        }
        li a{
            color: black;
        }
    </style>
@endpush
<ul class="list-unstyled">
    <li>
        <a href="{{route('home')}}" class="font-weight-bold text-left mb-4 blockquote">
            Home
        </a>
    </li>
    <li>
        <a href="{{route('explore.index')}}" class="font-weight-bold text-left mb-4 blockquote">
            Explore
        </a>
    </li>
    <li>
        <a href="#" class="font-weight-bold text-left mb-4 blockquote">
            Notifications
        </a>
    </li>
    <li>
        <a href="#" class="font-weight-bold text-left mb-4 blockquote">
            Messages
        </a>
    </li>
    <li>
        <a href="#" class="font-weight-bold text-left mb-4 blockquote">
            Bookmarks
        </a>
    </li>
    <li>
        <a href="#" class="font-weight-bold text-left mb-4 blockquote">
            Lists
        </a>
    </li>
    <li>
        <a href="{{route('profile.show',auth()->user()->username)}}" class="font-weight-bold text-left mb-4 blockquote">
            Profile
        </a>
    </li>
    <li>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit"
                        class="font-weight-bold text-left mb-4 blockquote"
                        style="
                                background: none;
                                color: red;
                                border: none;
                                padding: 0;
                                font: inherit;
                                cursor: pointer;
                                outline: inherit;"
                >
                    Logout
                </button>
            </form>
    </li>
</ul>
