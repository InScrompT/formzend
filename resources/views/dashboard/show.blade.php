@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script>
        function stillDev() {
            swal(
                'Hold up chief!',
                'You discovered a feature that is still under development. Follow me on twitter to be on the know',
                'warning'
            );
        }
    </script>
@endsection

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
                            <a href="#" class="is-active">Verified</a>
                            <a onclick="stillDev()" class="has-text-primary">Unverified</a>
                            <a href="#" onclick="stillDev()" class="has-text-primary">Deactivated</a>
                        </div>

                        @foreach ($user->websites as $website)
                            <a href="{{ route('dashboard.website.submissions', [
                                $user->id,
                                $website->id
                            ]) }}" class="panel-block">
                                <span class="tags has-addons mr-4">
                                    <div class="tag is-success is-light">Submissions</div>
                                    <div class="tag">{{ $website->submissions->count() }}</div>
                                </span>
                                {{ $website->url }}
                            </a>
                        @endforeach
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
                            <button class="button is-primary is-outlined is-fullwidth">
                                Buy Credits
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
