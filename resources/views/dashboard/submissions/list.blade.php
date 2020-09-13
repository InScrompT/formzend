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
                    <div class="panel">
                        <div class="panel-heading">
                            Form Submissions
                        </div>
                        <div class="panel-tabs">
                            <a href="#" class="is-active">All</a>
                            <a href="#" onclick="stillDev()" class="has-text-primary">Archived</a>
                        </div>
                        @if ($submissions->count())
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
                                    {{ $submission->data['email'] }}
                                </a>
                            @endforeach
                        @else
                            <div class="panel-block">
                                You have recieved no submissions
                            </div>
                        @endif
                    </div>

                    {{ $submissions->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </section>
@endsection
