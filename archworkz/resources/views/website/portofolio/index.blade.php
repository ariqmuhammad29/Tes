@extends('website.layout')

@section('title')
 Portofolio - {{@$about->title}}
@stop

@section('styles')

@stop

@section('content')
<section class="blog white-bg page-section-ptb">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h6>{{ @$about->title }}</h6>
                    <h2 class="title-effect">Portofolio</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @if ($portofolio->isEmpty())
                <h1 class="mx-auto">We are sorry, but its empty</h1>
            @endif
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <div class="isotope columns-4 popup-gallery">
                    @foreach ($portofolio as $model)
                        <div class="grid-item">
                            <div class="portfolio-item">
                                @foreach($model->images as $imagex)
                                <img src="{{ asset($imagex->image->sm) }}" alt="{{ $model->title }}">
                                @break
                                @endforeach
                                <div class="portfolio-overlay">
                                    <h4 class="text-white"> <a href="{{route('portofolio.show', $model->slug)}}"> {{ $model->title }} </a> </h4>
                                    <span class="text-white"> </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- ================================================ -->

                <div class="entry-pagination text-center mt-3">
                    <nav aria-label="Page navigation example">
                        {{ $portofolio->links('vendor.pagination.frontend') }}
                    </nav>
                </div>

                <!-- ================================================ -->

            </div>
        </div>
    </div>
</section>
@stop