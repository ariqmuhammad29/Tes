@extends('admin.layout')

@section('title')
  Edit Breadcrumb |
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item">Setting</li>
  <li class="breadcrumb-item">Breadcrumb</li>
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
      Edit Breadcrumb
    </div>
    <div class="card-body">

      <form id="form-about" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="profile">Profile</label>
          <div class="d-flex">
            <img alt="profile" title="profile"
              src="{{ asset(@$setting->profile) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-4">
              <input
                id="profile"
                type="file"
                name="profile"
                class="custom-file-input"
                onchange="document.querySelector('.form-group img').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="service">Service</label>
          <div class="d-flex">
            <img 
              id="service" 
              alt="service" title="service"
              src="{{ asset(@$setting->service) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="service"
                type="file"
                name="service"
                class="custom-file-input"
                onchange="document.querySelector('img#service').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="blog">Blog</label>
          <div class="d-flex">
            <img
              id="blog"
              alt="blog"
              title="blog" 
              src="{{ asset(@$setting->blog) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="blog"
                type="file"
                name="blog"
                class="custom-file-input"
                onchange="document.querySelector('img#blog').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="partner">Partner</label>
          <div class="d-flex">
            <img
              id="partner"
              alt="partner"
              title="partner" 
              src="{{ asset(@$setting->partner) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="partner"
                type="file"
                name="partner"
                class="custom-file-input"
                onchange="document.querySelector('img#partner').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="page">Page</label>
          <div class="d-flex">
            <img
              id="page"
              alt="page"
              title="page" 
              src="{{ asset(@$setting->page) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="page"
                type="file"
                name="page"
                class="custom-file-input"
                onchange="document.querySelector('img#page').src = window.URL.createObjectURL(this.files[0])"
                accept="image/*"
              >
              <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="contact">Contact</label>
          <div class="d-flex">
            <img
              id="contact"
              alt="contact"
              title="contact" 
              src="{{ asset(@$setting->contact) ?? asset('static/admin/img/default.png') }}">
            <div class="custom-file ml-3">
              <input
                id="contact"
                type="file"
                name="contact"
                class="custom-file-input"
                onchange="document.querySelector('img#contact').src = window.URL.createObjectURL(this.files[0])"
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
