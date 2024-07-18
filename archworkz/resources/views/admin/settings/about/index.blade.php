@extends('admin.layout')

@section('title')
  About | 
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
  Setting
</li>
<li class="breadcrumb-item">
  About
</li>
<li class="breadcrumb-item active">
  <a href="{{ route('admin.settings.about.index') }}">Index</a>
</li>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h4>About</h4>
  </div>
  <div class="card-body">
    @if (session()->has('success'))
      <div class="mt-3 mb-3 alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Lang</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>{{ @$about->id->title ?: 'No Title' }}</td>
          <td>ID</td>
          <td>
            <a
              href="{{ route('admin.settings.about.edit', ['lang' => 'id']) }}"
              class="btn btn-sm btn-light"
            >
              <i class="fa fa-edit"></i> Edit
            </a>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>{{ @$about->en->title ?: 'No Title' }}</td>
          <td>EN</td>
          <td>
            <a
              href="{{ route('admin.settings.about.edit', ['lang' => 'en']) }}"
              class="btn btn-sm btn-light"
            >
              <i class="fa fa-edit"></i> Edit
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection