@extends('admin.layout')

@section('title')
    Edit Keunggulan |    
@endsection

@section('additional-styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Keunggulan </h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.keunggulan.index') }}">Keunggulan </a>
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
            <form class="form-horizontal" action="{{ route('admin.keunggulan.update', $model->id) }}" method="post" enctype="multipart/form-data" id="form-posts" >
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Title</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title" value="{{ $model->title }}" required>
                        <input type="hidden" name="type" value="keunggulan">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Short Description</label>
                    <div class="controls">
                        <textarea class="form-control" id="desc_sort" name="description_short" cols="10" rows="5" required>{!! @$model->description_short !!}</textarea>
                    </div>
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  
                  <div id="description">{!! @$model->description !!}</div>
                  <textarea name="description" class="d-none"></textarea>
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <div class="d-flex">
                        <img 
                            src="{{ asset(@$model->image->sm) ?? asset('static/admin/img/default.png') }}" alt="photo">
                        <div class="custom-file ml-3">
                            <input
                                id="photo"
                                type="file"
                                name="image"
                                class="custom-file-input"
                                onchange="document.querySelector('.form-group img').src = window.URL.createObjectURL(this.files[0])"
                                accept="image/*"
                            >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.keunggulan.index') }}" tabindex="-1" class="btn btn-secondary">
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
    textAreaDescription.value   = editor.root.innerHTML
  })
</script>
@endsection