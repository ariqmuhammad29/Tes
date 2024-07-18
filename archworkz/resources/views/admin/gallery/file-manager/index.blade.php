@extends('admin.layout')

@section('title')
File Manager |
@endsection

@section('content')
<section class="section">
  <div class="section-header">
      <h1>File Manager</h1>

      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item">
              <a href="{{ route('admin.index') }}">Dashboard</a>
          </div>
          <div class="breadcrumb-item active">File Manager</div>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <div id="file-manager-app"></div>
      </div>
  </div>
</section>
@endsection

@section('additional-scripts')
<script src="{{ asset('file-manager/file-manager.js') }}"></script>

<script>
  let fileManager = new FileManager('#file-manager-app')
  fileManager.show()
</script>
@endsection