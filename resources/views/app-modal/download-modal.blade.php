<div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Caution!!!</h4>
        </div>
        <div class="modal-body">
          <h4>Download lampiran Keluhan ini?</h4>
          <table id="1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center" style="vertical-align: middle">No.</th>
                    <th class="text-center" style="vertical-align: middle">Lampiran</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                  <div class="attachment-table">
                    @foreach($complain->attachments as $attachment)
                      <tr>
                        <td >{{$x}}</td>
                        <td>{{$attachment->title}}</td>
                      </tr>
                      <?php ++$x; ?>
                    @endforeach
                  </div>
                  </tbody>
                  <!-- <tfoot>
                    <tr>
                      <td colspan="9" class="text-center">
                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data Keluhan</button>
                      </td>
                    </tr>
                  </tfoot> -->
            </table>
        </div>
        <div class="modal-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-lg btn-primary">Ya</button>
            <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Tidak</button>
          </div>
        </div>
      </div>
      
</div>