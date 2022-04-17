
@extends('layouts.masteradmin')

@push('css')
	<style>
    .dropdown-menu{
		max-height: 480px;
		overflow: auto;
	}
	.table-responsive{
		min-height: 500px;
	}
	.full_screen {
		width: 100%;
		position: fixed;
		height: 100%;
		top: 0;
		left: 0;
		z-index: 100;
	}
	</style>
@endpush
@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card card-fullscreen">
			<div class="card-header">
				<h2 class="">
					Data dosen
					<a class="btn btn-danger mx-1 float-right" href="{{ url('admin/trash/dosen/index') }}"><i class="fas fa-trash-restore"></i></a>
					<button type="button" class="btn btn-primary mx-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></button>
					<button type="button" class="btn btn-secondary mx-1 float-right fullscreen"><i class="fas fa-expand"></i></button>
				</h2>
			</div>
			<div class="card-body">
					{{-- <form method="POST" action="{{ route('admin.search.nama.dosen') }}" id="search">
						@csrf
						<div class="input-group w-25 float-right py-2">
							<input name="q" class="form-control" required type="text" id="inputName" onkeyup="myFunction()" placeholder="Cari Nama ..." title="Type in a name">
							<div class="input-group-append">
								<span class="input-group-text btn btn-primary" onclick="document.getElementById('search').submit()">
								<i class="fa fa-search"></i>
								</span>
							</div>

						</div> --}}
						{{-- @isset($query)
							<div class="float-left">
								<h5>Mencari nama dengan Kata kunci :<span class="font-weight-bold">{{' ❝'.$query.'❞'}}</span></h5>
								<p>Ditemukan {{$dosen->count()}} dari {{$total}} <a href="{{route('dosen.index')}}">Lihat semua</a></p>
							</div>
						@endisset --}}
						@isset($filter)
							<div class="float-left">
								<h5>Filter Kolom dengan Kolom :<span class="font-weight-bold">{{' ❝'.$filter.'❞'}}</span></h5>
								<p>Ditemukan {{$dosen->count()}} dari {{$total}} <a href="{{route('dosen.index')}}">Lihat semua</a></p>
							</div>
						@endisset
					{{-- </form> --}}
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center ">
									<h6 class="d-inline-block">No</h6>
								</th>
								<th class="text-center ">
									<h6 class="d-inline-block">NIK</h6></th>
								<th class="text-center ">
									<h6 class="d-inline-block">NIDN</h6></th>
								<th class="text-center ">
									<h6 class="d-inline-block">Nama</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Nama & Gelar</h6></th>
								<th  class="text-center">
									<h6 class="d-inline-block">Jabatan Fungsional</h6>
								</th>
								<th>
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Homebase</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  <span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
											  @foreach ($homebase as $d)
												<a class="dropdown-item" href="{{ route('admin.filter.column.dosen', ['id' => $d->id, 'column' => 'homebase']) }}">{{$d->homebase}}</a>
											  @endforeach
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item" href="{{ route('dosen.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								
								<th class="text-center">
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Status Dosen</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  <span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
											  @foreach ($statusdosen as $d)
												<a class="dropdown-item" href="{{ route('admin.filter.column.dosen', ['id' => $d->id, 'column' => 'statusdosen']) }}">{{$d->status}}</a>
											  @endforeach
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item" href="{{ route('dosen.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								<th class="text-center ">
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Status Aktif</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  <span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
											  @foreach ($statusaktifdosen as $d)
												<a class="dropdown-item" href="{{ route('admin.filter.column.dosen', ['id' => $d->id, 'column' => 'statusaktifdosen']) }}">{{$d->status}}</a>
											  @endforeach
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item" href="{{ route('dosen.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								<th class="text-center">
									<h6 class="d-inline-block">Aksi</h6></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th class="text-center">
									No</th>
								<th class="text-center">
									NIK</th>
								<th class="text-center">
									NIDN</th>
								<th class="text-center">
									Nama</th>
								<th class="text-center">
									Nama & Gelar</th>
								<th class="text-center">
									Jabatan Fungsional</th>
								<th class="text-center">
									Homebase</th>
								<th class="text-center">
									Status</th>
								<th class="text-center">
									Status Aktif</th>
								<th class="text-center">
									Aksi</th>
							</tr>
						</tfoot>
						<tbody>
							@foreach($dosen as $i)
							
							<tr>
								<td class="text-center">{{ $loop->iteration}}</td>
								<td >{{ $i->userz->username}}</td>
								<td >{{ $i->nidn}}</td>
								<td >{{ $i->userz->name}}</td>
								<td >{{ $i->namagelar}}</td>
								<td >{{ $i->Jabatan_fungsional->jabatan ?? "-"}}</td>
								<td >{{ $i->Homebase->homebase ?? "-"}}</td>
								<td >{{ $i->Statusdosen->status ?? "-"}}</td>
								<td >{{ $i->Statusaktifdosen->status ?? "-"}}</td>
								<td class="text-center">
									<div class="btn-group dropleft">
										<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  Aksi
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="{{ route('dosen.show', $i->id) }}">
												<i class="fas fa-address-book btn btn-success"></i> Detail
											</a>
											<button type="button" class="dropdown-item editModal" value="{{$i->id}}" data-toggle="modal" data-target="#addModal2">
												<i class="fas fa-edit btn btn-warning"></i> Edit
											</button>
											<form method="POST" action="{{ route('dosen.destroy', $i->id) }}">
												@csrf
												@method("DELETE")
												<button class="dropdown-item">
													<i class="fas fa-trash btn btn-danger"></i> Hapus
												</button>
											</form>
										</div>
									</div>
									
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

<div class="modal fade bd-example-modal-lg" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="addModal2Label" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="addModal2Label">edit dosen</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form method="POST" action="" id="editFormDosen">
				<div class="modal-body">
					@csrf
					@method("put")
					<label for="npm">Data Akun</label>
					<div class="row">
						<div class="form-group col-6">
							<label for="npm">Nomor Induk Karyawan (NIK)</label>
							<div class="form-line">
								<input type="text" name="username" id="inp-username" class="form-control"  required autofocus>
								<x-validate-error-message name="username"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Nama</label>
							<div class="form-line">
								<input type="text" name="nama" id="inp-nama" class="form-control"  required>
								<x-validate-error-message name="nama"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">E-mail</label>
							<div class="form-line">
								<input type="email" name="email" id="inp-email" class="form-control" >
								<x-validate-error-message name="email"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Password Baru</label>
							<div class="input-group">
								<input type="password" name="password" class="form-control" data-toggle="password">
								<div class="input-group-append">
								<span class="input-group-text">
									<i class="fa fa-eye"></i>
								</span>
								</div>
							</div>
							<x-validate-error-message name="password"/>
						</div>
					</div>
					<hr>
					<label for="npm">Data Akun</label>
					<div class="row">
						<div class="form-group col-6">
							<label for="npm">NIDN</label>
							<div class="form-line">
								<input type="text" name="nidn" id="inp-nidn" class="form-control"  required autofocus>
								<x-validate-error-message name="nidn"/>
							</div>
						</div>
						
						<div class="form-group col-6">
							<label for="npm">Nama & Gelar</label>
							<div class="form-line">
								<input type="text" name="namagelar" id="inp-namagelar" class="form-control"  required>
								<x-validate-error-message name="namagelar"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Home Base</label>
							<select name="homebase" id="inp-homebase" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Homebase</option>
								@foreach($homebase as $b)
								<option value="{{ $b->id}}">{{ $b->homebase}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group col-6">
							<label for="npm">Status dosen</label>
							<select name="statusdosen" id="inp-statusdosen" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status dosen</option>
								@foreach($statusdosen as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statusdosen"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Jabatan Fungsional</label>
							<select name="jabatan" id="inp-jabatan" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Jabatan Fungsional</option>
								@foreach($jabatan_fungsional as $b)
								<option value="{{ $b->id}}">{{ $b->jabatan}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status Aktif dosen</label>
							<select name="statusaktifdosen" id="inp-statusaktifdosen" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status aktif dosen</option>
								@foreach($statusaktifdosen as $b)
									<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statusaktifdosen"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="addModalLabel">Tambah dosen</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form method="POST" action="{{ route('dosen.store') }}">
				<div class="modal-body">
					@csrf
					<label for="npm">Data Akun</label>
					<div class="row">
						<div class="form-group col-6">
							<label for="npm">Nomor Induk Karyawan (NIK)</label>
							<div class="form-line">
								<input type="text" name="username" class="form-control"  required autofocus>
								<x-validate-error-message name="username"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Nama</label>
							<div class="form-line">
								<input type="text" name="nama" class="form-control"  required>
								<x-validate-error-message name="nama"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">E-mail</label>
							<div class="form-line">
								<input type="email" name="email" class="form-control" >
								<x-validate-error-message name="email"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Password</label>
							<div class="input-group">
								<input type="password" name="password" class="form-control" data-toggle="password">
								<div class="input-group-append">
								<span class="input-group-text">
									<i class="fa fa-eye"></i>
								</span>
								</div>
							</div>
							<x-validate-error-message name="password"/>
						</div>
					</div>
					<hr>
					<label for="npm">Data Dosen</label>
					<div class="row">
						<div class="form-group col-6">
							<label for="npm">NIDN</label>
							<div class="form-line">
								<input type="text" name="nidn" class="form-control"  required autofocus>
								<x-validate-error-message name="nidn"/>
							</div>
						</div>
						<div class="form-group col-6">
							<label for="npm">Nama & Gelar</label>
							<div class="form-line">
								<input type="text" name="namagelar" class="form-control"  required>
								<x-validate-error-message name="namagelar"/>
							</div>
						</div>
						
						<div class="form-group col-6">
							<label for="npm">Home Base</label>
							<select name="homebase" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Homebase</option>
								@foreach($homebase as $b)
								<option value="{{ $b->id}}">{{ $b->homebase}}</option>
								@endforeach
							</select>
                            <x-validate-error-message name="homebase"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status dosen</label>
							<select name="statusdosen" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status dosen</option>
								@foreach($statusdosen as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statusdosen"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Jabatan Fungsional</label>
							<select name="jabatan" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Jabatan Fungsional</option>
								@foreach($jabatan_fungsional as $b)
								<option value="{{ $b->id}}">{{ $b->jabatan}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="jabatan"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status Aktif dosen</label>
							<select name="statusaktifdosen" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status aktif dosen</option>
								@foreach($statusaktifdosen as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statusaktifdosen"/>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@push('script')
	<script>

		$(document).on("click", ".editModal", function()
        {
            let id = $(this).val();
            $.ajax({
                method: "get",
                url :  `{{route('dosen.index')}}`+`/${id}/edit`,
            }).done(function(response)
            {
				console.log(response);
                $("#inp-username").val(response.userz.username);
                $("#inp-nama").val(response.userz.name);
                $("#inp-namagelar").val(response.namagelar);
                $("#inp-email").val(response.userz.email);
                $("#inp-password").val(response.userz.password);
                $("#inp-nidn").val(response.nidn);
							
				$(`#inp-homebase option[value="${response.homebase}"]`).attr('selected', 'selected');
				$(`#inp-statusdosen option[value="${response.statusdosen}"]`).attr('selected', 'selected');
				$(`#inp-jabatan option[value="${response.jabatan_fungsional}"]`).attr('selected', 'selected');
				$(`#inp-statusaktifdosen option[value="${response.statusaktifdosen}"]`).attr('selected', 'selected');
                $("#divisi-option").append(`<option selected value="${response.divisi}">${response.divisi}</option>`);

                $("#editFormDosen").attr("action", "{{route('dosen.store')}}"+`/${id}`)
            });
        });
		$(document).ready( function () {
			$('.dataTable').DataTable({
			});
		} );
		let clicked = true;
        $(".fullscreen").on("click", function(){
			let media_card = $(".card-fullscreen");
            if (clicked) {
                media_card.addClass("full_screen");
				$(this).children().first().removeClass("fa-expand");
				$(this).children().first().addClass("fa-compress");
            } else {
				media_card.removeClass("full_screen");
				$(this).children().first().removeClass("fa-compress");
				$(this).children().first().addClass("fa-expand");
            }
            clicked = !clicked;
		});
	</script>
	{{-- <script src="{{asset('sbadmin/vendor/jquery/jquery.slim.min.js')}}"></script> --}}
	<script src="{{asset('show-password/bootstrap-show-password.js')}}"></script>
@endpush
@endsection
