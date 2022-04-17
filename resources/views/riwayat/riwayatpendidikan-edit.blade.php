@extends('layouts.masteruser')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="card-header">
                <h2>
                    <button type="button" class="btn btn-primary float-right mx-1 text-white" onclick="location.href='{{ route('profil') }}'"><i class="fas fa-arrow-left"></i></button>
                      Edit Data Riwayat Pendidikan
                  </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('riwayat-pendidikan.update',$riwayatpendidikan->id) }}">
                  @csrf
                  @method('PUT')
                    <label for="npm">Pendidikan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="pendidikan" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih pendidikan</option>
                        @foreach($pendidikan as $b)
                            <option {{$riwayatpendidikan->pendidikan == $b->id? 'selected':''}} value="{{ $b->id}}">{{ $b->pendidikan}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="pendidikan"/>
                    </div>
                    <label for="npm">Tahun Lulus</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="number" name="tahunlulus" class="form-control" value="{{$riwayatpendidikan->tahunlulus}}">
                        <x-validate-error-message name="tahunlulus"/>
                      </div>
                    </div>
                    <label for="npm">Nama Sekolah/Universitas</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="namasekolah" class="form-control" value="{{$riwayatpendidikan->namasekolah}}">
                        <x-validate-error-message name="namasekolah"/>
                      </div>
                    </div>
                    <label for="npm">Nomor Ijazah</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="noijazah" class="form-control" value="{{$riwayatpendidikan->noijazah}}">
                        <x-validate-error-message name="noijazah"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-1 float-right">Simpan</button>
                    <button type="button" class="btn btn-danger m-1 float-right" data-toggle="modal" data-target="#deleteModal" data-action="{{route('riwayat-pendidikan.destroy', $riwayatpendidikan->id)}}">Delete</button>
                  </form>
              </div>
          </div>
        </div>
  </div>
@endsection

