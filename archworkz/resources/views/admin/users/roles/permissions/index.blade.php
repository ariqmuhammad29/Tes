@extends('admin.layout')

@section('title', 'Roles | ')

@section('breadcrumb')
<li class="breadcrumb-item">
  <a href="{{ route('admin.index') }}">Dashboard</a>
</li>
<li class="breadcrumb-item">
  <a href="{{ route('admin.roles.index') }}">Role</a>
</li>
<li class="breadcrumb-item">
  {{ $role->name }}
</li>
<li class="breadcrumb-item active">
  Permissions
</li>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs mt-2">
          @can('roles index')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
              Users
            </a>
          </li>
          @endcan
          @can('roles index')
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.roles.index') }}">
              Role & Permission
            </a>
          </li>
          @endcan
        </ul>
      </div>
      <div class="card-body">
        @if (Session::has('status'))
        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
        @endif

        <h2 class="text-uppercase">Role {{ $role->name }}</h2>

        <hr>
        <form method="POST" class="mt-3">
          @csrf
          <section>
            <h6 class="text-muted mb-3">Admin Panel</h6>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="admin_access" name="admin_access" @if ($role->hasPermissionTo('admin access') or $role->name === 'superadmin') checked @endif>

              <label class="form-check-label" for="admin_access">
                Admin panel access
              </label>
            </div>
          </section>

          <div class="row">
            <div class="col-md">
              @include('admin.users.roles.permissions.components.users')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.roles')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.permissions')
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              @include('admin.users.roles.permissions.components.sliders')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.teams')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.clients')
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.services')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.testimonis')
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              @include('admin.users.roles.permissions.components.gallery-images')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.gallery-videos')
            </div>
            <div class="col-md">
              @include('admin.users.roles.permissions.components.gallery-file-manager')
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.blog-posts')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.blog-categories')
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.product-posts')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.product-categories')
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.portofolio-posts')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.portofolio-categories')
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.inboxes')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.subscribes')
            </div>
            <div class="col-md-4">
              @include('admin.users.roles.permissions.components.settings')
            </div>
          </div>

          <div class="mt-4">
            <button class="btn btn-primary">
              Save <i class="fa fa-save ml-2"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection