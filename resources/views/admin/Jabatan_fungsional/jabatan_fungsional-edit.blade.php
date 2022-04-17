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
              <a class="btn btn-primary mx-1 float-right" href="{{ route('jabatan-fungsional.index') }}"><i class="fas fa-arrow-left"></i></a>
                Edit Data Jabatan Fungsional
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('jabatan-fungsional.update',$jabatan_fungsional->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Jabatan</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="jabatan" class="form-control" value="{{$jabatan_fungsional->jabatan}}" required>
                      <x-validate-error-message name="jabatan"/>
                    </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="kode" class="form-control" value="{{$jabatan_fungsional->kode}}" required>
                      <x-validate-error-message name="kode"/>
                    </div>
              </div>
              <label for="npm">Keterangan</label>
              <div class="form-group">
                 <div class="form-line">
                    <textarea name="keterangan" maxlength="300" rows="3" class="form-control" placeholder="">{{$jabatan_fungsional->keterangan}}</textarea>
                 </div>
               </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span> Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
