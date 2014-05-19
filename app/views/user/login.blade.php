@extends("layout")
@section("content")
  {{ Form::open(array('url' => '/login', 'method' => 'post')) }}
  {{ $errors->first("username") }}<br />
  {{ $errors->first("password") }}<br />
  {{ Form::label("username", "Username") }}
  {{ Form::text("username") }}
  {{ Form::label("password", "Password") }}
  {{ Form::password("password") }}
  {{ Form::submit("login") }}
  {{ Form::close() }}
@stop