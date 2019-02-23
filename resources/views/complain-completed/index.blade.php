@extends('app-layouts.master-layout')

@section('js')
  <script src="{{asset('js/complain/app.js')}}"></script>
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Keluhan Selesai
      </h1>
    </section>

    <section class="content">
        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Keluhan Selesai</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="text-center" style="vertical-align: middle">No.</th>
                  <th class="text-center  col-lg-2" style="vertical-align: middle">Nama</th>
                  <th class="text-center" style="vertical-align: middle">Unit/Fakultas</th>
                  <th class="text-center col-lg-6" style="vertical-align: middle">Keluhan</th>
                  <th class="text-center" style="vertical-align: middle">Jenis Keluhan</th>
                  <th class="text-center" style="vertical-align: middle">Tanggal Masuk</th>
                  <th class="text-center col-lg-3" style="vertical-align: middle">Status</th>
                  <th class="text-center " style="vertical-align: middle">Ditangani Oleh</th>
                  <th class="text-center col-lg-1" style="vertical-align: middle">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($complains as $complain)
                <tr>
                  <td >{{$x}}</td>
                  <td>{{$complain->name}}</td>
                  <td>{{$complain->unit->name}}</td>
                  <td>{{str_limit($complain->description, $limit = 100, $end = '...')}}</td>
                  <td>{{$complain->complain_type->title}}</td>
                  <td>{{$complain->created_at->format('d M Y')}}</td> 
                  <td style="vertical-align: middle;"><i class="dot-done"></i> Selesai, {{$complain->updated_at->format('d M Y')}}</td>
                  <td style="vertical-align: middle;">{{$complain->user->name}}</td>
                  @if(Auth::user()->level_user != 1)
                    <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-xs btn-success view-complain" data-toggle="modal" data-target="#viewModal" data-id="{{$complain->id}}"><i class="fa fa-eye" title="Lihat Detail Keluhan"></i></button>
                      </div>
                    </td>
                  @endif
                </tr>
                <?php ++$x; ?>
                @endforeach
                </tbody>
              </table>
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