@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <strong>ERROR!</strong> {{ $error }} <br />
            @endforeach
        </div>
    @endif

    <form method="POST" action="/test/pass_test">
        @csrf

        <label>Name: <input type="text" name="users_name" value="{{ $data->name }}"></label><br />
        <label>Email: <input type="text" name="users_email" value="{{ $data->email }}"></label><br />
        <label>Post: <input type="text" name="users_post" placeholder="PR-manager"></label><br />

        @for($i = 1; $i <= 42; $i++)
            <label for="questions">question {{$i}}: <br />
                ...some text...
            </label><br />
            <input type="number" name="questions[{{$i}}][value]" min="1" max="10"><br />
        @endfor

        <button type="submit" name="button">SEND RESULTS!</button>

    </form>
@endsection
