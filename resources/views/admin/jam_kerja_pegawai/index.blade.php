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
				<form method="POST" action="{{ route('jam-kerja-pegawai.store') }}">
					@csrf
					<div class="row">
						<div class="form-group col-md-6">
							<label for="npm">pegawai<code><span class="col-red font-bold">*</span></code></label>
							<div class="form-group">
							  <select name="user" id="user" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Pegawai</option>
								@foreach($pegawai as $p)
								<option value="{{ $p->user}}">{{ "[$p->user] $p->namagelar"}}</option>
								@endforeach
							  </select>
							  <x-validate-error-message name="user"/>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="npm">Jam Kerja<code><span class="col-red font-bold">*</span></code></label>
							<div class="form-group">
								<select name="jam_kerja" id="jam_kerja" class="form-control show-tick" data-live-search="true">
									<option value="">Pilih jam Kerja</option>
									@foreach($jam_kerja as $j)
									<option value="{{ $j->id}}">{{ "[$j->jam_datang - $j->jam_pulang] ($j->jenis_kerja) $j->nama"}}</option>
									@endforeach
								</select>
								<x-validate-error-message name="jam_kerja"/>
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
				<a class="btn btn-danger" href="{{ url('jam_kerja_pegawai/trash') }}"><i class="fas fa-trash-restore"></i><span> Tong Sampah</span></a><br><br>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Nama jam kerja</th>
								<th>Jenis Kerja</th>
								<th>Jam Datang</th>
								<th>Jam Pulang</th>
								<th>Edit</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Nama jam kerja</th>
								<th>Jenis Kerja</th>
								<th>Jam Datang</th>
								<th>Jam Pulang</th>
								<th>Edit</th>
								<th>Hapus</th>
							</tr>
						</tfoot>
						<tbody>
							@foreach($jam_kerja_pegawai as $i)
							<tr>
								<td>{{ $loop->iteration}}</td>
								<td>{{ $i->pegawai->namagelar}}</td>
								<td>{{ ($i->Jam_kerja == null) ? "Jam Kerja deleted" : $i->Jam_kerja->nama}}</td>
								<td>{{ $i->jenis_kerja}}</td>
								<td>{{ $i->jam_datang}}</td>
								<td>{{ $i->jam_pulang}}</td>
								<td><button type="button" class="btn btn-warning" onclick="location.href='{{ route('jam-kerja-pegawai.edit', $i->id) }}'"><i class="far fa-edit"> </i></button></td>
								<td>
									<form method="POST" action="{{ route('jam-kerja-pegawai.destroy', $i->id) }}">
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
