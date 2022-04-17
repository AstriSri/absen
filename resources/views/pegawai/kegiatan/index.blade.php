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
					Kegiatan Kerja Harian
				</h2>
			</div>
			<div class="card-body" style="min-height: 50vh">
                @foreach ($kegiatan as $k)
                    <button class="card w-100 mb-3 " onclick="location.href='{{ route('kegiatan.edit',$k->id) }}';" >
                        <div class="border-bottom w-100 text-uppercase font-weight-bold">
                            {{ $k->kegiatan }}
                        </div>
                        <div class="card-body row w-100 ml-1 text-left">
                            <div class="col">
                                <h5 class="card-title text-primary text-uppercase text-bold">Volume</h5>
                                <p class="card-text ">{{ $k->volume }}</p>
                                <h5 class="card-title text-primary text-uppercase text-bold" >Output Pekerjaan</h5>
                                <p class="card-text ">{{ $k->keluaran }}</p>
                            </div>
                            <div class="col">
                                <h5 class="card-title text-primary text-uppercase text-bold">Satuan</h5>
                                <p class="card-text">{{ $k->satuan }}</p>
                            </div>
                        </div>
                    </button>
                @endforeach
                @if ($kegiatan->isEmpty())
                    
                <button class="card w-100 mb-3 " onclick="location.href='{{ route('kegiatan.create') }}';" >
                    <div class="border-bottom w-100 text-uppercase font-weight-bold">
                        {{ 'Anda belum memiliki kagiatan' }}
                    </div>
                    <div class="card-body row w-100 ml-1 text-left">
                        <div class="col">
                            <h5 class="card-title text-primary text-uppercase text-bold text-center">Tambah Kegiatan </h5>
                        </div>
                    </div>
                </button>
                @else
                <a href="{{ route('kegiatan.create') }}" class="rounded-sm px-2 btn btn-primary w-100">Tambah Kegiatan</a>
                    
                @endif
			</div>
		</div>
	</div>
</div>
@endsection