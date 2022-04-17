
@extends('layouts.masteradmin')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                Tambah Data Akun
                <a class="btn btn-danger float-right" href='{{ url('admin/dataakun/cari') }}'><i class="fas fa-arrow-left"></i></a>
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ url('simpanakun') }}">
                  @csrf
                    <label for="npm">Nama</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="nama" class="form-control" value="" required autofocus>
                      </div>
                    </div>
                    <label for="npm">Username</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="username" class="form-control" value="" required>
                      </div>
                    </div>
                    <label for="npm">E-mail</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="email" id="" name="email" class="form-control" value="">
                      </div>
                    </div>
                    <label for="npm">Level</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="level" class="form-control" value="" required>
                      </div>
                    </div>
                    <label for="npm">Hak Akses</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" id="" name="hakakses" class="form-control" value="">
                      </div>
                    </div>
                    <label for="npm">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" data-toggle="password">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="fa fa-eye"></i>
                          </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 ">Simpan</button>
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

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('.form-password').attr('type','text');
            }else{
                $('.form-password').attr('type','password');
            }
        });
    });
</script>
@endsection
