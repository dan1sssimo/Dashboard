<style>
    body {
        overflow-x: hidden;
        background-color: white;
    }

    .modalUpdateUser {
        display: none; /* Hidden by default */
        justify-content: center;
        align-items: center;
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    /* Modal Content/Box */
    .modal-content {
        height: 500px;
        width: 385.9px;
        padding: 15px;
        background: #FFFFFF;
        border: 1px solid #D1D1D1;
        border-radius: 10px;
    }
    .close {
        display: flex;
        justify-content: right;
        align-items: center;
        margin: 0 0 30px;
    }
    .close svg {
        cursor: pointer;
    }
    .modal-content-text {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .modal-content-check {
        margin: 0 0 45px;
    }
    .modal-text {
        margin: 0 0 40px;
    }
    .modal-t {
        width: 225px;
        height: 29px;

        font-family: 'Proxima Nova', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 29px;
        text-align: center;

        color: #000000;

    }
    .modal-button {
        display: flex;
        justify-content: center;
        align-items: center;

        height: 70px;
        width: 300px;
        text-decoration: none;
        background: #59D876;
        border-radius: 10px;
        transition: all 0.5s;
    }
    .modal-button:hover {
        background: #42a457;
    }

    .updateDataForm {
        margin-top: -30px;
    }

    #app {
        background: white;
    }
</style>

@if(Auth::user()->manager === "yes")
    <div id="users-table" style="height: 100%;">
        <table class="table table-striped table-sm bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Department</th>
                <th scope="col">Actions</th>
                @if(Auth::user()->admin == "yes")<th scope="col">Company</th>@endif
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr >
                    <td><p class="m-3">{{$user->id}}</p></td>
                    <td>
                        <p class="table-user-name-{{$user->name}} userName m-3">
                            @if($user->chief == "yes")
                                <strong title="department chief" style="cursor: pointer; color: green">
                                    {{$user->name}}
                                </strong>
                            @elseif($user->manager == "yes")
                                <strong title="company manager" style="cursor: pointer; color: blue">
                                    {{$user->name}}
                                </strong>
                            @endif
                        </p>
                    </td>
                    <td class="userEmail">  <p class="m-3">{{$user->email}}</p></td>

                    <td>
                        @if($user->manager != "yes" && $user->chief == "yes")
                            <p style="margin-top: 18px;" class="role-{{$user->id}} userRole">Department Chief</p>
                        @elseif($user->chief != "yes" && $user->manager == "yes")
                            <p style="margin-top: 18px;" class="role-{{$user->id}} userRole">Company manager</p>
                        @endif
                        <div class="btn-group">
                            {{--                        <button type="button" class="btn btn-second dropdown-toggle m-3" data-bs-toggle="dropdown" aria-expanded="false">--}}
                            {{--                            @if($user->manager != "yes" && $user->chief == "yes")--}}
                            {{--                                <p class="role-{{$user->id}} userRole">Department Chief</p>--}}
                            {{--                            @elseif($user->chief != "yes" && $user->manager == "yes")--}}
                            {{--                                <p class="role-{{$user->id}} userRole">Company manager</p>--}}
                            {{--                            @endif--}}
                            {{--                        </button>--}}
                            {{--                        <ul class="dropdown-menu">--}}
                            {{--                            @if(!($user->chief != "yes" && $user->manager == "yes"))--}}
                            {{--                                                    <li>--}}
                            {{--                                                        <form class="table-form-select-manager-{{$user->id}}">--}}
                            {{--                                                            <button class="btn-select-{{$user->id}} dropdown-item" >Company Manager</button>--}}
                            {{--                                                        </form>--}}
                            {{--                                                    </li>--}}
                            {{--                            @endif--}}
                            {{--                            @if(!($user->manager != "yes" && $user->chief == "yes"))--}}
                            {{--                                                    <li><form class="table-form-select-teamlead-{{$user->id}}">--}}
                            {{--                                                            <button class="btn-select-{{$user->id}} dropdown-item" >Department Chief</button>--}}
                            {{--                                                        </form></li>--}}
                            {{--                            @endif--}}
                            {{--                        </ul>--}}
                        </div>
                    </td>
                    <td>@if($user->manager === "yes")<p style="margin-top: 18px;">-</p>
                        @else
                            @if($user->department == "" || $user->department == null)
                                <p style="margin-top: 18px;">None department</p>
                            @else
                                <p style="margin-top: 18px;">{{$user->department}}</p>
                            @endif
                        @endif
                    </td>
                    <td><a type="button" class="update btn btn-primary" href="/users/{{$user->email}}">UPDATE</a><a type="button" class="btn btn-danger m-3" href="/users/delete/{{$user->email}}">DELETE</a></td>
                    <script>
                        $('.table-form-select-manager-{{$user->id}}').on("submit", function(e) {
                            let name = "{{$user->name}}";
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "/users/manager_status/{{$user->email}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                },
                                success: function (data) {
                                    alert("You changed " + name + " role on manager!");
                                    window.location.reload();
                                }
                            })
                        })
                        $('.table-form-select-chief-{{$user->id}}').on("submit", function(e) {
                            let name = "{{$user->name}}";
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "/users/chief_status/{{$user->email}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                },
                                success: function (data) {
                                    alert("You changed " + name + " role on chief!");
                                    window.location.reload();
                                }
                            })
                        })
                    </script>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.simple-bootstrap-4') }}<br /><br /><br />
    </div>

    <div id="myModal" class="modalUpdateUser">
        <div class="modal-content">
        <span class="close">
            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6.5332" y="19.6051" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-45 6.5332 19.6051)" fill="#737373"/>
                <rect x="20.1941" y="21.8475" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-135 20.1941 21.8475)" fill="#737373"/>
            </svg>
        </span>
            <div class="modal-content-text">
                <div class="modal-text">

                    <form class="updateDataForm">

                        <label class="form-label">Name: </label>
                        <input type="text" name="name" class="form-control name" placeholder="Name">

                        <label class="form-label">Email: </label>
                        <input type="text" name="email" value="@gmail.com" class="form-control email">

                        <br />
                        <label class="form-label">Role: </label>
                        <br />

                        @if(Auth::user()->manager === "yes")
                            <label class="form-label">Company Manager: </label>
                            <input type="radio" name="status" value="0" class="manager"><br />

                            <label class="form-label">Department Chief: </label>
                            <input type="radio" name="status" value="0" class="chief"><br />
                            <div class="departments" style="display: none">
                                <label class="form-label">Choose department: </label><br>
                                <select id="department" style="width: 300px; height: 30px;">
                                    <option value="" selected>None</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->title}}">{{$department->title}}</option>
                                    @endforeach
                                </select>
                                <br />
                            </div>
                            <script>
                                $(".chief").on("click", function()
                                {
                                    $(".departments").css("display", "block");
                                })

                                $(".manager").on("click", function()
                                {
                                    $(".departments").css("display", "none");
                                })
                            </script>
                        @elseif(Auth::user()->chief === "yes")
                            <label class="form-label">Teamlead: </label>
                            <input type="radio" name="status" value="0" class="teamlead"><br />

                            <label class="form-label">Employee: </label>
                            <input type="radio" name="status" value="0" class="employee"><br />
                        @endif
                        <br />
                        <button type="submit" class="modal-button btn btn-primary"><span class="modal-btn">UPDATE!</span></button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function()
        {
            $(".update").on("click", function(e)
            {
                let row = $(this).closest("tr");
                $(".name").val(row.get(0).querySelector('.userName').innerText);
                $(".email").val(row.get(0).querySelector('.userEmail').innerText);
                if ((row.get(0).querySelector('.userRole').innerText) == 'Chief')
                {
                    $(".chief")[0].checked = true
                }
                else if((row.get(0).querySelector('.userRole').innerText) == 'Manager')
                {
                    $(".manager")[0].checked = true
                }
                else if((row.get(0).querySelector('.userRole').innerText) == 'Teamlead')
                {
                    $(".teamlead")[0].checked = true
                }
                else if((row.get(0).querySelector('.userRole').innerText) == 'Employee')
                {
                    $(".employee")[0].checked = true
                }

                else
                {
                    $(".teamlead").val("no");
                    $(".manager").val("no");
                    $(".chief").val("no");
                }
                e.preventDefault();
                $("#myModal").css("display", "flex");
                $(".updateDataForm").on("submit", function(e)
                {
                    if($(".chief")[0].checked == true)
                    {
                        $(".chief").val("yes");
                        $(".manager").val("no");
                        $(".teamlead").val("no");
                    }
                    else if($(".manager")[0].checked == true)
                    {
                        $(".manager").val("yes");
                        $(".teamlead").val("no");
                        $(".chief").val("no");
                    }
                    else if($(".teamlead")[0].checked == true)
                    {
                        $(".teamlead").val("yes");
                        $(".manager").val("no");
                        $(".chief").val("no");
                    }

                    else if($(".employee")[0].checked == true)
                    {
                        $(".teamlead").val("no");
                        $(".manager").val("no");
                        $(".chief").val("no");
                        $(".employee").val("yes");
                    }

                    e.preventDefault();
                    let name = $(".name").val();
                    let email = $(".email").val();
                    let manager = $(".manager").val();
                    let chief = $(".chief").val();
                    let teamlead = $(".teamlead").val();
                    let employee = $(".employee").val();
                    let department = $("#department").val();
                    let supervisor = null;

                    $.ajax({
                        type: "PUT",
                        url: "/users/" + email,
                        data: {
                            "_token": "{{csrf_token()}}",
                            name: name,
                            email: email,
                            manager: manager,
                            chief: chief,
                            teamlead: teamlead,
                            employee: employee,
                            department: department,
                            supervisor: supervisor
                        },
                        success: function(data)
                        {
                            window.location.reload();
                        }
                    })
                })
            })
        });

        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            $("#myModal").css("display", "none");
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                $("#myModal").css("display", "none");
            }
        }
    </script>
