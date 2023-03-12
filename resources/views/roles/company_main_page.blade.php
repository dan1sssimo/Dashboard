@extends('layouts.app')
@section('title')
    Welcome!
@endsection
@section('content')

    <div class="company_buttons">
        <ul>
            <li><a href="/manager/{{Auth::user()->email}}">Company manager</a></li>
            <li><a href="/chief/{{Auth::user()->email}}">Departament chief</a></li>
            <li><a href="/teamlead/{{Auth::user()->email}}">Teamleader</a></li>
        </ul>
    </div>

@endsection