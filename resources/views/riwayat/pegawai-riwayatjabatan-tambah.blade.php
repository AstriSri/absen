@extends('layouts.masteruser')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                Tambah Data Riwayat Jabatan Pegawai
                <button type="button" class="btn btn-primary float-right mx-1 text-white" onclick="location.href='{{ route('profil') }}'"><i class="fas fa-arrow-left"></i></button>
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('riwayat-jabatan-pegawai.store', ) }}">
                  @csrf
                    <label for="npm">Jabatan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="jabatan" class="form-control show-tick" data-live-search="true">
                        <option>Pilih jabatan</option>
                        @foreach($jabatan as $b)
                        <option value="{{ $b->id}}">{{ $b->jabatan}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="jabatan"/>
                    </div>
                    <label for="npm">Nomor SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="no_sk" class="form-control">
                        <x-validate-error-message name="no_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_sk" class="form-control">
                        <x-validate-error-message name="tanggal_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal Mulai</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_mulai" class="form-control">
                        <x-validate-error-message name="tanggal_mulai"/>
                      </div>
                    </div>
                    <label for="npm">Nama TTD</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="nama_ttd" class="form-control">
                        <x-validate-error-message name="nama_ttd"/>
                      </div>
                    </div>
                    <label for="npm">TMT</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tmt" class="form-control">
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
