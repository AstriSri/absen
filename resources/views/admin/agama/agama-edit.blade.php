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
        <h2>
          <a class="btn btn-primary mx-1 float-right" href="{{ route('agama.index') }}"><i class="fas fa-arrow-left"></i></a>
          Edit Data Agama
        </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('agama.update',$agama->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Agama</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="agama" class="form-control" value="{{$agama->agama}}" required>
								      <x-validate-error-message name="agama"/>
                  </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="kode" class="form-control" value="{{$agama->kode}}" required>
								      <x-validate-error-message name="kode"/>
                    </div>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span> Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
