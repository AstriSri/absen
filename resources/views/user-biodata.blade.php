
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
@section('content')

<div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <button type="button" class="btn btn-danger " onclick="location.href='{{ url('profil') }}'"><i class="fas fa-arrow-left"></i> Kembali</button>
              <div class="header">
                  <h2 class="text-center mt-3">
                      Isi Biodata
                  </h2>
              </div>
              <div class="body">
              <div class="container">
                @if($biodata)
                <form method="POST" action="{{ url('pegawai_biodata_update') }}">
                  @csrf
                  
                    <input type="hidden" id="" name="idpegawai" class="form-control" value="{{$pegawai->id}}">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                          <label for="npm">Nomor Induk Kependudukan (NIK)<code><span class="col-red font-bold">*</span></code></label>
                            <input type="text" id="" name="nik" class="form-control" value="{{$biodata->nomorktp}}" required>
                        </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Jenis Kelamin<code><span class="col-red font-bold">*</span></code></label>
                          <select name="jeniskelamin" class="form-control show-tick" data-live-search="true">
                            <option value="null">Pilih jenis kelamin</option>
                            @foreach($jeniskelamin as $b)
                              @if($b->id == $biodata->jeniskelamin)
                                <option selected value="{{ $b->id}}">{{ $b->jeniskelamin}}</option>
                              @else
                                <option value="{{ $b->id}}">{{ $b->jeniskelamin}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Golongan Darah<code><span class="col-red font-bold">*</span></code></label>
                        <select name="goldar" class="form-control show-tick" data-live-search="true">
                          <option value="null">Pilih golongan darah</option>
                          @foreach($goldar as $b)
                            @if($b->id == $biodata->goldar)
                              <option selected value="{{ $b->id}}">{{ $b->goldar}}</option>
                            @else
                              <option value="{{ $b->id}}">{{ $b->goldar}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Agama<code><span class="col-red font-bold">*</span></code></label>
                        <select name="agama" class="form-control show-tick" data-live-search="true">
                          <option value="null">Pilih agama</option>
                          @foreach($agama as $b)
                            @if($b->id == $biodata->agama)
                              <option selected value="{{ $b->id}}">{{ $b->agama}}</option>
                            @else
                              <option value="{{ $b->id}}">{{ $b->agama}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                    
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="npm">Tempat Lahir<code><span class="col-red font-bold">*</span></code></label>
                          <div class="form-line">
                              <input type="text" id="" name="tempatlahir" class="form-control" value="{{$biodata->tempatlahir}}" required>
                          </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="npm">Tanggal Lahir<code><span class="col-red font-bold">*</span></code></label>
                          <div class="form-line" id="bs_datepicker_container">
                              <input type="date" name="tanggallahir" class="form-control" value="{{$biodata->tanggallahir}}" required>
                          </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="npm">Kewarganegaraan<code><span class="col-red font-bold">*</span></code></label>
                        <select name="kewarganegaraan" class="form-control show-tick" data-live-search="true">
                          <option value="null">Pilih kewarganegaraan</option>
                          @foreach($kewarganegaraan as $b)
                            @if($b->id == $biodata->kewarganegaraan)
                              <option selected value="{{ $b->id}}">{{ $b->kewarganegaraan}}</option>
                            @else
                              <option value="{{ $b->id}}">{{ $b->kewarganegaraan}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <p><u>Alamat</u></p>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="npm">Provinsi</label>
                        <select class="form-control show-tick"  name="id_provinsi" id="id_provinsi" data-live-search="true">
                          <option value="" selected disabled>Pilih provinsi</option>
                          @foreach($provinsi as $b)
                            <option value="{{ $b->id}}">{{ $b->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-3" id="kota">
                        <label for="kota">Kota</label>
                        <select name="id_kota" class="form-control show-tick" id="id_kota" >
                        </select>
                      </div>
                      <div class="form-group col-md-3" id="distrik">
                        <label for="npm">Kecamatan<code><span class="col-red font-bold">*</span></code></label>
                        <select name="id_distrik" class="form-control show-tick" data-live-search="true"  id="id_distrik">
                        </select>
                      </div>
                      <div class="form-group col-md-3" id="desa">
                        <label for="npm">Kelurahan<code><span class="col-red font-bold">*</span></code></label>
                        <select name="id_desa" class="form-control show-tick" data-live-search="true" id="id_desa">
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="npm">Jalan<code><span class="col-red font-bold">*</span></code></label>
                          <div class="form-line">
                              <input type="text" id="" name="alamat" class="form-control" value="{{$biodata->alamat}}">
                          </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">RT<code><span class="col-red font-bold">*</span></code></label>
                          <div class="form-line">
                              <input type="text" id="" name="rt" class="form-control" value="{{$biodata->rt}}">
                          </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">RW</label>
                          <div class="form-line">
                              <input type="text" id="" name="rw" class="form-control" value="{{$biodata->rw}}">
                          </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Kode Pos</label>
                          <div class="form-line">
                              <input type="text" id="" name="kodepos" class="form-control" value="{{$biodata->kodepos}}">
                          </div>
                      </div>
                    </div>
                    
                   <div class="form-row">
                     <div class="form-group col-md-4">
                      <label for="npm">Telp. Rumah</label>
                        <div class="form-line">
                            <input type="text" id="" name="telprumah" class="form-control" value="{{$biodata->notelprumah}}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="npm">No. HP</label>
                        <div class="form-line">
                            <input type="text" id="" name="telphp" class="form-control" value="{{$biodata->nohp}}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="npm">NPWP</label>
                        <div class="form-line">
                            <input type="text" id="" name="npwp" class="form-control" value="{{$biodata->npwp}}">
                        </div>
                    </div>
                   </div>
                   
                </form>
              @else
                <form method="POST" action="{{ url('pegawai_biodata_tambah') }}">
                  @csrf
                    <input type="hidden" id="" name="idpegawai" class="form-control" value="{{$pegawai->id}}">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="npm">Nomor Induk Kependudukan (NIK)<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="" name="nik" class="form-control" value="" required>
                            </div>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Jenis Kelamin<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="jeniskelamin" class="form-control show-tick" data-live-search="true">
                            <option value="null">Pilih jenis kelamin</option>
                            @foreach($jeniskelamin as $b)
                            <option value="{{ $b->id}}">{{ $b->jeniskelamin}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Golongan Darah<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="goldar" class="form-control show-tick" data-live-search="true">
                            <option value="null">Pilih golongan darah</option>
                            @foreach($goldar as $b)
                            <option value="{{ $b->id}}">{{ $b->goldar}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Agama<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="agama" class="form-control show-tick" data-live-search="true">
                            <option value="null">Pilih agama</option>
                            @foreach($agama as $b)
                            <option value="{{ $b->id}}">{{ $b->agama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="npm">Tempat Lahir<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="" name="tempatlahir" class="form-control" value="" required>
                            </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="npm">Tanggal Lahir<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                            <div class="form-line" id="bs_datepicker_container">
                                <input type="date" name="tanggallahir" class="form-control" required>
                            </div>
                        </div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="npm">Kewarganegaraan<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-group">
                          <select name="kewarganegaraan" class="form-control show-tick" data-live-search="true">
                            <option value="null">Pilih kewarganegaraan</option>
                            @foreach($kewarganegaraan as $b)
                            <option value="{{ $b->kode}}">{{ $b->kewarganegaraan}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                
                    <p><u>Alamat</u></p>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="npm">Provinsi</label>
                        
                          <select name="id_provinsi" class="form-control " id="id_provinsi" data-live-search="true">
                            <option value="" selected disabled>Pilih provinsi</option>
                            @foreach($provinsi as $b)
                            <option value="{{ $b->id}}">{{ $b->name}}</option>
                            @endforeach
                          </select>
                       
                      </div>
                      <div class="form-group col-md-3"id="kota">
                          <label for="kota">Kota</label>
                          <select name="id_kota" class="form-control " id="id_kota" data-live-search="true">
                          </select>
                      </div>
                      <div class="form-group col-md-3" id="distrik">
                        <label for="npm">Kecamatan<code><span class="col-red font-bold">*</span></code></label>
                        <select name="id_distrik" class="form-control "  id="id_distrik">
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Kelurahan<code><span class="col-red font-bold">*</span></code></label>
                        <select name="id_desa" class="form-control show-tick"  id="id_desa">
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="npm">Jalan<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-line">
                            <input type="text" id="" name="alamat" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">RT<code><span class="col-red font-bold">*</span></code></label>
                        <div class="form-line">
                            <input type="text" id="" name="rt" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">RW</label>
                        <div class="form-line">
                            <input type="text" id="" name="rw" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="npm">Kode Pos</label>
                        <div class="form-line">
                            <input type="text" id="" name="kodepos" class="form-control" value="">
                        </div>
                      </div>
                    </div>
                    
                   <div class="form-row">
                     <div class="form-group col-md-4">
                        <label for="npm">Telp. Rumah</label>
                        <div class="form-line">
                            <input type="text" id="" name="telprumah" class="form-control" value="">
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="npm">No. HP</label>
                        <div class="form-line">
                            <input type="text" id="" name="telphp" class="form-control" value="">
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                      <label for="npm">NPWP</label>
                      <div class="form-line">
                          <input type="text" id="" name="npwp" class="form-control" value="">
                      </div>
                     </div>
                   </div>
                </form>
                @endif
                <div class="mb-3 mt-3">
                  <button type="submit" class="btn btn-primary"> Simpan
                </div>
                </div>
              </div>
          </div>
        </div>
  </div>
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script>
    $(document).ready(function () {
        $('#id_provinsi').change(function () {
         
         
            var $kota = $('#id_kota');
            $.ajax({
                url: "{{ route('kota.index') }}",
                data: {
                    id_provinsi: $(this).val()
                },
                success: function (data) {
                   
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
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
        $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('.form-password').attr('type','text');
            }else{
                $('.form-password').attr('type','password');
            }
        });
    });
</script>


@endsection
