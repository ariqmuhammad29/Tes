@extends('admin.layout')

@section('title')
Edit Portofolio |
@endsection

@section('additional-styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Portofolio</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.portofolio.index') }}">Portofolio</a>
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
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
            @endif
            <form class="form-horizontal" action="{{ route('admin.portofolio.update', $model->id) }}" method="post" enctype="multipart/form-data" id="form-posts">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="title">Title</label>
                            <div class="controls">
                                <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title of the portofolio" value="{{ $model->title }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Client</label>
                            <div class="controls">
                                <select class="form-control" id="client" name="client_id" required>
                                    <option disabled {{ !$model->client_id ? 'selected' : '' }}>Please select the client</option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $model->client_id == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                        </option=>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Category</label>
                            <div class="controls">
                                <select class="form-control" id="category" name="portofolio_category_id" required>
                                    <option disabled {{ !$model->portofolio_category_id ? 'selected' : '' }}>Please select the category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($model->portofolio_category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <div id="description">{!! @$model->description !!}</div>
                    <textarea name="description" class="d-none"></textarea>
                </div>

                <div class="form-group">
                    <label for="photo">Cover</label>
                    <div class="controls">
                        <a href="javascript:void(0)" class="btn btn-success" onclick="addImage()" style="margin-bottom: 20px;">
                            <i class="fa fa-image"></i> Add Image
                        </a>
                    </div>
                    <div class="row" id="image-added">
                        @foreach(@$model->images as $image)
                        <div class="col-md-3" style="margin-bottom:40px;">
                            <div class="custom-file">
                                <input id="photo{{$image->id}}" type="file" name="image-{{$image->id}}" class="custom-file-input" onchange="document.querySelector('img#photo{{$image->id}}').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <input type="hidden" name="isimage-{{$image->id}}" value="true">
                            <img src="{{ asset(@$image->image->sm) ?? asset('static/admin/img/default.png') }}" alt="{{ $model->title }}" id="photo{{$image->id}}">
                            <a href="javascript:void(0)" onclick="imageRemove(this)" class="btn btn-icon btn-danger" title="delete"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.portofolio.index') }}" tabindex="-1" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-primary ml-2" type="submit">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    @stop

    @section('additional-scripts')
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        let editor = new Quill('#description', {
            theme: 'snow'
        })

        const formAbout = document.querySelector('form#form-posts')
        const textAreaDescription = document.querySelector('textarea[name=description]')

        formAbout.addEventListener('submit', (e) => {
            textAreaDescription.value = editor.root.innerHTML
        })
    </script>

    <script type="text/javascript">
        let tahu = 0;

        function addImage() {
            tahu++;
            var wrap = $("#image-added");
            var kelas = "\'img#photo-" + tahu + "\'";
            var assets = "{{asset('static/admin/img/default.png')}}";
            var html = '<div class="col-md-3 halo" style="margin-bottom:20px;">' +
                '<div class="custom-file">' +
                '<input id="photo-' + tahu + '" type="file" name="image[]" class="custom-file-input" accept="image/*"                                  onchange="document.querySelector(' + kelas + ').src = window.URL.createObjectURL(this.files[0])">' +
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