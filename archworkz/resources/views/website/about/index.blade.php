@extends('website.layout')
@section('title')
Tentang Kami - {{@$about->title}}
@stop

@section('styles')
<style type="text/css">
    @media (min-width: 1200px) {
        .col-lg-1-5 {
            width: 20%;
        }
    }

    @media (min-width: 992px) {
        .col-md-1-5 {
            width: 20%;
        }
    }

    @media (min-width: 768px) {
        .col-sm-1-5 {
            width: 20%;
        }
    }
</style>
@endsection

@section('scripts')
<script src="{{asset('static/website/js/archworkz/jquery-1.12.4.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#slider').minislider();
    });
</script>
<script>
    AOS.init();
</script>
@stop

@section('content')
    <!-- Masthead-->
    <header class="masthead-people" id="home">
        <div class="container-people">
            <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                <div class="col-xl-2 col-lg-2">
                    <div class="text-center text-lg-left" data-aos="fade-right" data-aos-delay="500">
                        <a href="{{ route('contact.index') }}"><img src="{{asset('static/website/images/archworkz/blue_nav.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-md-10 col-lg-10 mx-auto text-left mb-5" data-aos="fade-left" data-aos-delay="200">
                    <img src="{{asset('static/website/images/archworkz/txt-meettheteam.png')}}" alt="">
                </div>
                <div class="featured-text text-center col-md-12 col-lg-12 mx-auto text-lg-center" data-aos="fade-down"
                    data-aos-delay="600">
                    <a class="js-scroll-trigger" href="#about"><img src="{{asset('static/website/images/archworkz/arrowdown.png')}}" alt="" /></a>
                </div>

                <p align="center">
                    <!-- <a class="js-scroll-trigger" href="#team"><img src="assets/img/scrolldown.png" width="36" height="36" alt=""/></a> //-->
                </p>

            </div>
        </div>

    </header>
    <!-- About-->
    <section class="about-people1 text-center" id="about">
        <div class="container3a">
            <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                <div class="col-xl-6 col-lg-4" data-aos="fade-up" data-aos-delay="400"><img src="{{asset('static/website/images/archworkz/people-duo.png')}}"
                        height="660" alt="" />
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="featured-text text-lg-left" data-aos="fade-left" data-aos-delay="400">
                        <p class="text-white mb-5">
                            <img src="{{asset('static/website/images/archworkz/people-name1.png')}}" alt="" /><br>
                            <a href="people-cici.html"><img src="{{asset('static/website/images/archworkz/people-name2.png')}}" alt="" /></a><br>
                            <a href="people-nikko.html"><img src="{{asset('static/website/images/archworkz/people-name3.png')}}" alt="" /></a><br><br>
                        </p>
                        <p class="text-white mb-0">
                            Our history of success financial and corporate
                            stability allows us<br> to offer performance
                            bonding to meet any project’s requirements.<br>
                            We can handle whatever needs done, no
                            limitations.</p>
                    </div>

                </div>

            </div>
        </div>
    </section>
@stop