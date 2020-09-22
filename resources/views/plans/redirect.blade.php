@extends('layouts.app')

@section('title', 'Redirecting you...')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <h1 class="title has-text-grey-dark">You're being redirected...</h1>
                    <h2 class="subtitle">
                        If that didn't happen, <a href="#" class="has-text-primary">click here</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded" id="payment-form">
        <input type="hidden" name="key_id" value="{{ config('razorpay.api.key') }}">
        <input type="hidden" name="order_id" value="{{ $order }}">
        <input type="hidden" name="name" value="FormZend">
        <input type="hidden" name="description" value="Form submissions, made easy!">
        <input type="hidden" name="image" value="https://cdn.razorpay.com/logos/BUVwvgaqVByGp2_large.png">
        <input type="hidden" name="prefill[email]" value="{{ $user->email }}">
        <input type="hidden" name="callback_url" value="{{ route('plans.payment.done') }}">
        <input type="hidden" name="cancel_url" value="{{ route('plans.payment.cancelled') }}">
        <button>Submit</button>
    </form>

    <script>
        function submitForm() {
            document.getElementById('payment-form').submit();
        }

        window.onload = submitForm;
    </script>
@endsection

