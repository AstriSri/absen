@extends('layouts.masteradmin')

@section('page-title')
  <div class="block-header">
    <h2></h2>
  </div>
@endsection

@section('content')
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="card-header">
              <h2>
                  Tong Sampah Data Pegawai
                  <a class="btn btn-primary mx-1 float-right" href="{{ route('pegawai.index') }}"><i class="fas fa-arrow-left"></i></a>
              </h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Nama & Gelar</th>
                              <th>Status Kerja</th>
                              <th>Status Pegawai</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Nama & Gelar</th>
                              <th>Status Kerja</th>
                              <th>Status Pegawai</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($pegawai as $i)
                          <tr>
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->userz->username}}</td>
                              <td>{{ $i->userz->name}}</td>
                              <td>{{ $i->namagelar}}</td>
                              <td>{{ $i->Statuskerja->status}}</td>
                              <td>{{ $i->Statuspegawai->status}}</td>
                              <td>
                                <form method="POST" action="{{url('admin/pegawai/'.$i->id.'/restore')}}">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit" class="btn btn-success"><i class="fas fa-history"></i></button>
                                </form>
                              </td>
                              <td>
                                <form method="POST" action="{{url('admin/pegawai/'.$i->id.'/delete_per')}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                              <td>
                              
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
