@include('backend.partials.header')
@php
    app()->setLocale(auth()->user()->language_code);
@endphp
@yield('mainContent')

@include('backend.partials.footer')
