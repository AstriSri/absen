@extends('layouts.masteradmin')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

@section('content')
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        Data Akun
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col">
                            <div class="form-row align-items-center">

                                <div class="form-group col-md-5">

                                    <form method="POST" action="{{ url('admin/dataakun') }}">
                                        @csrf
                                        <input type="text" id="" name="nama" class="form-control" value="" autofocus
                                            placeholder="nama">
                                </div>
                                <div class="form-group col-md-5">

                                    <input type="text" id="" name="username" class="form-control" value=""
                                        placeholder="username">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <div class="col">
                            <form method="POST" action="{{ url('admin/dataakun') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" id="" name="email" class="form-control" value=""
                                            placeholder="email">
                                    </div>
                                    <div class="form-group col-2">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                                    </div>
                                    @if (Auth::user()->level == 100)
                                        <div class="form-group col-4">
                                            <select name="level" class="form-control show-tick" data-live-search="true">
                                                <option value="" selected disabled>Pilih level user</option>
                                                @foreach ($level as $b)
                                                    <option value="{{ $b->kode_role }}">{{ $b->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-2">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (Auth::user()->level == 100)
                        <button type="button" class="btn btn-success" onclick="location.href='{{ url('admin/tambahakun') }}'"><i
                                class="fas fa-plus"></i><span> Tambah Akun</span></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
