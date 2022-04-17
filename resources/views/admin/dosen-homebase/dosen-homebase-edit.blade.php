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
        <a class="btn btn-block btn-danger" href="{{ route('dosen-homebase.index') }}"><i class="fas fa-arrow-left"></i></a>
        <div class="card-header">
            <h2>
                Edit Data Homebase Dosen
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('dosen-homebase.update',$homebase->id) }}">
            @csrf
            @method("PUT")
            <label for="npm">Nama Homebase</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="homebase" class="form-control" value="{{$homebase->homebase}}" required>
                    <x-validate-error-message name="homebase"/>
                  </div>
            </div>
            <label for="npm">Kode</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="kode" class="form-control" value="{{$homebase->kode}}" required>
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
