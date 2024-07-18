<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<script src="{{asset('static/website/js/archworkz/scripts.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/minislider.js')}}"></script>

<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<script src="{{asset('static/website/js/archworkz/aos.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/bootstrap.min.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/validate.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/purecounter.js')}}"></script>
<script src="{{asset('static/website/js/archworkz/page-loader.js')}}"></script>
{{-- <script src="{{asset('static/website/js/archworkz/swiper-bundle.min.js')}}"></script> --}}

{{-- owl-carousel --}}
<script src="{{ asset('static/website/js/owl-carousel-testi/jquery.min.js') }}"></script>
<script src="{{ asset('static/website/js/owl-carousel-testi/owl.carousel.min.js') }}"></script>
<script src="{{ asset('static/website/js/owl-carousel-testi/style-slider.js') }}"></script> 

<script src="{{asset('static/website/js/archworkz/main2.js')}}"></script>
@yield('scripts')

