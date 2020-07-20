@component('mail::message')
# Hey there 👋

It's good to have you on board. Just verify your email and you'll be good to receive form submission from [{{ $url }}]({{ $url }})

@component('mail::button', ['url' => $verify])
Verify now 🔥
@endcomponent

@component('mail::panel')
If you don't remember setting up, just delete this email. Or contact us and we will help you.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
