
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
@section('page-title')
  <div class="block-header">
    <h2></h2>
  </div>
@endsection

@section('content')
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <a class="btn btn-block btn-danger text-white" href="{{ url('statusdosen') }}"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
          <div class="card-header">
              <h2>
                  Tong Sampah Data Status Pegawai
              </h2>
          </div>
          <div class="card-body">
          <!-- <a class="btn bg-red waves-effect" href="{{ url('kategori_trash') }}"><i class="material-icons">delete</i><span>Tong Sampah</span></a><br><br> -->
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Status Pegawai</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>Status Pegawai</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($statuspegawai as $i)
                          
                          <tr>
                              <td>{{ $count}}</td>
                              <td>{{ $i->status}}</td>
                              <td>{{ $i->kode}}</td>
                              <td><button type="button" class="btn btn-success" onclick="location.href='{{ url($i->id.'/statuspegawai/restore') }}'"><i class="fas fa-history"></i></button></td>
                              <td><button type="button" class="btn btn-danger" onclick="location.href='{{ url($i->id.'/statuspegawai/delete_per') }}'"><i class="far fa-trash-alt"></i></button></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
