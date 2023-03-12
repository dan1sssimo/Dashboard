@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 20%;">
                <div class="card-header"><i>{{ __('Reset your Password') }}</i></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('Email Address:') }}</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="userEmail form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="old_password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Old password:') }}</b></label>
                            <div class="col-md-6">
                                <input type="password" class="form-control old_password" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="confirm_old_password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Confirm old password:') }}</b></label>
                            <div class="col-md-6">
                                <input type="password" class="form-control confirm_old_password" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger resetPasswordButton">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let button = document.querySelector(".resetPasswordButton");
    button.disabled = true;
    document.addEventListener("change", ifEmpty);

    function ifEmpty() {
        if(document.getElementById("email").value === ""
            || document.querySelector(".old_password").value === ""
            || document.querySelector(".confirm_old_password").value === ""
            || document.querySelector(".old_password").value !== document.querySelector(".confirm_old_password").value) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }
    }

    $(".resetPasswordButton").on("click", function()
    {
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            onHidden: function() { window.location = "{{route('login')}}" }
        };

        toastr["info"]("Check your email address...", "Ok!");
    })
</script>
@endsection
