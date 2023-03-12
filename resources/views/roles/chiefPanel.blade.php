@extends('layouts.app')

@section('title')
    Hello, {{Auth::user()->name}}!
@endsection

@section('content')
    <p style="text-align: center; font-size: 25px; font-family: 'Times New Roman'">Hello, {{Auth::user()->name}}! You are the chief!</p>
@endsection
