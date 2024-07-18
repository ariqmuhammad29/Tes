@extends('admin.layout')

@section('title')
    Create FAQ |    
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>FAQ</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.faq.index') }}">FAQS</a>
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
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
            <form class="form-horizontal" action="{{route('admin.faq.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-form-label" for="question">Question</label>
                    <div class="controls">
                        <input class="form-control" id="title" size="16" type="text" name="question" placeholder="question" value="{{ old('question') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea
                        id="answer"
                        class="form-control"
                        name="answer"
                        placeholder="Answer from users"
                        style="min-height: 60px;"
                        rows="5">{{ old('answer') }}</textarea>
                </div>
                
            

                
                <div class="form-actions">
                    <a href="admin.menus.update" tabindex="-1" class="btn btn-secondary">
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