@extends('admin.layout')

@section('title')
    Tamu Undangan |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tamu Undangan</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                Tamu 
            </div>
            <div class="breadcrumb-item">
                Undangan
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.tamu.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Tamu Undangan</a>
        </div>
        <div class="card-body">
            @if (Session::has('status'))
                <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
            @endif
            <table class="table table-responsive-sm table-striped table-vertical-align">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 20px;">No</th>
                    <th>Nama Tamu</th>
                    <th>Jumlah Tamu</th>
                    <th>Jam Datang</th>
                    <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                @foreach($models as $key => $model)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <b>{{ $model->title }}</b>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $model->jumlah_datang }} Orang</span>
                        </td>
                        <td>    
                            <span class="badge badge-primary">
                                {{ @$model->updated_at }}
                            </span>
                        </td>
                            <!-- 
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('admin.tamu.edit', $model->id) }}">Edit</a>
                                    <form action="{{ route('admin.tamu.destroy', $model->id) }}" method="Tamu Undangan">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="dropdown-item">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                            -->
                    </tr>
                @endforeach
                @if ($models->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center"> <b>Table is empty</b> </td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
</section>
@stop