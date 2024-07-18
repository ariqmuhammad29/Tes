@extends('admin.layout')

@section('title')
    Edit Testimoni |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Testimoni </h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.testimoni.index') }}">Testimoni </a>
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
            <form class="form-horizontal" action="{{ route('admin.testimoni.update', $model->id) }}" method="post" enctype="multipart/form-data" id="form-posts" >
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="name">Nama</label>
                    <div class="controls">
                        <input class="form-control" id="name" size="16" type="text" name="name" placeholder="Nama" value="{{ $model->name }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Jabatan</label>
                    <div class="controls">
                        <input class="form-control" id="position" size="16" type="text" name="position" placeholder="position" value="{{ $model->position }}" required>
                    </div>
                </div>

                <div class="form-group">
                  <label for="description">Komentar</label>
                    <div class="controls">
                        <textarea class="form-control" id="desc" name="comment" style="min-height:90px;" placeholder="Description of thcomment" required>{{ @$model->comment }}</textarea>
                    </div>
                </div>

                <label for="rate">Rating</label><br>
                <div class="flex">
                    {{@$model->rate}}
                    <div>
                        <input type="radio" name="rate" value="1">
                        1
                    </div>
                    <div>
                        <input type="radio" name="rate" value="2">
                        2
                    </div>
                    <div>
                        <input type="radio" name="rate" value="3">
                        3
                    </div>
                    <div>
                        <input type="radio" name="rate" value="4">
                        4
                    </div>
                    <div>
                        <input type="radio" name="rate" value="5">
                        5
                    </div>
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
                    <a href="{{ route('admin.testimoni.index') }}" tabindex="-1" class="btn btn-secondary">
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