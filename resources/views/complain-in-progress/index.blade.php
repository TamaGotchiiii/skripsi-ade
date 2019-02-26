@extends('app-layouts.master-layout')

@section('js')
  <script src="{{asset('js/complain/app.js')}}"></script>
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Keluhan Dalam Pengerjaan
      </h1>
    </section>

    <section class="content">
        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Keluhan Dalam Pengerjaan</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="text-center col-lg-1" style="vertical-align: middle">Kode Antrian</th>
                  <th class="text-center" style="vertical-align: middle">Nama</th>
                  <th class="text-center col-lg-3" style="vertical-align: middle">Keluhan</th>
                  <th class="text-center" style="vertical-align: middle">Jenis Keluhan</th>
                  <th class="text-center " style="vertical-align: middle">Tanggal Masuk</th>      
                  <th class="text-center" style="vertical-align: middle">Lampiran</th>            
                  <th class="text-center col-lg-2" style="vertical-align: middle">Aksi</th>              
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($complains as $complain)
                <tr>
                  <td >{{$complain->complain_code}}</td>
                  <td>{{$complain->name}}</td>
                  <td>{{str_limit($complain->description, $limit = 100, $end = '...')}}</td>
                  <td>{{$complain->complain_type->title}}</td>
                  <td>{{$complain->created_at->format('d M Y')}}</td>
                  @if($complain->attachments->count() == 0)
                    <td class="text-center" style="vertical-align:middle">Tidak ada Lampiran</td>
                  @else
                    <td class="text-center" style="vertical-align:middle">
                        <button type="button" class="btn btn-xs btn-primary attachment-download" title="Download Lampiran" data-toggle="modal" data-target="#downloadModal" data-id= "{{$complain->id}}"><i class="fa fa-download"></i></button>
                    </td>
                  @endif 
                  <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-xs btn-primary confirm-done" data-toggle="modal" data-target="#confirmModal" title="Keluhan Selesai" data-id="{{$complain->id}}"><i class="fa fa-check"></i></button>
                        <button type="button" class="btn btn-xs btn-success view-complain" data-toggle="modal" data-target="#viewModal" data-id="{{$complain->id}}"><i class="fa fa-eye" title="Lihat Detail Keluhan"></i></button>
                        <button type="button" class="btn btn-xs btn-warning edit-complain" data-toggle="modal" data-target="#editModal" data-id="{{$complain->id}}"><i class="fa fa-pencil" title="Ubah Data Keluhan"></i></button>
                        <button type="button" class="btn btn-xs btn-danger delete-complain" data-toggle="modal" data-target="#deleteModal" data-id="{{$complain->id}}"><i class="fa fa-trash" title="Hapus Data Keluhan"></i></button>
                      </div>
                  </td>
                </tr>
                <?php ++$x; ?>
                @endforeach
                </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="7">
                        <button type="button" class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data Keluhan</button>
                      </td>
                    </tr>
                  </tfoot>
              </table>
              <div class="modal fade add-complain-modal" id="addModal" role="dialog">
                @include('app-modal.add-modal')
              </div>
              <div class="modal fade" id="editModal" role="dialog">
                  @include('app-modal.edit-modal')
                </div>
                <div class="modal fade" id="deleteModal" role="dialog">
                  @include('app-modal.delete-modal')
                </div>
                <div class="modal fade" id="downloadModal" role="dialog">
                  @include('app-modal.download-modal')
                </div>
                <div class="modal fade" id="confirmModal" role="dialog">
                  @include('app-modal.confirm-done-modal')
                </div>
                <div class="modal fade" id="viewModal" role="dialog">
                  @include('app-modal.view-modal')
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        </div>
    </section>
@endsection