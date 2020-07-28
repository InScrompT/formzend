@extends('layouts.app')

@section('title', 'Make Your Form Work - Home')

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
                            <pre><code>&lt;form action=&quot;<span class="has-text-primary">{{ config('app.url') }}/your@email.com</span>&quot; method=&quot;POST&quot;&gt;
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
                    <h3 class="is-size-3 has-text-grey-dark pb-4">Setting it up is easy!</h3>
                    <div class="content">
                        <h2 class="has-text-grey-dark">1. The form</h2>
                        <p>Change your form's <code>action</code> attribute to this and replace <b>your@email.com</b> with your own email.</p>
                        <div class="field">
                            <div class="control">
                                <input type="text" class="input is-primary" value="{{ config('app.url') }}/your@email.com" readonly>
                            </div>
                        </div>

                        <hr>

                        <h2 class="has-text-grey-dark">2. Add <code>name</code> attribute to every field</h2>
                        <p>Ensure all <code>&lt;input&gt;</code>, <code>&lt;select&gt;</code> and <code>&lt;textarea&gt;</code> elements inside your form have a name attribute, otherwise you will not receive the data filled in these fields.</p>

                        <hr>

                        <h2 class="has-text-grey-dark">3. Submit the form and confirm email</h2>
                        <p>Go to your website and submit the form once. This will send you an email asking to confirm your email address.</p>

                        <hr>

                        <h2 class="has-text-grey-dark">4. That's it. It's all set!</h2>
                        <p>From now on, when someone submits that form, we'll forward you the data as email.</p>
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
                                    Forms will be be encrypted and stored in the database for premium users.
                                    Each form data is sent through Mailgun's API. So their privacy policy also applies.
                                </div>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-title">
                                        Is FormZend free?
                                    </div>
                                </div>
                                <div class="card-content has-text-justified">
                                    Yes. Until FormZend is out of it's beta period, FormZend is completely free.
                                    For updates, follow me on <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Twitter</a>.
                                    We'll also be sending out emails to everyone.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="content">
            <div class="section">
                <div class="container">
                    <div class="columns">
                        <div class="column is-half is-offset-3">
                            <p>
                                Made with ♥ by <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Karan Sanjeev</a> • An another Indie Project.
                                <br>
                                This whole website is open sourced at <a href="https://github.com/InScrompT/FormZend" class="has-text-primary">Github</a>
                            </p>
                            <p>
                                Need help? Tweet to me at <a href="https://twitter.com/xXAlphaManXx" class="has-text-primary">Twitter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
