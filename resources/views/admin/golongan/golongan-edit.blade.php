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
            <a class="btn btn-primary float-right mx-1" href="{{ route('golongan.index') }}"><i class="fas fa-arrow-left"></i></a>
            Edit Data Golongan
          </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('golongan.update',$golongan->id) }}">
            @csrf
            @method("PUT")
            <label for="npm">Nama Golongan</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" name="golongan" class="form-control" value="{{$golongan->golongan}}" required>
                <x-validate-error-message name="golongan"/>
              </div>
            </div>
            <label for="npm">Kode</label>
            <div class="form-group">
              <div class="form-line">
                <input type="text" name="kode" class="form-control" value="{{$golongan->kode}}" required>
                <x-validate-error-message name="kode"/>
              </div>
            </div>
            <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span>Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
