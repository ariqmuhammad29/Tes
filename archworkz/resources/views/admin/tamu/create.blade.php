@extends('admin.layout')

@section('title')
    Create Tamu |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tamu</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                Tamu
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.tamu.index') }}">Undangan</a>
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
            <form class="form-horizontal" action="{{ route('admin.tamu.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="title">Nama Tamu</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Nama Tamu" value="{{ old('title') }}" required>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-form-label" for="noTelp">No Telepon</label>
                    <div class="controls">
                        <input class="form-control" id="noTelp" size="16" type="text" name="phone" placeholder="+62812xxxxxx" value="{{ old('phone') }}" required>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="jam">Jam Kehadiran</label>
                            <div class="controls">
                                <select class="form-control" id="jam" name="jam" required>
                                    <option disabled {{ old('jam') ? '' : 'selected' }}>Pilih Jam </option>
                                    @foreach ($jam as $jam)
                                        <option
                                            value="{{ $jam->id }}"
                                            {{ old('jam') == $jam->id ? 'selected' : '' }}>
                                            {{ $jam->title }}
                                        </option=>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.tamu.index') }}" tabindex="-1" class="btn btn-secondary">
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