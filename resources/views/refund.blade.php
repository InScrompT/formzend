@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="content">
                        <h2>{{ config('app.name') }} Refund & Cancellation Policy</h2>

                        Since {{ config('app.name') }} sells digital service, we cannot either refund nor cancel your purchase. But if
                        in case you are not happy with your purchase and did not like what {{ config('app.name') }} delivers, you can
                        contact me directly at <a href="mailto:formzend@alphaman.me">formzend@alphaman.me</a> and a refund
                        will be processed if the reason is agree-able.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
