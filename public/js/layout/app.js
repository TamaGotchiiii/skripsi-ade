$(document).ready(function(){
    $(document).on('click', '.profil-user', function(e){
        $('.profile-name-frame').removeClass('has-error has-success');
        $('.profile-email-frame').removeClass('has-error has-success');
        $('.profile-username-frame').removeClass('has-error has-success');
        $('.profile-name-status').html('');
        $('.profile-email-status').html('');
        $('.profile-username-status').html('');

        e.preventDefault();
        let el = $(this),
            id = el.data('id');
        
        
        $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: 'get-user',
              data: {
                  id
              },
              dataType: 'json',
              method: 'post',
              success: function(response){
                $('.edit-name-profile').val(response.result.name);
                $('.edit-email-profile').val(response.result.email);
                $('.edit-username-profile').val(response.result.username);
                $('.unit-selector-profile').append('<option value="'+response.result.unit.id+'">'+response.result.unit.name+'</option>');
                let unitSelection = '';
                response.units.forEach(unit => {
                    if(unit.id != response.result.unit.id){
                        unitSelection += `<option value="${unit.id}">
                            ${unit.name}
                        </option>`;
                    }
                });
                $('.unit-selector-profile').append(unitSelection);
              },
              fails: function(response){
                  console.log(response);
              } 
        });
    });

    $(document).on('keyup', '.edit-name-profile', function(){
        let name = $(this).val();

        if(name == ''){
            $('.profile-name-frame').removeClass('has-success').addClass('has-error');
            $('.profile-name-status').css('color', '#dd4b39');
            $('.profile-name-status').html('Field Nama tidak boleh kosong!');
        }else{
            $('.profile-name-frame').removeClass('has-error').addClass('has-success');
            $('.profile-name-status').html('');
        }
    });

    $(document).on('keyup', '.edit-email-profile', function(){
        let email = $(this).val();
        let el = $(this),
            id = el.data('id');
        if(email == ''){
            $('.profile-email-frame').removeClass('has-success').addClass('has-error');
            $('.profile-email-status').css('color', '#dd4b39');
            $('.profile-email-status').html('Field Email tidak boleh kosong!');
        }else if(!isEmail(email)){
            $('.profile-email-frame').removeClass('has-success').addClass('has-error');
            $('.profile-email-status').css('color', '#dd4b39');
            $('.profile-email-status').html('Email tidak valid!');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'check-edit-email',
                data: {
                    email,
                    id
                },
                dataType: 'json',
                method: 'post',
                success: function(response){
                    if(response.errors == true){
                        $('.profile-email-frame').removeClass('has-success').addClass('has-error');
                        $('.profile-email-status').css('color', '#dd4b39');
                        $('.profile-email-status').html('Email telah digunakan!');
                    }else{
                        $('.profile-email-frame').removeClass('has-error').addClass('has-success');
                        $('.profile-email-status').css('color', '#00a65a');
                        $('.profile-email-status').html('Email dapat digunakan!');
                    }
                },
                fails: function(response){
                    console.log(response);
                }
            })
        }
    });

    $(document).on('keyup', '.edit-username-profile', function(){
        let username = $(this).val();
        let el = $(this),
            id =  el.data('id');
        
        if(username == ''){
            $('.profile-username-frame').removeClass('has-success').addClass('has-error');
            $('.profile-username-status').css('color', '#dd4b39');
            $('.profile-username-status').html('Field Username tidak boleh kosong!');
        }else if(hasSpaceOrSpecialCharacter(username)){
            $('.profile-username-frame').removeClass('has-success').addClass('has-error');
            $('.profile-username-status').css('color', '#dd4b39');
            $('.profile-username-status').html('Username tidak boleh mengandung spasi, Username hanya terdiri dari angka dan huruf!');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'check-edit-username',
                data: {
                    username,
                    id
                },
                dataType: 'Json',
                method: 'post',
                success: function(response){
                    if(response.errors == true){
                        $('.profile-username-frame').removeClass('has-success').addClass('has-error');
                        $('.profile-username-status').css('color', '#dd4b39');
                        $('.profile-username-status').html('Username telah digunakan!');
                    }else{
                        $('.profile-username-frame').removeClass('has-error').addClass('has-success');
                        $('.profile-username-status').css('color', '#00a65a');
                        $('.profile-username-status').html('Username dapat digunakan!');
                    }
                },
                fails: function(response){
                    console.log(response);
                }
            });
        }
    });

    $(document).on('click', '.submit-edit-profile', function(){
        let el = $(this),
            id = el.data('id'),
            level = el.data('level');
        let name = $('.edit-name-profile').val();
        let email = $('.edit-email-profile').val();
        let username = $('.edit-username-profile').val();
        let unit = $('.unit-selector-profile').val();

        if(name != '' && email != '' && username != '' && isEmail(email) && !hasSpaceOrSpecialCharacter(username)){
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
            if(username == ''){
                $('.profile-username-frame').addClass('has-error');
                $('.profile-username-status').css('color', '#dd4b39');
                $('.profile-username-status').html('Field Username tidak boleh kosong!');
                $('edit-username-profile').focus();
            }
            if(hasSpaceOrSpecialCharacter(username)){
                $('.profile-username-frame').addClass('has-error');
                $('.profile-username-status').css('color', '#dd4b39');
                $('.profile-username-status').html('Username tidak boleh mengandung spasi, Username hanya terdiri dari angka dan huruf!');
                $('edit-username-profile').focus();
            }
            if(email == ''){
                $('.profile-email-frame').addClass('has-error');
                $('.profile-email-status').css('color', '#dd4b39');
                $('.profile-email-status').html('Field Email tidak boleh kosong!');
                $('edit-email-profile').focus();
            }
            
            if(!isEmail(email)){
                $('.profile-email-frame').addClass('has-error');
                $('.profile-email-status').css('color', '#dd4b39');
                $('.profile-email-status').html('Email tidak valid!');
                $('edit-email-profile').focus();
            }

            if(name == ''){
                $('.profile-name-frame').addClass('has-error');
                $('.profile-name-status').css('color', '#dd4b39');
                $('.profile-name-status').html('Field Nama tidak boleh kosong!');
                $('edit-name-profile').focus();
            }
        }
        
    });

    $(document).on('click', '.change-password', function(e){
        e.preventDefault();
        $('.old-password-frame').removeClass('has-success has-error');
        $('.new-password-frame').removeClass('has-success has-error');
        $('.confirm-new-password-frame').removeClass('has-success has-error');
        $('.old-password-status').html('');
        $('.new-password-status').html('');
    });

    $(document).on('keyup', '.old-password-field', function(){
        let oldPassword = $(this).val();

        if(oldPassword == ''){
            $('.old-password-frame').removeClass('has-success').addClass('has-error');
            $('.old-password-status').html('Field Password Lama tidak boleh kosong!');
        }else{
            $('.old-password-frame').removeClass('has-error').addClass('has-success');
            $('.old-password-status').html('');
        }
    });

    $(document).on('keyup', '.new-password-field, .confirm-new-password-field', function(){
        let newPassword = $('.new-password-field').val();
        let confirmNewPassword = $('.confirm-new-password-field').val();
        if(newPassword == '' || confirmNewPassword == ''){
            $('.new-password-frame').removeClass('has-success').addClass('has-error');
            $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
            $('.new-password-status').css('color', '#dd4b39');
            $('.new-password-status').html('Masukkan Password Baru dan Konfirmasi Password Baru!');
        }else if(newPassword.length < 8){
            $('.new-password-frame').removeClass('has-success').addClass('has-error');
            $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
            $('.new-password-status').css('color', '#dd4b39');
            $('.new-password-status').html('Password terlalu pendek!');
        }else if(newPassword != confirmNewPassword){
            $('.new-password-frame').removeClass('has-success').addClass('has-error');
            $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
            $('.new-password-status').css('color', '#dd4b39');
            $('.new-password-status').html('Password tidak cocok!');
        }else{
            $('.new-password-frame').removeClass('has-error').addClass('has-success');
            $('.confirm-new-password-frame').removeClass('has-error').addClass('has-success');
            $('.new-password-status').css('color', '#00a65a');
            $('.new-password-status').html('Password cocok!');
        }
    });

    $(document).on('click', '.submit-change-password', function(){
        let el = $(this),
            id = el.data('id');
        let oldPass = $('.old-password-field').val();
        let newPass = $('.new-password-field').val();
        let newPass_confirmation = $('.confirm-new-password-field').val();

        if(oldPass != '' && newPass != '' && newPass_confirmation != '' && newPass.length >=8 && newPass == newPass_confirmation){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'change-password',
                data: {
                    id,
                    oldPass,
                    newPass,
                    newPass_confirmation
                },
                dataType: 'json',
                method: 'post',
                success: function(response){
                    console.log(response);
                    if(response.errors == true && response.old_password_errors == false){
                        alert('Periksa kembali input yang anda masukkan!');
                    }else if(response.old_password_errors == true){
                        alert('Password lama tidak cocok');
                    }else{
                        alert('Password berhasil diganti!');
                        window.location.reload();
                    }
                },
                fails: function(response){
                    console.log(response);
                }

            });
        }else{
            if(newPassword == '' || newPass_confirmation == ''){
                $('.new-password-frame').removeClass('has-success').addClass('has-error');
                $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
                $('.new-password-status').css('color', '#dd4b39');
                $('.new-password-status').html('Masukkan Password Baru dan Konfirmasi Password Baru!');
                $('.new-password-field').focus();
            }else if(newPassword.length < 8){
                $('.new-password-frame').removeClass('has-success').addClass('has-error');
                $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
                $('.new-password-status').css('color', '#dd4b39');
                $('.new-password-status').html('Password terlalu pendek!');
                $('.new-password-field').focus();
            }else if(newPassword != newPass_confirmation){
                $('.new-password-frame').removeClass('has-success').addClass('has-error');
                $('.confirm-new-password-frame').removeClass('has-success').addClass('has-error');
                $('.new-password-status').css('color', '#dd4b39');
                $('.new-password-status').html('Password tidak cocok!');
                $('.new-password-field').focus();
            }
            if(oldPass == ''){
                $('.old-password-frame').removeClass('has-success').addClass('has-error');
                $('.old-password-status').html('Field Password Lama tidak boleh kosong!');
                $('.old-password-field').focus();
            }
        }
    });

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