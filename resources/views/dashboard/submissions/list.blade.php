@extends('layouts.app')

@section('title', 'Submissions - Dashboard')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="panel">
                        <div class="panel-heading">
                            Form Submissions
                        </div>
                        <div class="panel-tabs">
                            <a href="#" class="is-active">All</a>
                            <a href="#" class="has-text-primary">Archived</a>
                        </div>
                        @if ($website->submissions->count())
                            @foreach ($website->submissions as $submission)
                                <a href="#" class="panel-block">
                                    <span class="tags has-addons mr-4">
                                        <div class="tag is-success is-light">Fields</div>
                                        <div class="tag">{{ $submission->data->count() }}</div>
                                    </span>
                                    {{ $submission->data['email'] }}
                                </a>
                            @endforeach
                        @else
                            <div class="panel-block">
                                You have recieved no submissions
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
