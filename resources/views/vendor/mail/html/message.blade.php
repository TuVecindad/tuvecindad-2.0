@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => 'http://52.47.177.115/'])
{{-- {{ config('app.name') }} --}}
<img src="{{asset('http://52.47.177.115/images/logo_text.png')}}" alt="{{config('app.name')}}" style="width:128px;height:128px;">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
