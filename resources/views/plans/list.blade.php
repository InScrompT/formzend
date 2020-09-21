<hr>
<h1 class="title has-text-centered has-text-grey-dark">Pay Once Plans</h1>

<div class="columns is-centered">
    @foreach($normalPlan as $plan)
        <div class="column is-4">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title has-text-grey-dark">{{ $plan->name }}</p>
                </div>
                <div class="card-content">
                    <span class="is-size-4">Get {{ $plan->quantity }} submissions</span>
                    &mdash;
                    <span class="is-size-5">For just {{ $plan->amount }}$</span>

                    <br>
                    <br>

                    @if(strtolower($plan->name) === 'free')
                        <button class="button is-fullwidth is-outlined">Create free account</button>
                    @else
                        <button class="button is-fullwidth is-primary is-outlined">Buy {{ $plan->name }}</button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
