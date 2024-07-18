@extends('admin.layout')

@section('title', "Edit {$user->name} |")

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.users.index') }}">User</a>
    </li>
    <li class="breadcrumb-item">
        {{ $user->name }}
    </li>
    <li class="breadcrumb-item active">
        Edit
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
        <h1>Edit User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}">User</a>
            </div>
            <div class="breadcrumb-item">{{ $user->name }}</div>
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
                        action="{{ route('admin.users.update', [$user->id]) }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="col-form-label" for="name">Name</label>
                            <div class="controls">
                                <input class="form-control" id="name" size="16" type="text" name="name" value="{{ old('name') ?: $user->name }}" placeholder="Name">
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
                                            value="{{ old('username') ?: $user->username }}"
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
                                            value="{{ old('email') ?: $user->email }}"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Edit password untuk user yg login aja --}}
                        @if (auth()->user()->id === $user->id)
                        <hr>
                        <small class="text-muted">Change Password</small>
                        <div class="row mt-2">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="old_password">Old Password</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="old_password"
                                            type="password"
                                            name="old_password"
                                            placeholder="Old Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="col-form-label" for="password">New Password</label>
                                    <div class="controls">
                                        <input
                                            class="form-control"
                                            id="password"
                                            type="password"
                                            name="password"
                                            placeholder="New Password">
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
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <div class="d-flex">
                                        <img 
                                            src="{{ @$user->image->sm ?? asset('static/admin/img/default.png') }}" alt="photo">
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
                                {{-- Kalau superadmin, dia bisa edit role --}}
                                @if (auth()->user()->hasRole('superadmin'))
                                <section class="form-group">
                                    <label for="role">Role</label>
                                    <select 
                                        name="role"
                                        id="role"
                                        class="form-control"
                                        @if (@$user->roles->first()->name === 'superadmin') disabled @endif>
                                        <option disabled @if (!$user->roles->first() && !old('role')) selected @endif>Select Role</option>
                                        
                                        @foreach ($roles as $role)
                                            <option 
                                                value="{{ $role->name }}"
                                                @if (@$user->roles->first()->name === $role->name) selected @endif>
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