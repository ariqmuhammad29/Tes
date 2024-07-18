@extends('admin.layout')

@section('title', "Create User |")

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
        <a href="{{ route('admin.users.index') }}">User</a>
    </li>
    <li class="breadcrumb-item active">
        Create
    </li>
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.users.create') }}">
                <i class="icon-plus"></i>  Add User</a>
        </div>
    </li>
@stop

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}">User</a>
            </div>
            <div class="breadcrumb-item active">Create</div>
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
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form 
                        class="form-horizontal"
                        action="{{ route('admin.users.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="username">Username</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="username"
                                            type="text"
                                            name="username"
                                            value="{{ old('username') }}"
                                            placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Email</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="email"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <small class="text-muted">Change Password</small>
                        <div class="row mt-2">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="password"
                                            type="password"
                                            name="password"
                                            placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Password Confirmation</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="password_confirmation"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="Password Confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                {{-- Kalau superadmin, dia bisa create role --}}
                                @if (auth()->user()->hasRole('superadmin'))
                                <section class="form-group">
                                    <label for="role">Role</label>
                                    <select 
                                        name="role"
                                        id="role"
                                        class="form-control">
                                        <option disabled @if (!old('role')) selected @endif>Select Role</option>
                                        
                                        @foreach ($roles as $role)
                                            <option 
                                                value="{{ $role->name }}"
                                                @if (old('role') === $role->name) selected @endif
                                                @if ($role->name === 'superadmin') disabled @endif>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </section>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button class="btn btn-primary ml-2">
                                <i class="fa fa-save"></i> Create
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