@section("header")
  <div class="header">
    <div class="container">
      <h1>Tutorial</h1>
      @if (Auth::check())
        <h3>You are logged in!</h3><p>
        <a href="{{ URL::route("user/logout") }}">
          logout
        </a> |
        <a href="{{ URL::route("user/profile") }}">
          profile
        </a>
      @else
      <h3>You are not logged in!</h3><p>
        <a href="{{ URL::route("user/login") }}">
          login
        </a>
      @endif
    </div>
  </div>
@show