$(document).ready(function(){
    $(document).on('keyup', '#addFakultas', function(){
       let name = $(this).val();
       
       if(name == ''){
           $('.add-unit-frame').removeClass('has-success').addClass('has-error');
           $('.add-unit-status').html('Field Unit tidak boleh kosong!');
       }else{
           $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'check-unit',
                data: {
                    name
                },
                dataType: 'json',
                method: 'post',
                success: function(response){
                    if(response.errors == false){
                        $('.add-unit-frame').removeClass('has-error').addClass('has-success');
                        $('.add-unit-status').html('');
                    }else{
                        $('.add-unit-frame').removeClass('has-success').addClass('has-error');
                        $('.add-unit-status').html('Unit sudah ada!');
                    }
                },
                fails: function(response){
                    console.log(response);
                }
            });
       }
    });

    $(document).on('click', '#addUnitBtn', function(){
        let name = $('#addFakultas').val();

        if(name == ''){
            $('.add-unit-frame').removeClass('has-success').addClass('has-error');
            $('.add-unit-status').html('Field Unit tidak boleh kosong!');
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'check-unit',
                data: {
                    name
                },
                dataType: 'json',
                method: 'post',
                success: function(response){
                    if(response.errors == false){
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'add-unit',
                            data: {
                                name
                            },
                            dataType: 'Json',
                            method: 'post',
                            success: function(response){
                                console.log(response);
                                alert('Berhasil menambahkan Unit/Fakultas!');
                                window.location.reload();
                            },
                            fails: function(response){
                                console.log(response);
                            }
                        });
                    }else{
                        $('.add-unit-frame').removeClass('has-success').addClass('has-error');
                        $('.add-unit-status').html('Unit sudah ada!');
                    }
                },
                fails: function(response){
                    console.log(response);
                }
            });
        }
    });

    $(document).on('click', '.unit-delete', function(){
        let el = $(this),
            id = el.data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-unit',
            data: {
                id
            },
            dataType: 'json',
            method: 'post',
            success: function(response){
                $('.unit-name').html(response.result.name);
                $('.delete-unit').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.delete-unit', function(){
        let el = $(this),
            id = el.data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete-unit',
            data:{
                id
            },
            dataType: 'json',
            method: 'delete',
            success: function(response){
                console.log(response);
                alert('Berhasil menghapus unit!');
                window.location.reload();
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.edit-unit', function(){
        let el = $(this),
            id = el.data('id');
        $('.edit-unit-frame').removeClass('has-error has-success');
        $('.edit-unit-status').html('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-unit',
            data: {
                id
            },
            dataType: 'json',
            method: 'post',
            success: function(response){
                $('.edit-unit-field').val(response.result.name);
                $('.edit-unit-field').data('id', response.result.id);
                $('.submit-edit-unit').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('keyup', '.edit-unit-field', function(){
        let name = $(this).val();
        let el = $(this),
            id = el.data('id');
        
        if(name == ''){
            $('.edit-unit-frame').removeClass('has-success').addClass('has-error');
            $('.edit-unit-status').html('Field Unit tidak boleh kosong!');
        }else{
            $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'check-edit-unit',
                 data: {
                     name,
                     id
                 },
                 dataType: 'json',
                 method: 'post',
                 success: function(response){
                     if(response.errors == false){
                         $('.edit-unit-frame').removeClass('has-error').addClass('has-success');
                         $('.edit-unit-status').html('');
                     }else{
                         $('.edit-unit-frame').removeClass('has-success').addClass('has-error');
                         $('.edit-unit-status').html('Unit sudah ada!');
                     }
                 },
                 fails: function(response){
                     console.log(response);
                 }
             });
        }
    });
    $(document).on('click', '.submit-edit-unit', function(){
        let el = $(this),
            id = el.data('id');
        
        let name = $('.edit-unit-field').val();
        if(name == ''){
            $('.edit-unit-frame').removeClass('has-success').addClass('has-error');
            $('.edit-unit-status').html('Field Unit tidak boleh kosong!');
        }else{
            $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url: 'check-edit-unit',
                 data: {
                     name,
                     id
                 },
                 dataType: 'json',
                 method: 'post',
                 success: function(response){
                     if(response.errors == false){
                         $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update-unit',
                            data: {
                                id,
                                name,
                            },
                            dataType: 'json',
                            method: 'post',
                            success: function(response){
                                console.log(response);
                                alert('Berhasil mengupdate Unit/Fakultas!');
                                window.location.reload();
                            },
                            fails: function(response){
                                console.log(response);
                            }   
                         });
                     }else{
                         $('.edit-unit-frame').removeClass('has-success').addClass('has-error');
                         $('.edit-unit-status').html('Unit sudah ada!');
                     }
                 },
                 fails: function(response){
                     console.log(response);
                 }
             });
        }
        
    });
});