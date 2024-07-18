@extends('admin.layout')

@section('title')
    Create Submenu |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Submenu</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.submenus.update') }}">Menus</a>
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
            <form class="form-horizontal" action="{{route('admin.submenus.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Title</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title" value="{{ old('title') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Link</label>
                    <div class="controls">
                        <input class="form-control" id="status" size="16" type="text" name="link" placeholder="Link" value="{{ old('link') }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input form-check-inline" type="radio" name="status" id="exampleRadios1" value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                              Aktif
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
                            <label class="form-check-label" for="exampleRadios2">
                              Nonaktif
                            </label>
                          </div>
                </div>

                
                <div class="form-actions">
                    <a href="admin.menus.update" tabindex="-1" class="btn btn-secondary">
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