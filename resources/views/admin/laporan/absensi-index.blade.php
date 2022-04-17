@extends('layouts.masteradmin')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Filter</h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-5">
                                <label for="inputName" class=" col-form-label">Dari Tanggal</label>
                                <div class="">
                                    <input type="date" class="form-control" name="from_day" id="inputName" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group col-5">
                                <label for="inputName" class=" col-form-label">Sampai Tanggal</label>
                                <div class="">
                                    <input type="date" class="form-control" name="end_day" id="inputName" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <label class=" col-form-label" for="">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>
                        Laporan Absensi [{{ reset($months)->format('Y-m-d') }} - {{ end($months)->format('Y-m-d') }}]
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>nama</th>
                                    <th>Absen Hadir</th>
                                    <th>Datang Telat</th>
                                    <th>Pulang Awal</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>nama</th>
                                    <th>Absen Hadir</th>
                                    <th>Datang Telat</th>
                                    <th>Pulang Awal</th>
                                    <th>Detail</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($pegawai as $i)
                                    @php
                                        $jam_datang = $i->absensi->first()->jam_datang_jadwal ?? 0;
                                        $jam_pulang = $i->absensi->first()->jam_pulang_jadwal ?? 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $i->namagelar }}</td>
                                        <td>{{ $i->absensi->where('tanggal', '>=', reset($months)->format('Y-m-d'))->where('tanggal', '<=', end($months)->format('Y-m-d'))->count() .' dari ' .count($months) }}
                                        </td>
                                        <td>{{ $i->absensi->where('tanggal', '>=', reset($months)->format('Y-m-d'))->where('tanggal', '<=', end($months)->format('Y-m-d'))->where('jam_datang', '>=', $jam_datang)->count() }}
                                        </td>
                                        <td>{{ $i->absensi->where('tanggal', '>=', reset($months)->format('Y-m-d'))->where('tanggal', '<=', end($months)->format('Y-m-d'))->where('jam_pulang', '<=', $jam_pulang)->count() }}
                                        </td>
                                        <td>
                                            <form action="{{ url("admin/laporan/absensi/$i->id/show") }}" target="_blank" method="post">
												@csrf
												<input type="hidden" name="from_day" value="{{ reset($months)->format('Y-m-d') }}">
												<input type="hidden" name="end_day" value="{{ end($months)->format('Y-m-d') }}">
                                                <button class="fas fa-address-book btn btn-success"></button>
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

    <!-- Modal -->
    {{-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('userrole.store') }}">
          <div class="modal-body">
              @csrf
                <label for="npm">Nama User</label>
                <div class="form-group w-100">
                  <select name="username" class="form-control js-example-basic-single">
                      <option value="" selected disabled>Pilih User</option>
                      @foreach ($pegawai as $item)
                      <option value="{{ $item->username}}">[{{ $item->username }}]{{ $item->name}}</option>
                      @endforeach
                    </select>
                    <x-validate-error-message name="username"/>
                </div>
                <div class="form-group">
                  <label for="npm">Nama role</label>
                  <select name="kode_role" class="form-control" data-live-search="true">
                      <option value="" selected disabled>Pilih Role</option>
                    </select>
                    <x-validate-error-message name="kode_role"/>
                </div>
                
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div> --}}
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({});
        });
    </script>
@endpush
