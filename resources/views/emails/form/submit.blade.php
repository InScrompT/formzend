@component('mail::message')
# Form submission from [{{ $url }}]({{ $url }})

@component('mail::table')

| Field Name | Field Value |
| :--------: | :---------: |
@foreach($form as $key => $value)
| {{ $key }} | {{ $value }} |
@endforeach

@endcomponent

@component('mail::panel')
Don't want to receive form submissions anymore? Contact us!
@endcomponent

@endcomponent
