@extends('app-layouts.master-layout')

@section('js')
  <script src="{{asset('js/complain/app.js')}}"></script>
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Antrian Keluhan
      </h1>
    </section>

    <section class="content">
      @if(Auth::user()->level_user != 2)
      <div class="row">
          <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-hourglass-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Keluhan Belum Tertangani</span>
                <span class="info-box-number">{{$queue->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-half"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Keluhan Dalam Pengerjaan</span>
                <span class="info-box-number">{{$onProgress->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-hourglass-end"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Keluhan Terselesaikan</span>
                <span class="info-box-number">{{$done->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        @endif
        <!-- /.row -->

        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Antrian Keluhan</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="col-lg-12 table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="text-center col-lg-1" style="vertical-align: middle">Kode Antrian</th>
                  <th class="text-center" style="vertical-align: middle">Nama</th>
                  <th class="text-center col-lg-3" style="vertical-align: middle">Keluhan</th>
                  <th class="text-center" style="vertical-align: middle">Jenis Keluhan</th>
                  <th class="text-center " style="vertical-align: middle">Tanggal Masuk</th>
                  <th class="text-center " style="vertical-align: middle">Status</th>
                  <th class="text-center " style="vertical-align: middle">Ditangani Oleh</th>
                  @if(Auth::user()->level_user != 1)
                    <th class="text-center col-lg-2" style="vertical-align: middle">Aksi</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($complains as $complain)
                <div class="data">
                <tr>
                  <td style="vertical-align: middle;">{{$complain->complain_code}}</td>
                  <td style="vertical-align: middle;">{{$complain->name}}</td>
                  <td style="vertical-align: middle;">{{str_limit($complain->description, $limit = 100, $end = '...')}}</td>
                  <td style="vertical-align: middle;">{{$complain->complain_type->title}}</td>
                  <td style="vertical-align: middle;">{{$complain->created_at->format('d M Y')}}</td> 
                    <!-- Operator And Supervisor -->
                    @if($complain->status == 0)
                      <td style="vertical-align: middle;"><i class="dot-queue"></i> Dalam Antrian</td>
                      <td style="vertical-align: middle;">Belum Ditangani</td>
                    @elseif($complain->status == 1)
                      <td style="vertical-align: middle;"><i class="dot-progress"></i> Sedang Dikerjakan</td>
                      
                      <td style="vertical-align: middle;">{{$complain->user->name}}</td>
                      
                    @else
                      <td style="vertical-align: middle;"><i class="dot-done"></i> Selesai, {{$complain->updated_at->format('d M Y')}}</td>
                      
                      <td style="vertical-align: middle;">{{$complain->user->name}}</td>
                      
                    @endif
                  @if(Auth::user()->level_user != 1)
                    <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        @if(Auth::user()->level_user == 0 && $complain->status == 0)
                          <button type="button" class="btn btn-xs btn-primary take-complain" data-toggle="modal" data-target="#takeModal" data-id="{{$complain->id}}" title="Tangani Keluhan" ><i class="fa fa-sign-in"></i></button>
                        @endif
                        <button type="button" class="btn btn-xs btn-success view-complain" data-toggle="modal" data-target="#viewModal" data-id="{{$complain->id}}"><i class="fa fa-eye" title="Lihat Detail Keluhan"></i></button>
                        @if($complain->status == 0 || $complain->status == 1)
                          @if($complain->status == 1)
                            <button type="button" class="btn btn-xs btn-warning edit-with-confirm" data-toggle="modal" data-target="#confirmEditModal" data-id="{{$complain->id}}"><i class="fa fa-pencil" title="Ubah Data Keluhan"></i></button>
                          @else
                          <button type="button" class="btn btn-xs btn-warning edit-complain" data-toggle="modal" data-target="#editModal" data-id="{{$complain->id}}"><i class="fa fa-pencil" title="Ubah Data Keluhan"></i></button>
                          @endif
                          <button type="button" class="btn btn-xs btn-danger delete-complain" data-toggle="modal" data-target="#deleteModal" data-id="{{$complain->id}}"><i class="fa fa-trash" title="Hapus Data Keluhan"></i></button>
                        @endif
                      </div>
                    </td>
                  @endif
                </tr>
                </div>
                @endforeach
                </tbody>
                @if(Auth::user()->level_user == 2)
                  <tfoot>
                    <tr>
                      <td colspan="8">
                        <button type="button" class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data Keluhan</button>
                      </td>
                    </tr>
                  </tfoot>
                @endif
              </table>
              

                
                <div class="modal fade" id="editModal" role="dialog">
                  @include('app-modal.edit-modal')
                </div>
              <div class="modal fade add-complain-modal" id="addModal" role="dialog">
                @include('app-modal.add-modal')
              </div>
                <div class="modal fade" id="deleteModal" data-id= role="dialog">
                  @include('app-modal.delete-modal')
                </div>
                <div class="modal fade" id="takeModal" role="dialog">
                  @include('app-modal.take-modal')
                </div>
                <div class="modal fade" id="viewModal" role="dialog">
                  @include('app-modal.view-modal')
                </div>
              
              <div class="modal fade" id="confirmEditModal" role="dialog">
                @include('app-modal.edit-confirm-modal')
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        </div>
    </section>
@endsection