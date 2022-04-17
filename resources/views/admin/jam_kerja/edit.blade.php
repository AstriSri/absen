<?php $count = 0; ?>
@extends('layouts.masteradmin')

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
				<form method="POST" action="{{ route('jam-kerja.update', $jam_kerja->id) }}">
					@csrf
					@method("PUT")
					<label for="npm">Nama jam kerja</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="nama" class="form-control" value="{{$jam_kerja->nama}}" required>
							<x-validate-error-message name="nama"/>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<div class="form-line">
									<div class="form-group">
										<label for="jenis_kerja">Jenis Kerja</label>
										<select class="form-control" name="jenis_kerja" id="jenis_kerja">
											<option value="WFO" {{($jam_kerja->jenis_kerja == "WFO")?"selected=selected": ''}}>WFO Work From Office</option>
											<option value="WFH" {{($jam_kerja->jenis_kerja == "WFH")?"selected=selected": ''}}>WFH Work From Home</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<label for="npm">Jam datang</label>
							<div class="form-group">
								<div class="form-line">
									<input type="time" id="" name="jam_datang" class="form-control" value="{{$jam_kerja->jam_datang}}" required>
									<x-validate-error-message name="jam_datang"/>
								</div>
							</div>
						</div>
						<div class="col-4">
							<label for="npm">Jam pulang</label>
							<div class="form-group">
								<div class="form-line">
									<input type="time" id="" name="jam_pulang" class="form-control" value="{{$jam_kerja->jam_pulang}}" required>
									<x-validate-error-message name="jam_pulang"/>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-success m-t-15 waves-effect">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
