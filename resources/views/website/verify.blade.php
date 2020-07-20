@extends('layouts.app')

@section('title', 'Verify email')

@section('content')
    @include('layouts.navbar')
    <section class="section pd-4">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="title">Verification mail sent 🎉!</div>
                            <hr>
                            <div class="subtitle">
                                Check {{ $email }} for a verification email.
                                This is because the form is submitted from <a href="{{ $url }}">{{ $url }}</a>
                                which is not verified yet
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
