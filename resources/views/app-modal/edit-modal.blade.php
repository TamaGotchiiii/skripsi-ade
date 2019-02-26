<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#f39c12">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Edit Data Keluhan</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <input type="hidden" class="edit-complain-status" name="" value="">
            <div class="form-group">
              <label for="">Kode Antrian</label>
              <input type="text" class="form-control edit-complain-code" name="complain_code" readonly value="">
            </div>
            <div class="form-group complain-name-frame">
              <label for="">Nama</label>
              <input type="text" class="form-control complain-name-field edit-complain-name" id="editComplainName" name="name" value="">
              <b><span class="complain-name-status"></span></b>
            </div>
            @if(Auth::user()->level_user == 0)
              <div class="form-group complain-unit-frame">
                <label for="">Fakultas/Unit</label>
                <select name="" id="editComplainUnit" class="form-control complain-select-unit edit-complain-unit">
                </select>
                <b><span class="complain-unit-status"></span></b>
              </div>
            @else
              <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <input type="text" class="form-control edit-complain-unit-field" value="" readonly>
              </div>
            @endif
            <div class="form-group complain-id-frame">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" id="editComplainId" name="id_number" class="form-control complain-id-field edit-complain-id" value="">
              <b><span class="complain-id-status"></span></b>
            </div>
            <div class="form-group complain-email-frame">
              <label for="">Email</label>
              <input type="email" id="editComplainEmail" name="email" class="form-control complain-email-field edit-complain-email" value="">
              <b><span class="complain-email-status"></span></b>
            </div>
            <div class="form-group complain-complain-frame">
              <label for="">Keluhan</label>
              <textarea style="white-space: pre-wrap" name="" id="editComplainComplain" cols="30" rows="10" class="form-control complain-complain-field edit-complain-description"></textarea>
              <b><span class="complain-complain-status"></span></b>
            </div>
            <div class="form-group complain-type-frame">
              <label for="">Jenis Keluhan</label>
              <select name="" id="editComplainType" class="form-control complain-select-type">
                
              </select>
              <b><span class="complain-type-status"></span></b>
            </div>
            <div class="form-group">
              <input type="hidden" id="editAttachmentCounter" name="" value='0'>
              <input type="hidden" name="" value="0" id="editStartCounter">
              <button type="button" class="btn btn-md btn-primary pull-right" id="editAttachmentBtn"><i class="fa fa-plus"></i> Tambah Lampiran</button>
              <label for="">Lampiran</label>
              <!-- tampilan bisa dimaksimalkan menggunakan dropzone.js -->
              <!-- <input multiple="multiple" name="photos[]" type="file"> -->
            </div>
          </form>
         
            <table class="table table-bordered table-striped edit-attachment-table" id="editAttachmentTable">
                  <thead>
                  <tr>
                    <th class="text-center" style="vertical-align: middle">No.</th>
                    <th class="text-center" style="vertical-align: middle">Lampiran</th>
                    <th class="text-center" style="vertical-align: middle">Status File</th>
                    <th class="col-xs-1 text-center" style="vertical-align: middle">Aksi</th>
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
            <div id="editAttachmentField">
            
            </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary edit-submit-complain" data-auth = "{{Auth::user()->level_user}}">Submit</button>
            <button type="button" class="btn btn-warning edit-cancel-complain" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>