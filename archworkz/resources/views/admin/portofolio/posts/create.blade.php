@extends('admin.layout')

@section('title')
Create Portofolio |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Portofolio</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.portofolio.index') }}">Portofolio</a>
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
            <form class="form-horizontal" action="{{ route('admin.portofolio.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="title">Title</label>
                            <div class="controls">
                                <input class="form-control" id="title" size="16" type="text" name="title" placeholder="Title of the portofolio" value="{{ old('title') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Client</label>
                            <div class="controls">
                                <select class="form-control" id="client" name="client_id" required>
                                    <option disabled {{ old('client_id') ? '' : 'selected' }}>Please select the client</option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                        </option=>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="category">Category</label>
                            <div class="controls">
                                <select class="form-control" id="category" name="portofolio_category_id" required>
                                    <option disabled {{ old('portofolio_category_id') ? '' : 'selected' }}>Please select the category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('portofolio_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                        </option=>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="desc">Description</label>
                    <div class="controls">
                        <textarea class="form-control" id="desc" name="description" style="min-height: 70px;" placeholder="Description of the portofolio" required>{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo">Cover</label>
                    <div class="controls">
                        <a href="javascript:void(0)" class="btn btn-success" onclick="addImage()" style="margin-bottom: 20px;">
                            <i class="fa fa-image"></i> Add Image
                        </a>
                    </div>
                    <div class="row" id="image-added">
                        <div class="col-md-3 halo" style="margin-bottom:40px;">
                            <div class="custom-file">
                                <input id="photo" type="file" name="image[]" class="custom-file-input" onchange="document.querySelector('img#photo').src = window.URL.createObjectURL(this.files[0])" accept="image/*" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <img src="{{asset('static/admin/img/default.png')}}" alt="photo" id="photo">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('admin.portofolio.index') }}" tabindex="-1" class="btn btn-secondary">
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
@endsection

@section('additional-scripts')

<script type="text/javascript">
    let tahu = 0;

    function addImage() {
        tahu++;
        var wrap = $("#image-added");
        var kelas = "\'img#photo" + tahu + "\'";
        var assets = "{{asset('static/admin/img/default.png')}}";
        var html = '<div class="col-md-3 halo" style="margin-bottom:20px;">' +
            '<div class="custom-file">' +
            '<input id="photo' + tahu + '" type="file" name="image[]" class="custom-file-input" accept="image/*"                                  onchange="document.querySelector(' + kelas + ').src = window.URL.createObjectURL(this.files[0])">' +
            '<label class="custom-file-label" for="customFile">Choose file</label>' +
            '</div>' +
            '<img src="' + assets + '" alt="photo" id="photo' + tahu + '">' +
            '<a href="javascript:void(0)" onclick="imageRemove(this)" class="btn btn-icon btn-danger" title="delete"><i class="fas fa-trash"></i> Delete</a>' +
            '</div>';

        $(wrap).append(html);
    }

    function imageRemove(that) {
        $(that).parents('.col-md-3').remove();
    }
</script>

@endsection