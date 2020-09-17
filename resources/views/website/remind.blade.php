@extends('layouts.app')

@section('title', 'Let\'s verify email')

@section('content')
    @include('layouts.navbar')

    <section class="section mt-4">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="title">Email not verified ☹!</div>
                            <hr>
                            <div class="subtitle">
                                A verification email was sent to you before. Click on that to verify.
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="card-footer-item" onclick="document.getElementById('resend').submit();">
                                Resend verification mail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="{{ route('website.verify.resend', [$account, $website]) }}" method="POST" id="resend">@csrf</form>
@endsection
