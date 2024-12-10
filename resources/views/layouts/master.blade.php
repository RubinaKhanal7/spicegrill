<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @php

    @endphp



@include('includes.head')

<body>
    <div id="fb-root">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="fXefOAoL"></script>
</div>

    @include('includes.topnav')

    @include('includes.navbar')







    @yield('content')


    @include('includes.footer')

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('lightbox/dist/js/lightbox-plus-jquery.js') }}"></script>

    @yield('scripts')
</body>

</html>
