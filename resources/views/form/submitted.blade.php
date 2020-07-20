@extends('layouts.app')

@section('title', 'Form submitted')

@section('content')
    @include('layouts.navbar')

    <section class="section pt-4">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="title">Form submitted 🎉!</div>
                            <hr>
                            <div class="subtitle">
                                We have received your submission. We'll get back to you soon!
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ $url }}" class="card-footer-item">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
