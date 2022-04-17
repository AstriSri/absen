@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                    <button type="button" class="btn btn-primary mx-1 float-right" onclick="location.href='{{ route('dosen.show', $dosen->id) }}'"><i class="fas fa-arrow-left"></i></button>
                      Tambah Data Riwayat Golongan
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('dosen.riwayat-golongan.store', $dosen->id) }}">
                  @csrf
                    <label for="npm">Golongan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="golongan" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih golongan</option>
                        @foreach($golongan as $b)
                          <option value="{{ $b->id}}">{{ $b->golongan}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="golongan"/>
                    </div>
                    <label for="npm">Nomor SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="no_sk" class="form-control" value="">
                        <x-validate-error-message name="no_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_sk" class="form-control" value="">
                        <x-validate-error-message name="tanggal_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal Mulai</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_mulai" class="form-control" value="">
                        <x-validate-error-message name="tanggal_mulai"/>
                      </div>
                    </div>
                    <label for="npm">Nama TTD</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="nama_ttd" class="form-control" value="">
                        <x-validate-error-message name="nama_ttd"/>
                      </div>
                    </div>
                    <label for="npm">TMT</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tmt" class="form-control" value="">
                        <x-validate-error-message name="tmt"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </form>
              </div>
          </div>
        </div>
  </div>
@endsection

@section('js')
@endsection
