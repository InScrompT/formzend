@extends('layouts.app')

@section('title', 'Make Your Form Work')

@section('content')
    @include('layouts.navbar')
    <section class="section mt-4">
        <div class="container">
            <div class="columns level">
                <div class="column is-6 level-item">
                    <h1 class="is-size-1 has-text-grey-dark">Make your form work.</h1>
                    <h2 class="is-size-4">Submit the form to us, we'll email it to you. <br /> No server, no signup, no database.</h2>
                    <h3 class="is-size-5 has-text-primary is-italic"> &mdash; Perfect for static sites!</h3>
                </div>
                <div class="column is-6 level-item">
                    <div class="card">
                        <div class="card-content">
                            <pre><code>&lt;form action=&quot;<span class="has-text-primary">{{ route('form', ['your@email.com']) }}</span>&quot; method=&quot;POST&quot;&gt;
  &lt;input type=&quot;email&quot; name=&quot;email&quot;&gt;
  &lt;input type=&quot;text&quot; name=&quot;name&quot;&gt;
  &lt;input type=&quot;submit&quot; name=&quot;Send!&quot;&gt;
&lt;/form&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <hr>
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <h3 class="is-size-3 has-text-grey-dark pb-4">Setting it up is easy! 🤔</h3>
                    <div class="content">
                        <h3 class="has-text-grey-dark">1. The form</h3>
                        <p>Change your form's <code>action</code> attribute to this and replace <b>your@email.com</b> with your own email.</p>
                        <div class="field">
                            <div class="control">
                                <input type="text" class="input is-primary" value="{{ route('form', ['your@email.com']) }}" readonly>
                            </div>
                        </div>

                        <hr>

                        <h3 class="has-text-grey-dark">2. Add <code>name</code> attribute to every field</h3>
                        <p>Ensure all <code>&lt;input&gt;</code>, <code>&lt;select&gt;</code> and <code>&lt;textarea&gt;</code> elements inside your form have a name attribute, otherwise you will not receive the data filled in these fields.</p>

                        <hr>

                        <h3 class="has-text-grey-dark">3. Submit the form and confirm email</h3>
                        <p>Go to your website and submit the form once. This will send you an email asking to confirm your email address.</p>

                        <hr>

                        <h3 class="has-text-grey-dark">4. That's it. It's all set!</h3>
                        <p>From now on, when someone submits that form, we'll forward you the data as email.</p>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column is-half is-offset-3">
                    <h3 class="is-size-3 has-text-grey-dark pb-4">Need advanced feature sprinkles?</h3>
                    <div class="content">
                        <h3 class="has-text-grey-dark">
                            Custom Redirect
                        </h3>
                        <p>
                            Set an hidden text input field with name <code>_redirect</code>
                            and set it's value to a URL. Users will be automatically redirected to that URL
                        </p>
                        <pre><code>&lt;input type="text" name="<span class="has-text-primary">_redirect</span>" value="https://google.com/"&gt;</code></pre>

                        <hr>

                        <h3 class="has-text-grey-dark">
                            CORS Support
                        </h3>
                        <p>
                            Want to send data as an AJAX request? Send the data encoded as
                            <a href="https://developer.mozilla.org/en-US/docs/Web/API/FormData" target="_blank">
                                <code>FormData</code>
                            </a>
                            and {{ config('app.name') }} will handle everything else.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container">
            <hr>
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <a class="is-size-3 has-text-grey-dark pb-4" id="faq">Frequently Asked Questions</a>

                    <div class="columns mt-4">
                        <div class="column is-half">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-title">
                                        Is my data secure?
                                    </div>
                                </div>
                                <div class="card-content has-text-justified">
                                    Absolutely. Your data belongs to you. If you aren’t paying for a product,
                                    you are the product. I charge a small fee for
                                    {{ config('app.name') }}, because I sell service, not data.
                                </div>
                            </div>

                            <div class="pt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            I need to tell you *something*.
                                        </div>
                                    </div>
                                    <div class="card-content has-text-justified">
                                        Shoot me your thoughts at <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Twitter</a>.
                                        Always happy to help / know.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-title">
                                        Is {{ config('app.name') }} free?
                                    </div>
                                </div>
                                <div class="card-content has-text-justified">
                                    You can get started for free with 150 submissions. Add more submission credits later.
                                    Pay for only what you use. Checkout the
                                    <a href="{{ route('plans') }}" class="has-text-primary">plans here</a>
                                </div>
                            </div>

                            <div class="pt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-header-title">
                                            ...another FAQ here.
                                        </div>
                                    </div>
                                    <div class="card-content has-text-justified">
                                        I seriously don't know what to write here. Got questions? Message me at
                                        <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Twitter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container">
            <hr>
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <a class="is-size-3 has-text-grey-dark pb-4" id="pricing">But... what's the price? 💰</a>
                    <p class="is-size-5 pt-5">
                        The first <b>150</b> submissions are free. Add more submission credits later. Pay for only what you use.
                        Checkout the <a href="{{ route('plans') }}" class="has-text-primary">plans here</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container">
            <hr>
            <div class="column is-half is-offset-3">
                <a class="is-size-3 has-text-grey-dark pb-4" id="about">About {{ config('app.name') }}</a>
                <p class="is-size-5 pt-5">
                    I'm <a href="https://twitter.com/xXAlphaManXx">Karan Sanjeev</a>, a Indie Maker. {{ config('app.name') }} is
                    made completely on my own time without any funding or investment. I respect privacy and believe it's a right.
                </p>
                <p class="is-size-5 mt-3">
                    If you aren’t paying for a product, you are the product. I charge a small fee for {{ config('app.name') }},
                    because I sell service, not data.
                </p>
            </div>
        </div>
    </section>
    <section class="section pt-0">
        <div class="container">
            <hr>
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <p class="is-size-3 has-text-grey-dark pb-4">Just wanna get into the loop?</p>
                    <p class="is-size-6 pt-5 has-text-justified">
                        I'll send you important product updates directly to your inbox. I'll not send more than
                        3 emails a month (or even less). And your data is always secure :)
                    </p>

                    <br>

                    <form action="{{ route('form', ['formzend@alphaman.me']) }}" method="POST">
                        <div class="field">
                            <label for="name" class="label">Name</label>
                            <div class="control">
                                <input type="text" class="input" name="name" id="name">
                            </div>
                        </div>
                        <div class="field">
                            <label for="email" class="label">Email</label>
                            <div class="control">
                                <input type="email" class="input" name="email" id="email">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary is-outlined is-fullwidth" type="submit">Enroll 🎉 </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection
