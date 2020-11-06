@extends('layouts.app')

@section('title', 'Login - Dashboard')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="column is-offset-3 is-half">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-title">Get magic link and login</div>
                    </div>
                    <div class="card-content">
                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="field">
                                <label for="email">Email</label>
                                <div class="control">
                                    <input type="email" class="input @error('email') is-danger @enderror"
                                        id="email" name="email" placeholder="your@email.com" value="{{ old('email') }}"
                                        required>
                                </div>
                                @error('email')
                                    <p class="help is-danger">There is no account with this email.</p>
                                @enderror
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input type="submit" value="Get magic link 🎉!" class="button is-primary is-outlined is-fullwidth">
                                </div>
                            </div>
                        </form>

                        <hr>

                        <p class="has-text-justified">
                            We'll send you an email that will have magic link. No need of passwords.
                            You will be logged in automatically.
                        </p>
                    </div>

                    <div class="card-footer">
                        <div class="card-footer-item">
                            Made with ♥ by&nbsp;
                            <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Karan Sanjeev</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
