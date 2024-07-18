@extends('website.layout')
@section('title')
    Tentang Kami - {{ @$about->title }}
@stop

@section('styles')

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
    <section class="about-work-2" id="works">
        {{-- <div class="detail-project" style="background: url({{ $model->image->lg }});">
            <div class="detail-title col-lg-6">
                <h2>{{ @$model->title }}</h2>
            </div>
        </div> --}}

        <div class="parent-div">
            <img style="background-repeat: no-repeat; background-position: center; object-fit: cover;"
                src="{{ asset('storage/' . $model->image) }}" alt="">
            <div class="div-cild-2">
                <h2 class="" style="font-family: Montserrat; font-style: italic;">{{ @$model->title }}</h2>
            </div>
        </div>

        <div class="container">
            <div class="mb-4 row align-items-center no-gutters mb-lg-5">
                <div class="col-xl-8 col-lg-8" style="margin-top: 50px" data-aos="fade-up" data-aos-delay="200">
                    {{-- <p align="left">
                        <img src="" width="540" alt="" />
                    </p> --}}

                    <div class="d-flex detail-desk">
                        <div style="width:fit-content; margin-right:30px">
                            <h2>Project Name</h2>
                            <h2>Designer</h2>
                            <h2>Location</h2>
                            <h2>Status</h2>
                        </div>
                        <div style="width:fit-content">
                            <h2>{{ $model->project_name }}</h2>
                            <h2>{{ $model->designer }}</h2>
                            <h2>{{ $model->location }}</h2>
                            <h2>{{ $model->status }}</h2>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-4 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <p align="right">
                        <img src="{{ asset('static/website/images/archworkz/txt-projects.png') }}" height="60"
                            alt="" />
                    </p>
                </div> --}}
            </div>

            <div class="mb-4 row align-items-center mb-lg-5">
                @foreach ($models as $key => $item)
                    @if ($key > 0)
                        <div class="col-12 col-md-6 col-xl-6 col-lg-6" style="padding: 10px" data-aos="fade-up"
                            data-aos-delay="200">
                            <img class="img-fluid object-fit-cover" style="width: 540px;height: 360px; object-fit: cover;"
                                src="{{ $item->image->sm }}" alt="" />
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@stop
