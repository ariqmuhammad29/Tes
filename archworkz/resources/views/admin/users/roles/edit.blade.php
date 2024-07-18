@extends('admin.layout')

@section('title', "Edit {$role->name} |")

@section('additional-styles')
<style>
    .form-group img {
        height: 7rem;
        width: 7rem;
        object-fit: cover;
        border-radius: .25rem;
        flex: none;
    }
</style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.roles.index') }}">Roles</a>
    </li>
    <li class="breadcrumb-item">
        {{ $role->name }}
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.roles.create') }}">
                <i class="icon-plus"></i>  Add Role</a>
        </div>
    </li>
@stop

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Role</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.roles.index') }}">Role</a>
            </div>
            <div class="breadcrumb-item">{{ $role->name }}</div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
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
                    <form 
                        class="form-horizontal"
                        action="{{ route('admin.roles.update', [$role->id]) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" value="{{ old('name') ?: $role->name }}" placeholder="Name">
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-light">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button class="btn btn-primary ml-2">
                                <i class="fa fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
@stop