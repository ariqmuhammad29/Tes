@extends('admin.layout')

@section('title')
    Create Our-Works Project |
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
                <div class="breadcrumb-item active">
                    Create
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
                <form class="form-horizontal" action="{{ route('admin.Our-Works.posts.store') }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="title">Title</label>
                                <div class="controls">
                                    <input class="form-control" id="title" size="16" type="text" name="title"
                                        placeholder="Title of the portofolio" value="{{ old('title') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="status">Status</label>
                                <div class="controls">
                                    <input class="form-control" id="status" size="16" type="text" name="status"
                                        placeholder="Status Of The Project" value="{{ old('status') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="project_name">Project Name</label>
                                <div class="controls">
                                    <input class="form-control" id="project_name" size="16" type="text"
                                        name="project_name" placeholder="Project Name" value="{{ old('project_name') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="designer">Designer</label>
                                <div class="controls">
                                    <input class="form-control" id="designer" size="16" type="text" name="designer"
                                        placeholder="Designer Of The Project" value="{{ old('designer') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="location">Location</label>
                                <div class="controls">
                                    <input class="form-control" id="location" size="16" type="text" name="location"
                                        placeholder="Location Project" value="{{ old('location') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="desc">Type</label>
                                <div class="controls">
                                    <input class="form-control" id="description" size="16" type="text"
                                        name="description" placeholder="Type Of The Project"
                                        value="{{ old('description') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo">Cover Project</label>
                        <div class="">
                            <div class="custom-file ">
                                <input id="photo" type="file" name="image[]" class="custom-file-input"
                                    onchange="document.querySelector('img#photo').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img src="{{ asset('static/admin/img/default.png') }}" alt="photo" id="photo">

                        </div>
                        <div class="controls mt-2">
                            <label for="photo" style="font-weight: bold;">Content Image</label> <br>
                            <a href="javascript:void(0)" class="btn btn-success" onclick="addImage()">
                                <i class="fa fa-image"></i> Add Images Project
                            </a>
                            <div class="row mt-2" id="image-added">
                                <!-- Images will be added dynamically here -->
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.Our-Works.posts.index') }}" tabindex="-1" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button class="btn btn-primary ml-2" type="submit">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('additional-scripts')
    <script type="text/javascript">
        let tahu = 0;

        function addImage() {
            tahu++;
            var wrap = $("#image-added");
            var kelas = "\'img#photo" + tahu + "\'";
            var assets = "{{ asset('static/admin/img/default.png') }}";
            var html = '<div class="col-md-3 halo" style="margin-bottom:20px; ">' +
                '<div class="custom-file">' +
                '<input id="photo' + tahu +
                '" type="file" name="image[]" class="custom-file-input" accept="image/*"                                  onchange="document.querySelector(' +
                kelas + ').src = window.URL.createObjectURL(this.files[0])">' +
                '<label class="custom-file-label" for="customFile">Choose file</label>' +
                '</div>' +
                '<img src="' + assets + '" alt="photo" id="photo' + tahu + '">' +
                '<a href="javascript:void(0)" onclick="imageRemove(this)" class="btn btn-icon btn-danger" title="delete"><i class="fas fa-trash"></i> Delete</a>' +
                '</div>';

            $(wrap).append(html);
        }

        function imageRemove(that) {
            $(that).parents('.col-md-3').remove();
        }
    </script>
@endsection
