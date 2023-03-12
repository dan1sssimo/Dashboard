@extends('layouts.app')
@section('title')
    Companies
@endsection

@section('content')
    <style>
        body {
            overflow-y: hidden;
            overflow-x: hidden;
        }

        .modal {
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
            background: #5988d8;
            border-radius: 10px;
            transition: all 0.5s;
        }
        .modal-button:hover {
            background: #072060;
        }

        .addNewCompanyForm {
            margin-top: -30px;
        }
    </style>

    <div id="myModal" class="modal">
        <div class="modal-content">
        <span class="close">
            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6.5332" y="19.6051" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-45 6.5332 19.6051)" fill="#737373"/>
                <rect x="20.1941" y="21.8475" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-135 20.1941 21.8475)" fill="#737373"/>
            </svg>
        </span>
            <div class="modal-content-text">
                <div class="modal-text">

                    <form class="addNewCompanyForm" method="POST">
                        @csrf
                        <label class="form-label">Title: </label>
                        <input type="text" name="title" class="form-control title"><br />

                        <label class="form-label">Company manager: </label>
                        <input type="text" name="chief" class="form-control chief"><br />

                        <label class="form-label">Manager email: </label>
                        <input type="text" name="email" class="form-control email"><br />
                        <br />

                        <button type="submit" class="modal-button btn btn-primary"><span class="modal-btn">ADD!</span></button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr class="table-secondary">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Company manager</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr class="table-dark">
                            <td class="id-{{$company->id}}">{{$company->id}}</td>
                            <td class="title-{{$company->id}}"><p title="click to update" style="cursor: pointer;">{{$company->title}}</p></td>
                            <td class="newTitle-{{$company->id}}" style="display: none;">
                                <form method="POST" action="/companies/update/{{$company->title}}" style="display: flex;">
                                    @csrf
                                    <input type="text" class="form-control" name="newTitle" style="width: 150px; margin: 3px;" value="{{$company->title}}">
                                    <button class="btn btn-warning" style="margin: 3px;">SAVE</button>
                                    <a class="cancel-form-{{$company->id}} btn btn-warning" style="margin: 3px;">CANCEL</a>
                                </form>
                            </td>
                            <td class="manager-{{$company->id}}"><p title="click to update" style="cursor: pointer;">{{$company->manager}}</p></td>
                            <td class="newManager-{{$company->id}}" style="display: none;">
                                <form method="POST" action="/companies/update-manager/{{$company->manager}}" style="display: flex;">
                                    @csrf
                                    <input type="text" class="form-control" name="newManager" style="width: 150px; margin: 3px;" value="{{$company->manager}}">
                                    <button class="btn btn-warning" style="margin: 3px;">SAVE</button>
                                    <a class="cancel-form-manager-{{$company->id}} btn btn-warning" style="margin: 3px;">CANCEL</a>
                                </form>
                            </td>
                            <td class="managerEmail-{{$company->id}}"><p title="click to update" style="cursor: pointer;">{{$company->manager_email}}</p></td>
                            <td class="newManagerEmail-{{$company->id}}" style="display: none;">
                                <form method="POST" action="/companies/update-managerEmail/{{$company->manager_email}}" style="display: flex;">
                                    @csrf
                                    <input type="text" class="form-control" name="newManagerEmail" style="width: 150px; margin: 3px;" value="{{$company->manager_email}}">
                                    <button class="btn btn-warning" style="margin: 3px;">SAVE</button>
                                    <a class="cancel-form-managerEmail-{{$company->id}} btn btn-warning" style="margin: 3px;">CANCEL</a>
                                </form>
                            </td>
                            <td><a href="/companies/delete/{{$company->title}}" style="cursor:pointer;">DELETE</a> / <a href="/companies/delete/manager/{{$company->manager_email}}" style="cursor:pointer;">DELETE {{$company->manager}}</a></td>
                        </tr>

                        <script>
                            $(".title-{{$company->id}}").on("click", function(e)
                            {
                                e.preventDefault();
                                $(".manager-{{$company->id}}").off("click");
                                $(".managerEmail-{{$company->id}}").off("click");
                                $(".title-{{$company->id}}").css("display", "none");
                                $(".newTitle-{{$company->id}}").css("display", "block");

                                $(".cancel-form-{{$company->id}}").on("click", function(e)
                                {
                                    $(".manager-{{$company->id}}").on("click");
                                    $(".managerEmail-{{$company->id}}").on("click");
                                    window.location.reload();
                                })
                            })

                            $(".manager-{{$company->id}}").on("click", function(e)
                            {
                                e.preventDefault();
                                $(".title-{{$company->id}}").off("click");
                                $(".managerEmail-{{$company->id}}").off("click");
                                $(".manager-{{$company->id}}").css("display", "none");
                                $(".newManager-{{$company->id}}").css("display", "block");

                                $(".cancel-form-manager-{{$company->id}}").on("click", function(e)
                                {
                                    $(".title-{{$company->id}}").on("click");
                                    $(".managerEmail-{{$company->id}}").on("click");
                                    window.location.reload();
                                })
                            })

                            $(".managerEmail-{{$company->id}}").on("click", function(e)
                            {
                                e.preventDefault();
                                $(".title-{{$company->id}}").off("click");
                                $(".manager-{{$company->id}}").off("click");
                                $(".managerEmail-{{$company->id}}").css("display", "none");
                                $(".newManagerEmail-{{$company->id}}").css("display", "block");

                                $(".cancel-form-managerEmail-{{$company->id}}").on("click", function(e)
                                {
                                    $(".title-{{$company->id}}").on("click");
                                    $(".manager-{{$company->id}}").on("click");
                                    window.location.reload();
                                })
                            })
                        </script>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a class="addNewCompany btn btn-primary" href="#" style="margin: 5px 0px 0px 10px;">Add new company</a>

    <script>
        $(".addNewCompany").on("click", function(e)
        {
            e.preventDefault();
            $(".modal").css("display", "flex");
        })

        $(".close").on("click", function(e)
        {
            e.preventDefault();
            $(".modal").css("display", "none");
        })
    </script>
@endsection
