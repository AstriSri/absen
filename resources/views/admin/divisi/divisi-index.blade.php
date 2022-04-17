<?php $count = 0; ?>
@extends('layouts.masteradmin')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    Data Divisi
                    <a class="btn btn-danger mx-1 float-right" href="{{ url('admin/trash/divisi/index') }}"><i class="fas fa-trash-restore"></i><span></span></a>
                    <button type="button" class="btn btn-primary mx-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i></button>
                </h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Divisi</th>
                                <th>Kode</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Divisi</th>
                                <th>Kode</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($divisi as $i)
                            <?php $count++; ?>
                            <tr>
                                <td>{{ $count}}</td>
                                <td>{{ $i->divisi}}</td>
                                <td>{{ $i->kode}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" onclick="location.href='{{ route('divisi.edit', $i->id) }}'"><i class="far fa-edit"></i></button>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('divisi.destroy', $i->id)}}">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                        </button>
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

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Agama</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('divisi.store') }}">
            <div class="modal-body">
                @csrf
                <label for="npm">Nama Divisi</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" id="" name="divisi" class="form-control" value="" required>
                        <x-validate-error-message name="divisi"/>
                    </div>
                </div>
                <label for="npm">Kode</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" id="" name="kode" class="form-control" value="" required>
                        <x-validate-error-message name="kode"/>
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
@endsection