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
                        Buy once, use it till you exhaust the credits.
                    </p>
                </div>
            </div>

            <div class="columns">
                <div class="column is-8 is-offset-2">
                    @include('plans.list')
                </div>
            </div>
        </div>
    </section>
@endsection
