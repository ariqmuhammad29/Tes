@extends('website.layout')

@section('styles')
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@stop

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>

    <script>
        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["twitter", "facebook", "pinterest"]
        });
    </script>
@stop

@section('content')

<section class="white-bg page-section-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <img class="img-fluid mx-auto" src="{{@$service->image->sm}}" alt="{{ @$service->title }}">
      </div>
      <div class="col-lg-10 sm-mt-50 align-self-center">
        <div class="section-title">
          <h2 class="title-effect">{{ @$service->title }}</h2>
          <p class="mt-30"> {!! @$service->description !!}  </p>
        </div>
        <div class="entry-share clearfix">
            <div class="social list-style-none float-right">
                <strong>Share to your friends </strong>
                <div id="share"></div>
            </div>
        </div>
  </div>
  </div>
</section>
@stop