@extends('admin.layout')

@section('title')
    Edit ContactUs |
@endsection

@section('additional-styles')
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>ContactUs </h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.contactUs.edit') }}">ContactUs </a>
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
                        <label class="col-form-label" for="map">Map</label>
                        <div class="controls">
                            {{-- <input class="form-control" id="map" size="16" type="text" name="map"
                                placeholder="<iframe" value="{{ @$data->map }}" required>
                            <input type="hidden" name="type" value="contactUs"> --}}
                            <textarea class="form-control" id="map" name="map" cols="30" rows="10" style="min-height: 60px;" placeholder="<iframe>...">{{ @$data->map }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="addres">Addres</label>
                        <div class="controls">
                            {{-- <input class="form-control" id="addres" size="16" type="text" name="addres"
                                placeholder="Addres" value="{{ @$data->addres }}" required>
                            <input type="hidden" name="type" value="contactUs"> --}}
                            <textarea class="form-control" id="addres" name="addres" cols="30" rows="10" style="min-height: 60px;" placeholder="Addres">{{ @$data->addres }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="phone_number">Phone Number</label>
                        <div class="controls">
                            <input class="form-control" id="phone_number" size="16" type="text" name="phone_number"
                                placeholder="Number phone company" value="{{ @$data->phone_number }}" required>
                            <input type="hidden" name="type" value="contactUs">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <div class="controls">
                            <input class="form-control" id="email" size="16" type="text" name="email"
                                placeholder="Company email" value="{{ @$data->email }}" required>
                            <input type="hidden" name="type" value="contactUs">
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
