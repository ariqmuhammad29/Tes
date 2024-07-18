@extends('admin.layout')

@section('title')
  About |
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">Setting</li>
  <li class="breadcrumb-item">About</li>
  <li class="breadcrumb-item active">Edit ({{ strtoupper($lang) }})</li>
@endsection

@section('additional-styles')
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
  @if (session()->has('success'))
  <div class="mt-2 mb-2 alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="card">
    <div class="card-header">
      About ({{ strtoupper($lang) }})
    </div>
    <div class="card-body">

      <form id="form-about" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="title">Title</label>
          <input
            id="title"
            type="text"
            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
            name="title"
            placeholder="Title"
            value="{{ old('title') ?: @$about->title }}"
          >

          @if ($errors->has('title'))
          <div class="invalid-feedback">
            {{ $errors->first('title') }}
          </div>
          @endif
        </div>
        <div class="form-group">
          <label for="meta_keywords">Meta Keywords ({{ strtoupper($lang) }})</label>
          <textarea
            id="meta_keywords"
            name="meta_keywords"
            type="text"
            class="form-control {{ $errors->first('meta_keywords') ? 'is-invalid' : '' }}"
            placeholder="Meta Keywords"
          >{{ old('meta_keywords') ?: @$about->meta_keywords}}</textarea>
          @if ($errors->has('meta_keywords'))
          <div class="invalid-feedback">
            {{ $errors->first('meta_keywords') }}
          </div>
          @endif
        </div>
        <div class="form-group">
          <label for="meta_description">Meta Description ({{ strtoupper($lang) }})</label>
          <textarea
            id="meta_description"
            name="meta_description"
            type="text"
            class="form-control {{ $errors->first('meta_description') ? 'is-invalid' : '' }}"
            placeholder="Meta Description"
          >{{ old('meta_description') ?: @$about->meta_description }}</textarea>
          @if ($errors->has('meta_description'))
          <div class="invalid-feedback">
            {{ $errors->first('meta_description') }}
          </div>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Description ({{ strtoupper($lang) }})</label>
          
          <div id="description" style="min-height: 60px;">{!! @$about->description !!}</div>

          <textarea name="description" class="d-none"></textarea>
        </div>
        <div class="text-right mt-3">
          <button class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('additional-scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
  let editor = new Quill('#description', {
    theme: 'snow'
  })

  const formAbout = document.querySelector('form#form-about')
  const textAreaDescription = document.querySelector('textarea[name=description]')

  formAbout.addEventListener('submit', (e) => {
    textAreaDescription.value = editor.root.innerHTML
  })
</script>
@endsection
