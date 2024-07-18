<div class="wrapper">

    <!--=================================
     preloader -->

    {{--<div id="pre-loader">--}}
        {{--<img src="{{ asset('static/website/images/pre-loader/loader-06.svg') }}" alt="">--}}
    {{--</div>--}}

    <!--=================================
     preloader -->

    
        @include('website.partials.header')
    

    

    @yield('content')

    @include('website.partials.footer')

</div>
