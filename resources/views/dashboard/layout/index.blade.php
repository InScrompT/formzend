@extends('layouts.app')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            @if(Session::has('info'))
                <div class="columns">
                    <div class="column is-offset-2 is-8">
                        <div class="message is-info">
                            <div class="message-body">
                                {{ Session::get('info') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Session::has('error'))
                <div class="columns">
                    <div class="column is-offset-2 is-8">
                        <div class="message is-danger">
                            <div class="message-body">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="columns">
                    <div class="column is-offset-2 is-8">
                        <div class="message is-success">
                            <div class="message-body">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="columns">
                <div class="column is-offset-2 is-8">
                    <div class="mb-5">
                        <p class="is-size-4">Welcome back {{ auth()->user()->email }}</p>
                    </div>

                    @yield('dashboard')

                    <div class="panel">
                        <div class="panel-heading">Summary</div>
                        <div class="panel-block">
                            <p>
                                You've received <b>{{ auth()->user()->recieved }}</b> submissions and can receive
                                <b>{{ auth()->user()->allowed }}</b> more submissions.
                                <br>
                                Need more? Buy credits 😉
                            </p>
                        </div>
                        <div class="panel-block">
                            <p>
                                If there's something I can do for you, contact me at
                                <a href="https://twitter.com/xXAlphaManXx">Twitter</a>
                            </p>
                        </div>
                        <div class="panel-block">
                            <a class="button is-primary is-outlined is-fullwidth" href="{{ route('plans') }}">
                                Buy Credits
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
