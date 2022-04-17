@extends('layouts.masteruser')

@section('content')
<x-function/>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header bg-primary">
				<h2 class="text-white">
					Laporan
				</h2>
			</div>
			<div class="card-body">
				<div class="border-bottom p-2 bg-white">
					<form action="" method="GET" id="formId">
						<div class="flex row">
							<label class="mx-2 col" style="font-size: 20pt">Tampilkan Bulan :</label>
							<div class="form-group col">
							  <input value="{{$tanggal}}" type="month" name="bulan" onchange="document.getElementById('formId').submit()" class="form-control" placeholder="" aria-describedby="helpId">
							</div>
							{{-- <div class="form-group">
							  <input value="{{$tanggal}}" type="number" min="1990" max="2999" name="bulan" id="" onchange="document.getElementById('formId').submit()" class="form-control" placeholder="" aria-describedby="helpId">
							</div> --}}
						</div>
					</form>
				</div>
				<div class="row seven-cols mt-4">
					@foreach ( daysInMonth( \Carbon\Carbon::parse($tanggal) ) as $item)
					<div class="col-lg-1 p-1">
						<div class="card btn p-1 {{($item->isoFormat('dddd') == "Minggu") || ($item->isoFormat('dddd') == "Sabtu") ? "btn-outline-danger" : ($item->format("Y-m-d") == \Carbon\Carbon::now()->format("Y-m-d") ? "border-success btn-outline-success":"btn-light")}}">
							<div class="card-body border-none">
								@if ($absensi->where("tanggal", $item->format("Y-m-d"))->isEmpty())
									<a style="font-size:12px">
										<i class="fas fa-times-circle text-danger" aria-hidden="true"></i> Alpa
									</a>
								@else
									<a style="font-size:12px">
										<i class="fas fa-check-circle text-success" aria-hidden="true"></i> Hadir
									</a>
								@endif

								<h4 class="card-title m-0" style="font-size:40px">{{ $item->format("d") }}</h4>
								<p class="m-0 text-dark" style="font-size:13px">{{ $item->isoFormat("dddd") }}</p>
								<p class="m-0 text-primary" style="font-size:12px"> Datang
									@if ( $absensi->where("tanggal", $item->format("Y-m-d"))->first() )
										<i class="badge badge-primary">{{ $absensi->where("tanggal", $item->format("Y-m-d"))->first()->jam_datang }}</i>
									@else
										<i class="badge badge-warning">--:--</i>
									@endif
								</p>
								<p class="m-0 text-primary" style="font-size:12px"> Pulang
									@if ($absensi->where("tanggal", $item->format("Y-m-d"))->first() == null)
										<i class="badge badge-warning">--:--</i>
									@elseif($absensi->where("tanggal", $item->format("Y-m-d"))->first()->jam_pulang == null)
										<i class="badge badge-primary">--:--</i>
									@else
										<i class="badge badge-primary">{{ $absensi->where("tanggal", $item->format("Y-m-d"))->first()->jam_pulang }}</i>
									@endif
								</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@push('css')	
<style type="text/css">
	@media (min-width: 768px){
	.seven-cols .col-md-1,
	.seven-cols .col-sm-1,
	.seven-cols .col-lg-1  {
	  width: 100%;
	  *width: 100%;
	  max-width: 14.285714285714285714285714285714%;
	}
  }
  
  @media (min-width: 992px) {
	.seven-cols .col-md-1,
	.seven-cols .col-sm-1,
	.seven-cols .col-lg-1 {
	  width: 14.285714285714285714285714285714%;
	  *width: 14.285714285714285714285714285714%;
	  max-width: 14.285714285714285714285714285714% !important;
  flex:none !important;
	}
  }
   
  @media (min-width: 1200px) {
	.seven-cols .col-md-1,
	.seven-cols .col-sm-1,
	.seven-cols .col-lg-1 {
	  width: 14.285714285714285714285714285714%;
	  *width: 14.285714285714285714285714285714%;
	  max-width: 14.285714285714285714285714285714% !important;
  flex:none !important;
	}
  }
  </style>
  
  
@endpush
