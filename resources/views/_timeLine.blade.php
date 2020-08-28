<div class="border" style="border-radius: 20px;border-color: darkgray;">
    @forelse($tweets as $tweet)
        @include('_tweet')
    @empty
        <p class="p-4">No tweet yet.</p>
    @endforelse

</div>
<div class="d-flex justify-content-center mt-2">
    {{$tweets->links()}}
</div>
