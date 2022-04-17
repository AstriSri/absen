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
					Tambah Kegiatan Harian
				</h2>
			</div>
			<div class="card-body">
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" id="kegiatan.store">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="card-body">
                                <img src=" {{url('background/jadwal-kerja.jpg')}} " alt="" class="w-100">
                            </div>
                        </div>
                        <div class="col-md col-lg-7">
                            <div class="form-row mt-3">
                                <div class="form-group col">
                                    <label for="datepicker">Uraian pekerjaan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="tanggal_presensi" type="button" class="input-group-text bg-white" style="border:none;" disabled=""><i class="fa fa-calendar fa-fw" aria-hidden="true"></i></button>
                                        </div>    
                                        <input type="text" class="form-control bg-white" name="kegiatan" value="{{ $kegiatan->kegiatan}}" id="datepicker">
                                        <x-validate-error-message name="kegiatan"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="jadwal_kerja">Volume</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="jadwal_kerja" type="button" class="input-group-text bg-white" style="border:none;" disabled=""><i class="fas fa-business-time fa-fw" aria-hidden="true"></i></button>
                                        </div>    
                                        <input type="number" class="form-control bg-white" name="volume" value="{{ $kegiatan->volume}}" id="jadwal_kerja">
                                        <x-validate-error-message name="volume"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="check_in">Satuan</label>
                                    <div class="input-group">    
                                        <div class="input-group-prepend">
                                            <button id="check_in" type="button" class="input-group-text bg-white" style="border:none;" disabled=""><i class="fas fa-clock fa-fw" aria-hidden="true"></i></button>
                                        </div>
                                        <input type="text" class="form-control bg-white" name="satuan" value="{{ $kegiatan->satuan}}">
                                        <x-validate-error-message name="satuan"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="total_lph">Output Pekerjaan</label>
                                    <div class="input-group">    
                                        <div class="input-group-prepend">
                                            <button id="total_lph" type="button" class="input-group-text bg-white" style="border:none;" disabled=""><i class="fas fa-briefcase fa-fw" aria-hidden="true"></i></button>
                                        </div>
                                        <input type="text" class="form-control bg-white" name="keluaran" value="{{ $kegiatan->keluaran}}" id="total_lph">
                                        <x-validate-error-message name="keluaran"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-end flex-column">
                            <div type="button" class="btn btn-outline-danger mt-4 w-100" data-toggle="modal" 
                                onclick="event.preventDefault();
                                document.getElementById('kegiatan.delete').submit();">
                                HAPUS
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-end flex-column">
                            <div type="button" class="btn btn-outline-primary mt-4 w-100" data-toggle="modal" 
                                onclick="event.preventDefault();
                                document.getElementById('kegiatan.store').submit();">
                                SIMPAN
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
<form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" id="kegiatan.delete" method="POST">
    @csrf
    @method("DELETE")
</form>
@endsection
	
