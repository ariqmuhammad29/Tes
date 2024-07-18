@extends('admin.layout')

@section('title', 'Teams | ')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Teams</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">Team</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.teams.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add
                    Team</a>
            </div>
            <div class="card-body">
                @if (Session::has('status'))
                    <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
                @endif
                <table class="table table-responsive-sm table-striped table-vertical-align">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>
                                <i class="fas fa-arrows-alt-v"></i>
                            </th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>About</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $key => $team)
                            <tr>
                                <td>{{ $team->id }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.teams.change-order', [$team->id, 'up']) }}"
                                            class="btn btn-sm btn-light mb-1">
                                            <i class="fa fa-caret-up"></i>
                                        </a>
                                        <a href="{{ route('admin.teams.change-order', [$team->id, 'down']) }}"
                                            class="btn btn-sm btn-light">
                                            <i class="fa fa-caret-down"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <img src="{{ @$team->image->sm }}" class="rounded" style="width: 5rem">
                                </td>
                                <td>
                                    {{ $team->name }}
                                </td>
                                <td>
                                    {{ $team->role }}
                                </td>
                                <td class="text-wrap">
                                    {!! nl2br($team->about) !!}
                                </td>
                                <td>
                                    <!-- /btn-group-->
                                    <div class="btn-group">
                                        <button class="btn btn-warning dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Action</button>
                                        <div class="dropdown-menu" x-placement="bottom-start"
                                            style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.teams.edit', $team->id) }}">Edit</a>
                                            <form action="{{ route('admin.teams.destroy', $team->id) }}"
                                                onsubmit="return confirm('Are you sure?')" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="dropdown-item">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /btn-group-->
                                </td>
                            </tr>
                        @endforeach
                        @if ($teams->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center"> <b>Table is Empty</b> </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $teams->links() }}
            </div>
        </div>
    </section>
@stop
