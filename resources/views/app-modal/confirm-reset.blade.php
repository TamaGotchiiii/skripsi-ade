<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #00a65a">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Konfirmasi Reset Password</h4>
        </div>
        <div class="modal-body">
          <div class="form-group pass-admin-frame">
            <label for="">Konfirmasi Password Admin</label>
            <input type="password" id="confirmPass{{$user->id}}" data-id="{{$user->id}}" class="form-control pass-admin-field" placeholder="Masukkan Password Admin untuk Mengkonfirmasi Reset Password!">
            <b><span class="pass-admin-status"></span></b>
          </div> 
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" data-id="{{$user->id}}" class="btn btn-lg btn-success confirm-reset-password">Submit</button>
            <button type="button" class="btn btn-lg btn-danger cancel-reset-password" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>