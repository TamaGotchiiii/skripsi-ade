<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #e08e0b">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Edit Data User</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" id="editName{{$user->id}}" class="form-control" name="name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" id="editEmail{{$user->id}}" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" id="editUsername{{$user->id}}" class="form-control" name="username" value="{{$user->username}}">
            </div>
            <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <select name="unit" id="editUnit{{$user->id}}" class="form-control">
                    <option value="{{$user->unit}}">{{$user->unit->name}}</option>
                    <option value="add" name="add" data-toggle="modal" data-target="#addUnit">Tambah Unit Baru</option>
                    @foreach($units as $unit)
                        @if($unit->id != $user->unit->id)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Level User</label>
                <select name="level" id="editLevel{{$user->id}}" class="form-control">
                    <option value="{{$user->level_user}}">
                        @if($user->level_user == 0)
                            Admin
                        @elseif($user->level_user == 1)
                            Supervisor
                        @else
                            Operator
                        @endif
                    </option>
                    @if($user->level_user != 0)
                        <option value="0">Admin</option>
                    @endif
                    @if($user->level_user != 1)
                        <option value="1">Supervisor</option>
                    @endif
                    @if($user->level_user != 2)
                        <option value="2">Operator</option>
                    @endif
                </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>