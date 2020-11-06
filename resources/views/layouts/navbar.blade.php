<div class="container">
    <div class="navbar">
        <div class="navbar-brand">
            <div class="navbar-item">
                <a class="is-size-4 has-text-primary" href="{{ route('home') }}">{{ config('app.name') }}</a>
            </div>
            <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu" id="navMenu">
            <div class="navbar-end">
                @auth
                    <div class="navbar-item">
                        <a href="{{ route('dashboard') }}" class="has-text-primary">Dashboard</a>
                    </div>
                    <div class="navbar-item">
                        <a href="{{ route('logout') }}" class="has-text-primary">Logout</a>
                    </div>
                @else
                    <div class="navbar-item">
                        <a href="{{ route('home') }}#pricing" class="has-text-primary">Pricing</a>
                    </div>
                    <div class="navbar-item">
                        <a href="{{ route('home') }}#faq" class="has-text-primary">FAQ</a>
                    </div>
                    <div class="navbar-item">
                        <a href="{{ route('login') }}" class="has-text-primary">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
