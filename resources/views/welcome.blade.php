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
            <div class="columns level">
                <div class="column is-6">
                    <p class="title has-text-grey-dark level-item">
                        Submit form to us. We'll <span class="has-text-primary">&nbsp;email&nbsp;</span> it to you.
                    </p>
                    <p class="subtitle level-item">No server, no database. It's simple as that.</p>
                </div>
                <div class="column is-6 level-item">
                    <div class="card">
                        <div class="card-content">
                            <pre><code>&lt;form action=&quot;<span class="has-text-primary">https://formzend.com/your@email.com</span>&quot; method=&quot;post&quot;&gt;
  &lt;input type=&quot;email&quot; name=&quot;email&quot;&gt;
  &lt;input type=&quot;text&quot; name=&quot;name&quot;&gt;
  &lt;input type=&quot;text&quot; name=&quot;message&quot;&gt;
&lt;/form&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
