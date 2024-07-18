@extends('admin.layout')

@section('title', 'Create Client |')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create Client</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.clients.index') }}">Client</a>
            </div>
            <div class="breadcrumb-item active">Create</div>
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
            <form class="form-horizontal" action="{{ route('admin.clients.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email</label>
                            <div class="controls">
                                <input class="form-control" id="email" size="16" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="phone">Phone</label>
                            <div class="controls">
                                <input class="form-control" id="phone" size="16" type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="desc">Address</label>
                            <div class="controls">
                                <textarea class="form-control" id="desc" name="address" cols="30" rows="3" placeholder="Address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label class="col-form-label" for="desc">About</label>
                            <div class="controls">
                                <textarea class="form-control" id="desc" name="about" cols="30" rows="10" style="min-height: 60px;" placeholder="About">{{ old('about') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <div class="d-flex">
                                <img 
                                    src="{{ asset('static/admin/img/default.png') }}" alt="photo">
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
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Cancel
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
