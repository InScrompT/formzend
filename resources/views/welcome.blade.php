@extends('layouts.app')

@section('content')
    <script>hljs.initHighlightingOnLoad();</script>
    <style>
        .has-text-primary {
            color: #F57035 !important;
        }
    </style>
    <div class="container">
        <div class="navbar">
            <div class="navbar-brand">
                <div class="navbar-item">
                    <p class="is-size-4 has-text-primary">FormZend</p>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <a href="#" class="has-text-primary">Pricing</a>
                </div>
                <div class="navbar-item">
                    <a href="#" class="has-text-primary">FAQ</a>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-6">
                    <h1 class="is-size-1 has-text-grey-dark">Makes your form work.</h1>
                    <h2 class="is-size-4">Submit the form to us, we'll email it to you. <br /> No server, no signup, no database.</h2>
                    <h3 class="is-size-5 has-text-primary is-italic"> &mdash; Perfect for static sites!</h3>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <div class="card-content">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
