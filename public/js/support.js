$(document).ready(function(){
  $('#chooser').click(function(){
      $('#chooseFile').click();
      $('input[type="file"]#chooseFile').change(function(e){
          var filename = e.target.files[0].name;
          $('#filename').val(filename);
      });
  });
  $('.addFile').click(function(){
    $('input[type="file"]#chooseFile').val('');
    $('#filename').val('');
  });

  $('#addSelectUnit').change(function(){
    $val = $(this).val();
    if($val == "add"){
      $('#addUnit').modal('toggle');
    }
  });

  $(document).on('click', 'button#addUnitBtn', function(){
    $('#addUnit').modal('hide');
    $newFakultas = $('#addFakultas').val();
    $('#addSelectUnit').prepend(
        '<option value="new">'+$newFakultas+'</option>'
    ).val('new');
  });

  $(document).on('keyup', '#addConfirmPass, #addPassword', function(){
    let passVal = $('#addPassword').val();
    $('passStat').html('');
    let confPass = $('#addConfirmPass').val();
    if(passVal != '' && confPass != ''){
      if(passVal != confPass){
        $('#passStat').css('color', ' red');
        $('#passStat').html('Password TIdak Cocok');
        $('#inputAddPassword').removeClass('has-success').addClass('has-error');
        $('#inputAddConfirmPass').removeClass('has-success').addClass('has-error');
      }else{
        $('#passStat').css('color','green');
        $('#passStat').html('Password Cocok');
        $('#inputAddPassword').removeClass('has-error').addClass('has-success');
        $('#inputAddConfirmPass').removeClass('has-error').addClass('has-success');
      }
    }else{
      $('#passStat').html('');
      $('#inputAddPassword').removeClass('has-error has-success');
      $('#inputAddConfirmPass').removeClass('has-error has-success');
    }
  });

  $(document).on('click', '#submitAddUser', function(){
    alert('Lengkapi data user!');
    const name = $('#addName').val();
    const email = $('#addEmail').val();
    const username = $('#addUsername').val();
    const password = $('#addPassword').val();
    const confPass = $('#addConfirmPass').val();
    const unit = $('#addSelectUnit').val();
    const level = $('#addSelectLevel').val();
    if(level == ''){
      $('#inputAddLevel').addClass('has-error');
    }
    if(unit == ''){
      $('#inputAddUnit').addClass('has-error');
    }
    if(confPass == ''){
      $('#inputAddConfirmPass').addClass('has-error');
      $('#addConfirmPass').focus();
      $('#passStat').css('color', 'red');
      $('#passStat').html('Masukkan Password & Konfirmasi Password!');
    }
    if(password == ''){
      $('#inputAddPassword').addClass('has-error');
      $('#addPassword').focus();
      $('#passStat').css('color', 'red');
      $('#passStat').html('Masukkan Password & Konfirmasi Password!');
    }
    if(username == ''){
      $('#inputAddUsername').addClass('has-error');
      $('#addUsername').focus();
    }
    if(email == ''){
      $('#inputAddEmail').addClass('has-error');
      $('#addEmail').focus();
    }
    if(name == ''){
      $('#inputAddName').addClass('has-error');
      $('#addName').focus();
    }
  });

  //ubah frame saat field input terisi atau tidak
  $(document).on('focusout', 'input#addName', function(){
    let val = $('input#addName').val();
    if(val == ''){
      $('#inputAddName').removeClass('has-success').addClass('has-error');
    }else{
      $('#inputAddName').removeClass('has-error').addClass('has-success');
    }
  });

  $(document).on('focusout', 'input#addEmail', function(){
    let val = $('input#addEmail').val();
    if(val == ''){
      $('#inputAddEmail').removeClass('has-success').addClass('has-error');
      $('#emailStat').html('');
      $('#addEmailValue').val('0');
    }else{
      if(!validateEmail(val)){
        $('#inputAddEmail').removeClass('has-success').addClass('has-error');
        $('#emailStat').css({'color': 'red', 'font-weight': 'bold'});
        $('#emailStat').html('Email tidak valid!');
        $('#addEmailValue').val('0');
      }else{
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: 'check-email',
          method: 'POST',
          data : {email: val},
          dataType: 'html',
          success: function(response){
            let result = JSON.parse(response);
            if(result.userCount == 0){
              $('#inputAddEmail').removeClass('has-error').addClass('has-success');
              $('#emailStat').css({'color': 'green', 'font-weight':'bold'});
              $('#emailStat').html('Email dapat digunakan!');
              $('#addEmailValue').val('1');
            }else{
              $('#inputAddEmail').removeClass('has-success').addClass('has-error');
              $('#emailStat').css({'color': 'red', 'font-weight': 'bold'});
              $('#emailStat').html('Email sudah digunakan!');
              $('#addEmailValue').val('0');
            }
          }
        });
      }
    }
  });

  $(document).on('focusout', 'input#addUsername', function(){
    let val = $('input#addUsername').val();
    if(val == ''){
      $('#inputAddUsername').removeClass('has-success').addClass('has-error');
      $('#usernameStat').html('');
      $('#addUsernameValue').val('0');
    }else if(validateUsername(val)){
      $('#inputAddUsername').removeClass('has-success').addClass('has-error');
      $('#usernameStat').css({'color': 'red', 'font-weight': 'bold'});
      $('#usernameStat').html('Username tidak boleh mengandung spasi!'); 
    }else if(val.length < 5){
      $('#inputAddUsername').removeClass('has-success').addClass('has-error');
      $('#usernameStat').css({'color': 'red', 'font-weight': 'bold'});
      $('#usernameStat').html('Username min. 5 karakter!'); 
    }else{
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'check-username',
        method: 'POST',
        data: {username : val},
        dataType: 'html',
        success: function(response){
          let result = JSON.parse(response);
          if(result.userCount == 0){
            $('#inputAddUsername').removeClass('has-error').addClass('has-success');
            $('#usernameStat').css({'color': 'green', 'font-weight': 'bold'});
            $('#usernameStat').html('Username dapat digunakan!');
            $('#addUsernameValue').val('1');
          }else{
            $('#inputAddUsername').removeClass('has-success').addClass('has-error');
            $('#usernameStat').css({'color': 'red', 'font-weight': 'bold'});
            $('#usernameStat').html('Username sudah digunakan!');
            $('#addUsernameValue').val('0');
          } 
        }
      });
    }
  });
  
  //fungsi validasi penulisan email
  function validateEmail(email){
    let filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(email)){
      return true;
    }else{
      return false;
    }
  }

  //fungsi validasi username
  function validateUsername(username){
    let filter = /\s/;
    if(filter.test(username)){
      return true;
    }else{
      return false;
    }
  }
});
