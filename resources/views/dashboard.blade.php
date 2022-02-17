<h1>Dashboard, {{ Str::ucfirst(Auth::user()->name) }}</h1>
<a href="{{ route('auth.logout') }}">
    <button>Logout</button>
</a>
