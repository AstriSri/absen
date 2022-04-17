<?php $count = 0; ?>
@extends('layouts.masteradmin')

@section('content')
@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header">
				<h2>
					Tambah Data
				</h2>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('jam-kerja-pegawai.update', $jam_kerja_pegawai->id) }}">
					@csrf
					@method("PUT")
					<div class="form-group col-md-4">
                        <label for="npm">pegawai<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="user" class="form-control show-tick" data-live-search="true" disabled>
                            <option value="{{ $jam_kerja_pegawai->user}}">{{ "[$jam_kerja_pegawai->user] {$jam_kerja_pegawai->pegawai->namagelar}"}}</option>
                          </select>
                        </div>
                    </div>
					<div class="form-group col-md-4">
                        <label for="npm">Jam Kerja<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="jam_kerja" class="form-control show-tick" data-live-search="true" required>
                            <option value="">Pilih jam Kerja</option>
                            @foreach($jam_kerja as $j)
                            <option value="{{ $j->id}}">{{ "[$j->jam_datang - $j->jam_pulang] $j->nama"}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
					<button type="submit" class="btn btn-success m-t-15 waves-effect">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
