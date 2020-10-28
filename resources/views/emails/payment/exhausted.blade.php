@component('mail::message')
# Credits Exhausted

You have exhausted the credits in your FormZend account. To receive more submissions, you need to upgrade your plan.
Checkout the available plans, there is one for everyone 😉

@component('mail::button', ['url' => route('plans')])
Check Plans
@endcomponent

@component('mail::panel')
If you have any difficulty or need discounts, contact me at [Twitter](https://twitter.com/xXAlphaManXx).
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
