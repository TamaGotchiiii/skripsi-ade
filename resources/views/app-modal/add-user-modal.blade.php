<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Tambah Data User</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="form-group" id="inputAddName">
              <label for="">Nama</label>
              <input type="text" id="addName" placeholder="Nama" class="form-control" name="name">
            </div>
            <div class="form-group" id="inputAddEmail">
                <label for="">Email</label>
                <input type="email" name="email" id="addEmail" class="form-control" placeholder="Email">
                <span id="emailStat"></span>
                <input type="hidden" name="" value="0" id="addEmailValue">
            </div>
            <div class="form-group" id="inputAddUsername">
                <label for="">Username</label>
                <input type="text" id="addUsername" class="form-control" name="username" placeholder="Username">
                <span id="usernameStat"></span>
                <input type="hidden" name="" id="addUsernameValue" value="0">
            </div>
            <div class="form-group" id="inputAddPassword">
                <label for="">Password</label>
                <input type="password" name="password" id="addPassword" class="form-control" placeholder="Password">
            </div>
            <div class="form-group" id="inputAddConfirmPass">
                <label for="">Konfirmasi Password</label>
                <input type="password" name="confirmPass" id="addConfirmPass" class="form-control" placeholder="Konfirmasi Password">
                <span id="passStat" style="color:red; font-weight:bold"></span>
            </div>
            <div class="form-group" id="inputAddUnit">
                <label for="">Fakultas/Unit</label>
                <select name="unit" id="addSelectUnit" class="form-control">
                    <option value="">Pilih Fakultas/Unit</option>
                    <option value="add" name="add" data-toggle="modal" data-target="#addUnit">Tambah Unit Baru</option>
                    @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="inputAddLevel">
                <label for="">Level User</label>
                <select name="level" id="addSelectLevel" class="form-control">
                    <option value="">Pilih Level User</option>
                    <option value="0">Admin</option>
                    <option value="1">Supervisor</option>
                    <option value="2">Operator</option>
                </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary" id="submitAddUser">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>