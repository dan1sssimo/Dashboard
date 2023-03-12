@extends('layouts.app')
@section('title')
    Update Avatar
@endsection
@section('content')
    <!-- content -->
    <link rel="stylesheet" type="text/css" href="/css/profile.css">

    <main  class="avatar-main">
        <div class="avatar-container">
            <div class="avatar-card">
                <div class="avatar-header-title">
                    <h4 class="avatar-title">Update Avatar</h4>
                </div>

                <div class="avatar-content">
                    <form method="post" action="{{ route('store.avatar')}}" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="avatar-adder-image">
                            <label for="example-text-input" class="avatar-title-img">Avatar Image</label>
                            <div class="avatar-input">
                                <input name="image" class="form-control" type="file" id="image" max="12288"
                                       accept=".jpg, .jpeg, .png" required>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                            <div class="">
                                <img id="showImage" class="rounded img-thumbnail"
                                     src="{{ (!empty(Auth::user()->image))?url('upload/'.Auth::user()->image):url('upload/no_image.jpg') }}"
                                     alt="Avatar Image" width="100px" height="100px">
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="submit" class="avatar-update-btn" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end content -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection


