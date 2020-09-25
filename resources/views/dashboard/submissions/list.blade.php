@extends('layouts.app')

@section('title', 'Submissions - Dashboard')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script>
        function stillDev() {
            swal(
                'Hold up chief!',
                'You discovered a feature that is still under development. Follow me on twitter to be on the know',
                'warning'
            );
        }
    </script>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <article class="message is-info">
                        <div class="message-body">
                            <p class="has-text-weight-semibold">Tips:</p>
                            <p class="mt-2">
                                Have a <code>name</code> field or an <code>email</code> field in your form.
                                Allows you to easily find the form submission that you are looking for.
                            </p>
                        </div>
                    </article>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="panel">
                        <div class="panel-heading">
                            Form Submissions
                        </div>
                        <div class="panel-tabs">
                            <a href="#" class="is-active">All</a>
                            <a onclick="stillDev()">Archive</a>
                        </div>
                        @if ($submissions)
                            @foreach ($submissions as $submission)
                                <a href="{{ route('dashboard.website.submissions.show', [
                                    $user->id,
                                    $website->id,
                                    $submission->id
                                ]) }}" class="panel-block">
                                    <span class="tags has-addons mr-4">
                                        <div class="tag is-success is-light">Fields</div>
                                        <div class="tag">{{ $submission->data->count() }}</div>
                                    </span>
                                    {{
                                        $submission->data['email'] ??
                                        $submission->data['name'] ??
                                        'Submission on ' . $submission->created_at
                                    }}
                                </a>
                            @endforeach
                        @else
                            <div class="panel-block">
                                You have received no submissions
                            </div>
                        @endif
                    </div>

                    {{ $submissions->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </section>
@endsection
