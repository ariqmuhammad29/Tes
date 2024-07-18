@extends('admin.layout')

@section('title', 'Roles | ')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item active">Role</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <ul class="nav nav-tabs card-header-tabs mt-2">
                        @can('roles index')
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('admin.users.index') }}">
                                Users
                            </a>
                        </li>
                        @endcan
                        @can('roles index')
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                href="{{ route('admin.roles.index') }}">
                                Role & Permission
                            </a>
                        </li>
                        @endcan
                    </ul>
                    <div>
                        <a 
                            href="{{ route('admin.roles.create') }}"
                            class="btn btn-success pull-right"
                            >
                            <i class="fa fa-plus"></i> Add Role
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                    @endif

                    <table class="table table-responsive-sm table-striped table-vertical-align">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Name</th>
                            <th>Users</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ((request()->page ?? 1) - 1) * count($roles) }}</td>
                                <td>
                                    {{ $role->name }}
                                </td>
                                <td class="text-center">
                                  {{ $role->users_count }} users
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.permissions.index', [$role->id]) }}">
                                        {{ $role->name === 'superadmin' ? 'All' : $role->permissions_count }} permissions
                                    </a>
                                </td>
                                <td class="text-center">
                                    <!-- /btn-group-->
                                    <div class="btn-group">
                                        <button
                                          class="btn btn-warning dropdown-toggle"
                                          type="button"
                                          data-toggle="dropdown"
                                          aria-haspopup="true"
                                          aria-expanded="false"
                                          @if ($role->name === 'superadmin') disabled @endif>Action</button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @can('roles edit')
                                            <a class="dropdown-item" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                                            @endcan
                                            @can('roles delete')
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?')" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="dropdown-item">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <!-- /btn-group-->
                                </td>
                            </tr>
                        @endforeach
                        @if ($roles->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center"> <b>Table is Empty</b> </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
@stop