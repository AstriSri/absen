@extends('layouts.masteradmin')

@section('content')
<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="card-header">
              <h2>
                <button type="button" class="btn btn-primary mx-1 float-right text-white" onclick="location.href='{{ route('pegawai.show', $pegawai->id) }}'"><i class="fas fa-arrow-left"></i></button>
                  Tambah Data Dokumen
              </h2>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('pegawai.dokumen.store', $pegawai->id) }}" enctype="multipart/form-data">
                  @csrf
                    <label for="npm">Jenis Dokumen</label>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" name="jenisdok" class="form-control" required>
                        <x-validate-error-message name="jenisdok"/>
                      </div>
                    </div>
                    <label for="npm">Dokumen</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Choose file</span>
                      </div>
                      <div class="custom-file">
                        <input type="file" name="dokumen" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Ukuran file maksimal 500KB</label>
                      </div>
                    </div>
                    <x-validate-error-message name="dokumen"/>
                    <label for="npm">Keterangan</label>
                    <div class="form-group">
                      <div class="form-line">
                      <textarea name="keterangan" rows="3" class="form-control no-resize"></textarea>
                        <x-validate-error-message name="keterangan"/>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                </form>
              </div>
          </div>
        </div>
  </div>
@endsection
