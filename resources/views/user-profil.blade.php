@extends('layouts.masteruser')
@push('css')
    <link rel="stylesheet" href="{{ url('css/croppie.css') }}">
    <style>
      body{
          background: -webkit-linear-gradient(left, #3931af, #00c6ff);
      }
      .emp-profile{
          padding: 3%;
          margin-top: 3%;
          margin-bottom: 3%;
          border-radius: 0.5rem;
          background: #fff;
      }
      .profile-img{
          text-align: center;
      }
      .profile-img img{
          width: 70%;
          height: 100%;
      }
      .profile-img .file {
          position: relative;
          overflow: hidden;
          margin-top: -20%;
          width: 70%;
          border: none;
          border-radius: 0;
          font-size: 15px;
          background: #212529b8;
      }
      .profile-img .file input {
          position: absolute;
          opacity: 0;
          right: 0;
          top: 0;
      }
      .profile-head h5{
          color: #333;
      }
      .profile-head h6{
          color: #0062cc;
      }
      .profile-edit-btn{
          border: none;
          border-radius: 1.5rem;
          width: 70%;
          padding: 2%;
          font-weight: 600;
          color: #6c757d;
          cursor: pointer;
      }
      .proile-rating{
          font-size: 12px;
          color: #818182;
          margin-top: 5%;
      }
      .proile-rating span{
          color: #495057;
          font-size: 15px;
          font-weight: 600;
      }
      .profile-head .nav-tabs{
          margin-bottom:5%;
      }
      .profile-head .nav-tabs .nav-link{
          font-weight:600;
          border: none;
      }
      .profile-head .nav-tabs .nav-link.active{
          border: none;
          border-bottom:2px solid #0062cc;
      }
      .profile-work{
          padding: 14%;
          margin-top: -15%;
      }
      .profile-work p{
          font-size: 12px;
          color: #818182;
          font-weight: 600;
          margin-top: 10%;
      }
      .profile-work a{
          text-decoration: none;
          color: #495057;
          font-weight: 600;
          font-size: 14px;
      }
      .profile-work ul{
          list-style: none;
      }
      .profile-tab label{
          font-weight: 600;
      }
      .profile-tab p{
          font-weight: 600;
          color: #0062cc;
      }
      @media (min-width: 768px) {
        .modal-lg,
        .modal-xl {
          max-width: 90% !important;
        }
      }
      @media (min-width: 992px) {
        .modal-lg,
        .modal-xl {
          max-width: 80% !important;
        }
      }
      .row-pointer{
        cursor: pointer;
      }
      .row-pointer:hover{
        background-color: rgba(0, 0, 0, 0.2) !important;
      }
    </style>
@endpush

@section('content')
  <div class="emp-profile shadow-lg">
    <div class="row">
        <div class="col-md-3">
          <div class="p-3">
            <img src="{{ url(auth()->user()->foto.'/display_foto')}}" id="preview" class="border w-100 rounded-lg" onerror="this.onerror=null;this.src='{{asset('fileupload/a.jpg')}}';">
            <div class="input-group my-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-upload"></i></span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="upload" id="upload">
                <label class="custom-file-label" for="upload">Choose file</label>
              </div>
            </div>
          </div>
          <div>
            <div class="profile-work">
              <p>WORK LINK</p>
              @if ($dosen = auth()->user()->dosen)
                <a href="{{ url("user/idcard/dosen") }}">ID Card Dosen</a><br/>
              @endif
              @if ($pegawai = auth()->user()->pegawai)
                <a href="{{ url("user/idcard/pegawai") }}">ID Card Pegawai</a><br/>
              @endif
              <p>BARCODE</p>
              <?php 
                echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG(auth()->user()->username , 'C128') . '" alt="barcode"/>';
                ?>
              <br>
                    {{-- <a class="my-2 btn btn-secondary w-100" href="">Lihat Id Card</a> --}}
                {{--
              <a href="">Web Designer</a><br/>
              <a href="">Web Developer</a><br/>
              <a href="">WordPress</a><br/>
              <a href="">WooCommerce</a><br/>
              <a href="">PHP, .Net</a><br/> --}}
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-10">
              <div class="profile-head">
                <table class="w-100">
                  <tr>
                    <td class="w-25">Username</td>
                    <td>:</td>
                    <td>{{auth()->user()->username}}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{auth()->user()->email}}</td>
                  </tr>
                </table>
                  
                  <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="r-golongan-tab" data-toggle="tab" href="#r-golongan" role="tab" aria-controls="r-golongan" aria-selected="false">Riwayat Golongan</a>
                      </li>
                        @if (in_array(7,auth()->user()->levels))
                        <li class="nav-item">
                            <a class="nav-link" id="r-jabatan-d-tab" data-toggle="tab" href="#r-jabatan-d" role="tab" aria-controls="r-jabatan-d" aria-selected="false">Riwayat Jabatan Dosen</a>
                        </li>
                        @endif
                        @if (in_array(5,auth()->user()->levels))
                        <li class="nav-item">
                            <a class="nav-link" id="r-jabatan-p-tab" data-toggle="tab" href="#r-jabatan-p" role="tab" aria-controls="r-jabatan-p" aria-selected="false">Riwayat Jabatan Pegawai</a>
                        </li>
                        @endif
                      <li class="nav-item">
                          <a class="nav-link" id="r-pendidikan-tab" data-toggle="tab" href="#r-pendidikan" role="tab" aria-controls="r-pendidikan" aria-selected="false">Riwayat Pendidikan</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                      </li>
                  </ul>
              </div>
            </div>
            <div class="col-md-2">
              <div class="btn-group dropleft">
                <button type="button" class="m-1 btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </i>Edit Profile
                </button>
                <div class="dropdown-menu">
                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#updateBiodataModal"><i class="fas fa-edit"> Edit Profile</i></button>
                  <div class="dropdown-divider"></div>
                  <button type="button" class="dropdown-item" onclick="window.location='{{route('riwayat-golongan.create')}}'"><i class="fas fa-plus-circle"> Tambah Riwayat Golongan</i></button>
                  
                  @if (in_array(7,auth()->user()->levels))
                      <button type="button" class="dropdown-item" onclick="window.location='{{route('riwayat-jabatan-dosen.create')}}'"><i class="fas fa-plus-circle"> Tambah Riwayat Jabatan Dosen</i></button>
                    @endif
                  @if (in_array(5,auth()->user()->levels))
                      <button type="button" class="dropdown-item" onclick="window.location='{{route('riwayat-jabatan-pegawai.create')}}'"><i class="fas fa-plus-circle"> Tambah Riwayat Jabatan Pegawai</i></button>
                    @endif
                  <button type="button" class="dropdown-item" onclick="window.location='{{route('riwayat-pendidikan.create')}}'"><i class="fas fa-plus-circle"> Tambah Riwayat Pendidikan</i></button>
                  <div class="dropdown-divider"></div>
                  <button type="button" class="dropdown-item" onclick="window.location='{{route('dokumen.create')}}'"><i class="fas fa-plus-circle">Tambah Dokumen</i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="tab-content profile-tab col-12" id="myTabContent">
              <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                  <div class="row">
                      <div class="col-md-3 col-6">
                          <label>Nomor KTP</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->nomorktp ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Kewarganegaraan</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Kewarganegaraan->kewarganegaraan ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Tempat, Tanggal lahir</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->tempatlahir ?? "-"}}, {{$biodata->tanggallahir ? $biodata->tanggallahir->translatedFormat('d F Y') : "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Jenis Kelamin</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Jeniskelamin->jeniskelamin ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Golongan Darah</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Golongandarah->goldar ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Agama</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Agama->agama ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Nomor HP</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->nohp ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>NPWP</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->npwp ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Provinsi</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Provinsi->name ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Kabupaten/Kota</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Kota->name ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Kecamatan</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Kecamatan->name ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Kelurahan/Desa</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->Kelurahan->name ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>RT</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->rt ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>RW</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->rw ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Kodepos</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->kodepos ?? "-"}}</p>
                      </div>
                      <div class="col-md-3 col-6">
                          <label>Telepon rumah</label>
                      </div>
                      <div class="col-md-3 col-6">
                          <p>{{$biodata->notelprumah ?? "-"}}</p>
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="r-golongan" role="tabpanel" aria-labelledby="r-golongan-tab">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th class="">No</th>
                        <th class="">Golongan</th>
                        <th class="col-md-2">NoSK</th>
                        <th class="col-md-2">SK</th>
                        <th class="col-md-2">Mulai</th>
                        <th class="col-md-2">TTD</th>
                        <th class="col-md-2">Tmt</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($riwayatgolongan as $i)
                        <tr class="row-pointer" onclick="window.location='{{route('riwayat-golongan.edit', $i->id)}}'">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $i->Golongan->golongan }}</td>
                          <td>{{ $i->no_sk }}</td>
                          <td>{{ $i->tanggal_sk->translatedFormat('d F Y') }}</td>
                          <td>{{ $i->tanggal_mulai->translatedFormat('d F Y') }}</td>
                          <td>{{ $i->nama_ttd }}</td>
                          <td>{{ $i->tmt->translatedFormat('d F Y') }}</td>
                        </tr>                                
                      @endforeach
                    </tbody>
                  </table>
              </div>
              <div class="tab-pane fade" id="r-jabatan-p" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Jabatan</th>
                              <th>No. SK</th>
                              <th>Tanggal SK</th>
                              <th>Tanggal Mulai</th>
                              <th>Nama TTD</th>
                              <th>Tmt</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($riwayatjabatanpegawai as $i)
                          <tr class="row-pointer" onclick="window.location='{{route('riwayat-jabatan-pegawai.edit', $i->id)}}'">
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->Jabatan->jabatan}}</td>
                              <td>{{ $i->no_sk}}</td>
                              <td>{{ $i->tanggal_sk->translatedFormat('d F Y')}}</td>
                              <td>{{ $i->tanggal_mulai->translatedFormat('d F Y')}}</td>
                              <td>{{ $i->nama_ttd}}</td>
                              <td>{{ $i->tmt->translatedFormat('d F Y')}}</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="r-jabatan-d" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Jabatan</th>
                              <th>No. SK</th>
                              <th>Tanggal SK</th>
                              <th>Tanggal Mulai</th>
                              <th>Nama TTD</th>
                              <th>Tmt</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($riwayatjabatandosen as $i)
                          <tr class="row-pointer" onclick="window.location='{{route('riwayat-jabatan-dosen.edit', $i->id)}}'">
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->Jabatan->jabatan}}</td>
                              <td>{{ $i->no_sk}}</td>
                              <td>{{ $i->tanggal_sk->translatedFormat('d F Y')}}</td>
                              <td>{{ $i->tanggal_mulai->translatedFormat('d F Y')}}</td>
                              <td>{{ $i->nama_ttd}}</td>
                              <td>{{ $i->tmt->translatedFormat('d F Y')}}</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="r-pendidikan" role="tabpanel" aria-labelledby="r-pendidikan-tab">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Pendidikan</th>
                              <th>Tahun Lulus</th>
                              <th>Nama Sekolah/Universitas</th>
                              <th>Nomor Ijazah</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($riwayatpendidikan as $i)
                          <tr class="row-pointer" onclick="window.location='{{route('riwayat-pendidikan.edit', $i->id)}}'">
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->Pendidikan->pendidikan}}</td>
                              <td>{{ $i->tahunlulus}}</td>
                              <td>{{ $i->namasekolah}}</td>
                              <td>{{ $i->noijazah}}</td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Jenis</th>
                              <th>Dokumen</th>
                              <th>Keterangan</th>
                              <th>Tanggal Upload</th>
                              <th>Lihat</th>
                              <th>Hapus</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($dokumen as $i)
                          <tr>
                              <td>{{ $loop->iteration}}</td>
                              <td>{{ $i->jenis}}</td>
                              <td>{{ $i->dokumen}}</td>
                              <td>{{ $i->keterangan}}</td>
                              <td>{{$i->created_at->translatedFormat('d F Y')}}</td>
                              <td><button type="button" class="btn btn-primary" onClick="window.open('{{ route('dokumen.show', $i->id) }}');"><i class="fas fa-eye"></i></button></td>
                              <td>
                                <form action="{{ route('dokumen.destroy', $i) }}" method="post">
                                  @csrf 
                                  @method("DELETE")
                                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    </div>
  </div>

  <div id="myModal" class="modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title float-left">Crop Image</h4>
              <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
              <div class="col-md-8 text-center">
                <div id="image" style="width:250px; margin-top:20px"></div>
              </div>
              <div class="col-md-4" style="padding-top:20px;">
                <button class="btn btn-success crop_image" value="{{auth()->user()->id}}">Crop & Upload Image</button>
            </div>
          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="updateBiodataModal" tabindex="-1" role="dialog" aria-labelledby="updateBiodataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateBiodataModalLabel">Biodata Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form method="POST" action="{{ route('user.biodata.update', $biodata->id) }}">
          <div class="modal-body">
            @csrf
            @method("PUT")
                <div class="form-row">
                  <div class="form-group col">
                    <label for="npm">Nomor Induk Kependudukan (NIK)<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nik" class="form-control" value="{{ $biodata->nomorktp ?? "" }}" required>
                            <x-validate-error-message name="nik"/>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">Golongan Darah<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="goldar" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih golongan darah</option>
                        @foreach($goldar as $b)
                          <option value="{{ $b->id}}" {{ $biodata->goldar == $b->id ? 'selected' : "" }}>{{ $b->goldar}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="goldar"/>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">Agama<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="agama" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih agama</option>
                        @foreach($agama as $b)
                        <option value="{{ $b->id}}" {{ $biodata->agama == $b->id ? 'selected' : "" }}>{{ $b->agama}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="agama"/>
                    </div>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col">
                    <label for="npm">Telp. Rumah</label>
                    <div class="form-line">
                        <input type="text" name="notelprumah" class="form-control" value="{{$biodata->notelprumah}}">
                        <x-validate-error-message name="notelprumah"/>
                      </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">No. HP</label>
                    <div class="form-line">
                        <input type="text" name="nohp" class="form-control" value="{{ $biodata->nohp}}">
                          <x-validate-error-message name="nohp"/>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">NPWP</label>
                    <div class="form-line">
                        <input type="text" name="npwp" class="form-control" value="{{ $biodata->npwp}}">
                          <x-validate-error-message name="npwp"/>
                    </div>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col">
                    <label for="npm">Tempat Lahir<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="tempatlahir" class="form-control" value="{{$biodata->tempatlahir}}" required>
                          <x-validate-error-message name="tempatlahir"/>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">Tanggal Lahir<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                        <div class="form-line" id="bs_datepicker_container">
                            <input type="date" name="tanggallahir" class="form-control" value="{{ $biodata->tanggallahir ? $biodata->tanggallahir->format("Y-m-d") : ""}}" required>
                          <x-validate-error-message name="tanggallahir"/>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">Kewarganegaraan<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="kewarganegaraan" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih kewarganegaraan</option>
                        @foreach($kewarganegaraan as $b)
                        <option value="{{ $b->id }}" {{ $biodata->kewarganegaraan == $b->id ? 'selected' : "" }}>{{ $b->kewarganegaraan}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="kewarganegaraan"/>
                    </div>
                  </div>
                  <div class="form-group col">
                    <label for="npm">Jenis Kelamin<code><span class="col-red font-bold">*</span></code></label>
                    <div class="form-group">
                      <select name="jeniskelamin" class="form-control show-tick" data-live-search="true">
                        <option value="">Pilih jenis kelamin</option>
                        @foreach($jeniskelamin as $b)
                        <option value="{{ $b->id}}" {{ $biodata->jeniskelamin == $b->id ? 'selected' : "" }}>{{ $b->jeniskelamin}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="jeniskelamin"/>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="npm">Provinsi</label>
                      <select name="provinsi" class="form-control " id="id_provinsi" data-live-search="true">
                        <option value="" selected disabled>Pilih provinsi</option>
                        @foreach($provinsi as $b)
                        <option value="{{ $b->id}}" {{ $biodata->provinsi == $b->id ? 'selected' : "" }}>{{ $b->name}}</option>
                        @endforeach
                      </select>
                      <x-validate-error-message name="provinsi"/>
                  </div>
                  <div class="form-group col-md-3"id="kota">
                      <label for="kota">Kota</label>
                      <select name="kota" class="form-control " id="id_kota" data-live-search="true">
                        <option value="">Pilih Kota/Kabupaten</option>
                        @isset($biodata->kota)
                          <option value="{{ $biodata->kota }}" selected>{{ $biodata->Kota->name}}</option>  
                        @endisset
                      </select>
                  </div>
                  <div class="form-group col-md-3" id="distrik">
                    <label for="npm">Kecamatan<code><span class="col-red font-bold">*</span></code></label>
                    <select name="kecamatan" class="form-control "  id="id_distrik">
                        <option value="">Pilih Kecamatan</option>
                        @isset($biodata->kecamatan)
                          <option value="{{ $biodata->kecamatan }}" selected>{{ $biodata->Kecamatan->name}}</option>  
                        @endisset
                      </select>
                      <x-validate-error-message name="kecamatan"/>
                    </div>
                  <div class="form-group col-md-3">
                    <label for="npm">Kelurahan/Desa<code><span class="col-red font-bold">*</span></code></label>
                    <select name="kelurahan" class="form-control show-tick"  id="id_desa">
                        <option value="">Pilih Kelurahan/Desa</option>
                        @isset($biodata->kelurahan)
                          <option value="{{ $biodata->kelurahan }}" selected>{{ $biodata->Kelurahan->name}}</option>  
                        @endisset
                    </select>
                      <x-validate-error-message name="kelurahan"/>
                    </div>
                </div>
                
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="npm">Jalan</label>
                    <div class="form-line">
                        <input type="text" name="alamat" class="form-control" value="{{ $biodata->alamat }}">
                        <x-validate-error-message name="alamat"/>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="npm">RT</label>
                    <div class="form-line">
                        <input type="text" name="rt" class="form-control" value="{{ $biodata->rt }}">
                        <x-validate-error-message name="rt"/>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="npm">RW</label>
                    <div class="form-line">
                        <input type="text" name="rw" class="form-control" value="{{ $biodata->rw }}">
                        <x-validate-error-message name="rw"/>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="npm">Kode Pos</label>
                    <div class="form-line">
                        <input type="text" name="kodepos" class="form-control" value="{{ $biodata->kodepos }}">
                        <x-validate-error-message name="kodepos"/>
                    </div>
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
@endsection

@push('script')
    <script src="{{ url('js/croppie.js') }}"></script>

    <script>
      $(document).ready(function(){
  
        $image_crop = $('#image').croppie({
          enableExif: true,
          viewport: {
            width:250,
            height:250,
            type:'square' //circle
          },
          boundary:{
            width:300,
            height:300
          }
        });

        $('#upload').on('change', function(){
          var reader = new FileReader();
          reader.onload = function (event) {
            $image_crop.croppie('bind', {
              url: event.target.result
            }).then(function(){
              console.log('jQuery bind complete');
            });
          }
          reader.readAsDataURL(this.files[0]);
          $('#myModal').modal('show');
        });

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.crop_image').click(function(event){
          let id = $(this).val();
          $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
          }).then(function(response){
            console.log(response);
            $.ajax({
              url:`user/${id}/update/foto`,
              type: "POST",
              data:{"foto": response},
              success:function(data)
              {
                console.log(data);
                $('#myModal').modal('hide');
                $('#uploaded').html(data);
                location.reload();
              }
            });
          })
        });

      }); 

      $(document).ready(function(){
          $('.form-checkbox').click(function(){
              if($(this).is(':checked')){
                  $('.form-password').attr('type','text');
              }else{
                  $('.form-password').attr('type','password');
              }
          });
      });
      $(document).ready(function () {
          $('#id_provinsi').change(function () {
          
          
              var $kota = $('#id_kota');
              $.ajax({
                  url: "{{ route('kota.index') }}",
                  data: {
                      id_provinsi: $(this).val()
                  },
                  success: function (data) {
                      $kota.empty();
                      $kota.append('<option value="" selected>Pilih Kota</option>');
                      $.each(data, function (id, value) {
                          $kota.append('<option value="' + id + '">' + value + '</option>');
                      });
                  }
              });
              $('#id_kota, #id_distrik, #id_desa').val("");
              $('#kota').removeClass('hidden');
          });
          $('#id_kota').change(function () {
              var $distrik = $('#id_distrik');
              $.ajax({
                  url: "{{ route('distrik.index') }}",
                  data: {
                      id_kota: $(this).val()
                  },
                  success: function (data) {
                      $distrik.html('<option value="" selected>Choose kecamatan</option>');
                      $.each(data, function (id, value) {
                          $distrik.append('<option value="' + id + '">' + value + '</option>');
                      });
                  }
              });
              $('#id_distrik, #id_desa').val("");
              $('#distrik').removeClass('d-none');
          });
          $('#id_distrik').change(function () {
              var $desa = $('#id_desa');
              $.ajax({
                  url: "{{ route('desa.index') }}",
                  data: {
                      id_distrik: $(this).val()
                  },
                  success: function (data) {
                      $desa.html('<option value="" selected>Choose city</option>');
                      $.each(data, function (id, value) {
                          $desa.append('<option value="' + id + '">' + value + '</option>');
                      });
                  }
              });
              $('#id_desa').val("");
              $('#desa').removeClass('d-none');
          });
      });
    </script>
@endpush
