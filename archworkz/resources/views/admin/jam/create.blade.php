@extends('admin.layout')

@section('title')
    Create Jam Kehadiran |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Jam Kehadiran</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                Jam Kehadiran
            </div>
            <div class="breadcrumb-item active">
                Create
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
            <form class="form-horizontal" action="{{ route('admin.jam.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Jam Kehadiran</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="cth: 09.00 - 10.00" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.jam.index') }}" tabindex="-1" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-primary ml-2" type="submit">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@stop
