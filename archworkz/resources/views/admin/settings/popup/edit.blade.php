@extends('admin.layout')

@section('title')
    Edit Pop Up |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Pop Up</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.settings.popup.index') }}">Edit Pop Up</a>
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
            <form class="form-horizontal" action="{{route('admin.settings.popup.update',$popup->id)}}" method="post" enctype="multipart/form-data">
                
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label class="col-form-label" for="title">Title</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title" value="{{ $popup->title }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Description</label>
                    <div class="controls">
                        <input class="form-control" id="description" size="16" type="text" name="description" placeholder="Description" value="{{ $popup->description }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Link</label>
                    <div class="controls">
                        <input class="form-control" id="description" size="16" type="text" name="url" placeholder="Link" value="{{ $popup->url }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Type</label>
                    <div class="controls">
                        <input class="form-control" id="type" size="16" type="text" name="type" placeholder="Type" value="{{ $popup->type }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc_sort">Status</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input form-check-inline" type="radio" name="status" id="exampleRadios1" value="1" @if($popup->status==1)checked @endif>
                                                
                            <label class="form-check-label" for="exampleRadios1">
                              Aktif
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name=status id="exampleRadios2" value="0" @if($popup->status==0)checked @endif>
                            <label class="form-check-label" for="exampleRadios2">
                              Nonaktif
                            </label>
                          </div>
                </div>

                
                <div class="form-actions">
                    <a href="" tabindex="-1" class="btn btn-secondary">

                        <i class="fa fa-arrow-left"></i> Back
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