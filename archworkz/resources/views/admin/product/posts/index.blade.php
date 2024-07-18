@extends('admin.layout')

@section('title')
    Post |
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Our-Works Project</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    Our-Works
                </div>
                <div class="breadcrumb-item">
                    Project
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.Our-Works.posts.create') }}" class="btn btn-success pull-right"><i
                        class="fa fa-plus"></i> Add Project</a>
            </div>
            <div class="card-body">
                <div class="float-right">
                    <form id="searchForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Category" name="name"
                                value="">
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="float-right" style="margin-right:10px;">
                    <select class="form-control selectric" id="shortBy">
                        <option value="">Urutkan Berdasarkan</option>
                        <option {{ Request::get('shortby') == 'Post A-Z' ? 'selected' : '' }}>Post A-Z</option>
                        <option {{ Request::get('shortby') == 'Post Z-A' ? 'selected' : '' }}>Post Z-A</option>
                        <option {{ Request::get('shortby') == 'Post Awal' ? 'selected' : '' }}>Post Awal</option>
                    </select>
                </div>

                <div class="clearfix mb-3"></div>
                @if (Session::has('status'))
                    <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                @endif
                <table class="table table-responsive-sm table-striped table-vertical-align">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th style="width: 110px;">Preview</th>
                            <th>Project</th>
                            <th>Project Name</th>
                            <th>Designer</th>
                            <th>Location </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $key => $model)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="thumbnail">
                                        @foreach ($model->images as $imagex)
                                            <img class="img-thumbnail"
                                                src="{{ asset(@$imagex->image->sm) ?? asset('static/admin/img/default.png') }}"
                                                alt="{{ $model->title }}"
                                                style="height: 60px;object-fit: cover;width: fit-content;">
                                        @break
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <b>{{ $model->title }}</b> <br>
                                <span>{{ str_limit(strip_tags($model->description), 100, ' ...') }}</span><br>
                            </td>
                            <td>
                                {{ $model->project_name }}
                            </td>
                            <td>
                                {{ $model->designer }}
                            </td>
                            <td>
                                {{ $model->location }}
                            </td>
                            <td>
                                {{ $model->status }}
                            </td>
                            <td>
                                <!-- /btn-group-->
                                <div class="btn-group">
                                    <button class="btn btn-warning dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" x-placement="bottom-start"
                                        style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.Our-Works.posts.edit', $model->id) }}">Edit</a>
                                        <form action="{{ route('admin.Our-Works.posts.destroy', $model->id) }}"
                                            method="post">
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
            window.location.href = "{{ route('admin.Our-Works.posts.index') }}?name=" + name +
                "&shortBy=" + shortBy;
        });

        $("#shortBy").on('change', function() {
            $("#searchForm").submit();
        });

    });
</script>
@endsection
