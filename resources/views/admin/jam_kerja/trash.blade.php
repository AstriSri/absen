@extends('layouts.masteradmin')

@section('page-title')
  <div class="block-header">
    <h2></h2>
  </div>
@endsection

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <a class="btn btn-block btn-danger" href="{{ route('jam-kerja.index') }}"><i class="fas fa-arrow-left"></i><span> Kembali</span></a>
            <div class="card-header">
                <h2>
                    Tong Sampah Data Agama
                </h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Jam Datang</th>
								<th>Jenis Kerja</th>
								<th>jam Pulang</th>
								<th>Edit</th>
								<th>Hapus</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Jam Datang</th>
								<th>Jenis Kerja</th>
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
								<td>{{ $i->jam_datang}}</td>
								<td>{{ $i->jam_pulang}}</td>
                                <td><button type="button" class="btn btn-success" onclick="location.href='{{ url($i->id.'/jam-kerja/restore') }}'"><i class="fas fa-history"></i></button></td>
                                <td><button type="button" class="btn btn-danger" onclick="location.href='{{ url($i->id.'/jam-kerja/delete_per') }}'"><i class="far fa-trash-alt"></i></button></td>
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
