<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#449d44">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Detail Keluhan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group handle-by">
            <label for="">Ditangani Oleh</label>
            <input type="text" readonly class="form-control handle-by-field" value="">
          </div>
            <div class="form-group">
              <label for="">Kode Antrian</label>
              <input type="text" class="form-control view-complain-code" name="complain_code" readonly value="">
            </div>
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control view-complain-name" name="name" readonly value="">
            </div>
            <div>
              <label for="">Fakultas/Unit</label>
              <input type="text" class="form-control view-complain-unit" readonly value="">
            </div>
            <div class="form-group">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" name="id_number" class="form-control view-complain-id" readonly value="">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control view-complain-email" readonly value="">
            </div>
            <div class="form-group">
              <label for="">Keluhan</label>
              <textarea style="white-space: pre-wrap" name="" id="" cols="30" rows="10" class="form-control view-complain-description" readonly></textarea>
            </div>
            <div class="form-group">
              <label for="">Jenis Keluhan</label>
              <input type="text" class="form-control view-complain-type" value="" readonly>
            </div>
          </form>
            <div class="form-group">
              <label for="">Lampiran</label>
              <!-- tampilan bisa dimaksimalkan menggunakan dropzone.js -->
              <!-- <input multiple="multiple" name="photos[]" type="file"> -->
            </div>
            <table class="table table-bordered table-striped" id="viewAttachment">
                  <thead>
                  <tr>
                    <th class="text-center" style="vertical-align: middle">No.</th>
                    <th class="text-center" style="vertical-align: middle">Lampiran</th>
                    <th class="text-center" style="vertical-align: middle">Status File</th>
                  </tr>
                  </thead>
                  <tbody>
                  
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
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>