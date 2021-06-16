@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'asd'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
