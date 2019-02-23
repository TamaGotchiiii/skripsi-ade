@extends('app-layouts.master-layout')

@section('js')
  <script src="{{url('js/unit/app.js')}}"></script>
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Daftar Unit
      </h1>
    </section>

    <section class="content">
        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Daftar Unit</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="text-center col-lg-1" style="vertical-align: middle">No.</th>
                  <th class="text-center" style="vertical-align: middle">Fakultas/Unit</th>
                  <th class="text-center" style="vertical-align: middle">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($units as $unit)
                <tr>
                  <td class="text-center">{{$x}}</td>
                  <td>{{$unit->name}}</td>
                    <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-xs btn-warning edit-unit" data-toggle="modal" data-target="#editUnit" title="Edit User" data-id="{{$unit->id}}"><i class="fa fa-pencil"></i></button>
                        @if($unit->complains->count() == 0)
                            <button class="btn btn-xs btn-danger unit-delete" data-id="{{$unit->id}}" data-toggle="modal" data-target="#deleteUnit" title="Hapus User"><i class="fa fa-trash"></i></button>
                        @endif
                      </div>
                    </td>
                </tr>
                <?php ++$x; ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#addUnit"><i class="fa fa-plus"> Tambah Unit</i></button>
                        </td>
                    </tr>
                </tfoot>
              </table>
              <div class="modal fade" id="addUnit" role="dialog">
                @include('app-modal.add-unit-modal');
              </div>
              <div class="modal fade" id="deleteUnit" role="dialog">
                @include('app-modal.delete-unit');
              </div>
              <div class="modal fade" id="editUnit" role="dialog">
                @include('app-modal.edit-unit');
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        </div>
    </section>
@endsection