@extends('admin.layout')

@section('title')
    Create AboutUs |
@endsection
@section('additional-styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>AboutUs</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.about.index') }}">AboutUs</a>
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
                <form class="form-horizontal" action="{{ route('admin.about.store') }}" method="post"
                    enctype="multipart/form-data" id="form-posts">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label" for="title">Title</label>
                        <div class="controls">
                            <input class="form-control" id="title" size="16" type="text" name="title"
                                placeholder="Title of the AboutUs" value="{{ old('title') }}" required>
                            <input type="hidden" name="type" value="AboutUs">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>

                        <div id="description"></div>
                        <textarea name="description" class="d-none"></textarea>
                    </div>
                    <div class="form-actions">
                        <a href="{{ route('admin.about.index') }}" tabindex="-1" class="btn btn-secondary">
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
            [{ 'font': [] }],
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],        
            [{ 'color': [] }, { 'background': [] }],          
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
