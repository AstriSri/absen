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
          <a class="btn btn-primary float-right mx-1" href="{{ route('goldar.index') }}"><i class="fas fa-arrow-left"></i></a>
            Edit Data Golongan Darah
        </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('goldar.update', $goldar->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Golongan Darah</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="goldar" class="form-control" value="{{$goldar->goldar}}" required>
                      <x-validate-error-message name="goldar"/>
                    </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="kode" class="form-control" value="{{$goldar->kode}}" required>
                      <x-validate-error-message name="kode"/>
                    </div>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">save</i><span>Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
