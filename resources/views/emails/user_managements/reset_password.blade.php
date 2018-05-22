@component('mail::message')
# Hi, {!! $data['name'] !!}

{!! $data['message'] !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
