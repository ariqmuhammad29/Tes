@extends('admin.layout')

@section('title')
  Basic Info |
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">Setting</li>
  <li class="breadcrumb-item">Basic Info</li>
@endsection

@section('content')
  @if (session()->has('success'))
  <div class="mt-2 mb-2 alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="card">
    <div class="card-header">
      Basic Info
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input
                  id="name"
                  type="text"
                  class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                  name="name"
                  placeholder="Name"
                  value="{{ old('name') ?: @$setting->name }}">
                @if ($errors->has('name'))
                <div class="invalid-feedback">
                  {{ $errors->first('name') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  id="email"
                  type="email"
                  name="email"
                  class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                  placeholder="Email"
                  value="{{ old('email') ?: @$setting->email }}">
                @if($errors->has('email'))
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input
                  id="phone"
                  name="phone"
                  type="text"
                  class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}"
                  placeholder="Phone"
                  value="{{ old('phone') ?: @$setting->phone }}">
                @if ($errors->has('phone'))
                <div class="invalid-feedback">
                  {{ $errors->first('phone') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="whatsapp">Whatsapp</label>
                <input
                  id="whatsapp"
                  name="whatsapp"
                  type="text"
                  class="form-control {{ $errors->first('whatsapp') ? 'is-invalid' : '' }}"
                  placeholder="Whatsapp"
                  value="{{ old('whatsapp') ?: @$setting->whatsapp }}">
                @if ($errors->has('whatsapp'))
                <div class="invalid-feedback">
                  {{ $errors->first('whatsapp') }}
                </div>
                @endif
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group">
                <label for="name">Youtube</label>
                <input id="youtube" type="text" name="youtube"
                  class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}"                  
                  placeholder="https://www.youtube.com/embed/e54j2VSUjsI"
                  value="{{ old('youtube') ?: @$setting->youtube }}">
                @if ($errors->has('youtube'))
                <div class="invalid-feedback">
                  {{ $errors->first('youtube') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="address">Address</label>
                <textarea style="min-height: 110px;" 
                  id="address"
                  name="address"
                  class="form-control {{ $errors->first('address') ? 'is-invalid' : '' }}"
                  placeholder="Address"
                >{{ old('address') ?: @$setting->address }}</textarea>

                @if ($errors->has('address'))
                <div class="invalid-feedback">
                  {{ $errors->first('address') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="gmap">Gmap iframe</label>
                <textarea style="min-height: 110px;" 
                  id="gmaps"
                  name="gmaps"
                  class="form-control {{ $errors->first('gmaps') ? 'is-invalid' : '' }}"
                  placeholder="<iframe src=https://www.google.com/maps/> </iframe>"
                >{{ old('gmaps') ?: @$setting->gmaps }}</textarea>

                @if ($errors->has('gmaps'))
                <div class="invalid-feedback">
                  {{ $errors->first('gmaps') }}
                </div>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="pixel">Facebook Pixel</label>
                <textarea style="min-height: 110px;" 
                  id="pixel"
                  name="pixel"
                  class="form-control {{ $errors->first('pixel') ? 'is-invalid' : '' }}"
                  placeholder="Facebook Pixel"
                >{{ old('pixel') ?: @$setting->pixel }}</textarea>

                @if ($errors->has('pixel'))
                <div class="invalid-feedback">
                  {{ $errors->first('pixel') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="analytics">Google Analytics</label>
                <textarea style="min-height: 110px;" 
                  id="analytics"
                  name="analytics"
                  class="form-control {{ $errors->first('analytics') ? 'is-invalid' : '' }}"
                  placeholder="U-12345678"
                >{{ old('analytics') ?: @$setting->analytics }}</textarea>

                @if ($errors->has('analytics'))
                <div class="invalid-feedback">
                  {{ $errors->first('analytics') }}
                </div>
                @endif
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label" for="file-container">File</label>
                <div class="d-flex">
                  <iframe class="img-fluid" id="file" alt="File" src="{{ old('file') ?: asset(@$setting->file) }}" /></iframe> 
                  <div class="custom-file ml-3">
                    <input
                      id="file"
                      type="file"
                      name="file"
                      class="custom-file-input"
                      onchange="document.querySelector('.form-group iframe').src = window.URL.createObjectURL(this.files[0])"
                    >
                    <label class="custom-file-label" for="customFile">Choose file</label> <br>
                    <p style="margin-top:10px;">Maximum allowed size is 2MB</p>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="text-right mt-3">
          <button class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection