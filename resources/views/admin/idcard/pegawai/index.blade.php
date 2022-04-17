@extends('layouts.masteradmin')

@push('css')
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/datatables/dataTables.checkboxes.css') }}">
@endpush
@section('content')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header">
				<h2 class="">
					Pilih Data Pegawai
				</h2>
			</div>
			<div class="card-body">
				<form id="idcard-form" method="POST" action="{{ route('cetakIdcardPegawai') }}" enctype="multipart/form-data" target="_blank">
					@csrf
				
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover table dataTable js-exportable" id="myTable">
							<thead>
								<tr>
									<th></th>
									<th class="text-center">
										<h6 class="d-inline-block">NIK</h6>	
									</th>
									<th class="text-center">
										<h6 class="d-inline-block">Nama & Gelar</h6>
									</th>
									
									<th class="text-center">
										<h6 class="d-inline-block">Jabatan</h6></th>
									
									<th class="text-center">
										<h6 class="d-inline-block">Divisi</h6></th>
									<th class="text-center">
										<h6 class="d-inline-block">Status Kerja</h6></th>
									<th class="text-center">
										<h6 class="d-inline-block">Status Pegawai</h6></th>
									<th class="text-center">
										<h6>Aksi</h6>
									</th>
								</tr>
							</thead>
							
							<tbody>

								@foreach($pegawai as $i)

								<tr>
									<td>{{$i->id}}</td>
									<td >{{ $i->userz->username}}</td>
									<td >{{ $i->namagelar}}</td>
									<td >{{ $i->Jabatan->jabatan ?? "-"}}</td>
									<td >{{ $i->Divisi->divisi ?? "-"}}</td>
									<td >{{ $i->Statuskerja->status ?? "-"}}</td>
									<td >{{ $i->Statuspegawai->status ?? "-"}}</td>
									<td class="text-center">
										<a href='{{url("admin/pegawai/$i->id/idcard/show")}}' class="btn btn-warning">Lihat</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-6"><p>Selected <span class="total-seledted">0</span></p></div>
						<div class="col-md-6"><button id="btn-submit" class="btn btn-primary float-right" disabled>Cetak</button></div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

@push('script')
	<script src="{{asset('sbadmin/vendor/datatables/dataTables.checkboxes.min.js')}}"></script>
<script>
		$(document).ready(function (){
			var table = $('.dataTable').DataTable({
				'columnDefs': [
					{
						'targets': 0,
						'checkboxes': {
						'selectRow': true
						}
					}
				],
				'select': {
					'style': 'multi'
				},
				'order': [[2, 'asc']]
			});


			// Handle form submission event
			$('#idcard-form').on('submit', function(e){
				var form = this;

				var rows_selected = table.column(0).checkboxes.selected();

				// Iterate over all selected checkboxes
				$("#idcard-form input[name='id[]']").remove();
				$.each(rows_selected, function(index, rowId){
					// Create a hidden element
					$(form).append(
						$('<input>')
							.attr('type', 'hidden')
							.attr('name', 'id[]')
							.val(rowId)
					);
				});
			});

			$("#myTable input[type='checkbox']").on("change", function(){
				var form = this;

				var rows_selected = table.column(0).checkboxes.selected();

				// Iterate over all selected checkboxes
				var t = 0;
				$.each(rows_selected, function(index, rowId){
					t+=1;
				});
				$(".total-seledted").html(t);
				if(t == 0){
					$("#btn-submit").attr('disabled','disabled');
				}else{
					$("#btn-submit").removeAttr('disabled')
				}
			});
		});
	</script>
@endpush
@endsection
