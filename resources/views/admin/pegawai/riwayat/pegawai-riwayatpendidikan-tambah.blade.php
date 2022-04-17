@extends('layouts.masteradmin')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                    <button type="button" class="btn btn-primary float-right mx-1" onclick="location.href='{{ route('pegawai.show',$pegawai->id) }}'"><i class="fas fa-arrow-left"></i></button>
                      Tambah Data Riwayat Pendidikan
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('pegawai.riwayat-pendidikan.store', $pegawai->id) }}">
                  @csrf
                    <label for="npm">Pendidikan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="pendidikan" class="form-control show-tick" data-live-search="true">
                        <option value="null">Pilih pendidikan</option>
                        @foreach($pendidikan as $b)
                        <option value="{{ $b->id}}">{{ $b->pendidikan}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="pendidikan"/>
                    </div>
                    <label for="npm">Tahun Lulus</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="number" name="tahunlulus" class="form-control" >
                          <x-validate-error-message name="tahunlulus"/>
                      </div>
                    </div>
                    <label for="npm">Nama Sekolah/Universitas</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="namasekolah" class="form-control" >
                          <x-validate-error-message name="namasekolah"/>
                      </div>
                    </div>
                    <label for="npm">Nomor Ijazah</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="noijazah" class="form-control" >
                          <x-validate-error-message name="noijazah"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </form>
              </div>
          </div>
        </div>
  </div>
@endsection
