@component('mail::message')
# Introduction
{{ $data['subject'] }}

@component('mail::panel', ['url' => 'test'])
Panel to show
@endcomponent

{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
