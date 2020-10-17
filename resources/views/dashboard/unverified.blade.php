@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-offset-3 is-half">
                    <div class="mb-5">
                        <p class="is-size-4">Welcome back {{ $user->email }}</p>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            Your websites
                        </div>
                        <div class="panel-tabs">
                            <a href="{{ route('dashboard') }}" class="has-text-primary">Verified</a>
                            <a href="#" class="is-active">Unverified</a>
                        </div>

                        @forelse($user->websites->where('verified', false) as $website)
                            <div class="panel-block">
                                <a href="{{ route('website.verify.resend', [$user, $website]) }}"
                                   class="button is-small is-outlined is-primary mr-5">Verify Now</a>

                                {{ $website->url }}
                            </div>
                        @empty
                            <div class="panel-block">
                                <span class="has-text-success">Awesome, you don't have any unverified websites</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="panel">
                        <div class="panel-heading">Summary</div>
                        <div class="panel-block">
                            <p>
                                You've received <b>{{ $user->recieved }}</b> submissions and can receive
                                <b>{{ $user->allowed }}</b> more submissions.
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
