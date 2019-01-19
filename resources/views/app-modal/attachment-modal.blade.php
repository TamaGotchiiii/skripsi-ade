<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Caution!!!</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Masukkan Nama Lampiran</label>
            <input type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Pilih File</label>
            <div class="input-group">
                <input type="text" class="form-control" id="filename" readonly placeholder="Pilih File....">
                
                <span class="input-group-btn">
                    <button class="btn btn-primary" id="chooser" type="button">Pilih File!</button>
                </span>
                <input type="file" id="chooseFile" style="display:none">
            </div><!-- /input-group -->
          </div>
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-primary">Ya</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
</div>