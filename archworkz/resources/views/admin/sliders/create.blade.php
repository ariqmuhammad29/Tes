@extends('admin.layout')

@section('title')
    Create Slider  |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Add Slider</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.sliders.index') }}">Slider</a>
            </div>
            <div class="breadcrumb-item active">Create</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" placeholder="Name of the slider">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea
                                id="desc"
                                class="form-control"
                                name="description"
                                placeholder="Description of the slider"
                                style="min-height: 60px;"
                                rows="5">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="img-container">Image</label>
                            <div class="d-flex">
                                <img src="{{ asset('static/admin/img/default.png') }}" alt="photo">
                                <div class="custom-file ml-3">
                                    <input
                                        id="photo"
                                        type="file"
                                        name="image"
                                        class="custom-file-input"
                                        onchange="document.querySelector('.form-group img').src = window.URL.createObjectURL(this.files[0])"
                                        accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Cancel
                            </a>
                            <button class="btn btn-primary ml-2" type="submit">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
@stop
