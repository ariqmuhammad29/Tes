@extends('admin.layout')

@section('title')
    Edit Footer Info |
@endsection

@section('additional-styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer Info </h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.about.edit') }}">Footer Info </a>
                </div>
                {{-- <div class="breadcrumb-item">
                    {{ $data->title }}
                </div> --}}
                <div class="breadcrumb-item active">
                    Edit
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
                <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="form-posts">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-form-label" for="location">Addres</label>
                        <div class="controls">
                            <input class="form-control" id="location" size="16" type="text" name="location"
                                placeholder="Addres" value="{{ @$data->location }}" required>
                            <input type="hidden" name="type" value="footer">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="phone_number">Phone Number</label>
                        <div class="controls">
                            <input class="form-control" id="phone_number" size="16" type="number" name="phone_number"
                                placeholder="Phone Number" value="{{ @$data->phone_number }}" required>
                            <input type="hidden" name="type" value="footer">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="company_number">Company Number</label>
                        <div class="controls">
                            <input class="form-control" id="company_number" size="16" type="number"
                                name="company_number" placeholder="Company Number" value="{{ @$data->company_number }}"
                                required>
                            <input type="hidden" name="type" value="footer">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="website">Website</label>
                        <div class="controls">
                            <input class="form-control" id="website" size="16" type="text" name="website"
                                placeholder="www." value="{{ @$data->website }}" required>
                            <input type="hidden" name="type" value="footer">
                        </div>
                    </div>



                    <div class="form-actions">

                        <button class="btn btn-primary ml-2" type="submit">
                            <i class="fa fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
            editor.root.style.lineHeight = '0';
            const formAbout = document.querySelector('form#form-posts');
            const textAreaDescription = document.querySelector('textarea[name=description]');

            formAbout.addEventListener('submit', (e) => {
                textAreaDescription.value = editor.root.innerHTML;
            });
        </script>
    @endsection
