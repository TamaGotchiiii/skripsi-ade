<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Tambah Data Keluhan</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" name="id_number" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="">Keluhan</label>
              <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="">Jenis Keluhan</label>
              <select name="" id="" class="form-control">
                <option value="null">Pilih Jenis Keluhan</option>
                @foreach($complain_types as $type)
                    @if($complain->complain_type_id != $type->id)
                        <option value="{{$type->id}}">{{$type->title}}</option>
                    @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-md btn-primary pull-right addFile" data-toggle="modal" data-target="#attachmentModal"><i class="fa fa-plus"></i> Tambah Lampiran</button>
              <label for="">Lampiran</label>
              <!-- tampilan bisa dimaksimalkan menggunakan dropzone.js -->
              <!-- <input multiple="multiple" name="photos[]" type="file"> -->
              <!-- <input type="file"> -->
            </div>
          </form>
          <!-- @if($complain->attachments->count() > 0)
            <table id="1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center" style="vertical-align: middle">No.</th>
                    <th class="text-center" style="vertical-align: middle">Lampiran</th>
                    <th class="col-xs-1 text-center" style="vertical-align: middle">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $x = 1; ?>
                  <div class="attachment-table">
                    @foreach($complain->attachments as $attachment)
                      <tr>
                        <td >{{$x}}</td>
                        <td>{{$attachment->title}}</td>
                        <td style="vertical-align: middle;" class="text-center">
                          <div class="btn-group">
                            <button type="button" title="Lihat Lampiran" class="btn btn-xs btn-success" data-toggle="modal" data-target="#viewAttachmentModal{{$attachment->id}}"><i class="fa fa-eye"></i></button>
                            <button type="button" title="Hapus Lampiran" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteAttachmentModal{{$attachment->id}}"><i class="fa fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                      <?php ++$x; ?>
                    @endforeach
                  </div>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="9" class="text-center">
                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Tambah Data Keluhan</button>
                      </td>
                    </tr>
                  </tfoot> -->
            </table>
          @endif -->
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>