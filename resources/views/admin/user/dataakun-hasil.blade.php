@extends('layouts.masteradmin')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
@section('page-title')
    <div class="block-header">
        <h2>Sistem Informasi Pegawai</h2>
    </div>
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-header">
                <h2>
                  Data Akun
                  <a class="btn btn-danger text-white float-right" href='{{ url('admin/dataakun/cari') }}'><i class="fas fa-arrow-left"></i></a>
                    </h2>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>
                                    <center>No.</center>
                                </th>
                                <th>
                                    <center>Username</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>E-mail</center>
                                </th>
                                @if (Auth::user()->level == 100)
                                    <th>
                                        <center>Level</center>
                                    </th>
                                @endif
                                <th>
                                    <center>Edit</center>
                                </th>
                                @if (Auth::user()->level == 100)
                                    <th>
                                        <center>Hapus</center>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <center>No.</center>
                                </th>
                                <th>
                                    <center>Username</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>E-mail</center>
                                </th>
                                @if (Auth::user()->level == 100)
                                    <th>
                                        <center>Level</center>
                                    </th>
                                @endif
                                <th>
                                    <center>Edit</center>
                                </th>
                                @if (Auth::user()->level == 100)
                                    <th>
                                        <center>Hapus</center>
                                    </th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user as $a)
                                <tr>
                                    <td>
                                        <center>{{ $loop->iteration }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $a->username }}</center>
                                    </td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    @if (Auth::user()->level == 100)
                                        <td>
                                            <center>{{ $a->level }}</center>
                                        </td>
                                    @endif
                                    <!-- <form method="get" action="{{ url('edit/' . $a->id . '/akun') }}" target="_blank">
                                  @csrf
                                  <td><center><button type="submit" class="btn bg-deep-orange waves-effect"><i class="material-icons">mode_edit</i></button></center></td>
                                </form> -->
                                    <td>
                                        <center><a class="btn btn-warning" href="{{ url('edit/' . $a->id . '/akun') }}"
                                                target="_blank"><i class="far fa-edit"></i></a></center>
                                    </td>
                                    <!-- <td><center><button type="button" class="btn bg-deep-orange waves-effect" onclick="location.href='{{ url('edit/' . $a->id . '/akun') }}'"><i class="material-icons">mode_edit</i></button></center></td> -->
                                    @if (Auth::user()->level == 100)
                                        <td>
                                            <center><button type="button" class="btn btn-danger"
                                                    onclick="location.href='{{ url($a->id . '/hapusakun') }}'"><i
                                                        class="far fa-trash-alt"></i></button></center>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
