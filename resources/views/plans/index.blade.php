@extends('layouts.app')

@section('title', 'Plans | Pricing')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <h1 class="title has-text-grey-dark">No subscription, no fuss.</h1>
                    <h2 class="subtitle is-italic has-text-primary">Pay for only what you use.</h2>
                </div>
            </div>

            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <p class="is-size-5">
                        I hate monthly plans. Why bill for something I might not even use?
                        If it's something I hate, why should I make the same hate available to you?
                        &mdash;
                        <i>Buy once, use it till you exhaust the credits.</i>
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="column is-8 is-offset-2">
                    @include('plans.normal')
                </div>
            </div>

{{--            <div class="columns">--}}
{{--                <div class="column is-8 is-offset-2">--}}
{{--                    @include('plans.subscription')--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="columns">
                <div class="column is-8 is-offset-2">
                    <div class="mb-4">
                        <p class="is-size-4 has-text-grey-dark has-text-weight-semibold">
                            <span class="has-text-primary">&rightarrow;</span>
                            What is a submission?
                        </p>
                        <p class="is-size-5 has-text-grey-dark">
                            A successful form submission where the data is sent to your email is considered a submission.
                        </p>
                    </div>
                    <div class="">
                        <p class="is-size-4 has-text-grey-dark has-text-weight-semibold">
                            <span class="has-text-primary">&rightarrow;</span>
                            What after I exhaust my credits?
                        </p>
                        <p class="is-size-5 has-text-grey-dark">
                            You'll be sent an email saying that you've exhausted your credits. You can then top-up your account
                            with credits if you wish to do so :)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
