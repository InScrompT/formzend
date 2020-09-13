@component('mail::message')
# Hey there 👋

You can login into your {{ config('app.name') }} dashboard using the button below.

@component('mail::button', ['url' => $url])
Login now 🔥
@endcomponent

@component('mail::panel')
If you don't remember asking for a login link, just disregard this email.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
