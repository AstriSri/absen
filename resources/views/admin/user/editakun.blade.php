<?php $count = 0; ?>
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <form method="GET" action="{{ url('') }}" onclick="self.close()">
              @csrf
              <button type="submit" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</button>
            </form>
              <div class="card-header mt-2">
                  <h2>
                      Edit Data Akun
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ url($akun->id.'/updateakun') }}">
                  @csrf
                    <label for="npm">Nama</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="nama" class="form-control" value="{{$akun->name}}" required readonly>
                      </div>
                    </div>
                    <label for="npm">Username</label>
                    <div class="form-group">
                      <div class="form-line">
                        @if(Auth::user()->level == 100)
                        <input type="text" id="" name="username" class="form-control" value="{{$akun->username}}" required>
                        @else
                        <input type="text" id="" name="username" class="form-control" value="{{$akun->username}}" required readonly>
                        @endif
                      </div>
                    </div>
                    <label for="npm">E-mail</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="email" id="" name="email" class="form-control" value="{{$akun->email}}">
                      </div>
                    </div>
                  @if(Auth::user()->level == 100)
                    <label for="npm">Level</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="level" class="form-control" value="{{$akun->level}}" required>
                      </div>
                    </div>
                    <label for="npm">Hak Akses</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="hakakses" class="form-control" value="{{$akun->hak_akses}}">
                      </div>
                    </div>
                  @else
                    <input type="hidden" id="" name="level" class="form-control" value="{{$akun->level}}" required>
                    <input type="hidden" id="" name="hakakses" class="form-control" value="{{$akun->hak_akses}}">
                  @endif
                  <label for="npm">Password</label>
                  <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" data-toggle="password">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="fa fa-eye"></i>
                          </span>
                        </div>
                      </div>
                    <button type="submit" class="btn btn-primary mt-3 waves-effect">Simpan</button>
                </form>
              </div>
          </div>
        </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"

  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"

  crossorigin="anonymous">

</script>
<script  src="{{asset('show-password/bootstrap-show-password.js')}}"></script>
@endsection
