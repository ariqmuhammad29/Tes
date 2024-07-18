@extends('website.layout')
@section('title')
    {{-- Galeri Foto - {{ $about->title }} --}}
@stop

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
    <header class="masthead-ourworks" id="home">
        <!-- START SLIDER -->
        <div>
            <div class="owl-carousel">
                @foreach ($sliders as $slider)
                    <div class="item">
                        <img src="{{ $slider->image->lg }}" alt="">
                        <h2>{{ $slider->name }}</h2>
                        <h1>{{ $slider->description }}</h1>
                    </div>
                @endforeach
            </div>
        </div>



        <!-- END OF SLIDER -->


    </header>

    <section class="about-work" id="works">
        {{-- <div class="container3">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-right" data-aos="fade-up" data-aos-delay="200">
                </div>
            </div>
        </div> --}}
        <div class="container">
            <div class="row align-items-center no-gutters mb-4 mb-lg-5 d-flex justify-content-end" data-aos="fade-up"
                data-aos-delay="400">
                {{-- <div class="col-xl-6 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                </div> --}}
                <img src="{{ asset('static/website/images/archworkz/txt-projects.png') }}" height="60" alt=""
                    style="margin-top: 20px" />
            </div>
            <div class="d-flex row flex-wrap">
                @foreach ($product as $item)
                    <div class="col-6 align-items-center no-gutters mb-4 mb-lg-5">
                        <div data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('gallery.show', $item->slug) }}">
                                <img class="img-gallery" style="max-width: 100%; width: full; height: auto;"
                                    src="{{ asset('storage/' . $item->image) }}" alt="" />
                            </a>
                            <h2 style="color: white; font-size:18px; text-align:left; width:100%">{{ $item->title }}
                            </h2>
                            <h3 style="color:gray; font-size:14px">{!! @$item->description !!}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
