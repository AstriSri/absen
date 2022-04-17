<?php $count = 0; ?>
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
          <div class="card-header">
              <h2 class="text-primary">
                  <a class="btn btn-primary mx-1 float-right" href="{{ route('agama.index') }}"><i class="fas fa-arrow-left"></i><span></span></a>
                  Tong Sampah Data Agama
              </h2>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Agama</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>Agama</th>
                              <th>Kode</th>
                              <th>Restore</th>
                              <th>Hapus Permanen</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($agama as $i)
                          <tr>
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->agama}}</td>
                              <td>{{ $i->kode}}</td>
                              <td>
                                <form method="POST" action="{{url('admin/agama/'.$i->id.'/restore')}}">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit" class="btn btn-success"><i class="fas fa-history"></i></button>
                                </form>
                              </td>
                              <td>
                                <form method="POST" action="{{url('admin/agama/'.$i->id.'/delete_per')}}">
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
