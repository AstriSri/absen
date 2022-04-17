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
          <a class="btn mx-1 btn-primary float-right" href="{{ route('divisi.index') }}"><i class="fas fa-arrow-left"></i><span></span></a>
            Edit Data Divisi
        </h2>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('divisi.update',$divisi->id) }}">
          @csrf
          @method("PUT")
            <label for="npm">Nama Divisi</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="" name="divisi" class="form-control" value="{{$divisi->divisi}}" required>
                    <x-validate-error-message name="divisi"/>
                </div>                            
            </div>
            <label for="npm">Kode</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="text" id="" name="kode" class="form-control" value="{{$divisi->kode}}" required>
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
