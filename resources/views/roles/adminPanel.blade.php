@extends('layouts.app')

@section('title')
    Hello, {{Auth::user()->name}}!
@endsection

@section('content')
    <!-- USERS DATA -->
    @if (\Session::has('error'))
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr["warning"]("Maybe, you used incorrect file, something doesn't similar on xlsx and csv? Or forgot add need column to table. Change error and try again!", "Error!!!");
        </script>
        {{Session::forget('error')}}
    @endif
    <div style="background-color: white; text-align: center; margin-bottom: 90px; padding-top: 25px; height: 100%;">
        @if(Auth::user()->admin !== "yes")
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new worker or import</button><hr />
        @endif
        @if(Auth::user()->admin == "yes")@endif
        <div class="row">
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <section>
                    <div class="table-responsive">
                        @include('roles.usersPagination')
                    </div>
                </section>
            </div>
        </div>
    </div>

    @if(Auth::user()->admin !== "yes")
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: 3%; height: 100%;">
            <div class="modal-dialog">
                <div class="modal-content" style="height: 100%">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">Add new worker or import</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="margin-top: -5px;">
                        <form class="add-worker-form">
                            <label><b>Name:</b> <input type="text" class="form-control add-worker-form-name"></label><br />
                            <label><b>Email:</b> <input type="email" class="form-control add-worker-form-email"></label><br />
                            <label><b>Password:</b> <input type="password" class="form-control add-worker-form-password" style="margin-bottom: 15px;"></label><br />

                            @if(Auth::user()->manager == "yes")
                                <label class="form-label">Department chief: </label>
                                <input type="radio" name="status" value="0" class="chief-add"><br />

                                <div class="departments" style="display: none">
                                    <label class="form-label">Choose department for department chief: </label><br>
                                    <select id="departmentForCard" style="width: 300px; height: 30px;">
                                        <option value="" selected>None</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->title}}">{{$department->title}}</option>
                                        @endforeach
                                    </select>
                                    <br /><br />
                                </div>

                                <label class="form-label">Company manager: </label>
                                <input type="radio" name="status" value="0" class="manager-add"><br />
                                <script>
                                    $(".chief-add").on("click", function()
                                    {
                                        $(".departments").css("display", "block");
                                    })

                                    $(".manager-add").on("click", function()
                                    {
                                        $(".departments").css("display", "none");
                                    })
                                </script>
                                <div style="display: none;">
                                    <label class="form-label">Teamlead: </label>
                                    <input type="radio" name="status" value="0" class="teamlead-add"><br />
                                    <label class="form-label">Employee: </label>
                                    <input type="radio" name="status" value="0" class="employee-add" style="margin-bottom: 20px;"><br />
                                </div>
                            @elseif(Auth::user()->chief == "yes")
                                <div style="display: none;">
                                    <label class="form-label">Department chief: </label>
                                    <input type="radio" name="status" value="0" class="chief-add"><br />

                                    <div class="departments" style="display: none">
                                        <label class="form-label">Choose department for department chief: </label><br>
                                        <select id="departmentForCard" style="width: 300px; height: 30px;">
                                            <option value="" selected>None</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->title}}">{{$department->title}}</option>
                                            @endforeach
                                        </select>
                                        <br />
                                    </div>

                                    <label class="form-label">Company manager: </label>
                                    <input type="radio" name="status" value="0" class="manager-add"><br />
                                </div>
                                <div style="display: block;">
                                    <label class="form-label">Teamlead: </label>
                                    <input type="radio" name="status" value="0" class="teamlead-add"><br />
                                    <label class="form-label">Employee: </label>
                                    <input type="radio" name="status" value="0" class="employee-add" style="margin-bottom: 20px;"><br />
                                    <input id="departmentForCard" type="text" value="" style="display: none;">
                                </div>
                            @elseif(Auth::user()->teamlead == "yes")
                                <div style="display: none;">
                                    <label class="form-label">Department chief: </label>
                                    <input type="radio" name="status" value="0" class="chief-add"><br />

                                    <div class="departments" style="display: none">
                                        <label class="form-label">Choose department for department chief: </label><br>
                                        <select id="departmentForCard" style="width: 300px; height: 30px;">
                                            <option value="" selected>None</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->title}}">{{$department->title}}</option>
                                            @endforeach
                                        </select>
                                        <br />
                                    </div>

                                    <label class="form-label">Company manager: </label>
                                    <input type="radio" name="status" value="0" class="manager-add"><br />
                                </div>
                                <div style="display: block;">
                                    <div style="display: none">
                                        <label class="form-label">Teamlead: </label>
                                        <input type="radio" name="status" value="0" class="teamlead-add"><br />
                                    </div>
                                    <label class="form-label">Employee: </label>
                                    <input type="radio" name="status" value="1" class="employee-add" style="margin-bottom: 20px;"><br />
                                    <input id="departmentForCard" type="text" value="" style="display: none;">
                                </div>
                            @endif
                            <button class="btn btn-primary">Add new worker</button>
                        </form><hr />
                        <form method="POST" action="/users/import" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="form-control" id="fileControl" style="margin-bottom: 20px;">
                            <a class="btn btn-primary" href="/export">Save table example</a>
                            <button class="btn btn-primary uploadFile" disabled>Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- END USERS DATA -->

    <script>
        document.getElementById('fileControl').addEventListener('change', function(){
            if( this.value ){
                $(".uploadFile").prop("disabled", false);
            } else {
                $(".uploadFile").prop("disabled", true);
            }
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "timeOut": "1500",
            "hideMethod": "fadeOut",
            onHidden: function(){ window.location.reload(); }
        }

        $(document).ready(function()
        {
            $(document).on("click", ".pagination a", function(e)
            {
                e.preventDefault();
                let page = $(this).attr("href").split("page=")[1];
                $.ajax({
                    url: "/users/list?page=" + page,
                    success: function(data)
                    {
                        $('.table-responsive').html(data);
                    }
                })
            })
        })

        $(".add-worker-form").on("submit", function(e)
        {
            e.preventDefault();

            if($(".manager-add")[0].checked == true)
            {
                $(".manager-add").val("yes");
                $(".teamlead-add").val("no");
                $(".employee-add").val("no");
                $(".chief-add").val("no");
            }
            else if($(".teamlead-add")[0].checked == true)
            {
                $(".teamlead-add").val("yes");
                $(".manager-add").val("no");
                $(".employee-add").val("no");
                $(".chief-add").val("no");
            }
            else if($(".chief-add")[0].checked == true)
            {
                $(".chief-add").val("yes");
                $(".teamlead-add").val("no");
                $(".manager-add").val("no");
                $(".employee-add").val("no");
            }
            else if($(".employee-add")[0].checked == true)
            {
                $(".teamlead-add").val("no");
                $(".manager-add").val("no");
                $(".employee-add").val("yes");
                $(".chief-add").val("no");
            }

            else
            {
                $(".teamlead-add").val("no");
                $(".manager-add").val("no");
                $(".employee-add").val("no");
                $(".chief-add").val("no");
            }

            let name = $(".add-worker-form-name").val();
            let email = $(".add-worker-form-email").val();
            let password = $(".add-worker-form-password").val();
            let manager = $(".manager-add").val();
            let teamlead = $(".teamlead-add").val();
            let employee = $(".employee-add").val();
            let chief = $(".chief-add").val();
            let department = $("#departmentForCard").val();

            $.ajax({
                type: "POST",
                url: "/users",
                data:
                    {
                        "_token": "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        password: password,
                        manager: manager,
                        teamlead: teamlead,
                        employee: employee,
                        chief: chief,
                        department: department
                    },
                success: function(data)
                {
                    toastr["success"]("User uploaded!", "Success:")
                },
                error: function(data)
                {
                    toastr["error"]("Sorry, there was an error! Try it again!", "Error:")
                }
            })
        })
    </script>

@endsection
