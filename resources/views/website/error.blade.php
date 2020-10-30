@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="section mt-4">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-header has-background-danger">
                            <p class="card-header-title has-text-white is-size-4">{{ $title }}</p>
                        </div>
                        <div class="card-content">
                            <div class="subtitle">
                                {{ $error }}
                            </div>
                        </div>
                    </div>

                    <article class="message is-success mt-6">
                        <div class="message-body">
                            If there's any problem that you need help with,
                            contact me at <a href="https://twitter.com/xXAlphaManXx">Twitter</a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
