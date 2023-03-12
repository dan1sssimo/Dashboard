@extends('layouts.app')
@section('title')
    Contuct us!
@endsection
@section('content')

<div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Send your data to us</h1>
            </div>

            <div class="modal-body p-5 pt-0">
                <form method="POST" action="">
                    @csrf
                    <div class="form-floating mb-3">
                        <input id="name" type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="email" type="text" name="email" class="form-control" value="{{Auth::user()->email}}" >
                        <label for="floatingPassword">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="phone" type="text" name="phone" class="form-control" value="+38 (095) 432 11 00">
                        <label for="floatingPassword">Phone</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary sendMessageButton" type="submit">Send</button>
                    <small class="text-muted">We will read your message during 3 days.</small>
                    <hr class="my-4">
                </form>
                <h2 class="fs-5 fw-bold mb-3">Use our socials:</h2>
                <a class="w-100 py-2 mb-2 btn btn-outline-dark rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter"></use></svg>
                    Twitter
                </a>
                <a class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"></use></svg>
                    Facebook
                </a>
                <a class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#github"></use></svg>
                    GitHub
                </a>
            </div>
        </div>
    </div>
</div>


    <script>
        $(".sendMessageButton").on("click", () =>
        {
            toastr.options = {
                "closeButton": true,
                "debug": false,
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
                "hideMethod": "fadeOut"
            };

            toastr["success"]("Your message sent to us!", "Success!");
        })
    </script>
@endsection
