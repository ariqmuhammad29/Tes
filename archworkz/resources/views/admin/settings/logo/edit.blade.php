@extends('admin.layout')

@section('title')
  Edit Logo |
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">Setting</li>
  <li class="breadcrumb-item">Logo</li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@section('additional-styles')

<style>
  .form-group img {
    width: 300px !important;
    flex: none;
    object-fit: contain;
  }
</style>
@endsection

@section('content')
  @if (session()->has('success'))
  <div class="mt-2 mb-2 alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="card">
    <div class="card-header">
      Edit Logo
    </div>
    <div class="card-body">

      <form id="form-about" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="logo">Logo</label>
          <div class="d-flex">
            <img alt="logo" title="logo"
              src="{{ asset('storage/'.@$setting->logo) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-4">
              <input
                id="logo"
                type="file"
                name="logo"
                class="custom-file-input"
                onchange="document.querySelector('.form-group img').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="logo_gray">Logo Grayscale</label>
          <div class="d-flex">
            <img 
              id="logo_gray" 
              alt="logo grayscale" title="logo grayscale"
              src="{{ asset('storage/'.@$setting->logo_gray) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="logo_gray"
                type="file"
                name="logo_gray"
                class="custom-file-input"
                onchange="document.querySelector('img#logo_gray').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="icon">Icon</label>
          <div class="d-flex">
            <img
              id="icon"
              alt="icon"
              title="icon" 
              src="{{ asset('storage/'.@$setting->icon) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="icon"
                type="file"
                name="icon"
                class="custom-file-input"
                onchange="document.querySelector('img#icon').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="ogimage">Gambar</label>
          <div class="d-flex">
            <img
              id="ogimage"
              alt="Gambar"
              title="Gambar" 
              src="{{ asset('storage/'.@$setting->ogimage) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="ogimage"
                type="file"
                name="ogimage"
                class="custom-file-input"
                onchange="document.querySelector('img#ogimage').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
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
