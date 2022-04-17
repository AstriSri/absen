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
                  Tong Sampah Data Status Dosen
                  <a class="btn btn-primary mx-1 float-right" href="{{ route('statusdosen.index') }}"><i class="fas fa-arrow-left"></i></a>
              </h2>
          </div>
          <div class="card-body">
         
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Status Dosen</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>Status Dosen</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($statusdosen as $i)
                          <tr>
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->status}}</td>
                              <td>{{ $i->kode}}</td>
                              <td>
                                <form method="POST" action="{{url('admin/statusdosen/'.$i->id.'/restore')}}">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit" class="btn btn-success"><i class="fas fa-history"></i></button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{url('admin/statusdosen/'.$i->id.'/delete_per')}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>    
                            </td>
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
