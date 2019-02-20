<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white">Tambah Data Keluhan</h4>
        </div>
        <div class="modal-body">
          <form action="" id="addComplainForm">
            <div class="form-group complain-name-frame">
              <label for="">Nama</label>
              <input type="text" class="form-control complain-name-field" name="name" id="addComplainName">
              <b><span class="complain-name-status"></span></b>
            </div>
            @if(Auth::user()->level_user == 0)
              <div class="form-group complain-unit-frame">
                <label for="">Fakultas/Unit</label>
              <select name="" id="addComplainUnit" class="form-control complain-select-unit">
                  <option value="">Pilih Fakultas/Unit</option>
                  @foreach($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
                </select>
                <b><span class="complain-unit-status"></span></b>
              </div>
            @else
              <div class="form-group">
                <label for="">Fakultas/Unit</label>
                <input type="text" class="form-control complain-select-unit" id="addComplainUnit" value="{{$user->unit->name}}" readonly>
              </div>
            @endif
            <div class="form-group complain-id-frame">
              <label for="">No. Identitas/NIM/NIP</label>
              <input type="text" id="addComplainId" name="id_number" class="form-control complain-id-field">
              <b><span class="complain-id-status"></span></b>
            </div>
            <div class="form-group complain-email-frame">
              <label for="">Email</label>
              <input type="email" id="addComplainEmail" name="email" class="form-control complain-email-field">
              <b><span class="complain-email-status"></span></b>
            </div>
            <div class="form-group complain-complain-frame">
              <label for="">Keluhan</label>
              <textarea name="" id="addComplainComplain" cols="30" rows="10" class="form-control complain-complain-field"></textarea>
              <b><span class="complain-complain-status"></span></b>
            </div>
            <div class="form-group complain-type-frame">
              <label for="">Jenis Keluhan</label>
              <select name="" id="addComplainType" class="form-control complain-select-type">
                <option value="">Pilih Jenis Keluhan</option>
                @foreach($complain_types as $type)
                    @if($complain->complain_type_id != $type->id)
                        <option value="{{$type->id}}">{{$type->title}}</option>
                    @endif
                @endforeach
              </select>
              <b><span class="complain-type-status"></span></b>
            </div>
            <div class="form-group">
              <input type="hidden" class="attachment-counter" value="0">
              <button type="button" class="btn btn-md btn-primary pull-right add-attachment"><i class="fa fa-plus"></i> Tambah Lampiran</button>
              <label for="">Lampiran</label>
              <!-- tampilan bisa dimaksimalkan menggunakan dropzone.js -->
              <!-- <input multiple="multiple" name="photos[]" type="file"> -->
              <!-- <input type="file"> -->
            </div>
          </form>
          <table class="table table-bordered table-striped attachment-table" id="addAttachment">
            <thead>
              <tr>
                <th class="text-center" style="vertical-align:middle">No.</th>
                <th class="text-center" style="vertical-align:middle">Lampiran</th>
                <th class="text-center" style="vertical-align:middle">Status File</th>
                <th class="col-xs-1 text-center" style="vertical-align:middle">aksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <div id="addAttachmentField">

          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary add-submit-complain">Submit</button>
            <button type="button" class="btn btn-warning add-cancel-complain" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>