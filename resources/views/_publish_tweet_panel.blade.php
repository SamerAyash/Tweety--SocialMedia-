@push('style')
    <style>
        textarea:focus{
            outline: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.075);
        }
    </style>
@endpush
<div class="border p-3 mb-5" style="border-color: deepskyblue !important;border-radius: 10px">
    <form method="POST" action="/tweets">
        @csrf
                    <textarea
                        name="body" class="border-0 w-100 p-3"
                        placeholder="What's up doc?" rows="4" required>
                    </textarea>

    <hr class="my-4">
    <footer class="d-flex flex-row justify-content-between">
        <a href="{{route('profile.show',auth()->user()->username)}}">
            <img src="{{auth()->user()->getAvatar(auth()->user()->avatar)}}" width="40" alt="your avatar" class="rounded-circle mr-2">
        </a>
        <button class="btn btn-primary rounded-lg px-2 shadow" type="submit">Publish</button>
    </footer>
    </form>
    @error('body')
        <p class="p-1" style="color:red;font-weight:600">{{$message}}</p>
    @enderror
</div>
