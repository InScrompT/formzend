@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            @if(Session::has('info'))
                <div class="columns">
                    <div class="column is-offset-3 is-half">
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
                    <div class="column is-offset-3 is-half">
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
                    <div class="column is-offset-3 is-half">
                        <div class="message is-success">
                            <div class="message-body">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
                            <a href="#" class="is-active">Verified</a>
                            <a href="{{ route('dashboard.websites.unverified') }}" class="has-text-primary">Unverified</a>
                        </div>

                        @forelse ($user->websites->where('verified', true) as $website)
                            <a href="{{ route('dashboard.website.submissions', [
                                $user->id,
                                $website->id
                            ]) }}" class="panel-block">
                                <div class="tags has-addons mr-4">
                                    <div class="tag is-success is-light">Submissions</div>
                                    <div class="tag">{{ $website->submissions->count() }}</div>
                                </div>
                                {{ $website->url }}
                            </a>
                        @empty
                            <div class="panel-block">
                                <p class="has-text-danger">
                                    You don't have any verified websites.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <div class="panel">
                        <div class="panel-heading">Summary</div>
                        <div class="panel-block">
                            <p>
                                You've recieved <b>{{ $user->recieved }}</b> submissions and can recieve
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
