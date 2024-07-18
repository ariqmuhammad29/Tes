@extends('admin.layout')

@section('title')
Category |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1> faqs</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                faqs
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.faq.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add
                Category Article</a>
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
            @endif
            <table class="table table-responsive-sm table-striped table-vertical-align">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 20px;">No</th>
                        <th>faq</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $d->question }}
                            <br>
                            {{ $d->answer }}
                            <br>
                            Publish : {{ $d->created_at }}
                        </td>
                        <!-- <td></td> 
                            <td class="text-muted"></td> -->

                        </td>
                        <td>
                            <!-- /btn-group-->
                            <div class="btn-group">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start"
                                    style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('admin.faq.edit', $d->id) }}">Edit</a>
                                    <form action="{{ route('admin.faq.destroy', $d->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="dropdown-item">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /btn-group-->
                        </td>
                    </tr>
                    @endforeach
                    @if ($data->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center"> <b>Table is empty</b> </td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</section>
@stop