<hr>
<h1 class="title has-text-centered has-text-grey-dark">Pay Once Plans</h1>

<div class="columns is-centered">
    @foreach($normalPlan as $plan)
        <div class="column is-half">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title has-text-grey-dark">{{ $plan->name }}</p>
                </div>
                <div class="card-content">
                    <p class="is-size-4">Get {{ $plan->quantity }} submissions</p>
                    <p class="is-size-5">
                        &mdash; For @if($plan->amount) just {{ $plan->amount }}$ @else Free @endif
                    </p>

                    <div class="mt-5">
                        @if(strtolower($plan->name) === 'free')
                            <a class="button is-fullwidth is-outlined" href="{{ route('dashboard') }}">
                                Create free account
                            </a>
                        @else
                            <a class="button is-fullwidth is-primary is-outlined" href="{{ route('plans.buy', $plan->id) }}">
                                Buy {{ $plan->name }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<hr>
