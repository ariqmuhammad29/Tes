@extends('admin.layout')

@section('title', 'Edit Team |')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Team</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.teams.index') }}">Team</a>
                </div>
                <div class="breadcrumb-item">
                    {{ $team->name }}
                </div>
                <div class="breadcrumb-item active">Edit</div>
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
                <form class="form-horizontal" action="{{ route('admin.teams.update', [$team->id]) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="row">
                        <div class="col-md">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Name</label>
                                        <div class="controls">
                                            <input class="form-control" id="name" size="16" type="text"
                                                name="name" value="{{ old('name') ?: $team->name }}" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="role">Role</label>
                                        <div class="controls">
                                            <input class="form-control" id="role" size="16" type="text"
                                                name="role" value="{{ old('role') ?: $team->role }}" placeholder="Role">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="desc">About</label>
                                <div class="controls">
                                    <textarea class="form-control" id="desc" name="about" cols="30" rows="4" placeholder="About"
                                        style="min-height: 60px;">{{ old('about') ?: $team->about }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="form-group">
                                <label class="col-form-label" for="img-container">Photo</label>
                                <div class="controls">
                                    <img class="img-fluid" id="img-container" alt="Team Gallery" width="100"
                                        height="100" src="{{ @$team->image->sm }}" />
                                    <input type="file"
                                        onchange="document.getElementById('img-container').src = window.URL.createObjectURL(this.files[0])"
                                        name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-3">
                        <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button class="btn btn-primary ml-2" type="submit">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@stop

@section('additional-scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
    <script>
        let accounts = {!! json_encode(old('accounts') ?: $team->social_media) !!}

        let socialMediaApp = new Vue({
            el: '#social-media-container',
            data: () => ({
                accounts
            }),
            methods: {
                addSocialMedia() {
                    this.accounts.push({
                        platform: null,
                        link: null
                    })
                },
                removeSocialMedia() {
                    if (this.accounts.length) {
                        this.accounts.pop()
                    }
                }
            }
        })
    </script>
@endsection
