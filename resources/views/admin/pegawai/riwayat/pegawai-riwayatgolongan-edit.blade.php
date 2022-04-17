@extends('layouts.masteradmin')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                    <button type="button" class="btn btn-primary float-right mx-1 text-white" onclick="location.href='{{ route('pegawai.show', $pegawai->id) }}'"><i class="fas fa-arrow-left"></i></button>
                      Edit Data Riwayat Golongan
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('pegawai.riwayat-golongan.update', ['pegawai'=>$pegawai->id, 'riwayat_golongan'=> $riwayatgolongan->id]) }}">
                  @csrf
                  @method("PUT")
                    <label for="npm">Golongan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="golongan" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih golongan</option>
                        @foreach($golongan as $b)
                          @if($riwayatgolongan->golongan == $b->id)
                            <option selected value="{{ $b->id}}">{{ $b->golongan}}</option>
                          @else
                            <option value="{{ $b->id}}">{{ $b->golongan}}</option>
                          @endif
                        @endforeach
                      </select>
                      <x-validate-error-message name="golongan"/>
                    </div>
                    <label for="npm">Nomor SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="no_sk" class="form-control" value="{{$riwayatgolongan->no_sk}}">
							          <x-validate-error-message name="no_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal SK</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_sk" class="form-control" value="{{$riwayatgolongan->tanggal_sk->format("Y-m-d")}}">
							          <x-validate-error-message name="tanggal_sk"/>
                      </div>
                    </div>
                    <label for="npm">Tanggal Mulai</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{$riwayatgolongan->tanggal_mulai->format("Y-m-d")}}">
							          <x-validate-error-message name="tanggal_mulai"/>
                      </div>
                    </div>
                    <label for="npm">Nama TTD</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="nama_ttd" class="form-control" value="{{$riwayatgolongan->nama_ttd}}">
							          <x-validate-error-message name="nama_ttd"/>
                      </div>
                    </div>
                    <label for="npm">TMT</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="date" name="tmt" class="form-control" value="{{$riwayatgolongan->tmt->format("Y-m-d")}}">
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
