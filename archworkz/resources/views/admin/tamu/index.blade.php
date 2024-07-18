@extends('admin.layout')

@section('title')
Tamu Undangan |
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tamu Undangan</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
            </div>
            <div class="breadcrumb-item">
                Tamu
            </div>
            <div class="breadcrumb-item">
                Undangan
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.tamu.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Tamu Undangan</a>
        </div>
        <div class="card-body">

            <div class="float-right">
                <form id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Tamu" name="name" value="{{ Request::get('name') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
            <div class="float-right" style="margin-right:10px;">
                <select class="form-control selectric" id="admin">
                    <option value="">Di Input Oleh:</option>
                    @foreach($admins as $key => $admin)
                    <option value="{{ $admin->id }}" {{ ($admin->id == Request::get('admin')) ? 'selected' : '' }}>{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="float-right" style="margin-right:10px;">
                <select class="form-control selectric" id="jam">
                    <option value="">Jam Undangan</option>
                    @foreach($jams as $key => $jam)
                    <option value="{{ $jam->id }}" {{ ($jam->id == Request::get('jam')) ? 'selected' : '' }}>{{ $jam->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="float-right" style="margin-right:10px;">
                <select class="form-control selectric" id="shortBy">
                    <option value="">Urutkan Berdasarkan</option>
                    <option {{ (Request::get("shortby")) == "Jam Undangan" ? "selected" : "" }}>Jam Undangan</option>
                    <option {{ (Request::get("shortby")) == "Admin" ? "selected" : "" }}>Admin</option>
                    <option {{ (Request::get("shortby")) == "Nama Tamu" ? "selected" : "" }}>Nama Tamu</option>
                </select>
            </div>
            @endif

            <div class="clearfix mb-3"></div>

            <p class="card-text">All {{ $models->count() }} Data</p>

            @if (Session::has('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">{{ session('message') }}</div>
            @endif
            <table class="table table-responsive-sm table-striped table-vertical-align">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 20px;">No</th>
                        <th>Nama Tamu</th>
                        <!-- <th>No Telepon</th> -->
                        <th>Nama Admin</th>
                        <th>Jam Undangan</th>
                        <th>Share</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($models as $key => $model)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <b>{{ $model->title }}</b> <br>
                            <input type="text" value="" id="pilih-{{@$model->id}}" style="position:absolute;left:-1000px;top:-1000px;" />

                        </td>
                        <!-- <td>{{ $model->phone }}</td> -->
                        <td>{{ $model->user->name }}</td>
                        <td>@php
                            $classes = ['primary', 'success', 'danger', 'warning', 'info']
                            @endphp
                            <span class="badge badge-{{ $classes[@$model->jams->id % 5] }}">
                                {{ @$model->jams->title ?? 'belum tersedia' }}
                            </span>
                        </td>
                        <td><a href="javascript:void(0)" onclick="copy_link({{@$model->id}})" title="copy link"><i class="fa fa-copy fa-lg"></i></a> &nbsp;
                            <a href="" target="_blank" title="lihat link"><i class="fa fa-link fa-lg"></i></a> &nbsp;
                            <a href="https://wa.me/{{ @$model->phone }}?text=Assalamu’alaikum Warahmatullahi Wabarakatuh
                            %0A%0AMerupakan kebahagiaan bagi kami apabila
                            %0ABapak/Ibu/Saudara {{ $model->title }}
                            %0A%0ABerkenan hadir dalam acara resepsi pernikahan
                            %0A%0AFaza Amaly Sulthon
                            %0APutri Moh Sulthon Amien %26 Enny Soetji Indriastuti
                            %0A%0A %20 %20 %20 %20 %20 %20 %20 %20 %26 
                            %0A%0AMuhammad Harya Prayogi
                            %0APutra Hargiyanto Witonomihardjo (Allahu Yarham) %26  Kurniati Sundari
                            %0A%0ALink Undangan: 
                            %0A
                            %0A%0AWassalamu’alaikum Warahmatullahi Wabarakatuh" target="_blank" title="share whatsapp">
                                <img src="{{asset('static/website')}}/images/wa.png" style="margin-top:-7px;height:19px;"></a>
                        </td>
                        <td>
                            <!-- /btn-group-->
                            <div class="btn-group">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" href="{{ route('admin.tamu.edit', $model->id) }}">Edit</a>
                                    <form action="{{ route('admin.tamu.destroy', $model->id) }}" method="post">
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
                    @if ($models->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center"> <b>Table is empty</b> </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
</section>
@stop
@section('additional-scripts')
<script type="text/javascript">
    function copy_link(id) {

        var copyText = document.getElementById("pilih-" + id);
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Link yang disalin: " + copyText.value);
    }

    $(document).ready(function() {

        $("#searchForm").submit(function(event) {
            event.preventDefault();
            var name = $("input[name=name]").val();
            var admin = '';
            var jam = '';
            var shortBy = '';

            if ($('#admin').length > 0) {
                admin = $("#admin").val();
            }

            if ($('#jam').length > 0) {
                jam = $("#jam").val();
            }

            if ($('#shortBy').length > 0) {
                shortBy = $("#shortBy").val();
            }
            window.location.href = "{{ route('admin.tamu.index') }}?name=" + name + "&admin=" + admin + "&jam=" + jam + "&shortby=" + shortBy;
        });

        $("#admin").on('change', function() {
            $("#searchForm").submit();
        });

        $("#jam").on('change', function() {
            $("#searchForm").submit();
        });

        $("#shortBy").on('change', function() {
            $("#searchForm").submit();
        });

    });
</script>
@endsection