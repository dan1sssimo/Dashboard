@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('content')
    <!-- content -->
    <link rel="stylesheet" type="text/css" href="/css/profile.css">

    @if(Session::has("error"))
        <script>
            alert("Error! Try again!")
        </script>
        {{Session::forget('error')}}
    @endif
    <main class="profile-main">
        <div class="formEditPasswordBlock">
            <form class="form-editPassword" method="POST" action="/profile/edit_password">
                @csrf
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">Create new password</h1>
                </div>

                <div class="form-label-group">
                    <label for="inputEmail">Old password:</label>
                    <input type="password" id="inputPassword" class="form-control old_pass" placeholder="Password" required="" name="old_pass">
                </div>

                <div class="form-label-group">
                    <label for="inputPassword">New password:</label>
                    <input type="password" id="inputPassword" class="form-control new_pass" placeholder="Password" required="" name="new_pass">
                </div>

                <div class="form-label-group">
                    <label for="inputPassword">Confirm new password:</label>
                    <input type="password" id="inputPassword" class="form-control conf_new_pass" placeholder="Password" required="" name="conf_new_pass">
                </div>

                <button class="btn btn-sm btn-secondary btn-block" name="editPassword" type="submit">Edit</button>
            </form>
        </div>
        <div class="profile-content">
            <div class="profile-card">
                <div class="profile-card-img">
                    <img id="showImage" class="rounded img-thumbnail mx-auto d-block"
                         src="{{ (!empty(Auth::user()->image))?url('upload/'.Auth::user()->image):url('upload/no_image.jpg') }}"
                         alt="Avatar Image">
                </div>
                <div class="profile-card-buttons">
                    <div>
                        <a class="prof-btn-add" type="button" href="{{ route('add.avatar') }}">Update Avatar</a>
                    </div>
                    <div>
                        <a class="prof-btn-delete" type="button" href="{{ route('delete.avatar',Auth::user()->id) }}">Delete Avatar</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


