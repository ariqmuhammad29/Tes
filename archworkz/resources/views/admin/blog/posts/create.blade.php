@extends('admin.layout')

@section('title')
    Create Blog Posts |    
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
                <a href="{{ route('admin.blog.posts.index') }}">Posts</a>
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
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
            <form class="form-horizontal" action="{{ route('admin.blog.posts.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Title</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title of the article" value="{{ old('title') }}" required>
                        <input id="user_id" name="user_id" value="{{ auth()->user()->id }}" type="hidden" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Category</label>
                            <div class="controls">
                                <select class="form-control" id="category" name="blog_category_id" required>
                                    <option disabled {{ old('blog_category_id') ? '' : 'selected' }}>Please select the category</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option=>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Publish date</label>

                            <input
                                class="form-control"
                                type="datetime-local"
                                name="published_at"
                                value="{{ old('published_at') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <div class="d-flex">
                        <img src="{{ asset('static/admin/img/default.png') }}" alt="photo">
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
                <div class="form-group">
                    <label class="col-form-label" for="desc">Description</label>
                    <div class="controls">
                        <textarea class="form-control" id="desc" name="description" style="min-height: 60px;" placeholder="Description of the article" required>{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.blog.posts.index') }}" tabindex="-1" class="btn btn-secondary">
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
@stop