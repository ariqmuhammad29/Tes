@extends('admin.layout')

@section('title', 'Users | ')

@section('breadcrumb')
    
@stop

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item active">User</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <ul class="nav nav-tabs card-header-tabs mt-2">
                        @can('users index')
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                href="{{ route('admin.users.index') }}">
                                Users
                            </a>
                        </li>
                        @endcan
                        @can('roles index')
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('admin.roles.index') }}">
                                Role & Permission
                            </a>
                        </li>
                        @endcan
                    </ul>

                    <div>
                        <a 
                            href="{{ route('admin.users.create') }}"
                            class="btn btn-success pull-right"
                            >
                            <i class="fa fa-plus"></i> Add User
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
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration + ((request()->page ?? 1) - 1) * count($users) }}</td>
                                <td class="text-center">
                                    <img 
                                        src="{{ @$user->image->sm }}" class="rounded my-2" style="width: 3rem; height: 3rem; object-fit: cover;">
                                </td>
                                <td>
                                    {{ $user->name }}
                                    <div>
                                        <small class="text-muted">
                                            {{ $user->username }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td class="text-center">
                                    {{ @$user->roles->first()->name ?? 'No role' }}
                                </td>
                                <td class="text-center">
                                    <!-- /btn-group-->
                                    <div class="btn-group">
                                        <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @can('users edit')
                                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                            @endcan
                                            @can('users delete')
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')" method="post">
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
                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center"> <b>Table is Empty</b> </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
@stop