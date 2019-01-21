<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#f39c12">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Edit Data Keluhan</h4>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="name" value="{{$complain->name}}">
            </div>
            @if(Auth::user()->level_user == 0)
              <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <select name="" id="" class="form-control">
                  <option value="{{$complain->unit_id}}">{{$complain->unit->name}}</option>
                  @foreach($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
                </select>
              </div>
            @else
              <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <input type="text" class="form-control" value="{{$user->unit->name}}" readonly>
              </div>
            @endif
            <div class="form-group">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" name="id_number" class="form-control" value="{{$complain->id_number}}">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control" value="{{$complain->email}}">
            </div>
            <div class="form-group">
              <label for="">Keluhan</label>
              <textarea style="white-space: pre-wrap" name="" id="" cols="30" rows="10" class="form-control">{{$complain->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="">Jenis Keluhan</label>
              <select name="" id="" class="form-control">
                <option value="{{$complain->complain_type_id}}">{{$complain->complain_type->title}}</option>
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
            </div>
          </form>
          @if($complain->attachments->count() > 0)
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
                            <button type="button" title="Hapus Lampiran" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteAttachmentModal{{$attachment->id}}"><i class="fa fa-trash"></i></button>
                          </div>
                        </td>
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
          @endif
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>