@extends('admin.layout')

@section('title')
    Edit {{ $tool->name }} |
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Tools</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.tools.index') }}">Tool</a>
                </div>
                <div class="breadcrumb-item">
                    {{ $tool->name }}
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
                <form class="form-horizontal" action="{{ route('admin.tools.update', $tool->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label" for="name">Name</label>
                        <div class="controls">
                            <input class="form-control" id="name" size="16" type="text" name="name"
                                placeholder="Name of the tool" value="{{ $tool->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="desc">Description</label>
                        <div class="controls">
                            <textarea class="form-control" id="desc" name="description" cols="30" rows="10" style="min-height: 60px;"
                                placeholder="Description of the tool">{{ $tool->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="img-container">Image</label>
                        <div class="d-flex">
                            <img class="img-fluid" id="img-container" alt="Slider Gallery" width="100" height="100"
                                src="{{ @$tool->image->sm }}" />
                            <div class="custom-file ml-3">
                                <input type="file" name="image" class="custom-file-input"
                                    onchange="document.getElementById('img-container').src = window.URL.createObjectURL(this.files[0])">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.tools.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Cancel
                        </a>
                        <button class="btn btn-primary ml-2" type="submit">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
