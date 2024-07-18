@extends('admin.layout')

@section('title')
    Create Service |
@endsection

@section('additional-styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Service</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.services.index') }}">Service</a>
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
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach
                @endif
                <form class="form-horizontal" action="{{ route('admin.services.store') }}" method="post"
                    enctype="multipart/form-data" id="form-posts">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label" for="title">Title</label>
                        <div class="controls">
                            <input class="form-control" id="title" size="16" type="text" name="title"
                                placeholder="Title of the service" value="{{ old('title') }}" required>
                            <input type="hidden" name="type" value="service">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="desc_sort">Short Description</label>
                        <div class="controls">
                            <textarea class="form-control" id="desc_sort" name="description_short" cols="30" rows="10"
                                placeholder="Short Description of the service" required>{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>

                        <div id="description"></div>
                        <textarea name="description" class="d-none"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <div class="d-flex">
                            <img src="{{ asset('static/admin/img/default.png') }}" alt="photo">
                            <div class="custom-file ml-3">
                                <input id="photo" type="file" name="image" class="custom-file-input"
                                    onchange="document.querySelector('.form-group img').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.services.index') }}" tabindex="-1" class="btn btn-secondary">
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
@section('additional-scripts')
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // Mendapatkan toolbar default Quill
        var toolbarOptions = [
            [{
                'font': []
            }],
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
                'color': []
            }, {
                'background': []
            }],
            ['link', 'image'],
            ['clean']
        ];

        // Inisialisasi Quill dengan toolbar yang telah dikustomisasi
        var editor = new Quill('#description', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        const formAbout = document.querySelector('form#form-posts');
        const textAreaDescription = document.querySelector('textarea[name=description]');

        formAbout.addEventListener('submit', (e) => {
            textAreaDescription.value = editor.root.innerHTML;
        });
    </script>
@endsection
