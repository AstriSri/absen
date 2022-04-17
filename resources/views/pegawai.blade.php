{{-- <?php $count = 0; ?>
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

@section('content')
<div class="row">
 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       
          <div class="card">
            <div class="card-header">
                <h2 class="text-center mt-3">
                    Data Pegawai
                </h2>
            </div>
            <div class="card-body">
              <div class="row">
                
                <div class="col-6" >
                  <div class="form-row align-items-center">
                    <div class="form-group col-md-8">
                      <form method="POST" action="{{ url('/pegawai_cari') }}">
                        @csrf
                      <input type="text" id="" name="nama" class="form-control" value="" autofocus placeholder="Nama">
                    </div>
                    <div class="form-group col-md-2">
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                    </div>
                  </div>
                  
                </div>
                
                <div class="col-6">
                  
                  <div class="form-row align-items-center">
                    <div class="form-group col-md-8">
                     
                      <select name="divisi" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih divisi</option>
                        @foreach($divisi as $b)
                          <option value="{{ $b->id}}">{{ $b->divisi}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-2 ">
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                    </div>
                  </form>
                  </div>
                 
                </div>
              </div>
              <div class="row">
                <div class="col-6" >
                  <div class="form-row align-items-center">
                    <div class="form-group col-md-8">
                      <form method="POST" action="{{ url('/pegawai_cari') }}">
                        @csrf
                      <select name="statuskerja" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih status kerja</option>
                        @foreach($statuskerja as $b)
                          <option value="{{ $b->id}}">{{ $b->status}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                    </div>
                  </div>
                  
                </div>
                @if(Auth::user()->level == 100)
                <div class="col-6">
                  
                  <div class="form-row align-items-center">
                    <div class="form-group col-md-8">
                     
                      <select name="statuspegawai" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih status pegawai</option>
                        @foreach($statuspegawai as $b)
                          <option value="{{ $b->id}}">{{ $b->status}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-2 ">
                      <button type="submit" class="btn btn-primary m-t-15 waves-effect">Cari</button>
                    </div>
                  </form>
                  </div>
                 
                </div>
                @endif
              </div>
              
              <div class="text-center mt-5">
                @if(Auth::user()->level == 100)
                  <button type="button" class="btn btn-success" onclick="location.href='{{ url('pegawai_add') }}'"><i class="fas fa-plus-circle"></i><span> Tambah Pegawai</span></button>
                @endif
                <button type="button" class="btn btn-warning" onclick="location.href='{{ url('pegawai_list') }}'"><i class="far fa-eye"></i><span> Tampilkan Semua Pegawai</span></button>
              </div>
              
            </div>
          </div>
        
      </div>
          
</div>

@if($cari == 1)
<div class="row mt-5">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <button type="button" class="btn btn-danger" onclick="location.href='{{ url('pegawai') }}'"><i class="fas fa-arrow-left"></i> Kembali</button>
          <div class="card-header">
              <h2 class="text-center">
                  Hasil Pencarian Pegawai
              </h2>
          </div>
          <div class="card-body">
            <a class="btn btn-danger" href="{{ url('pegawai/trash') }}"><i class="fas fa-trash-restore"></i><span> Tong Sampah</span></a><br><br>
              <div class="table-responsive">
                  <!-- <table class="table table-bordered table-striped table-hover js-basic-example dataTable"> -->
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Nama & Gelar</th>
                              <th>Divisi</th>
                              <th>Status Kerja</th>
                              <th>Status Pegawai</th>
                              <th>Detail</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                              <th>No.</th>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Nama & Gelar</th>
                              <th>Divisi</th>
                              <th>Status Kerja</th>
                              <th>Status Pegawai</th>
                              <th>Detail</th>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($pegawai as $i)
                          <?php $count++; ?>
                          <tr>
                              <td>{{ $count}}</td>
                              <td>{{ $i->userz->username}}</td>
                              <td>{{ $i->userz->name}}</td>
                              <td>{{ $i->namagelar}}</td>
                              <td>{{ $i->divisis->divisi}}</td>
                              <td>{{ $i->statuskerjas->status}}</td>
                              <td>{{ $i->statuspegawais->status}}</td>
                              <td><a class="btn bg-deep-orange waves-effect" href="{{ url($i->id.'/pegawai_detail') }}" target="_blank"><i class="fas fa-address-book lg"></i></a></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endif
@endsection --}}
