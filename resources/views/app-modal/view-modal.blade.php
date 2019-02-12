<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#449d44">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Detail Keluhan</h4>
        </div>
        <div class="modal-body">
          @if($complain->status != 0)
            <label for="">Ditangani Oleh</label>
            <input type="text" readonly class="form-control" value="{{$complain->user->name}}">
          @endif
          <br>
            <div class="form-group">
              <label for="">Kode Antrian</label>
              <input type="text" class="form-control" name="complain_code" readonly value="{{$complain->complain_code}}">
            </div>
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="name" readonly value="{{$complain->name}}">
            </div>
            <div>
              <label for="">Fakultas/Unit</label>
              <input type="text" class="form-control" readonly value="{{$complain->unit->name}}">
            </div>
            <div class="form-group">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" name="id_number" class="form-control" readonly value="{{$complain->id_number}}">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control" readonly value="{{$complain->email}}">
            </div>
            <div class="form-group">
              <label for="">Keluhan</label>
              <textarea style="white-space: pre-wrap" name="" id="" cols="30" rows="10" class="form-control" readonly>{{$complain->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="">Jenis Keluhan</label>
              <input type="text" class="form-control" value="{{$complain->complain_type->title}}" readonly>
            </div>
          </form>
          @if($complain->attachments->count() > 0)
            <div class="form-group">
              <label for="">Lampiran</label>
              <!-- tampilan bisa dimaksimalkan menggunakan dropzone.js -->
              <!-- <input multiple="multiple" name="photos[]" type="file"> -->
            </div>
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