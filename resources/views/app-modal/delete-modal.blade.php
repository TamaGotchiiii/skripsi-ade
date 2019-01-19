<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #dd4b39">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Warning!!!</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah Anda Yakin Ingin Menghapus Data Keluhan Ini?</h4>
          <label for="">Keluhan : </label><br>
          {!! nl2br(e($complain->description)) !!}<br><br>  
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-danger">Ya</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
      
</div>