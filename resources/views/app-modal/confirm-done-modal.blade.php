<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Caution!!!</h4>
        </div>
        <div class="modal-body">
          <h4>Apakah Keluhan Ini Telah Selesai?</h4>
          <label for="">Keluhan : </label><br>
          {!! nl2br(e($complain->description)) !!}<br><br>
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-primary">Ya</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
      
</div>