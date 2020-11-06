@extends('layouts.app')

@section('title', 'Email Sent! - Login')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="column is-offset-3 is-half">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Magic link sent to {{ $email }}</div>
                    </div>
                    <div class="card-content">
                        <p class="has-text-justified">
                            An email has been sent to your {{ $email }}. Click that link and you'll be automatically logged-in.
                            No more passwords for you to remember. Ain't that awesome? I know.
                        </p>

                        <br>

                        <p class="has-text-justified">
                            PS: You can close this tab now. Go to your email 😉
                        </p>
                    </div>

                    <div class="card-footer">
                        <div class="card-footer-item">
                            Made with ♥ by&nbsp;
                            <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Karan Sanjeev</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
