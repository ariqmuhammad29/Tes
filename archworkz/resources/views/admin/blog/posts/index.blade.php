@extends('admin.layout')

@section('title')
Post |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Blog Posts</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                Blog
            </div>
            <div class="breadcrumb-item">
                Posts
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Post</a>
        </div>
        <div class="card-body">

            <div class="float-right">
                <form id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Data" name="name" value="">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>



            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
            <div class="float-right" style="margin-right:10px;">
                <select class="form-control selectric" id="shortBy">
                    <option value="">Urutkan Berdasarkan</option>
                    <option {{(Request::get("shortby")) == "Post A-Z" ? "selected" : "" }}>Post A-Z</option>
                    <option {{ (Request::get("shortby")) == "Post Z-A" ? "selected" : "" }}>Post Z-A</option>
                    <option {{ (Request::get("shortby")) == "Post Awal" ? "selected" : "" }}>Post Awal</option>
                </select>
            </div>
            @endif
            <div class="clearfix mb-3"></div>
            @if (Session::has('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
            @endif
            <table class="table table-responsive-sm table-striped table-vertical-align">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 20px;">No</th>
                        <th style="width: 110px;">Preview</th>
                        <th>Post</th>
                        <th style="width: 170px;">Publish Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($models as $key => $model)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <div class="thumbnail">
                                <img class="img-thumbnail" src="{{ asset(@$model->image->sm) }}" alt="">
                            </div>
                        </td>
                        <td>
                            <b>{{ $model->title }}</b> <br>
                            <span>{{ str_limit(strip_tags($model->description), 135, ' ...')}}</span><br>
                            @php
                            $classes = ['primary', 'success', 'danger', 'warning', 'info']
                            @endphp
                            <span class="badge badge-{{ $classes[@$model->category->id % 5] }}">
                                {{ @$model->category->name ?? 'No Category' }}
                            </span>
                        </td>
                        <td>
                            @if ($model->is_published)
                            {{ $model->published_at->toDateTimeString()}}
                            @else
                            <span class="badge badge-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <!-- /btn-group-->
                            <div class="btn-group">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('admin.blog.posts.edit', $model->id) }}">Edit</a>
                                    <form action="{{ route('admin.blog.posts.destroy', $model->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="dropdown-item">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /btn-group-->
                        </td>
                    </tr>
                    @endforeach
                    @if ($models->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center"> <b>Table is empty</b> </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
</section>
@stop
@section('additional-scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $("#searchForm").submit(function(event) {
            event.preventDefault();
            var name = $("input[name=name]").val();
            var shortBy = '';

            if ($('#shortBy').length > 0) {
                shortBy = $("#shortBy").val();
            }
            window.location.href = "{{ route('admin.blog.posts.index') }}?name=" + name + "&shortBy=" + shortBy;
        });

        $("#shortBy").on('change', function() {
            $("#searchForm").submit();
        });

    });
</script>
@endsection