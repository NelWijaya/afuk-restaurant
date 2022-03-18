@if(isset(Auth::user()->email))
    <strong>Welcome {{ Auth::user()->email }}</strong>
    <a href="/logout">Logout</a>
@else
    <script>window.location = "/loginaccount";</script>
@endif