@extends('layouts.masteruser')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header bg-primary">
				<h2 class="text-white">
					Absensi
				</h2>
			</div>
			<div class="card-body">
				<h4 class="card-header bg-white font-weight-bold">
					{{ 	$jenis_kerja = auth()->user()->pegawai->jam_kerja == null ? "Not Set" : 
						(
							auth()->user()->pegawai->jam_kerja->jenis_kerja == "WFH" ? "Work From Home" :
							(
								auth()->user()->pegawai->jam_kerja->jenis_kerja == "WFO" ? "Work From Office" : "Not Set"
							)
						)
					}}
				</h4>
				<div class="row">
					<div class="col-lg-5">
						<div class="card-body">
							<img src=" {{url('background/absensi-animasi.png')}} " alt="" class="w-100">
						</div>
					</div>
					<div class="col-md col-lg-7">
						<div class="form-row mt-3">
							<div class="form-group col">
								<label for="datepicker">Tanggal Presensi</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<button id="tanggal_presensi" type="button" class="input-group-text bg-white" style="cursor:pointer;border:none;" disabled=""><i class="fa fa-calendar fa-fw" aria-hidden="true"></i></button>
									</div>    
									<input type="text" class="form-control bg-white" name="tanggal_presensi" placeholder="Contoh: Monday, 1 January 2021" data-date-format="dd MM yyyy" id="datepicker" disabled="" value="{{ $tanggal }}" style="border:none;">
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col">
								<label for="jadwal_kerja">Jadwal Kerja Pegawai</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<button id="jadwal_kerja" type="button" class="input-group-text bg-white" style="cursor:pointer;border:none;" disabled=""><i class="fas fa-business-time fa-fw" aria-hidden="true"></i></button>
									</div>    
									<input type="text" class="form-control bg-white" name="jadwal_kerja" placeholder="Contoh: 08.00 - 16.00" data-date-format="dd MM yyyy" id="jadwal_kerja" disabled="" value="{{ "$jadwal_datang - $jadwal_pulang WITA" }}" style="border:none;">
									@if (!$absensi)
										<button type="button" class="btn btn-outline-primary w-25" data-toggle="modal" data-target="#ChangeJenisJamKerja">
											Change jam kerja
										</button>
									@endif
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col">
								<label for="check_in">Waktu Datang</label>
								<div class="input-group">    
									<div class="input-group-prepend">
										<button id="check_in" type="button" class="input-group-text bg-white" style="cursor:pointer;border:none;" disabled=""><i class="fas fa-clock fa-fw" aria-hidden="true"></i></button>
									</div>
									<input type="text" class="form-control bg-white" name="check_in" placeholder="Contoh: 08.00" data-date-format="dd MM yyyy" id="check_in" disabled="" value="{{ $absensi->jam_datang ?? "--:--" }}" style="border:none;">
									@if ($absensi)
										@if(!($absensi->jam_pulang))
											<button type="button" class="btn btn-outline-primary w-25" data-toggle="modal" data-target="#PresensiPulang">
												Presensi Pulang
											</button>
										@endif
									@else
										<button type="button" class="btn btn-outline-primary w-25" data-toggle="modal" data-target="#PresensiMasuk">
											Presensi Datang
										</button>
									@endif
								</div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col">
								<label for="total_lph">Total Pekerjaan</label>
								<div class="input-group">    
									<div class="input-group-prepend">
										<button id="total_lph" type="button" class="input-group-text bg-white" style="cursor:pointer;border:none;" disabled=""><i class="fas fa-briefcase fa-fw" aria-hidden="true"></i></button>
									</div>
									<input type="number" class="form-control bg-white" name="total_lph" placeholder="Pekerjaan" data-date-format="dd MM yyyy" id="total_lph" disabled="" value="{{ $kegiatan }}" style="border:none;">
									<button type="button" class="btn btn-outline-primary w-25" onclick="location.href='{{ route('kegiatan.index') }}';">
										Tambah Kegiatan
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="PresensiMasuk" tabindex="-1" role="dialog" aria-labelledby="PresensiMasukLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <form action="{{ route('absensi.store') }}" method="POST">
			  @csrf
			  <div class="modal-header">
				<h5 class="modal-title" id="PresensiMasukLabel">Jenis Jam Kerja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <table class="m-4">
				<tr>
					<td>Jenis Kerja</td>
					<td>:</td>
					<td>{{$jenis_kerja}}</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td>:</td>
					<td>{{$tanggal}}</td>
				</tr>
				<tr>
					@if($jadwal_datang <= \Carbon\Carbon::now()->format('H:i') )
						<td colspan="3"><p class="text-danger text-small">*) Apakah kamu yakin melanjutkan absensi, aksi ini tidak dapat dikembalikan</p></td>
					@elseif($jadwal_pulang <= \Carbon\Carbon::now()->format('H:i'))
						<td colspan="3"><p class="text-danger text-small">*) Anda Alpha karena, sudah melewati waktu pulang kerja</p></td>
					@else
						<td colspan="3"><p class="text-danger text-small">*) Anda hanya bisa Absen pada 1 jam sebelum masuk jam kerja dan setelahnya</p></td>
					@endif
				</tr>
			  </table>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				@if($jadwal_datang <= \Carbon\Carbon::now()->format('H:i') && $jadwal_pulang > \Carbon\Carbon::now()->format('H:i'))
					<button type="submit" class="btn btn-primary">Presensi Sekarang</button>
				@else	
					<div class="btn btn-primary">Presensi Sekarang</div>
				@endif
			  </div>
			  <input type="hidden" name="jam_datang_jadwal" value="{{ $jadwal_datang }}">
			  <input type="hidden" name="jam_pulang_jadwal" value="{{ $jadwal_pulang }}">
		  </form>
	  </div>
	</div>
  </div>
  @isset($absensi)
	<div class="modal fade" id="PresensiPulang" tabindex="-1" role="dialog" aria-labelledby="PresensiPulangLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('absensi.update', $absensi->id) }}" method="POST">
				@csrf
				@method("PUT")
				<div class="modal-header">
				<h5 class="modal-title" id="PresensiMasukLabel">Jenis Jam Kerja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<table class="m-4">
				<tr>
					<td>Jenis Kerja</td>
					<td>:</td>
					<td>{{$jenis_kerja}}</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td>:</td>
					<td>{{$tanggal}}</td>
				</tr>
				<tr>
					<td>Waktu Bekerja</td>
					<td>:</td>
					<td>{{\Carbon\Carbon::now()->diff( $absensi->jam_datang )->format('%H:%i')}}</td>
				</tr>
				<tr>
					<td>Total kegiatan harian</td>
					<td>:</td>
					<td>{{ $kegiatan }}</td>
				</tr>
				<tr>
					@if ($kegiatan)
					<td colspan="3"><p class="text-danger text-small">*) Apakah kamu yakin melanjutkan absensi, aksi ini tidak dapat dikembalikan</p></td>
					@else
					<td colspan="3"><p class="text-danger text-small">*) Anda hanya bisa pulang jika sudah mengisi kegiatan kerja</p></td>
					@endif
				</tr>
				</table>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				@if ($kegiatan)
					<button type="submit" class="btn btn-primary">Presensi Sekarang</button>
				@else
					<div class="btn btn-primary">Presensi Sekarang</div>
				@endif
				</div>
				<input type="hidden" name="jam_datang_jadwal" value="{{ $absensi->jam_datang ?? "--:--" }}">
				<input type="hidden" name="jam_pulang_jadwal" value="{{ $absensi->jam_pulang ?? "--:--" }}">
			</form> 
		</div>
		</div>
	</div>
  @endisset
  <div class="modal fade" id="ChangeJenisJamKerja" tabindex="-1" role="dialog" aria-labelledby="ChangeJenisJamKerjaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <form action="{{ route('user.jam-kerja.update') }}" method="POST">
			  @csrf
			  <div class="modal-header">
				<h5 class="modal-title" id="ChangeJenisJamKerjaLabel">Jenis Jam Kerja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="form-group">
					<select class="form-control" name="jam_kerja" required>
						<option value="" class="text-danger"> --Jam Kerja-- </option>
					{{$id_jam_kerja = auth()->user()->pegawai->jam_kerja == null ? "" :auth()->user()->pegawai->jam_kerja->jam_kerja}}
					@foreach ($jam_kerja as $j)
						<option value="{{ $j->id}}" {{ $j->id == $id_jam_kerja? "selected=selected":"" }}>{{ "[$j->jam_datang - $j->jam_pulang] ($j->jenis_kerja) $j->nama"}}</option>
					@endforeach
				  </select>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
		  </form>
	  </div>
	</div>
  </div>
@endsection
	
