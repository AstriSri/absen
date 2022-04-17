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
          <a class="btn btn-primary mx-1 float-right" href="{{ route('role.index') }}"><i class="fas fa-arrow-left"></i></a>
          Edit Data Role
        </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('role.update',$role->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama Role</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="role" class="form-control" value="{{$role->role}}" required>
								      <x-validate-error-message name="role"/>
                  </div>
              </div>
              <label for="npm">Kode Role</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" name="kode_role" class="form-control" value="{{$role->kode_role}}" required>
								      <x-validate-error-message name="kode_role"/>
                    </div>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span> Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
