<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Tambah Data User</h4>
        </div>
        <div class="modal-body">
          <form action="" id="addUserForm" class="user-form">
            <div class="form-group name-frame" id="inputAddName">
              <label for="">Nama</label>
              <input type="text" id="addName" placeholder="Nama" class="form-control name-field" name="name">
              <b><span id="addNameStat" class="name-status"></span></b>
            </div>
            <div class="form-group email-frame" id="inputAddEmail">
                <label for="">Email</label>
                <input type="email" name="email" id="addEmail" class="form-control email-field" placeholder="Email">
                <span id="addEmailStat" class="email-status"></span>
                <input type="hidden" class="email-value" name="" value="0" id="addEmailValue">
            </div>
            <div class="form-group username-frame" id="inputAddUsername">
                <label for="">Username</label>
                <input type="text" id="addUsername" class="form-control username-field" name="username" placeholder="Username">
                <span id="addUsernameStat" class="username-status"></span>
                <input type="hidden" name="" id="addUsernameValue" class="username-value" value="0">
            </div>
            <div class="form-group password-frame" id="inputAddPassword">
                <label for="">Password</label>
                <input type="password" name="password" id="addPassword" class="form-control" placeholder="Password">
            </div>
            <div class="form-group confirm-pass-frame" id="inputAddConfirmPass">
                <label for="">Konfirmasi Password</label>
                <input type="password" name="confirmPass" id="addConfirmPass" class="form-control" placeholder="Konfirmasi Password">
                <span id="addPassStat" class="password-status" style="font-weight:bold"></span>
            </div>
            <div class="form-group unit-frame" id="inputAddUnit">
                <label for="">Fakultas/Unit</label>
                <select name="unit" id="addSelectUnit" class="form-control unit-selector">
                    <option value="">Pilih Fakultas/Unit</option>
                    <option value="add" name="add" data-toggle="modal" data-target="#addUnit">Tambah Unit Baru</option>
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                </select>
                <b><span class="unit-status" id="addSelectUnitStat"></span></b>
                
            </div>
            <div class="form-group level-frame" id="inputAddLevel">
                <label for="">Level User</label>
                <select name="level" id="addSelectLevel" class="form-control level-selector">
                    <option value="">Pilih Level User</option>
                    <option value="0">Admin</option>
                    <option value="1">Supervisor</option>
                    <option value="2">Operator</option>
                </select>
                <b><span id="addSelectLevelStat" class="level-status"></span></b>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary" id="submitAddUser">Submit</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>