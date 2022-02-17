@if($errors->any())
    <ul>
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('auth.register') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Name"> <br>
    <input type="email" name="email" placeholder="Email"> <br>
    <input type="password" name="password" placeholder="Password"> <br>
    <input type="password" name="password_confirmation" placeholder="Password confirmation"> <br>

    <input type="submit">
</form>
