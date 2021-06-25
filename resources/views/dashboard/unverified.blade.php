@extends('dashboard.layout.index')

@section('title', 'Dashboard | Unverified websites')

@section('dashboard')
    <div class="panel">
        <div class="panel-heading">
            Your websites
        </div>
        <div class="panel-tabs">
            <a href="{{ route('dashboard') }}" class="has-text-primary">Verified</a>
            <a href="#" class="is-active">Unverified</a>
        </div>

        @forelse(auth()->user()->websites->where('verified', false) as $website)
            <div class="panel-block">
                <a href="{{ route('website.verify.resend', [$website]) }}"
                   class="button is-small is-outlined is-primary mr-5">Verify Now</a>

                {{ $website->url }}
            </div>
        @empty
            <div class="panel-block">
                <span class="has-text-success">Awesome, you don't have any unverified websites</span>
            </div>
        @endforelse
    </div>
@endsection
