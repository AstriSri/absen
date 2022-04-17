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
					Data Pegawai
					<a class="btn btn-danger mx-1 float-right" href="{{ url('admin/trash/pegawai/index') }}"><i class="fas fa-trash-restore"></i></a>
					<button type="button" class="btn btn-primary mx-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></button>
					<button type="button" class="btn btn-secondary mx-1 float-right fullscreen"><i class="fas fa-expand"></i></button>
				</h2>
			</div>
			<div class="card-body">
					@isset($filter)
						<div class="float-left">
							<h5>Filter Kolom dengan Kolom :<span class="font-weight-bold">{{' ❝'.$filter.'❞'}}</span></h5>
							<p>Ditemukan {{$pegawai->count()}} dari {{$total}} <a href="{{route('pegawai.index')}}">Lihat semua</a></p>
						</div>
					@endisset
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover table dataTable js-exportable" id="myTable">
						<thead>
							<tr>
								<th class="text-center"	>
									<h6 class="d-inline-block">No</h6>
								</th>
								<th class="text-center">
									<h6 class="d-inline-block">NIK</h6>	
								</th>
								<th class="text-center">
									<h6 class="d-inline-block">Nama</h6>
								</th>
								<th class="text-center">
									<h6 class="d-inline-block">Nama & Gelar</h6>
								</th>
								
								<th class="text-center">
									<h6 class="d-inline-block">Jabatan</h6></th>
								<th>
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Divisi</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  <span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
											  @foreach ($divisi as $d)
												<a class="dropdown-item" href="{{ route('admin.filter.column.pegawai', ['id' => $d->id, 'column' => 'divisi']) }}">{{$d->divisi}}</a>
											  @endforeach
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item" href="{{ route('pegawai.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								<th>
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Status Kerja</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												  <span class="sr-only"></span>
											</button>
											<div class="dropdown-menu">
												  @foreach ($statuskerja as $sk)
												<a class="dropdown-item" href="{{ route('admin.filter.column.pegawai', ['id' => $sk->id, 'column' => 'statuskerja']) }}">{{$sk->status}}</a>
												  @endforeach
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="{{ route('pegawai.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								<th>
									<div class="text-center">
										<div class="row">
											<h6 type="button" class="d-inline-block col-10">Status Pegawai</h6>
											<button type="button" class="btn p-0 dropdown-toggle dropdown-toggle-split col-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="sr-only"></span>
											</button>
											<div class="dropdown-menu">
											@foreach ($statuspegawai as $sp)
												<a class="dropdown-item" href="{{ route('admin.filter.column.pegawai', ['id' => $sp->id, 'column' => 'statuspegawai']) }}">{{$sp->status}}</a>
												
											@endforeach
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{ route('pegawai.index') }}">Semua</a>
											</div>
										</div>
									</div>
								</th>
								<th class="text-center">
									<h6>Aksi</h6>
								</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th class="text-center">
									<h6 class="d-inline-block">No</h6>.</th>
								<th class="text-center">
									<h6 class="d-inline-block">NIK</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Nama</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Nama & Gelar</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Jabatan</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Divisi</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Status Kerja</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Status Pegawai</h6></th>
								<th class="text-center">
									<h6 class="d-inline-block">Detail</h6></th>
							</tr>
						</tfoot>
						<tbody>

							@foreach($pegawai as $i)

							<tr>
								<td class="text-center">{{ $loop->iteration}}</td>
								<td >{{ $i->userz->username}}</td>
								<td >{{ $i->userz->name}}</td>
								<td >{{ $i->namagelar}}</td>
								<td >{{ $i->Jabatan->jabatan ?? "-"}}</td>
								<td >{{ $i->Divisi->divisi ?? "-"}}</td>
								<td >{{ $i->Statuskerja->status ?? "-"}}</td>
								<td >{{ $i->Statuspegawai->status ?? "-"}}</td>
								<td class="text-center">
									<div class="btn-group dropleft">
										<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										  Aksi
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="{{ route('pegawai.show', $i->id) }}">
												<i class="fas fa-address-book btn btn-success"></i> Detail
											</a>
											<button type="button" class="dropdown-item editModal" value="{{$i->id}}" data-toggle="modal" data-target="#editModal">
												<i class="fas fa-edit btn btn-warning"></i> Edit
											</button>
											<form method="POST" action="{{ route('pegawai.destroy', $i->id) }}">
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

<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="editModalLabel">Edit Pegawai</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form method="POST" action="" id="editFormPegawai">
				<div class="modal-body">
					@csrf
					@method("PUT")
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
							<label for="npm">Nama & Gelar</label>
							<div class="form-line">
								<input type="text" name="namagelar" id="inp-namagelar" class="form-control"  required>
								<x-validate-error-message name="namagelar"/>
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
							<label for="npm">Divisi</label>
							<select name="divisi" id="inp-divisi" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih divisi</option>
								@foreach($divisi as $b)
								<option class="divisi-option" value="{{ $b->id}}">{{ $b->divisi}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="divisi"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status Kerja</label>
							<select name="statuskerja" id="inp-statuskerja" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status kerja</option>
								@foreach($statuskerja as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statuskerja"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status Pegawai</label>
							<select name="statuspegawai" id="inp-statuspegawai" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status pegawai</option>
								@foreach($statuspegawai as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statuspegawai"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Jabatan</label>
							<select name="jabatan" id="inp-jabatan" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Jabatan</option>
								@foreach($jabatan as $b)
								<option value="{{ $b->id}}">{{ $b->jabatan}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="jabatan"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">New Password</label>
							<div class="input-group">
								<input type="password" name="password" id="inp-password" class="form-control" data-toggle="password">
								<div class="input-group-append">
								<span class="input-group-text">
									<i class="fa fa-eye"></i>
								</span>
								</div>
							</div>
							<x-validate-error-message name="password"/>
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
			<h5 class="modal-title" id="addModalLabel">Tambah Pegawai</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form method="POST" action="{{ route('pegawai.store') }}">
				<div class="modal-body">
					@csrf
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
						<label for="npm">Nama & Gelar</label>
						<div class="form-line">
							<input type="text" name="namagelar" class="form-control"  required>
							<x-validate-error-message name="namagelar"/>
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
						<label for="npm">Divisi</label>
						<select name="divisi" class="form-control show-tick" data-live-search="true">
							<option value="">Pilih divisi</option>
							@foreach($divisi as $b)
							<option value="{{ $b->id}}">{{ $b->divisi}}</option>
							@endforeach
						</select>
							<x-validate-error-message name="divisi"/>
						</div>
						<div class="form-group col-6">
						<label for="npm">Status Kerja</label>
						<select name="statuskerja" class="form-control show-tick" data-live-search="true">
							<option value="">Pilih status kerja</option>
							@foreach($statuskerja as $b)
							<option value="{{ $b->id}}">{{ $b->status}}</option>
							@endforeach
						</select>
						</div>
						<div class="form-group col-6">
							<label for="npm">Status Pegawai</label>
							<select name="statuspegawai" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih status pegawai</option>
								@foreach($statuspegawai as $b)
								<option value="{{ $b->id}}">{{ $b->status}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="statuspegawai"/>
						</div>
						<div class="form-group col-6">
							<label for="npm">Jabatan</label>
							<select name="jabatan" id="inp-jabatan" class="form-control show-tick" data-live-search="true">
								<option value="">Pilih Jabatan</option>
								@foreach($jabatan as $b)
								<option value="{{ $b->id}}">{{ $b->jabatan}}</option>
								@endforeach
							</select>
							<x-validate-error-message name="jabatan"/>
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
		function myFunction() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("inputName");
			filter = input.value.toUpperCase();
			table = document.getElementById("myTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[3];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}       
			}
		}
		$(document).on("click", ".editModal", function()
        {
            let id = $(this).val();
            $.ajax({
                method: "get",
                url :  `{{route('pegawai.index')}}`+`/${id}/edit`,
            }).done(function(response)
            {
				console.log(response);
                $("#inp-username").val(response.userz.username);
                $("#inp-nama").val(response.userz.name);
                $("#inp-namagelar").val(response.namagelar);
                $("#inp-email").val(response.userz.email);
                $("#inp-password").val(response.userz.password);
							
				$(`#inp-divisi option[value="${response.divisi}"]`).attr('selected', 'selected');
				$(`#inp-statuskerja option[value="${response.statuskerja}"]`).attr('selected', 'selected');
				$(`#inp-statuspegawai option[value="${response.statuspegawai}"]`).attr('selected', 'selected');
				$(`#inp-jabatan option[value="${response.jabatan}"]`).attr('selected', 'selected');

                $("#editFormPegawai").attr("action", "{{route('pegawai.store')}}"+`/${id}`)
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
