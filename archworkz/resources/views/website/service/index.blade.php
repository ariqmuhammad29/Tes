@extends('website.layout')

@section('title')
Layanan Kami | {{@$about->title}}
@stop

@section('content')

<section class="service white-bg page-section-ptb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="section-title text-center">
          <h6>{{@$about->title}}</h6>
          <h2 class="title-effect">Layanan Kami</h2>
          <p>Kami memberikan pelayanan terbaik yang bisa kami lakukan!</p>
        </div>
      </div>
    </div>
    <!-- =========================================== -->
    <div class="row">
      @foreach($service as $result)
      <div class="col-lg-4 col-md-4 mb-30">
        <div class="feature-text box-shadow h-100 text-center">
          <div class="feature-icon">
            <img src="{{ asset(@$result->image->sm) }}" width="40" class="theme-color mb-20">
          </div>
          <div class="feature-info">
            <h4 class="pb-10">{{$result->title}}</h4>
            <p>{{$result->description_short}} </p>
            <a class="button icon-color mt-20" href="{{ route('service.show', $result->slug) }}">Read more <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!--=================================
service-->
<section class="action-box theme-bg full-width">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h3> Ingin Tau Lebih Banyak Tentang Kami ?</h3>
        <p>15 Tahun Pengalaman perusahaan kami dari nasional hingga internasional</p>
        <a class="button white" href="{{asset(@$setting->firstWhere('key','file')->value)}}" target="_blank">
          <span>Download Company Profile</span>
          <i class="fa fa-download"></i>
        </a>
      </div>
    </div>
  </div>
</section>

@stop