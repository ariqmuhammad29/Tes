@extends('admin.layout')

@section('title')
    Edit Our-Works Posts |
@endsection

@section('additional-styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
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
                    <a href="{{ route('admin.Our-Works.posts.index') }}">Project</a>
                </div>
                <div class="breadcrumb-item">
                    {{ $model->title }}
                </div>
                <div class="breadcrumb-item active">
                    Edit
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if (Session::has('status'))
                    <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
                <form class="form-horizontal" action="{{ route('admin.Our-Works.posts.update', $model->id) }}"
                    method="post" enctype="multipart/form-data" id="form-posts">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Title Field -->
                            <div class="form-group">
                                <label class="col-form-label" for="title">Title</label>
                                <div class="controls">
                                    <input class="form-control" id="title" size="16" type="text" name="title"
                                        placeholder="Title of the product" value="{{ $model->title }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Status Field -->
                            <div class="form-group">
                                <label class="col-form-label" for="status">Status</label>
                                <div class="controls">
                                    <input class="form-control" id="status" size="16" type="text" name="status"
                                        placeholder="Status Of Project" value="{{ $model->status }}" required>
                                </div>
                            </div>
                        </div>
                        {{-- Project Name field --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="project_name">Project Name</label>
                                <div class="controls">
                                    <input class="form-control" id="project_name" size="16" type="text"
                                        name="project_name" placeholder="Project Name" value="{{ $model->project_name }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        {{-- Designer field --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="designer">Designer</label>
                                <div class="controls">
                                    <input class="form-control" id="designer" size="16" type="text" name="designer"
                                        placeholder="Designer Project" value="{{ $model->designer }}" required>
                                </div>
                            </div>
                        </div>
                        {{-- add location field --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="location">Location</label>
                                <div class="controls">
                                    <input class="form-control" id="location" size="16" type="text" name="location"
                                        placeholder="Project Location" value="{{ $model->location }}" required>
                                </div>
                            </div>
                        </div>
                        {{-- type project field --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="description">Type</label>
                                <div class="controls">
                                    <input class="form-control" id="description" size="16" type="text"
                                        name="description" placeholder="Project Location" value="{{ $model->description }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Add other fields here -->

                        <div class="col-md-12">
                            <!-- Cover Field -->
                            <div class="form-group">
                                <label for="photo">Cover Project</label>
                                <div class="row" id="image-added">
                                    @foreach (@$model->images as $image)
                                        <!-- Image Field -->
                                        @if ($image->image->path == $model->image)
                                            <!-- Display the current image -->
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="photo{{ $image->id }}" type="file"
                                                        name="image-{{ $image->id }}" class="custom-file-input"
                                                        onchange="document.querySelector('img#photo{{ $image->id }}').src = window.URL.createObjectURL(this.files[0])"
                                                        accept="image/*">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <input type="hidden" name="isimage-{{ $image->id }}" value="true">
                                                <img src="{{ asset(@$image->image->sm) ?? asset('static/admin/img/default.png') }}"
                                                    alt="{{ $model->title }}" id="photo{{ $image->id }}">
                                                <a href="javascript:void(0)" onclick="imageRemove(this)"
                                                    class="btn btn-icon btn-danger" title="delete"><i
                                                        class="fas fa-trash"></i>
                                                    Delete</a>
                                            </div>
                                            <!-- Content Image Label -->
                                            <div class="col-md-12" style="margin-bottom: 5px; font-weight: bold;">
                                                <label for="">Content Image</label>
                                            </div>
                                            <!-- Add Image Button -->
                                            <div class="controls col-md-12">
                                                <a href="javascript:void(0)" class="btn btn-success" onclick="addImage()"
                                                    style="margin-bottom: 20px;">
                                                    <i class="fa fa-image"></i> Add Image Project
                                                </a>
                                            </div>
                                        @elseif ($model->image)
                                            <!-- Display other images -->
                                            <div class="col-md-3" style="margin-bottom: 40px;">
                                                <div class="custom-file">
                                                    <input id="photo{{ $image->id }}" type="file"
                                                        name="image-{{ $image->id }}" class="custom-file-input"
                                                        onchange="document.querySelector('img#photo{{ $image->id }}').src = window.URL.createObjectURL(this.files[0])"
                                                        accept="image/*">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <input type="hidden" name="isimage-{{ $image->id }}" value="true">
                                                <img src="{{ asset(@$image->image->sm) ?? asset('static/admin/img/default.png') }}"
                                                    alt="{{ $model->title }}" id="photo{{ $image->id }}">
                                                <a href="javascript:void(0)" onclick="imageRemove(this)"
                                                    class="btn btn-icon btn-danger" title="delete"><i
                                                        class="fas fa-trash"></i>
                                                    Delete</a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Form Actions -->
                        <div class="form-actions col-md-12">
                            <a href="{{ route('admin.Our-Works.posts.index') }}" tabindex="-1"
                                class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button class="btn btn-primary ml-2" type="submit">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('additional-scripts')
        <script type="text/javascript">
            let tahu = 0;

            function addImage() {
                tahu++;
                var wrap = $("#image-added");
                var kelas = "\'img#photo-" + tahu + "\'";
                var assets = "{{ asset('static/admin/img/default.png') }}";
                var html = '<div class="col-md-3 halo" style="margin-bottom:20px;">' +
                    '<div class="custom-file">' +
                    '<input id="photo-' + tahu +
                    '" type="file" name="image[]" class="custom-file-input" accept="image/*"                                  onchange="document.querySelector(' +
                    kelas + ').src = window.URL.createObjectURL(this.files[0])">' +
                    '<label class="custom-file-label" for="customFile">Choose file</label>' +
                    '</div>' +
                    '<img src="' + assets + '" alt="photo" id="photo-' + tahu + '">' +
                    '<a href="javascript:void(0)" onclick="imageRemove(this)" class="btn btn-icon btn-danger" title="delete"><i class="fas fa-trash"></i> Delete</a>' +
                    '</div>';

                $(wrap).append(html);
            }

            function imageRemove(that) {
                $(that).parents('.col-md-3').remove();
            }
        </script>
    @endsection
