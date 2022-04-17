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
                Edit Data Status Dosen
              <a class="btn btn-danger mx-1 float-right" href="{{ route('statusdosen.index') }}"><i class="fas fa-arrow-left"></i><span> Kembali</span></a>
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('statusdosen.update',$status->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Status Dosen</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="status" class="form-control" value="{{$status->status}}" required>
                      <x-validate-error-message name="status"/>
                  </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="kode" class="form-control" value="{{$status->kode}}" required>
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
