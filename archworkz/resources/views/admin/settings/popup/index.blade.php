@extends('admin.layout')

@section('title')
  Popup | 
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">
  Setting
</li>
<li class="breadcrumb-item">
  Popup
</li>
<li class="breadcrumb-item active">
  <a href="{{ route('admin.settings.popup.index') }}">Pop Up</a>
</li>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h4>Pop Up</h4>
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
          <th>Description</th>
          <th>Link</th>
          <th>Type</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        @foreach($popup as $p)
        <tr>
            <td>{{ $no }}</td>   
            <td>{{ $p->title }}</td>
            <td>{{ $p->description }}</td>
            <td>{{ $p->url }}</td>
            <td>{{ $p->type }}</td>
            <td>{{ $p->status }}</td>
          <td>
            <a
              href="{{ route('admin.settings.popup.edit', $p->id) }}"
              class="btn btn-sm btn-light"
            >
              <i class="fa fa-edit"></i> Edit
            </a>
          </td>
        </tr>
        <?php $no++; ?>
        @endforeach
            @if ($popup->isEmpty())
                <tr>
                    <td colspan="5" class="text-center"> <b>Table is empty</b> </td>
                </tr>
            @endif
      </tbody>
    </table>
  </div>
</div>
@endsection