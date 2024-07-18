@extends('website.layout')

@section('title')
 @if(!empty($kategori->name))
  {{ $kategori->name }}
 @else
  Blog
 @endif
  - {{@$about->title}}
@stop

@section('styles')
<style type="text/css">
    .bulet { border-radius: 5%; }
    @media (min-width: 768px) {
        .img-cover{
            object-fit: cover; height: 250px;
        }
    }
</style>
@stop
@section('content')

    <section class="blog white-bg page-section-ptb">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="section-title text-center">
                        <h6>{{ @$about->title }}</h6>
                        <h2 class="title-effect">Blog</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 sm-mb-30">
                    <div class="sidebar-widget">
                        <h6 class="mb-20">Cari</h6>
                        <div class="widget-search">
                            <form action="{{ route('article.search') }}" method="get">
                                <a type="submit" href="#"> <i class="fa fa-search"></i></a>
                                <input type="search" name="cari" class="form-control" placeholder="Cari disini...." />
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h6 class="mt-40 mb-20">Blog Terbaru </h6>
                        @foreach ($recentPosts as $recentPost)
                            <div class="recent-post clearfix">
                                <div class="recent-post-image">
                                    <img class="img-fluid" src="{{ asset($recentPost->image->sm) }}" alt="">
                                </div>
                                <div class="recent-post-info">
                                    <a href="{{ route('article.show', $recentPost->slug) }}">{{ $recentPost->title }}</a>
                                    <span><i class="fa fa-calendar-o"></i> {{ $recentPost->created_at->format('d F Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sidebar-widget clearfix">
                        <h6 class="mt-40 mb-20">Kategori</h6>
                        <ul class="widget-categories">
                            @foreach ($categoryArticles as $categoryArticle)
                                <li><a href="{{ route('article.index', $categoryArticle->slug) }}"><i class="fa fa-angle-double-right"></i> {{ $categoryArticle->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- ========================== -->
                <div class="col-lg-9">

                    <div class="row">
                        @if ($article->isEmpty())
                            <div class="col-lg-12 col-md-12">
                                <h3 class="text-center">We are sorry, but its empty</h3>
                            </div>
                        @endif
                        @foreach($article as $key => $result)
                        <div class="col-lg-6 col-md-6">
                            <div class="blog-entry mb-50">
                                <div class="entry-image clearfix">
                                    <img class="img-fluid img-cover bulet" src="{{asset($result->image->sm) }}" alt="{{$result->title}}">
                                </div>
                                <div class="blog-detail">
                                    <div class="entry-title mb-10">
                                        <a href="{{ route('article.show', $result->slug) }}">{{str_limit(strip_tags(@$result->title), 45, ' ...')}}</a>
                                    </div>
                                    <div class="entry-meta mb-10">
                                        <ul>
                                            <li><a href="javascript:void(0);"><i class="fa fa-calendar-o"></i> 
                                            @if ($result->published_at != Null)
                                                {{ $result->published_at->toDateTimeString() }} 
                                            @else
                                                {{ $result->created_at->toDateTimeString() }} 
                                            @endif
                                            </a></li>
                                            <li><i class="fa fa-folder-open-o"></i> <a href="{{ route('article.index', $result->category->slug) }}"> {{ $result->category->name }} </a> </li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>{{ str_limit(strip_tags($result->description), 120, ' ...') }}</p>
                                    </div>
                                    <div class="entry-share clearfix">
                                        <div class="entry-button">
                                            <a class="button arrow" href="{{ route('article.show', $result->slug) }}">Selengkapnya<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mt-30">
                            {{ $article->links('vendor.pagination.frontend') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop