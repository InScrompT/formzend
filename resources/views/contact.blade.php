@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="content">
                        <h2>Contact me</h2>

                        <p>
                            I'm <a href="https://twitter.com/xXAlphaManXx">Karan Sanjeev</a>, a Indie Maker. FormZend is
                            made completely on my own time without any funding or investment. I respect privacy and believe it's a right.
                        </p>

                        <p>
                            If there is something that you need to talk about with me, shoot me a DM at
                            <a href="https://twitter.com/xXAlphaManXx">Twitter</a>. But if you still prefer using
                            contact forms, then here's one &mdash; <span class="is-italic has-text-primary">just for you</span>
                        </p>

                        <form action="{{ config('app.url') }}/formzend@alphaman.me" method="POST">
                            <div class="field">
                                <label for="name" class="label">Name</label>
                                <div class="control">
                                    <input type="text" class="input" name="name" id="name" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="field">
                                <label for="email" class="label">Email</label>
                                <div class="control">
                                    <input type="email" class="input" name="email" id="email" placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="field">
                                <label for="message" class="label">Message</label>
                                <div class="control">
                                    <textarea name="message" id="message" class="textarea" placeholder="I have pizzas for you..."></textarea>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-primary is-outlined is-fullwidth" type="submit">
                                        Shoot 🚀
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
