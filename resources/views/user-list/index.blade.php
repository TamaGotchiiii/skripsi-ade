@extends('app-layouts.master-layout')

@section('content')
    <section class="content-header">
      <h1>
        Daftar User
      </h1>
    </section>

    <section class="content">
        <!-- info box -->
        <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Tabel Daftar User</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="text-center" style="vertical-align: middle">No.</th>
                  <th class="text-center" style="vertical-align: middle">Nama</th>
                  <th class="text-center" style="vertical-align: middle">Fakultas/Unit</th>
                  <th class="text-center" style="vertical-align: middle">Username</th>
                  <th class="text-center" style="vertical-align: middle">Email</th>
                  <th class="text-center" style="vertical-align: middle">Level User</th>
                  <th class="text-center" style="vertical-align: middle">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $x = 1; ?>
                @foreach($users as $user)
                <tr>
                  <td >{{$x}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->unit->name}}</td>
                  <td>{{$user->username}}</td>
                  <td>{{$user->email}}</td>
                  @if($user->level_user == 0)
                    <td>Admin</td>
                  @elseif($user->level_user == 1)
                    <td>Supervisor</td>
                  @else
                    <td>Operator</td>
                  @endif 
                    <td style="vertical-align: middle;" class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#resetPass{{$user->id}}" title="Reset Password"><i class="fa fa-key"></i></button>
                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal{{$user->id}}" title="Edit User"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal{{$user->id}}" title="Hapus User"><i class="fa fa-trash"></i></button>
                      </div>
                    </td>
                </tr>
                <?php ++$x; ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <button class="btn btn-md btn-primary pull-right" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"> Tambah User</i></button>
                        </td>
                    </tr>
                </tfoot>
              </table>
              @foreach($users as $user)
                <div class="modal fade" id="deleteModal{{$user->id}}" role="dialog">
                    @include('app-modal.delete-user')
                </div>
                <div class="modal fade" id="editModal{{$user->id}}" role="dialog">
                  @include('app-modal.edit-user')
                </div>
                <div class="modal fade" id="resetPass{{$user->id}}" role="dialog">
                  @include('app-modal.reset-password')
                </div>
                <div class="modal fade" id="confirmReset{{$user->id}}" role="dialog">
                  @include('app-modal.confirm-reset')
                </div>
              @endforeach
              <div class="modal fade" id="addUser" role="dialog">
                @include('app-modal.add-user-modal')
              </div>
              <div class="modal fade" id="addUnit" role="dialog">
                @include('app-modal.add-unit-modal')
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            </div>
        </div>
    </section>
@endsection