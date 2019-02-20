<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #e08e0b">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Edit Data User</h4>
        </div>
        <div class="modal-body">
          <form action="" class="user-form">
            <div class="form-group name-frame">
              <label for="">Nama</label>
              <input type="text" id="editName{{$user->id}}" class="form-control name-field" name="name" value="{{$user->name}}">
              <b><span class="name-status"></span></b>
            </div>
            <div class="form-group email-frame">
                <label for="">Email</label>
                <input type="email" id="editEmail{{$user->id}}" name="email" class="form-control edit-email-field" data-id="{{$user->id}}" value="{{$user->email}}">
                <b><span class="email-status"></span></b>
            </div>
            <div class="form-group username-frame">
                <label for="">Username</label>
                <input type="text" id="editUsername{{$user->id}}" class="form-control edit-username-field" name="username" data-id="{{$user->id}}" value="{{$user->username}}">
                <b><span class="username-status"></span></b>
            </div>
            <div class="form-group unit-frame">
                <label for="">Fakultas/Unit</label>
                <select name="unit" id="editUnit{{$user->id}}" class="form-control unit-selector">
                    <option value="{{$user->unit_id}}">{{$user->unit->name}}</option>
                    <option value="add" name="add" data-toggle="modal" data-target="#addUnit">Tambah Unit Baru</option>
                    @foreach($units as $unit)
                        @if($unit->id != $user->unit->id)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                        @endif
                    @endforeach
                </select>
                <b><span class="unit-status"></span></b>
            </div>
            <div class="form-group level-frame">
                <label for="">Level User</label>
                <select name="level" id="editLevel{{$user->id}}" class="form-control level-selector">
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
                <b><span class="level-status"></span></b>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary submit-edit-user" data-id="{{$user->id}}">Submit</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>