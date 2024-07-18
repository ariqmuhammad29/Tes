@extends('admin.layout')

@section('title')
    Create Social Media |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Social Media</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.social.index') }}">Social Media</a>
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
            <form class="form-horizontal" action="{{ route('admin.social.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Nama</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Name of the Social Media" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="type">Type</label>
                    <div class="controls">
                        <select class="form-control" id="type" name="type" required>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                          
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="title">Url Sosial Media</label>
                    <div class="controls">
                        <input class="form-control" id="url" size="16" type="text" name="url" placeholder="https://instagram.com/" value="{{ old('url') }}" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.social.index') }}" tabindex="-1" class="btn btn-secondary">
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