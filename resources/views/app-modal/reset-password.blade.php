<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #00a65a">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Reset Password!!</h4>
        </div>
        <div class="modal-body">
          <h4>
            Apakah Anda Yakin Ingin Me-reset password User Ini?
          </h4>
          <label for="">Nama : {{$user->name}}</label>  
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#confirmReset{{$user->id}}">Ya</button>
            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
      
</div>