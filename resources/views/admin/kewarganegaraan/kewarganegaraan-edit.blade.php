<?php $count = 0; ?>
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
                Edit Data Kewarganegaraan
               <a class="btn btn-block bg-primary mx-1 float-right" href="{{ route('kewarganegaraan.index') }}"><i class="fas fa-arrow-left"></i></a>
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('kewarganegaraan.update', $kewarganegaraan->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Kewarganegaraan</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="kewarganegaraan" class="form-control" value="{{$kewarganegaraan->kewarganegaraan}}" required>
                      <x-validate-error-message name="kewarganegaraan"/>
                    </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="kode" class="form-control" value="{{$kewarganegaraan->kode}}" required>
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
