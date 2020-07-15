@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data" class="p-3">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{auth()->user()->name}}">
            @error('name')
            <p class="bg-danger text-white small">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{auth()->user()->username}}">
            @error('username')
            <p class="bg-danger text-white small">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{auth()->user()->email}}">
            <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
            @error('email')
            <p class="bg-danger text-white small">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <div class="d-flex">
                <input type="file" name="avatar" id="avatar" >
                <img
                    class="rounded-circle"
                    width="150"
                    height="150"
                    src="{{asset('storage/'.auth()->user()->avatar)}}"
                    id="image">
            </div>
            @error('avatar')
            <p class="bg-danger text-white small">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" minlength="8" id="password">
            @error('password')
            <p class="bg-danger text-white small">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" minlength="8" id="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('profile.show',auth()->user()->username)}}" class="btn btn-light hover:underline">Cancel</a>
    </form>
@endsection
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#avatar').change(function(evt) {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>

@endpush
