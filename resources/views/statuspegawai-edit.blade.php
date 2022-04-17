{{-- <?php $count = 0; ?>
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
        <a class="btn btn-block btn-danger text-white" href="{{ url('statuspegawai') }}"><i class="fas fa-arrow-left"></i><span>Kembali</span></a>
        <!-- <form method="GET" action="{{ url('kategori') }}">
          @csrf
          <button type="submit" class="btn btn-block bg-red waves-effect"><i class="material-icons">arrow_back</i><span>Kembali</span></button>
        </form> -->
        <div class="card-header">
            <h2>
                Edit Data Status Pegawai
            </h2>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('statuspegawai.update',$status->id) }}">
            @csrf
              <label for="npm">Nama Status Pegawai</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="status" class="form-control" value="{{$status->status}}" required>
                  </div>
              </div>
              <label for="npm">Kode</label>
              <div class="form-group">
                  <div class="form-line">
                      <input type="text" id="" name="kode" class="form-control" value="{{$status->kode}}" required>
                  </div>
              </div>
              <button type="submit" class="btn btn-success m-t-15 waves-effect"><i class="fas fa-save"></i><span> Simpan Perubahan</span></button>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection --}}
