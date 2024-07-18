@extends('website.layout')
@section('title')
    Tentang Kami - {{ @$about->title }}
@stop


@section('scripts')
    <script src="{{ asset('static/website/js/archworkz/jquery-1.12.4.min.js') }}"></script>
    <script>
        AOS.init();
    </script>
@stop

@section('content')
    <section id="detail-team" style="">
        <div>
            <img class="img-person" src="{{ asset(@$model->image->lg) }}" alt="">
            <div class="detail-team-desk">
                <div class="words-from">
                    <h2>{{ @$model->name }}</h2>
                    <div class="bg"></div>
                </div>
                <p>{{ @$model->about }}</p>
            </div>
        </div>
    </section>

    {{-- <div class="detail-team-wrapper">
        <div class="detail-team-desk">
            <div class="words-from">
                <h2>{{ @$model->name }}</h2>
                <div class="bg"></div>
            </div>
            <p>{{ @$model->about }}</p>
        </div>
        <img src="{{ asset(@$model->image->lg) }}" alt="">
    </div> --}}

    
@stop