@elseif(Auth::user()->admin === "yes")
    <div id="users-table" style="min-height: 500px;">
        <table class="table table-striped table-sm bg-white">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Company</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        @if($user->manager == "yes")
                            <p style="color: blue; cursor: pointer">CM: {{$user->name}}</p>
                        @elseif($user->admin == "yes")
                            <p style="color: red; cursor: pointer">ADMIN: {{$user->name}}</p>
                        @endif
                    </td>
                    <td>{{$user->email}}</td>
                    <td>@if($user->company_title !== null) {{$user->company_title}} @else None @endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.simple-bootstrap-4') }}<br /><br /><br />
    </div>
@elseif(Auth::user()->chief === "yes")
    <p style="font-size: 13px;">* Your manager: <b>{{$manager}}</b></p><br />
    <div id="users-table" style="min-height: 500px;">
        <table class="table table-striped table-sm bg-white">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="name-{{$user->name}}">
                        <form class="changeName-{{$user->id}}" style="display: block; margin-top: 20px;">
                            <input type="text" value="{{$user->name}}" class="newTableName-{{$user->id}}">
                            <button type="submit" class="btn btn-primary saveChangeName">EDIT</button>
                        </form>
                    </td>
                    <td class="email-{{$user->email}}">
                        <form class="changeEmail-{{$user->id}}" style="display: block; margin-top: 20px;">
                            <input type="text" value="{{$user->email}}" class="newTableEmail-{{$user->id}}">
                            <button type="submit" class="btn btn-primary saveChangeEmail">EDIT</button>
                        </form>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle m-3" data-bs-toggle="dropdown" aria-expanded="false">
                                @if($user->teamlead == "yes")
                                    <p class="role-{{$user->id}} userRole">Teamlead</p>
                                @elseif($user->employee == "yes")
                                    <p class="role-{{$user->id}} userRole">Employee</p>
                                @endif
                            </button>
                            <ul class="dropdown-menu">
                                @if($user->teamlead == "yes")
                                    <li>
                                        <form class="table-form-select-employee-{{$user->id}}">
                                            <button class="btn-select-{{$user->id}} dropdown-item" >Employee</button>
                                        </form>
                                    </li>
                                @endif
                                @if($user->employee == "yes")
                                    <li>
                                        <form class="table-form-select-teamlead-{{$user->id}}">
                                            <button class="btn-select-{{$user->id}} dropdown-item" >Teamlead</button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </td>
                    <td><a type="button" class="btn btn-danger m-3" href="/users/delete/{{$user->email}}">DELETE</a></td>
                </tr>
                <script>
                    $(document).ready(function()
                    {
                        $(".changeName-{{$user->id}}").on("submit", function (e)
                        {
                            e.preventDefault();
                            let name = $(".newTableName-{{$user->id}}").val();
                            $.ajax({
                                type: "POST",
                                url: "/users/changeName_chief/{{$user->name}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    name: name
                                },
                                success: function(data) {
                                    alert(data.success);
                                    window.location.reload();
                                }
                            })
                        })
                        $(".changeEmail-{{$user->id}}").on("submit", function (e)
                        {
                            e.preventDefault();
                            let email = $(".newTableEmail-{{$user->id}}").val();
                            $.ajax({
                                type: "POST",
                                url: "/users/changeEmail_chief/{{$user->email}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    email: email
                                },
                                success: function(data) {
                                    alert(data.success);
                                    window.location.reload();
                                }
                            })
                        })
                    })

                    $('.table-form-select-teamlead-{{$user->id}}').on("submit", function(e) {
                        let name = "{{$user->name}}";
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "/users/teamlead_status/{{$user->email}}",
                            data: {
                                "_token": "{{csrf_token()}}",
                            },
                            success: function (data) {
                                alert("You changed " + name + " role on teamlead!");
                                window.location.reload();
                            }
                        })
                    })
                    $('.table-form-select-employee-{{$user->id}}').on("submit", function(e) {
                        let name = "{{$user->name}}";
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "/users/employee_status/{{$user->email}}",
                            data: {
                                "_token": "{{csrf_token()}}",
                            },
                            success: function (data) {
                                alert("You changed " + name + " role on employee!");
                                window.location.reload();
                            }
                        })
                    })
                </script>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.simple-bootstrap-4') }}<br /><br /><br />
    </div>
