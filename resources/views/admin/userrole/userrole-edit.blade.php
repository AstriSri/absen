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
          <a class="btn btn-primary mx-1 float-right" href="{{ route('userrole.index') }}"><i class="fas fa-arrow-left"></i></a>
          Edit Data Role
        </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('userrole.update',$userrole->id) }}">
            @csrf
            @method("PUT")
              <label for="npm">Nama User</label>
              <div class="form-group">
                <select name="username" class="form-control selectpicker" data-live-search="true">
                    <option value="" selected disabled>Pilih User</option>
                    @foreach($user as $item)
                    <option value="{{ $item->username }}" {{ ($item->username == $userrole->username ? "selected" : '') }}>[{{ $item->username }}]{{ $item->name}}</option>
                    @endforeach
                  </select>
                  <x-validate-error-message name="username"/>
              </div>
              <div class="form-group">
                <label for="npm">Nama role</label>
                <select name="kode_role" class="form-control selectpicker" data-live-search="true">
                    <option value="" selected disabled>Pilih Role</option>
                    @foreach($role as $item)
                    <option value="{{ $item->kode_role}}" {{ ($item->kode_role == $userrole->kode_role ? "selected" : '') }}>{{ $item->role}}</option>
                    @endforeach
                  </select>
                  <x-validate-error-message name="kode_role"/>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span> Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
