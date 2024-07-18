@extends('website.layout')

@section('scripts')
    <script src="{{ asset('static/website/js/archworkz/jquery-1.12.4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#slider').minislider();
        });
    </script>
    <script>
        AOS.init();
    </script>
@stop


@section('content')

    <style>

    </style>

    <div id="loading-container">
        <div id="loading">
            <div id="loading-center">
                <img class="img-logo" src="{{ asset('static/website/images/archworkz/Artwork logo-05.png') }}" alt="">
                <div id="loading-before">
                    <div id="loading-bar"></div>
                </div>
                <h2>Loading</h2>
            </div>
            <div class="dark-bg"></div>
            <img class="img-bg" src="{{ asset('static/website/images/archworkz/RYD_4494.png') }}" alt="">
        </div>

    </div>
    <div id="content">
        <!-- Masthead-->
        <header class="masthead " id="home">
            <div class="bg-header">
                <img class="image2" src="{{ asset('static/website/images/archworkz/Man-Crop-edit1.png') }}" alt="">
                {{-- <div class="filter-black"></div> --}}
                <img class="image1" src="{{ asset('static/website/images/archworkz/BG-Workshop.jpeg') }}" alt="ArtWorkz">
                <h3 class="image3">Perfection In Details</h3>
            </div>

            <div class="container2">
                <div class="social-media">
                    <ul>
                        <li>
                            <a href="">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="featured-text">
                    <div class="contact-us d-flex align-items-center">
                        <a href="{{ route('contact.index') }}">
                            <img class="img-contact-home" style="margin-left: 10px"
                                src="{{ asset('static/website/images/archworkz/icon-zocial-email.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="home-setting-wrap">
            <div class="back-top-home" id="backTopButton">
                <button onclick="scrollToTop()" id="btntop" class="">
                    <img src="{{ asset('static/website/images/archworkz/Back On Top.svg') }}" alt="">
                </button>
            </div>

            <div class="home-setting d-flex align-items-center" style="padding-right: 20px">
                <ul class="" style="margin-left: auto">
                    <li class="mb-4">
                        <a href="{{ route('landing.index') }}#about">
                            <img src="{{ asset('static/website/images/archworkz/icon-home.svg') }}" alt="">
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('landing.index') }}#service">
                            <img src="{{ asset('static/website/images/archworkz/icon-setting.svg') }}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('landing.index') }}#team">
                            <img src="{{ asset('static/website/images/archworkz/icon-people.svg') }}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container3">
            <div class="content-about">
                <div class="text-about">
                    <h1 data-aos="fade-up" data-aos-delay="500">
                        About Us
                    </h1>
                    <span data-aos="zoom-in-right" data-aos-duration="600" data-aos-delay="100"></span>
                </div>

                <div class="featured-text-wrap">
                    <div class="featured-text text-center text-lg-left" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-description" style="color: white; margin-left: auto; margin-right:auto;">
                            <p>{!! @$about->description !!} </p>
                        </div>
                        {{-- <div class="" style="margin-top: -100x; font-size:25px; color:white">
                            {!! substr(@$about->description, 383) !!}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Signup-->
    <section class="about-service" id="service">
        <div class="container3">
            <div class="content-service">
                <div class="text-about reverse">
                    <h1 data-aos="fade-up" data-aos-delay="500">
                        Our Service
                    </h1>
                    <span data-aos="zoom-in-left" data-aos-duration="600" data-aos-delay="100"></span>
                </div>

                <div class="featured-text-wrap mt-3 mt-md-0">
                    <div class="featured-text text-center text-lg-left" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-description" style="color: white; margin-left: auto; margin-right:auto;">
                            <p>{!! @$service->description !!} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM-->
    <section class="projects-section bg-white" id="team">
        <div class="container4">
            <div class="content-team">
                <div class="text-about">
                    <h1 data-aos="fade-up" data-aos-delay="500">
                        Our Team
                    </h1>
                    <span data-aos="zoom-in-left" data-aos-duration="600" data-aos-delay="100"></span>
                </div>

                <div class="featured-text-wrap">
                    <div class="text-center text-lg-left" data-aos="fade-up" data-aos-delay="200"
                        style="width: 75%; display:flex; flex-wrap:wrap; justify-content:center; margin-left:auto; margin-right:auto">
                        <div class="team-description" style="color: white">
                            {!! @$info->description !!}
                            <div style="margin-top: -50px">
                                <a href="{{ route('team.index') }}">
                                    <img src="{{ asset('static/website/images/archworkz/txt-more.png') }}"alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <img src="{{ asset('static/website/images/element/@$sosial->type.svg') }}" alt="">
    </div>
@stop