@elseif(Auth::user()->teamlead === "yes")
    <p style="font-size: 13px;">* Your manager: <b>{{$manager}}</b></p>
    @if($chief !== null)<p style="font-size: 13px;">** Your department chief: <b>{{$chief}}</b>@endif</p><br />
    <div id="users-table" style="min-height: 500px;">
        <table class="table table-striped table-sm bg-white">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="name-{{$user->name}}">
                        <form class="changeName-{{$user->id}}" style="display: block; margin-top: 20px;">
                            <input type="text" value="{{$user->name}}" class="newTableName-{{$user->id}}">
                            <button type="submit" class="btn btn-primary saveChangeName">EDIT</button>
                        </form>
                    </td>
                    <td class="email-{{$user->email}}">
                        <form class="changeEmail-{{$user->id}}" style="display: block; margin-top: 20px;">
                            <input type="text" value="{{$user->email}}" class="newTableEmail-{{$user->id}}">
                            <button type="submit" class="btn btn-primary saveChangeEmail">EDIT</button>
                        </form>
                    </td>
                    <td><p style="margin-top: 20px;">Employee</p></td>
                    <td><a type="button" class="btn btn-danger m-3" href="/users/delete/{{$user->email}}">DELETE</a></td>
                </tr>

                <script>
                    $(document).ready(function()
                    {
                        $(".changeName-{{$user->id}}").on("submit", function (e)
                        {
                            e.preventDefault();
                            let name = $(".newTableName-{{$user->id}}").val();
                            $.ajax({
                                type: "POST",
                                url: "/users/changeName_chief/{{$user->name}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    name: name
                                },
                                success: function(data) {
                                    alert(data.success);
                                    window.location.reload();
                                }
                            })
                        })
                        $(".changeEmail-{{$user->id}}").on("submit", function (e)
                        {
                            e.preventDefault();
                            let email = $(".newTableEmail-{{$user->id}}").val();
                            $.ajax({
                                type: "POST",
                                url: "/users/changeEmail_chief/{{$user->email}}",
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    email: email
                                },
                                success: function(data) {
                                    alert(data.success);
                                    window.location.reload();
                                }
                            })
                        })
                    })

                </script>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.simple-bootstrap-4') }}<br /><br /><br />
    </div>
    @endif
