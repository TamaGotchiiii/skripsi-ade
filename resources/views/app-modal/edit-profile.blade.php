<div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background: #e08e0b">
          <button type="button" style="color: white" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:white"><i class="fa fa-user"></i> Edit Profile</h4>
        </div>
        <div class="modal-body">
          <form action="" class="user-form">
            <div class="form-group profile-name-frame">
              <label for="">Nama</label>
              <input type="text" id="editName" class="form-control edit-name-profile" name="name" value="">
              <b><span class="profile-name-status"></span></b>
            </div>
            <div class="form-group profile-email-frame">
                <label for="">Email</label>
                <input type="email" id="editEmail" name="email" class="form-control edit-email-profile" data-id="{{Auth::user()->id}}">
                <b><span class="profile-email-status"></span></b>
            </div>
            <div class="form-group profile-username-frame">
                <label for="">Username</label>
                <input type="text" id="editUsername" class="form-control edit-username-profile" name="username" data-id="{{Auth::user()->id}}" value="">
                <b><span class="profile-username-status"></span></b>
            </div>
            <div class="form-group unit-frame">
                <label for="">Fakultas/Unit</label>
                <select name="unit" id="editUnit" class="form-control unit-selector-profile">
                    
                </select>
                <b><span class="unit-status"></span></b>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary submit-edit-profile" data-id="{{Auth::user()->id}}" data-level="{{Auth::user()->level_user}}">Submit</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      
</div>