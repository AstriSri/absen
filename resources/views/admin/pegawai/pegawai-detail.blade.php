@extends('layouts.masteradmin')

@section('content')

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
                <br />
                <br />
                <br/>
                <button class="btn btn-success crop_image" value="{{$pegawai->id}}">Crop & Upload Image</button>
            </div>
          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div>

  <div class="row clearfix mb-2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header">
          <h2>
              {{$pegawai->namagelar}}
              <small>{{$pegawai->user}} - {{$pegawai->Divisi->divisi}}</small>
              <a class="btn btn-primary mx-1 float-right" href="{{ route('pegawai.index') }}"><i class="fas fa-arrow-left"></i><span></span></a>
          </h2>
        </div>
        <div class="card-body">
          <div class="row clearfix">
            <div class="col-md-3">
              <img src="{{ url($pegawai->userz->foto.'/display_foto')}}" id="preview" class="border w-100" onerror="this.onerror=null;this.src='{{asset('fileupload/a.jpg')}}';">
              <div class="input-group my-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-upload"></i></span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="upload" id="upload">
                  <label class="custom-file-label" for="upload">Choose file</label>
                </div>
              </div>
              <div class="form-group">
                <div class="col">
                  <h4>Barcode</h4>
                  <?php 
                    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($pegawai->user, 'C128') . '" alt="barcode"/>';
                    ?>
                  <br>
                  <a class="my-2 btn btn-secondary w-100" href="{{ url("admin/pegawai/$pegawai->id/idcard/show") }}">Lihat Id Card</a>
                </div>
              </div>
            </div>
            <div class="card col-md-9">
              <div class="card-body">

                @if ($biodata = $pegawai->biodata)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Nomor KTP</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->nomorktp ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Kewarganegaraan</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Kewarganegaraan->kewarganegaraan ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Tempat Lahir</h6>
                        </div>
                        <div class="col-md-7 text-secondary">: {{ $biodata->tempatlahir ?? "-"}}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Provinsi</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Provinsi->name ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->tanggallahir ?? "-"}}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Kota/Kabupaten</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Kota->name ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-md-7 text-secondary">: {{ $biodata->Jeniskelamin->jeniskelamin ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Kecamatan</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Kecamatan->name ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Agama</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Agama->agama ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Kelurahan/Desa</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->Kelurahan->name ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Golongan Darah</h6>
                        </div>
                        <div class="col-md-7 text-secondary">: {{ $biodata->golongandarah->goldar ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">RT</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->rt ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">No. HP</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->nohp ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">RW</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->rw ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">No. Telepon</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->notelprumah ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Kode Pos</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->kodepos ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">NPWP</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->npwp ?? "-" }}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-5">
                          <h6 class="mb-0">Alamat</h6>
                        </div>
                        <div class="col-sm-7 text-secondary">: {{ $biodata->alamat ?? "-" }}</div>
                      </div>
                    </div>
                  </div>
                  <hr class="mt-0">
                  <div class="col-md-12">
                    <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#updateBiodataModal"><i class="fas fa-edit"></i></button>
                  </div>
                @else
                <div class="col-md-12">
                  <form method="POST" action="{{ route('pegawai.biodata.create', $pegawai->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success float-right m-1"><i class="fas fa-plus"></i></button>
                  </form>
                </div>
                @endif
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      
  <div class="row clearfix">
      <!-- Example Tab -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="card-header">
            <h2>
              Detail Pegawai
            </h2>
          </div>
          <div class="card-body">
              <!-- Nav tabs -->
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Riwayat Golongan</a>
                  <a class="nav-item nav-link" id="riwayat-jabatan-tab" data-toggle="tab" href="#riwayat-jabatan" role="tab" aria-controls="riwayat-jabatan" aria-selected="false">Riwayat Jabatan</a>
                  <a class="nav-item nav-link" id="nav-pendidikan-tab" data-toggle="tab" href="#nav-pendidikan" role="tab" aria-controls="nav-pendidikan" aria-selected="false">Riwayat Pendidikan</a>
                  <a class="nav-item nav-link" id="nav-dokumen-tab" data-toggle="tab" href="#nav-dokumen" role="tab" aria-controls="nav-dokumen" aria-selected="false">Dokumen</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <button type="button" class="btn btn-success my-3" onclick="location.href='{{ route('pegawai.riwayat-golongan.create', $pegawai->id ) }}'"><i class="fas fa-plus-circle"></i><span>Tambah Riwayat Golongan</span></button>
                    @if(!$pegawai->riwayatgolongan->isEmpty())
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Golongan</th>
                                    <th>No. SK</th>
                                    <th>Tanggal SK</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Nama TTD</th>
                                    <th>Tmt</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Golongan</th>
                                    <th>No. SK</th>
                                    <th>Tanggal SK</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Nama TTD</th>
                                    <th>Tmt</th>
                                    <th>Edit</th>
                                    <th>Hapus</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($pegawai->riwayatgolongan as $i)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $i->Golongan->golongan}}</td>
                                    <td>{{ $i->no_sk}}</td>
                                    <td>{{ $i->tanggal_sk->translatedFormat('d F Y')}}</td>
                                    <td>{{ $i->tanggal_mulai->translatedFormat('d F Y')}}</td>
                                    <td>{{ $i->nama_ttd}}</td>
                                    <td>{{ $i->tmt->translatedFormat('d F Y')}}</td>
                                    <td><a type="button" class="btn btn-warning" href="{{ route('pegawai.riwayat-golongan.edit', ['pegawai' => $pegawai->id, 'riwayat_golongan' => $i->id] ) }}"><i class="far fa-edit"></a></td>
                                    <td>
                                        <form method="POST" action="{{route('pegawai.riwayat-golongan.destroy', ['pegawai' => $pegawai->id, 'riwayat_golongan' => $i->id])}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>    
                                    </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                      </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="riwayat-jabatan" role="tabpanel" aria-labelledby="riwayat-jabatan-tab">
                  <button type="button" class="btn btn-success mt-3" onclick="location.href='{{ route('pegawai.riwayat-jabatan.create', $pegawai->id ) }}'"><i class="fas fa-plus-circle"></i><span> Tambah Riwayat Jabatan</span></button>
                  @if(!$pegawai->riwayatjabatan->isEmpty())
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
                                  <th>Edit</th>
                                  <th>Hapus</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>Jabatan</th>
                                  <th>No. SK</th>
                                  <th>Tanggal SK</th>
                                  <th>Tanggal Mulai</th>
                                  <th>Nama TTD</th>
                                  <th>Tmt</th>
                                  <th>Edit</th>
                                  <th>Hapus</th>
                              </tr>
                          </tfoot>
                          <tbody>
                          @foreach($pegawai->riwayatjabatan as $i)
                              <tr>
                                  <td>{{ $loop->iteration}}</td>
                                  <td>{{ $i->Jabatan->jabatan}}</td>
                                  <td>{{ $i->no_sk}}</td>
                                  <td>{{ $i->tanggal_sk->translatedFormat('d F Y')}}</td>
                                  <td>{{ $i->tanggal_mulai->translatedFormat('d F Y')}}</td>
                                  <td>{{ $i->nama_ttd}}</td>
                                  <td>{{ $i->tmt->translatedFormat('d F Y')}}</td>
                                  <td><a type="button" class="btn btn-warning" href="{{ route('pegawai.riwayat-jabatan.edit', ['pegawai' => $pegawai->id, 'riwayat_jabatan' => $i->id] ) }}"><i class="far fa-edit"></a></td>
                                  <td>
                                      <form method="POST" action="{{route('pegawai.riwayat-jabatan.destroy', ['pegawai' => $pegawai->id, 'riwayat_jabatan' => $i->id])}}">
                                          @csrf
                                          @method("DELETE")
                                          <button type="submit" class="btn btn-danger">
                                          <i class="far fa-trash-alt"></i>
                                          </button>
                                      </form>    
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                  @endif
                </div>
                <div class="tab-pane fade" id="nav-pendidikan" role="tabpanel" aria-labelledby="nav-pendidikan-tab">
                  <button type="button" class="btn btn-success my-3" onclick="location.href='{{  route('pegawai.riwayat-pendidikan.create', $pegawai->id) }}'"><i class="fas fa-plus-circle"></i><span>Tambah Riwayat Pendidikan</span></button>
                  @if(!$pegawai->riwayatpendidikan->isEmpty())
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                          <thead>
                              <tr>
                                  <th>No.</th>
                                  <th>Pendidikan</th>
                                  <th>Tahun Lulus</th>
                                  <th>Nama Sekolah/Universitas</th>
                                  <th>Nomor Ijazah</th>
                                  <th>Edit</th>
                                  <th>Hapus</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>No.</th>
                                  <th>Pendidikan</th>
                                  <th>Tahun Lulus</th>
                                  <th>Nama Sekolah/Universitas</th>
                                  <th>Nomor Ijazah</th>
                                  <th>Edit</th>
                                  <th>Hapus</th>
                              </tr>
                          </tfoot>
                          <tbody>
                          @foreach($pegawai->riwayatpendidikan as $i)
                              <tr>
                                  <td>{{ $loop->iteration}}</td>
                                  <td>{{ $i->Pendidikan->pendidikan}}</td>
                                  <td>{{ $i->tahunlulus}}</td>
                                  <td>{{ $i->namasekolah}}</td>
                                  <td>{{ $i->noijazah}}</td>
                                  <td><a type="button" class="btn btn-warning" href="{{ route('pegawai.riwayat-pendidikan.edit', ['pegawai' => $pegawai->id, 'riwayat_pendidikan' => $i->id] ) }}"><i class="far fa-edit"></a></td>
                                  <td>
                                      <form method="POST" action="{{route('pegawai.riwayat-pendidikan.destroy', ['pegawai' => $pegawai->id, 'riwayat_pendidikan' => $i->id])}}">
                                          @csrf
                                          @method("DELETE")
                                          <button type="submit" class="btn btn-danger">
                                          <i class="far fa-trash-alt"></i>
                                          </button>
                                      </form>    
                                  </td>
                                </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                  @endif
                </div>
                <div class="tab-pane fade" id="nav-dokumen" role="tabpanel" aria-labelledby="nav-dokumen-tab">
                  <button type="button" class="btn btn-success my-3" onclick="location.href='{{ route('pegawai.dokumen.create', $pegawai->id) }}'"><i class="fas fa-plus-circle"></i><span>Tambah Dokumen</span></button>
                  @if(!$pegawai->dokumen->isEmpty())
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
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis</th>
                                    <th>Dokumen</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Upload</th>
                                    <th>Lihat</th>
                                    <th>Hapus</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($pegawai->dokumen as $i)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $i->jenis}}</td>
                                    <td>{{ $i->dokumen}}</td>
                                    <td>{{ $i->keterangan}}</td>
                                    <td>{{ $i->created_at->translatedFormat('d F Y')}}</td>
                                    <td><button type="button" class="btn btn-primary" onClick="window.open('{{ route('pegawai.dokumen.show', ['pegawai' => $pegawai->id, 'dokuman' => $i->id]) }}');"><i class="fas fa-eye"></i></button></td>
                                    <td>
                                      <form method="POST" action="{{route('pegawai.dokumen.destroy', ['pegawai' => $pegawai->id, 'dokuman' => $i->id])}}">
                                          @csrf
                                          @method("DELETE")
                                          <button type="submit" class="btn btn-danger">
                                          <i class="far fa-trash-alt"></i>
                                          </button>
                                      </form>    
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                      </div>
                  @endif
                </div>
              </div>
              

              <!-- Tab panes -->
              
          </div>
      </div>
    </div>
    <!-- #END# Example Tab -->
  </div>

  @isset($biodata)
    <div class="modal fade bd-example-modal-lg" id="updateBiodataModal" tabindex="-1" role="dialog" aria-labelledby="updateBiodataModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateBiodataModalLabel">Biodata Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form method="POST" action="{{ route('pegawai.biodata.update', $pegawai->biodata->id) }}">
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
                              <input type="date" name="tanggallahir" class="form-control" value="{{ $biodata->tanggallahir ? $biodata->tanggallahir->format("Y-m-d") : '' }}" required>
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
                        <select name="provinsi" class="form-control selectpicker" id="id_provinsi" data-live-search="true">
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
                        <x-validate-error-message name="kota"/>
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
  @endisset
@endsection

@push('css')
  <link rel="stylesheet" href="{{ url('css/croppie.css') }}">
  <style>
    
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
  </style>
@endpush

@push('script')
<script src="{{ url('js/croppie.js') }}"></script>
<script type="text/javascript">  
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
            url:`${id}/update/foto`,
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
