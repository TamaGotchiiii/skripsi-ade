$(document).ready(function(){
  //change frame if selector unit change
  $('.unit-selector').change(function(){
    val = $(this).val();
    /*
      this if statement will trigger if user want to add new unit
      if this if statement trigger the modal to add new unit will appear
    */ 
    if(val == "add"){
      $('#addUnit').modal('toggle');
    }
    /**
     * if user change the selector to the null value
     * then the frame of the selector will become red
     * after that, the text of error will appear below the selector
     * 
     * if user change the selector into a value
     * then the frame of the selector will become green
     * and the text of error will disappear
     */
    if(val == ''){
      $('.unit-frame').removeClass('has-success').addClass('has-error');
      $('.unit-status').css('color', '#dd4b39');
      $('.unit-status').html('Silahkan pilih unit fakultas user!');
    }else{
      $('.unit-frame').removeClass('has-error').addClass('has-success');
      $('.unit-status').html('');
    }
  });

  /**
   * this function is for reseting the form if user cancel adding new unit
   */
  $('#addUnit').on('hidden.bs.modal', function(){
    let val = $('#addSelectUnit').val();
    /**
     * if user does not cancel adding unit
     * then the selector value will of selector will automatically select the first value of selector
     */
    if(val == 'add'){
      $('.unit-selector').val('');
      $('.unit-frame').removeClass('has-success').addClass('has-error');
      $('.unit-status').html('');
    }
  });
  
  /**
   * function after submitting new unit
   * if when submitting the new unit and the unit is already added
   * then proceed without adding it to the database
   * else add it to the database
   */
  $(document).on('click', 'button#addUnitBtn', function(){
    $('#addUnit').modal('hide');
    newFakultas = $('#addFakultas').val();
    /**
    * add the new submit value to the selector
    */
   //reevaluate this(done)
    $('.unit-selector').prepend(
      "<option value='"+newFakultas+"'>"+newFakultas+'</option>').val(newFakultas);
    //end
    /**
     * Ajax to add unit
     */
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/user-submit-unit',
      data: {
        newFakultas
      },
      dataType: 'html',
      method: 'POST',
      success: function(response){
        console.log(response);
      }
    });
  });

  /**
   * function for checking everytime user change the value of selector
   * if the value is empty then change the frame of selector to red
   * and the error message will appear
   * 
   * if it is change to any value, then the frame will change to green
   * and the error message will disappear
   */
  $(document).on('change', '.level-selector', function(){
    let val = $(this).val();
    if(val == ''){
      $('.level-frame').removeClass('has-success').addClass('has-error');
      $('.level-status').css('color', '#dd4b39');
      $('.level-status').html('Silahkan pilih level user!');
    }else{
      $('.level-frame').removeClass('has-error').addClass('has-success');
      $('.level-status').html('');
    }
  });


  /**
   * function for checking password and password confirmation
   * this function will give message according to the status of 
   * the password and the confirmation password to the user about 
   * the password and the confirmation
   */
  $(document).on('keyup', '#addConfirmPass, #addPassword', function(){
    let passVal = $('#addPassword').val();
    let confPass = $('#addConfirmPass').val();
    if(passVal.length < 8){
      $('#addPassStat').html('Password min. 8 karakter!');
      $('#inputAddPassword').removeClass('has-success').addClass('has-error');
      $('#inputAddConfirmPass').removeClass('has-success').addClass('has-error');
      $('#addPassStat').css('color', '#dd4b39');
    }else if(passVal.length >= 8 && confPass == ''){
      $('#addPassStat').html('Masukkan konfirmasi password!');
      $('#inputAddPassword').removeClass('has-success').addClass('has-error');
      $('#inputAddConfirmPass').removeClass('has-success').addClass('has-error');
      $('#addPassStat').css('color', '#dd4b39');
    }else{
      if(passVal != '' && confPass != ''){
        if(passVal != confPass){
          $('#addPassStat').css('color', '#dd4b39');
          $('#addPassStat').html('Password tidak cocok');
          $('#inputAddPassword').removeClass('has-success').addClass('has-error');
          $('#inputAddConfirmPass').removeClass('has-success').addClass('has-error');
        }else{
          $('#addPassStat').css('color','#00a65a');
          $('#addPassStat').html('Password Cocok');
          $('#inputAddPassword').removeClass('has-error').addClass('has-success');
          $('#inputAddConfirmPass').removeClass('has-error').addClass('has-success');
        }
      }else{
        $('#addPassStat').html('');
        $('#inputAddPassword').removeClass('has-error has-success');
        $('#inputAddConfirmPass').removeClass('has-error has-success');
      }
    }
  });

  /**
   * this function will act as the validation for the front end of
   * the web
   */
  $(document).on('click', '#submitAddUser', function(){
    let name = $('#addName').val();
    let email = $('#addEmail').val();
    let username = $('#addUsername').val();
    let password = $('#addPassword').val();
    let confPass = $('#addConfirmPass').val();
    let unit = $('#addSelectUnit').val();
    let level = $('#addSelectLevel').val();
    let emailVal = $('#addEmailValue').val();
    let usernameVal = $('#addUsernameValue').val();
    if(name != '' && email != '' && username != '' && password != '' && confPass != '' && unit != '' && level != '' && password.length >= 8 && confPass.length >= 8 && password == confPass && username.length >= 5 && emailVal != 0 && usernameVal != 0){
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/submit-user',
        data: {
          name,
          email,
          username,
          password,
          password_confirmation : confPass,
          unit,
          level
        },
        dataType: 'html',
        method: 'POST',
        success: function(response){
          let result = JSON.parse(response);
          if(result.errors == false){
            alert('Berhasil menambahkan user!');
            window.location.reload();
          }else{
            let emailStatus = '';
            let usernameStatus = '';
            if(result.usernameDuplicate != 0){
              usernameStatus = 'Username telah digunakan!';
              $('.username-frame').removeClass('has-success').addClass('has-error');
              $('.username-status').css({'color': 'red', 'font-weight': 'bold'});
              $('.username-status').html('Username telah digunakan!');
            }
            if(result.emailDuplicate != 0){
              emailStatus = 'Email telah digunakan!';
              $('.email-frame').removeClass('has-success').addClass('has-error');
              $('.email-status').css({'color': 'red', 'font-weight': 'bold'});
              $('.email-status').html('Email telah digunakan!');
            }
            alert('Silahkan periksa kembali data-data yang telah dimasukkan!\n- '+usernameStatus+'\n- '+emailStatus);
          }
        }, 
        error: function(response){
          console.log(response);
        }
      });
    }else{
      if(level == ''){
        $('.level-frame').addClass('has-error');
        $('.level-status').css('color', '#dd4b39');
        $('.level-status').html('Silahkan pilih level user!');
      }
      if(unit == ''){
        $('.unit-frame').addClass('has-error');
        $('.unit-status').css('color', '#dd4b39');
        $('.unit-status').html('Silahkan pilih unit/fakultas user!');
      }
      if(password.length < 8 || confPass.length < 8 || password != confPass){
        $('#addPassword').focus();
      }
      if(confPass == ''){
        $('#inputAddConfirmPass').addClass('has-error');
        $('#addConfirmPass').focus();
        $('#addPassStat').css('color', '#dd4b39');
        $('#addPassStat').html('Masukkan Password & Konfirmasi Password!');
      }
      if(password == ''){
        $('#inputAddPassword').addClass('has-error');
        $('#addPassword').focus();
        $('#addPassStat').css('color', '#dd4b39');
        $('#addPassStat').html('Masukkan Password & Konfirmasi Password!');
      }
      
      if(username == ''){
        $('.username-frame').addClass('has-error');
        $('.username-field').focus();
        $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.username-status').html('Field Username tidak boleh kosong!');
      }else if(hasSpaceOrSpecialCharacter(username) || username.length < 5 || usernameVal == 0){
        $('.username-field').focus();
      }
      if(email == ''){
        $('.email-frame').addClass('has-error');
        $('.email-field').focus();
        $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.email-status').html('Field Email tidak boleh kosong!');
      }else if(!isEmail(email) || emailVal == 0){
        $('.email-field').focus();
      }
      if(name == ''){
        $('.name-frame').addClass('has-error');
        $('.name-field').focus();
        $('.name-status').css('color', '#dd4b39');
        $('.name-status').html('Field Nama tidak boleh kosong!');
      }
    }
    
  });

  /**
   * this is a function for checking Name field
   * everytime user type in the keyboard
   * this function will trigger and give a status message 
   * according to the condition of the Name field
   * and change the color of the frame according to that status
   */
  $(document).on('keyup', '.name-field', function(){
    let val = $(this).val();
    if(val == ''){
      $('.name-frame').removeClass('has-success').addClass('has-error');
      $('.name-status').css('color', '#dd4b39');
      $('.name-status').html('Field Nama tidak boleh kosong!');
    }else{
      $('.name-frame').removeClass('has-error').addClass('has-success');
      $('.name-status').html('');
    }
  });

  /**
   * in this function everytime user type on email field
   * this function will check if the value is email or not
   * if the value is an email than this function will check
   * to the database for email duplication
   * 
   * this function will also give status message and change frame  
   */ 
  $(document).on('keyup', '.email-field', function(){
    let email = $(this).val();
    if(email == ''){
      $('.email-frame').removeClass('has-success').addClass('has-error');
      $('.email-status').html('Field Email tidak boleh kosong!');
      $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
      $('.email-value').val('0');
    }else{
      if(!isEmail(email)){
        $('.email-frame').removeClass('has-success').addClass('has-error');
        $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.email-status').html('Email tidak valid!');
        $('.email.value').val('0');
      }else{
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: 'check-email',
          method: 'POST',
          data : {email},
          dataType: 'html',
          success: function(response){
            let result = JSON.parse(response);
            if(result.userCount == 0){
              $('.email-frame').removeClass('has-error').addClass('has-success');
              $('.email-status').css({'color': '#00a65a', 'font-weight':'bold'});
              $('.email-status').html('Email dapat digunakan!');
              $('.email-value').val('1');
            }else{
              $('.email-frame').removeClass('has-success').addClass('has-error');
              $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
              $('.email-status').html('Email telah digunakan!');
              $('.email-value').val('0');
            }
          }
        });
      }
    }
  });

  /**
   * in this function everytime user type in Username field
   * this function will check if there are space or
   * special character, if not then this function will check
   * for username duplication on the database.
   * 
   * this function will give user status message of the username
   * and change the color of the frame according to the status
   */
  $(document).on('keyup', '.username-field', function(){
    let username = $(this).val();
    if(username == ''){
      $('.username-frame').removeClass('has-success').addClass('has-error');
      $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
      $('.username-status').html('Field Username tidak boleh kosong!');
      $('.username-value').val('0');
    }else if(hasSpaceOrSpecialCharacter(username)){
      $('.username-frame').removeClass('has-success').addClass('has-error');
      $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
      $('.username-status').html('Username tidak boleh mengandung spasi,  Username hanya dapat mengandung angka dan huruf!');
      $('.username-value').val('0'); 
    }else if(username.length < 5){
      $('.username-frame').removeClass('has-success').addClass('has-error');
      $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
      $('.username-status').html('Username min. 5 karakter!');
      $('.username-value').val('0'); 
    }else{
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'check-username',
        method: 'POST',
        data: {username},
        dataType: 'html',
        success: function(response){
          let result = JSON.parse(response);
          if(result.userCount == 0){
            $('.username-frame').removeClass('has-error').addClass('has-success');
            $('.username-status').css({'color': '#00a65a', 'font-weight': 'bold'});
            $('.username-status').html('Username dapat digunakan!');
            $('.username-value').val('1');
          }else{
            $('.username-frame').removeClass('has-success').addClass('has-error');
            $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
            $('.username-status').html('Username telah digunakan!');
            $('.username-value').val('0');
          } 
        }
      });
    }
  });
  
  /**
   * this function will trigger if user close addUser modal
   * 
   * this function will reset all field, selector and any value
   * to the default
   */
  $('#addUser').on('hidden.bs.modal', function (){
    $('form#addUserForm')[0].reset();
    $('.name-status').html('');
    $('.email-status').html('');
    $('.username-status').html('');
    $('.password-status').html('');
    $('.unit-status').html('');
    $('.level-status').html('');
    $('#addSelectorUnit').val('');
    $('.username-value').val('0');
    $('.email-value').val('0');
    $('.name-frame').removeClass('has-error has-success');
    $('.email-frame').removeClass('has-error has-success');
    $('.username-frame').removeClass('has-error has-success');
    $('.password-frame').removeClass('has-error has-success');
    $('.confirm-pass-frame').removeClass('has-error has-success');
    $('.unit-frame').removeClass('has-error has-success');
    $('.level-frame').removeClass('has-error has-success');
  });

  /**
   * this function will trigger if user close editUser modal
   * 
   * this function will reset all field, selector and any value
   * to the default
   */
  $('.edit-user-modal').on('hidden.bs.modal', function(){
    $('.name-status').html('');
    $('.email-status').html('');
    $('.username-status').html('');
    $('.password-status').html('');
    $('.unit-status').html('');
    $('.level-status').html('');
    $('#addSelectorUnit').val('');
    $('.username-value').val('0');
    $('.email-value').val('0');
    $('.name-frame').removeClass('has-error has-success');
    $('.email-frame').removeClass('has-error has-success');
    $('.username-frame').removeClass('has-error has-success');
    $('.password-frame').removeClass('has-error has-success');
    $('.confirm-pass-frame').removeClass('has-error has-success');
    $('.unit-frame').removeClass('has-error has-success');
    $('.level-frame').removeClass('has-error has-success');
  });

  $('.confirm-pass').on('hidden.bs.modal', function(){
    $('.pass-admin-field').val('');
    $('.pass-admin-frame').removeClass('has-success has-error');
    $('.pass-admin-status').html('');
  });
  /**
   * this function is for deleting user from the table
   * and then refreshing the web page
   */

   $(document).on('click', '.delete-user', function(){
      let el = $(this),
        id = el.data('id');
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/delete-user',
        method: 'DELETE',
        dataType: 'html',
        data: {
          id
        },
        success: function(response){
          console.log(response);
          alert('Berhasil hapus data user!');
          window.location.reload();
        },
        fails: function(response){
          console.log(response);
        }
      });
   });

   /**
    * this function is for field email in edit form
    * this function will send the email value everytime user typed
    * the value in email field
    */
   $(document).on('keyup', '.edit-email-field', function(){
      let el = $(this),
        id = el.data('id');
      let email = $(this).val();
      if(email == ''){
        $('.email-frame').removeClass('has-success').addClass('has-error');
        $('.email-status').html('Field Email tidak boleh kosong!');
        $('.email-value').val('0');
      }else{
        if(!isEmail(email)){
          $('.email-frame').removeClass('has-success').addClass('has-error');
          $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
          $('.email-status').html('Email tidak valid!');
          $('.email.value').val('0');
        }else{
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'check-edit-email',
            method: 'POST',
            data : {
              email,
              id
            },
            dataType: 'html',
            success: function(response){
              let result = JSON.parse(response);
              if(result.errors == false){
                $('.email-frame').removeClass('has-error').addClass('has-success');
                $('.email-status').css({'color': '#00a65a', 'font-weight':'bold'});
                $('.email-status').html('Email dapat digunakan!');
                $('.email-value').val('1');
              }else{
                $('.email-frame').removeClass('has-success').addClass('has-error');
                $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
                $('.email-status').html('Email telah digunakan!');
                $('.email-value').val('0');
              }
            }
          });
        }
      }
      
   });

   /**
    * this function will check the value of the username in edit form
    * and make sure if the value does not change user can still submit
    * the form 
    */
   $(document).on('keyup', '.edit-username-field', function(){
      let el = $(this),
        id = el.data('id');
      let username = $(this).val();
      if(username == ''){
        $('.username-frame').removeClass('has-success').addClass('has-error');
        $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.username-status').html('Field Username tidak boleh kosong!');
        $('.username-value').val('0');
      }else if(hasSpaceOrSpecialCharacter(username)){
        $('.username-frame').removeClass('has-success').addClass('has-error');
        $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.username-status').html('Username tidak boleh mengandung spasi,  Username hanya dapat mengandung angka dan huruf!');
        $('.username-value').val('0'); 
      }else if(username.length < 5){
        $('.username-frame').removeClass('has-success').addClass('has-error');
        $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.username-status').html('Username min. 5 karakter!');
        $('.username-value').val('0'); 
      }else{
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: 'check-edit-username',
          method: 'POST',
          data: {
            username,
            id
          },
          dataType: 'html',
          success: function(response){
            let result = JSON.parse(response);
            if(result.errors == false){
              $('.username-frame').removeClass('has-error').addClass('has-success');
              $('.username-status').css({'color': '#00a65a', 'font-weight': 'bold'});
              $('.username-status').html('Username dapat digunakan!');
              $('.username-value').val('1');
            }else{
              $('.username-frame').removeClass('has-success').addClass('has-error');
              $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
              $('.username-status').html('Username telah digunakan!');
              $('.username-value').val('0');
            } 
          }
        });
      }
   });

   /**
    * this function is for submit all value after user done edit the data
    */
  $(document).on('click', '.submit-edit-user', function(){
    let el = $(this),
        id = el.data('id');
    let name = $('#editName'+id).val();
    let email = $('#editEmail'+id).val();
    let username = $('#editUsername'+id).val();
    let unit = $('#editUnit'+id).val();
    let level = $('#editLevel'+id).val();
    let emailVal = $('#editEmailValue'+id).val();
    let usernameVal = $('#editUsernameValue'+id).val();
    if(name != '' && email != '' && username != '' && unit != '' && level != '' && username.length >= 5 && emailVal != 0 && usernameVal != 0){
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/update-user',
        data: {
          id,
          name,
          email,
          username,
          unit,
          level
        },
        dataType: 'html',
        method: 'POST',
        success: function(response){
          let result = JSON.parse(response);
          if(result.errors == false){
            alert('Berhasil mengubah user!');
            window.location.reload();
          }else{
            let emailStatus = '';
            let usernameStatus = '';
            if(result.usernameDuplicate != 0){
              usernameStatus = 'Username telah digunakan!';
              $('.username-frame').removeClass('has-success').addClass('has-error');
              $('.username-status').css({'color': 'red', 'font-weight': 'bold'});
              $('.username-status').html('Username telah digunakan!');
            }
            if(result.emailDuplicate != 0){
              emailStatus = 'Email telah digunakan!';
              $('.email-frame').removeClass('has-success').addClass('has-error');
              $('.email-status').css({'color': 'red', 'font-weight': 'bold'});
              $('.email-status').html('Email telah digunakan!');
            }
            alert('Silahkan periksa kembali data-data yang telah dimasukkan!\n- '+usernameStatus+'\n- '+emailStatus);
          }
        }, 
        error: function(response){
          console.log(response);
        }
      });
    }else{
      if(level == ''){
        $('.level-frame').addClass('has-error');
        $('.level-status').css('color', '#dd4b39');
        $('.level-status').html('Silahkan pilih level user!');
      }
      if(unit == ''){
        $('.unit-frame').addClass('has-error');
        $('.unit-status').css('color', '#dd4b39');
        $('.unit-status').html('Silahkan pilih unit/fakultas user!');
      }
      
      if(username == ''){
        $('.username-frame').addClass('has-error');
        $('.username-field').focus();
        $('.username-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.username-status').html('Field Username tidak boleh kosong!');
      }else if(hasSpaceOrSpecialCharacter(username) || username.length < 5 || usernameVal == 0){
        $('.username-field').focus();
      }
      if(email == ''){
        $('.email-frame').addClass('has-error');
        $('.email-field').focus();
        $('.email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        $('.email-status').html('Field Email tidak boleh kosong!');
      }else if(!isEmail(email) || emailVal == 0){
        $('.email-field').focus();
      }
      if(name == ''){
        $('.name-frame').addClass('has-error');
        $('.name-field').focus();
        $('.name-status').css('color', '#dd4b39');
        $('.name-status').html('Field Nama tidak boleh kosong!');
      }
    } 
   });

   /**
    * this function will trigger if user(admin) agree to reset the 
    * password by entering his/her password
    */
  $(document).on('click', '.confirm-reset-password', function(){
    let el = $(this),
      id = el.data('id');
    let adminPass = $('#confirmPass'+id).val();
    $('.confirm-reset-password').prop("disabled", true);
    $('.cancel-reset-password').prop("disabled", true);
    if(adminPass == ''){
      $('.pass-admin-frame').addClass('has-error');
      $('.pass-admin-field').focus();
      $('.pass-admin-status').css('color', '#dd4b39');
      $('.pass-admin-status').html('Masukkan password admin!');
    }else{
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/reset-password',
        data: {
          id,
          adminPass,
        },
        dataType: 'html',
        method: 'post',
        success: function(response){
          let result = JSON.parse(response);
          if(result.errors == false){
            alert('Berhasil me-reset password user !');
            window.location.reload();
          }else{
            $('.pass-admin-field').focus();
            $('.pass-admin-frame').removeClass('has-success').addClass('has-error');
            $('.pass-admin-status').css('color', 'red');
            $('.pass-admin-status').html('Password admin salah!');
            $('.confirm-reset-password').removeAttr('disabled');
            $('.cancel-reset-password').removeAttr('disabled');
          }
        },
        fails: function(response){
          console.log(response);
        }
      });
    }
  });

  $(document).on('keyup', '.pass-admin-field', function(){
    let el = $(this),
      id = el.data('id');
    let adminPass = $('#confirmPass'+id).val();
    if(adminPass == ''){
      $('.pass-admin-frame').removeClass('has-success').addClass('has-error');
      $('.pass-admin-status').css('color', '#dd4b39');
      $('.pass-admin-status').html('Masukkan password admin!');
    }else{
      $('.pass-admin-frame').removeClass('has-error').addClass('has-success');
    }
  });
  

  /**
   * this function is for checking if the user input is using 
   * email format or not 
   */
  function isEmail(email){
    let filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(email)){
      return true;
    }else{
      return false;
    }
  }

  /**
   * this function is for checking if the user input for username
   * have space or special character in them.
   */
  function hasSpaceOrSpecialCharacter(username){
    let filter = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    if(filter.test(username)){
      return true;
    }else{
      return false;
    }
  }
});
