@extends('layouts.app')
@section('title')
    Departments
@endsection
@section("content")

    <div style="background-color: white; text-align: center; margin-bottom: 90px; padding-top: 15px;">
        @if(Auth::user()->tariff === 1)
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new department</button><hr />

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="height: 100%">
                        <div class="modal-header">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add new department</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="margin-top: -5px;">
                            <form method="POST" action="/departments">
                                @csrf
                                <label><b>Department name:</b> <input type="text" class="form-control" name="title"></label><br /><br />
                                <button class="btn btn-primary">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div id="users-table">
            <table class="table table-striped table-sm bg-white">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Department name</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($departments as $department)
                    <tr >
                        <td class="id-{{$department->id}}">{{$department->id}}</td>
                        <td class="title-{{$department->id}}" style="cursor: pointer;"><p title="click to update">{{$department->title}}</p></td>
                        <td class="title-{{$department->id}}-newTitle" style="display: none;">
                            <form method="POST" action="/departments/update/{{$department->title}}" style="display: flex; align-content: center; justify-content: center">
                                @csrf
                                <input type="text" class="form-control" name="newTitle" style="width: 250px; margin: 3px;" value="{{$department->title}}">
                                <button class="btn btn-warning" style="margin: 3px;">SAVE</button>
                                <a class="cancel-form-{{$department->id}} btn btn-warning" style="margin: 3px;">CANCEL</a>
                            </form>
                        </td>
                        <td><a href="/departments/delete/{{$department->title}}">DELETE</a></td>
                    </tr>

                    <script>
                        $(".title-{{$department->id}}").on("click", function(e)
                        {
                            e.preventDefault();
                            $(".title-{{$department->id}}").css("display", "none");
                            $(".title-{{$department->id}}-newTitle").css("display", "block");

                            $(".cancel-form-{{$department->id}}").on("click", function(e)
                            {
                                e.preventDefault();
                                $(".title-{{$department->id}}").css("display", "block");
                                $(".title-{{$department->id}}-newTitle").css("display", "none");
                            })
                        })
                    </script>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
