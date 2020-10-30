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
                                <p>A verification email was sent to you before. Click on that to verify.</p>
                                <p class="pt-4">
                                    Lost the mail? No worries. <a href="{{ route('login') }}">Login</a> into your
                                    account and request another verification mail.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
