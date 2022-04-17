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
				<form method="POST" action="{{ route('jam-kerja.store') }}">
					@csrf
					<label for="npm">Nama jam kerja</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="nama" class="form-control" value="" required>
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
											<option value="WFO">WFO Work From Office</option>
											<option value="WFH">WFH Work From Home</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-4">
							<label for="npm">Jam datang</label>
							<div class="form-group">
								<div class="form-line">
									<input type="time" name="jam_datang" class="form-control" value="" required>
									<x-validate-error-message name="jam_datang"/>
								</div>
							</div>
						</div>
						<div class="col-4">
							<label for="npm">Jam pulang</label>
							<div class="form-group">
								<div class="form-line">
									<input type="time" name="jam_pulang" class="form-control" value="" required>
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
<div class="row clearfix mt-5">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header">
				<h2>
					Data Jam Kerja
				</h2>
			</div>
			<div class="card-body">
				<a class="btn btn-danger" href="{{ url('jam_kerja/trash') }}"><i class="fas fa-trash-restore"></i><span> Tong Sampah</span></a><br><br>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Jenis Kerja</th>
								<th>jam Datang</th>
								<th>jam Pulang</th>
								<th>Edit</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Jenis Kerja</th>
								<th>jam Datang</th>
								<th>jam Pulang</th>
								<th>Edit</th>
								<th>Hapus</th>
							</tr>
						</tfoot>
						<tbody>
							@foreach($jam_kerja as $i)
							<tr>
								<td>{{ $loop->iteration}}</td>
								<td>{{ $i->nama}}</td>
								<td>{{ $i->jenis_kerja}}</td>
								<td>{{ $i->jam_datang}}</td>
								<td>{{ $i->jam_pulang}}</td>
								<td><button type="button" class="btn btn-warning" onclick="location.href='{{ route('jam-kerja.edit', $i->id) }}'"><i class="far fa-edit"> </i></button></td>
								<td>
									<form method="POST" action="{{ route('jam-kerja.destroy', $i->id) }}">
										@csrf
										@method("DELETE")
										<button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"> </i></button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
