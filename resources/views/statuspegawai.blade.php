{{-- 
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

@section('content')
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-header">
            <h2>
                Tambah Data
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ url('statuspegawai_tambah') }}">
            @csrf
              <label for="npm">Nama Status Pegawai</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="status" class="form-control" value="" required>
                  </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="kode" class="form-control" value="" required>
                  </div>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect">Tambahkan</button>
          </form>
        </div>
    </div>
  </div>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="card-header">
              <h2>
                  Data Status Pegawai
              </h2>
          </div>
          <div class="card-body">
          <a class="btn btn-danger" href="{{ url('statuspegawai/trash') }}"><i class="fas fa-trash-restore"></i><span> Tong Sampah</span></a><br><br>
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Status Pegawai</th>
                              <th>Kode</th>
                              <th>Edit</th>
                              <th>Hapus</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>Status Pegawai</th>
                              <th>Kode</th>
                              <th>Edit</th>
                              <th>Hapus</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($status as $i)
                          
                          <tr>
                              <td>{{ $count}}</td>
                              <td>{{ $i->status}}</td>
                              <td>{{ $i->kode}}</td>
                              <td><button type="button" class="btn btn-warning" onclick="location.href='{{ url($i->id.'/statuspegawai_edit') }}'"><i class="far fa-edit"></i></button></td>
                              <td><button type="button" class="btn btn-danger" onclick="location.href='{{ url($i->id.'/statuspegawai_hapus') }}'"><i class="far fa-trash-alt"></button></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection --}}
