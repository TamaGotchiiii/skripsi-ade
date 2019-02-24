<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #e08e0b">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white"><i class="fa fa-lock"></i> Ganti Password</h4>
        </div>
        <div class="modal-body">
          <form action="" class="user-form">
            <div class="form-group old-password-frame">
                <label for="">Password Lama</label>
                <input type="password" class="form-control old-password-field">
                <b><span class="old-password-status" style="color:#dd4b39"></span></b>
            </div>
            <div class="form-group new-password-frame">
                <label for="">Password Baru</label>
                <input type="password" class="form-control new-password-field">
            </div>
            <div class="form-group confirm-new-password-frame">
                <label for="">Konfirmasi Password Baru</label>
                <input type="password" class="form-control confirm-new-password-field">
                <b><span class="new-password-status" style="color:#dd4b39"></span></b>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary submit-change-password" data-id="{{Auth::user()->id}}">Submit</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>