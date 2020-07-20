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
                            <pre><code>&lt;form action=&quot;<span class="has-text-primary">https://formzend.com/your@email.com</span>&quot; method=&quot;POST&quot;&gt;
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
            <div class="columns mt-4">
                <div class="column is-half is-offset-3">
                    <h3 class="is-size-3 has-text-grey-dark pb-4">Setting it up is easy!</h3>
                    <div class="content pt-4">
                        <h2 class="has-text-grey-dark">1. The form</h2>
                        <p>Change your form's <code>action</code> attribute to this and replace <b>your@email.com</b> with your own email.</p>
                        <div class="field">
                            <div class="control">
                                <input type="text" class="input is-primary" value="https://formzend.com/your@email.com" readonly>
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
@endsection
