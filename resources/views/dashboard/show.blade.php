@extends('dashboard.layout.index')

@section('title', 'Dashboard | Verified websites')

@section('dashboard')
    <div class="panel">
        <div class="panel-heading">
            Your websites
        </div>
        <div class="panel-tabs">
            <a href="#" class="is-active">Verified</a>
            <a href="{{ route('dashboard.websites.unverified') }}" class="has-text-primary">Unverified</a>
        </div>
        @forelse ($websites as $website)
            <a href="{{ route('dashboard.website.submissions', [
                $website->id
            ]) }}" class="panel-block">
                <div class="tags has-addons mr-4">
                    <div class="tag is-success is-light">Submissions</div>
                    <div class="tag">{{ $website->submissions_count }}</div>
                </div>
                {{ $website->url }}
            </a>
        @empty
            <div class="panel-block">
                <p class="has-text-danger">
                    You don't have any verified websites.
                </p>
            </div>
            <a href="{{ route('home') }}" class="panel-block has-text-info">
                Click here to integrate {{ config('app.name') }}
            </a>
        @endforelse
    </div>
@endsection
