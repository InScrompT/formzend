@component('mail::message')
# Account Upgraded 🎉

You have now upgraded your account for **{{ $price }}$** which gives you **{{ $submissions }}** more for a total of **{{ $total }}**
submissions.

Your transaction code is: _{{ $code }}_

@component('mail::panel')
I just wanted to thank you. You have helped keep FormZend up and running.

If there is anything you'd like to see in FormZend,
reply to this email or shoot me a DM at [Twitter](https://twitter.com/xXAlphaManXx).
@endcomponent

@endcomponent
