@if(session()->has('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul>
        @foreach($errors->all() as $message)
            <li style="color: red">{{ $message }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('auth.login') }}" method="post">
    @csrf

    <input type="email" placeholder="Email" name="email"> <br>
    <input type="password" placeholder="Password" name="password"> <br>

    <input type="submit">
</form>
