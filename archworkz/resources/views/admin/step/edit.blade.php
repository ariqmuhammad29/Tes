@extends('admin.layout')

@section('title')
    Edit Step |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Step</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.step.index') }}">Edit Step</a>
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
            <form class="form-horizontal" action="{{route('admin.step.update',$step->id)}}" method="post" enctype="multipart/form-data">
                
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label class="col-form-label" for="title">Title</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title" value="{{ $step->title }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label" for="desc">Description</label>
                    <div class="controls">
                        <textarea class="form-control" id="desc" name="description" cols="30" rows="10" style="min-height: 60px;"
                            placeholder="Description of the sponsor">{{ $step->description }}</textarea>
                    </div>
                </div>
                
            

                
                <div class="form-actions">
                    <a href="" tabindex="-1" class="btn btn-secondary">
                        {{-- admin.menus.update --}}
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