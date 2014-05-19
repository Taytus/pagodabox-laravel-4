@extends("layout")
@section("content")
  {{ Form::open() }}
    @extends("layout")
@section("content")
  {{ Form::open() }}
    @if (Session::get("error"))
      {{ Session::get("error") }}<br />
    @endif
    @if (Session::get("status"))
      {{ Session::get("status") }}<br />
    @endif
    {{ Form::label("email", "Email") }}
    {{ Form::text("email", Input::old("email")) }}
    {{ Form::submit("reset") }}
  {{ Form::close() }}
@stop

    {{ $errors->first("token") }}<br />
    {{ Form::label("email", "Email") }}
    {{ Form::text("email", Input::get("email")) }}
    {{ $errors->first("email") }}<br />
    {{ Form::label("password", "Password") }}
    {{ Form::password("password") }}
    {{ $errors->first("password") }}<br />
    {{ Form::label("password_confirmation", "Confirm") }}
    {{ Form::password("password_confirmation") }}
    {{ $errors->first("password_confirmation") }}<br />
    {{ Form::submit("reset") }}
  {{ Form::close() }}
@stop