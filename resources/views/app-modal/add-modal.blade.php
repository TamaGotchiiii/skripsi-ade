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
            @if(Auth::user()->level_user == 0)
              <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <select name="" id="" class="form-control">
                  <option value="">Pilih Fakultas/Unit</option>
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
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
</div>