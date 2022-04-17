
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
@section('page-title')
  <div class="block-header">
    <h2>Sistem Informasi Akademik</h2>
  </div>
@endsection

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="card-header">
                  <h2>
                      Ganti Password
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ url('simpanpassword') }}">
                  @csrf
                  <label for="npm">Password</label>
                  <div class="input-group">
                      <input type="password" name="password" id="password" class="form-control" data-toggle="password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="fa fa-eye"></i>
                        </span>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
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
