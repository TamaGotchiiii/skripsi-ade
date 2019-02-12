<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #00a65a">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Konfirmasi Reset Password</h4>
        </div>
        <div class="modal-body">
          <div class="form-grou">
            <label for="">Konfirmasi Password Admin</label>
            <input type="password" name="" id="confirmReset{{$user->id}}" class="form-control" placeholder="Masukkan Password Admin untuk Mengkonfirmasi Reset Password!">
          </div> 
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-success">Ya</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
      
</div>