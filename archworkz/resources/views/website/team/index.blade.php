@extends('website.layout')
@section('title')
    Tentang Kami - {{ @$about->title }}
@stop

@section('styles')
    <style type="text/css">
        @media (min-wslugth: 1200px) {
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
    <!-- Masthead-->
    <header class="masthead-people" id="home">
        <div class="container-people">
            <div class="back-top">
                <a href="">
                    <img src="{{ asset('static/website/images/archworkz/Back On Top.svg') }}" alt="">
                </a>
            </div>

            <div class="team-title">
                <h3 data-aos="fade-up" data-aos-duration="500">
                    Meet
                </h3>
                <h2 data-aos="fade-up" data-aos-duration="500" data-aos-delay="150">
                    The Team
                </h2>
            </div>

            <div class="team-social-media">
                <a href="http://www.instagram.com/artworkz.co.id/">
                    <img style="width:35px; height:35px;"
                        src="{{ asset('static/website/images/archworkz/icon-insta.png') }}" alt="">
                </a>
                <a href="http://www.facebook.com">
                    <img src="{{ asset('static/website/images/archworkz/icon-fb.png') }}" alt="">
                </a>
            </div>
        </div>

        <div class="team-message">
            <a href="{{ route('contact.index') }}">
                <img src="{{ asset('static/website/images/archworkz/icon-zocial-email.png') }}" alt="">
            </a>
        </div>
    </header>

    <!-- About-->
    <section id="about-team">
        <div class="about-team-wrapper d-flex flex-column flex-md-row">
            <img class="team-duo w-full img-fluid mb-md-4" style="background-size: cover; background-position: center;"
                src="{{ asset('static/website/images/archworkz/people-duo.png') }}" alt="">

            <div class="team-desk">
                <div class="words-from">
                    <h2>Words From</h2>
                    <div class="bg"></div>
                </div>

                @foreach (@$team as $item)
                    <a href="{{ route('team.show', $item->slug) }}" class="people-name">
                        <div class="people-name-desk">
                            <h2>{{ $item->name }}</h2>
                            <h4>{{ $item->role }}</h4>
                        </div>
                        <img class="img-arrow" src="{{ asset('static/website/images/archworkz/arrow.svg') }}"
                            alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="bg-people-wrapper">
        <img class="bg-people" src="{{ asset('static/website/images/archworkz/Mask Group 6.png') }}" alt="">

        <div class="desk-team-wrapper">
            <p class="desk-team">
                Our history of success financial and corporate
                stability allows us to offer performance
                bonding to meet any project’s requirements.
                We can handle whatever needs done, no
                limitations.
            </p>
        </div>

        <div class="filter-gray"></div>
    </div>
@stop
