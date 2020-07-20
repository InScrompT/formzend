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
                            <div class="title">Email verified 🎉!</div>
                            <hr>
                            <div class="subtitle">
                                Forms from <a href="{{ $url }}">{{ $url }}</a> will now be directly sent to {{ $email }}.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
