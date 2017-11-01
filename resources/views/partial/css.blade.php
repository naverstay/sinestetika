<!--link href="{{ asset('css/site/fonts/BrutalType.css') }}" rel="stylesheet"-->
@if (in_array(\Route::currentRouteName(), ['project']))
    <!--link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet"-->
@endif
<!--link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"-->

<link href="{{ asset('css/site.min.css') }}?t={{ time() }}" rel="stylesheet">
<link href="{{ asset('css/site/style.css') }}?t={{ time() }}" rel="stylesheet">