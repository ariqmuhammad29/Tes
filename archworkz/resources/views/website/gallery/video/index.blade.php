@extends('website.layout')
@section('title')
 Galeri Video - {{$about->title}}
@stop

@section('content')
    <section class="white-bg page-section-ptb">
        <div class="container-fluid">
            <div class="row justify-content-center">
               <div class="col-lg-8">
                <div class="section-title text-center">
                    <h6>{{@$about->title}}</h6>
                    <h2 class="title-effect">Galeri Video</h2>
                  </div>
              </div>
            </div>
            <div class="row">
                @if ($models->isEmpty())
                    <h1 class="mx-auto">We are sorry, but its empty</h1>
                @endif
                @foreach ($models as $model)
                    <div class="col-md-4">
                        <div class="blog-box blog-2 blog-border">
                            <div class="popup-video-image border-video popup-gallery">
                                <img class="img-fluid" src="{{ $model->showpreview() }}" alt="">
                                <a class="popup-youtube" href="https://www.youtube.com/watch?v=OnfYLBNvrPw"> <i class="fa fa-play"></i> </a>
                                <div class="video-attribute">
                                    <span class="length">{{ str_limit($model->title, 35, '...') }}</span>
                                    <span class="quality">HD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                    <!-- ================================================ -->

                    <div class="entry-pagination text-center mt-3">
                        <nav aria-label="Page navigation example">
                            {{ $models->links('vendor.pagination.frontend') }}
                        </nav>
                    </div>

                    <!-- ================================================ -->

                </div>
            </div>
        </div>
    </section>

    <!--=================================
    grid -->
@stop