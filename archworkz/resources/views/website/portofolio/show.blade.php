@extends('website.layout')
@section('title')
 {{ $portofolio->title }} - {{ $portofolio->client }}
@stop

@section('meta')
<meta name="keywords" content="{{@$portofolio->category->name}}" />
<meta name="description" content="{!! $portofolio->description !!}" />
<meta name="author" content="{{@$portofolio->user->name}}" />
<meta property="og:image" content="{{ asset($portofolio->image->lg) }}">
@stop

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

<section class="single-portfolio-post white-bg page-section-ptb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h6>{{ @$about->title }}</h6>
                </div>
            </div>
        </div>
    </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 port-information">
        <div class="port-title sm-mt-40">
          <h3 class="mb-20">{{ $portofolio->title }}</h3>
          <span><b>Klien: </b>{{ $portofolio->title }}</span>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="port-info mt-20 mb-20">
          {!! $portofolio->description !!}
        </div>
        <div class="entry-share clearfix">
          <div class="social list-style-none float-right">
            <strong>Bagikan </strong>
            <div id="share"></div>
          </div>
        </div>
      </div>
    </div>
 
    <div class="popup-gallery mt-10">
       <div class="row">
          <div class="col-lg-12 col-md-12">
            <h3 class="theme-color mb-30">Galeri</h3>
            <div class="owl-carousel" data-nav-dots="false" data-items="4" data-xs-items="2" data-xx-items="1">
              @foreach ($portofolio->images as $result)
              <div class="item">
                  <div class="portfolio-item">
                   <img src="{{ asset($result->image->sm) }}" alt=" {{ $portofolio->title }}">
                    <a class="popup portfolio-img" href="{{ asset($result->image->md) }}"><i class="fa fa-arrows-alt"></i></a>
                  </div>
              </div>
              @endforeach
            </div>
          </div>
       </div>
    </div>
</div>
</section>
@stop