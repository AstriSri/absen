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
                  Tong Sampah Data Dosen
                  <a class="btn btn-primary mx-1 float-right" href="{{ route('dosen.index') }}"><i class="fas fa-arrow-left"></i></a>
              </h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Nama & Gelar</th>
                              <th>Homebase</th>
                              <th>Status Dosen</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th class="text-center">No</th>
                              <th class="text-center">NIK</th>
                              <th class="text-center">Nama</th>
                              <th class="text-center">Nama & Gelar</th>
                              <th class="text-center">Status Kerja</th>
                              <th class="text-center">Status Dosen</th>
                              <th class="text-center">Restore</th>
                              <th class="text-center">Hapus Permanen</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($dosen as $i)
                          <tr>
                              <td class="text-center"	>{{ $loop->iteration}}</td>
                              <td>{{ $i->userz->username}}</td>
                              <td>{{ $i->userz->name}}</td>
                              <td>{{ $i->namagelar}}</td>
                              <td>{{ $i->Homebase->homebase ?? "  "}}</td>
                              <td>{{ $i->Statusdosen->status ?? ""}}</td>
                              <td>
                                <form method="POST" action="{{url('admin/dosen/'.$i->id.'/restore')}}">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit" class="btn btn-success"><i class="fas fa-history"></i></button>
                                </form>
                              </td>
                              <td>
                                <form method="POST" action="{{url('admin/dosen/'.$i->id.'/delete_per')}}">
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
