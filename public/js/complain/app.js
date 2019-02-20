$(document).ready(function(){
    $(document).on('keyup', '.complain-name-field', function(){
        let val = $(this).val();

        if(val == ''){
            $('.complain-name-frame').removeClass('has-success').addClass('has-error');
            $('.complain-name-status').css('color', '#dd4b39');
            $('.complain-name-status').html('Field Nama tidak boleh kosong!');    
        }else{
            $('.complain-name-frame').removeClass('has-error').addClass('has-success');
            $('.complain-name-status').html('');
        }
    });

    $(document).on('change', '.complain-select-unit', function(){
        let val = $(this).val();

        if(val == ''){
            $('.complain-unit-frame').removeClass('has-success').addClass('has-error');
            $('.complain-unit-status').css('color', '#dd4b39');
            $('.complain-unit-status').html('Silahkan pilih unit/fakultas!');
        }else{
            $('.complain-unit-frame').removeClass('has-error').addClass('has-success');
            $('.complain-unit-status').html('');
        }
    });

    $(document).on('keyup', '.complain-id-field', function(){
        let val =$(this).val();

        if(val == ''){
            $('.complain-id-frame').removeClass('has-success').addClass('has-error');
            $('.complain-id-status').css('color', '#dd4b39');
            $('.complain-id-status').html('Field No. Identitas/NIM/NIP tidak boleh kosong!');
        }else{
            $('.complain-id-frame').removeClass('has-error').addClass('has-success');
            $('.complain-id-status').html('');
        }
    });

    $(document).on('keyup', '.complain-email-field', function(){
        let email = $(this).val();
        if(email == ''){
            $('.complain-email-frame').removeClass('has-success').addClass('has-error');
            $('.complain-email-status').html('Field Email tidak boleh kosong!');
            $('.complain-email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
        }else{
            if(!isEmail(email)){
                $('.complain-email-frame').removeClass('has-success').addClass('has-error');
                $('.complain-email-status').css({'color': '#dd4b39', 'font-weight': 'bold'});
                $('.complain-email-status').html('Email tidak valid!');
            }else{
                $('.complain-email-frame').removeClass('has-error').addClass('has-success');
                $('.complain-email-status').html('');
            }
        }
    });

    $(document).on('keyup', '.complain-complain-field', function(){
        let val = $(this).val();

        if(val == ''){
            $('.complain-complain-frame').removeClass('has-success').addClass('has-error');
            $('.complain-complain-status').css('color', '#dd4b39');
            $('.complain-complain-status').html('Field Keluhan tidak boleh kosong!');
        }else{
            $('.complain-complain-frame').removeClass('has-error').addClass('has-success');
            $('.complain-complain-status').html('');
        }
    });

    $(document).on('change', '.complain-select-type', function(){
        let val = $(this).val();

        if(val == ''){
            $('.complain-type-frame').removeClass('has-success').addClass('has-error');
            $('.complain-type-status').css('color', '#dd4b39');
            $('.complain-type-status').html('Silahkan pilih Jenis Keluhan!');
        }else{
            $('.complain-type-frame').removeClass('has-error').addClass('has-success');
            $('.complain-type-status').html('');
        }
    });

    $(document).on('click', '.add-attachment', function(){
        let attachmentCounter = $('.attachment-counter').val();
        attachmentCounter++;
        $('.attachment-counter').val(attachmentCounter);
        $('#addAttachmentField').append(`
            <input type="file" class="attachment-file" style="display:none" data-counter="${attachmentCounter}" id="attachment${attachmentCounter}">
        `);
        let html = '';
        html += `<tr>
            <td class="text-center" style="vertical-align:middle">${attachmentCounter}</td>
            <td>
            <input type="text" class="form-control attachment-name-field" data-counter="${attachmentCounter}" id="attachmentName${attachmentCounter}">
            <b><span id="attachmentStatus${attachmentCounter}"></span></b>
            </td>
            <td class="text-center" style="vertical-align:middle"><span id="fileStatus${attachmentCounter}">Belum ada file</span></td>
            <td class="text-center" style="vertical-align:middle">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-xs btn-primary upload-button" data-counter="${attachmentCounter}"><i class="fa fa-upload"></i></button>
                    <button type="button" class="btn btn-xs btn-danger remove-attachment" data-counter="${attachmentCounter}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>`;
        $('#addAttachment').append(html);
        $('#attachmentName'+attachmentCounter).focus();
    });

    $(document).on('click', '.remove-attachment', function(){
        let el = $(this),
            counter = el.data('counter');
        $('#attachment'+counter).val('');
        el.closest('tr').remove();
        for(let i = 1; i<=3; i++){
            console.log($('#attachment'+i).val());
        }
    });

    $(document).on('click', '.upload-button', function(){
        let el = $(this),
            counter = el.data('counter');
        name = $('#attachmentName'+counter).val();

        if(name == ''){
            $('#attachmentStatus'+counter).css('color', 'red');
            $('#attachmentStatus'+counter).html('Silahkan masukkan nama lampiran!');
            $('#attachmentName'+counter).focus();
        }else{
            $('#attachment'+counter).click();
        }
    });

    $(document).on('change', '.attachment-file', function(){
        let el = $(this),
            counter = el.data('counter');
        
        $('#fileStatus'+counter).html('File Ok');
    });

    $(document).on('keyup', '.attachment-name-field', function(){
        let el = $(this),
            counter = el.data('counter'),
            val = $(this).val();

        if(val == ''){
            $('#attachmentStatus'+counter).css('color', 'red');
            $('#attachmentStatus'+counter).html('Silahkan masukkan nama lampiran!');
        }else{
            $('#attachmentStatus'+counter).html('');
        }
    });

    $(document).on('click', '.add-submit-complain', function(){
        let el = $(this);
        el.prop('disabled',true);
        $('.add-cancel-complain').prop('disabled', true);
        let name = $('#addComplainName').val();
        let unit = $('#addComplainUnit').val();
        let id = $('#addComplainId').val();
        let email = $('#addComplainEmail').val();
        let complain = $('#addComplainComplain').val();
        let complain_type = $('#addComplainType').val();
        if(name != '' && unit != '' && id != '' && email != '' && complain != '' && complain_type != ''){
            let data = new FormData();
            data.append('name', name);
            data.append('unit', unit);
            data.append('id', id);
            data.append('email', email);
            data.append('complain', complain);
            data.append('complain_type', complain_type);
            let counter = $('.attachment-counter').val();
            if(counter != 0){
                for(let i = 1; i<=counter; i++){
                    let file = $('#attachment'+i).val();
                    if(file != ''){
                        data.append('files[]', $('#attachment'+i)[0].files[0]);
                        data.append('attachmentsname[]', $('#attachmentName'+i).val());
                    }    
                }
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'submit-complain',
                data: data,
                type: 'POST',
                dataType:'html',
                contentType: false,
                processData: false,
                success: function(response){
                    let result = JSON.parse(response);
                    if(result.errors == true){
                        alert(result.messages);
                        el.removeAttr('disabled');
                        $('.add-cancel-complain').removeAttr('disabled');
                    }else{
                        alert(result.messages);
                        window.location.reload();
                    }

                },
                fails: function(response){
                    console.log(response);
                }
            });
        }else{
            if(complain_type == ''){
                $('.complain-type-frame').removeClass('has-success').addClass('has-error');
                $('.complain-type-status').css('color', '#dd4b39');
                $('.complain-type-status').html('Silahkan pilih Jenis Keluhan!');
            }
            if(complain == ''){
                $('.complain-complain-frame').removeClass('has-success').addClass('has-error');
                $('.complain-complain-status').css('color', '#dd4b39');
                $('.complain-complain-status').html('Field Keluhan tidak boleh kosong!');
                $('.complain-complain-field').focus();
            }
            if(email == ''){
                $('.complain-email-frame').removeClass('has-success').addClass('has-error');
                $('.complain-email-status').css('color', '#dd4b39');
                $('.complain-email-status').html('Field Email tidak boleh kosong!');
                $('.complain-email-field').focus();
            }
    
            if(!isEmail(email)){
                $('.complain-email-frame').removeClass('has-success').addClass('has-error');
                $('.complain-email-status').css('color', '#dd4b39');
                $('.complain-email-status').html('Email tidak valid!');
                $('.complain-email-field').focus();
            }
            if(id == ''){
                $('.complain-id-frame').removeClass('has-success').addClass('has-error');
                $('.complain-id-status').css('color', '#dd4b39');
                $('.complain-id-status').html('Field No. Identitas/NIM/NIP tidak boleh kosong!');
                $('.complain-id-field').focus();
            }
            if(unit == ''){
                $('.complain-unit-frame').removeClass('has-success').addClass('has-error');
                $('.complain-unit-status').css('color', '#dd4b39');
                $('.complain-unit-status').html('Silahkan pilih Unit/Fakultas!');
                $('.complain-select-unit').focus();
            }
            if(name == ''){
                $('.complain-name-frame').removeClass('has-success').addClass('has-error');
                $('.complain-name-status').css('color', '#dd4b39');
                $('.complain-name-status').html('Field Nama tidak boleh kosong!');
            }
        }
    });

    $('.add-cancel-complain').on('.hidden.bs.modal', function(){
        $('form#addComplainForm')[0].reset();
        $('.complain-name-frame').removeClass('has-error has-success');
        $('.complain-name-status').html('');
        $('.complain-unit-frame').removeClass('has-error has-success');
        $('.complain-unit-status').html('');
        $('.complain-id-frame').removeClass('has-error has-success');
        $('.complain-id-status').html('');
        $('.complain-email-frame').removeClass('has-error has-success');
        $('.complain-email-status').html('');
        $('.complain-complain-frame').removeClass('has-error has-success');
        $('.complain-complain-status').html('');
        $('.complain-type-frame').removeClass('has-error has-success');
        $('.complain-type-status').html('');
        $('.attachment-counter').val('0');
        $('#addAttachment').empty();
        $('#addAttachmentField').empty();
    });

    $(document).on('click', '.delete-complain', function(){
        let el = $(this),
            id = el.data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            data: {
                id
            },
            dataType: 'HTML',
            method: 'POST',
            success: function(response){
                let resp = JSON.parse(response);
                if(resp.result.status == 1){
                    $('.in-progress-warning').css({'color': 'red', 'font-weight': 'bold'});
                    $('.in-progress-warning').html('Keluhan dalam pengerjaan, ');
                }else{
                    $('.in-progress-warning').html('');
                }
                $('.delete-complain-code').html(resp.result.complain_code);
                $('.delete-complain-name').html(resp.result.name);
                $('button.confirm-delete-complain').data('id', resp.result.id);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.confirm-delete-complain', function(){
        let el = $(this),
            id = el.data('id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete-complain',
            data: {
                id
            },
            dataType: 'HTML',
            method: 'DELETE',
            success: function(response){
                console.log(response);
                alert('Berhasil menghapus keluhan!');
                window.location.reload();
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.view-complain', function(){
        let el = $(this),
            id = el.data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            data: {
                id
            },
            dataType: 'json',
            method: 'POST',
            success: function(response){
                $('#viewAttachment tbody').empty();
                if(response.result.status == 0){
                    $('.handle-by').hide();
                }else{
                    $('.handle-by').show();
                    $('.handle-by-field').val(response.result.user.name);
                }
                $('.view-complain-code').val(response.result.complain_code);
                $('.view-complain-name').val(response.result.name);
                $('.view-complain-unit').val(response.result.unit.name);
                $('.view-complain-id').val(response.result.id_number);
                $('.view-complain-email').val(response.result.email);
                $('.view-complain-description').val(response.result.description);
                $('.view-complain-type').val(response.result.complain_type.title);
                let html = '';
                let counter=0;
                response.result.attachments.forEach(attachment => {
                    ++counter;
                    html += `<tr>
                        <td class="text-center" style="vertical-align:middle">${counter}</td>
                        <td class="text-center" style="vertical-align:middle">${attachment.title}</td>
                        <td class="text-center" style="vertical-align:middle">File Ok</td>
                    </tr>`;
                    console.log(html);
                });
                $('#viewAttachment').append(html);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });
    
    $(document).on('click', '.edit-complain', function(){
        let el = $(this),
            id = el.data('id');
        $('.complain-name-frame').removeClass('has-error has-success');
        $('.complain-name-status').html('');
        $('.complain-unit-frame').removeClass('has-error has-success');
        $('.complain-unit-status').html('');
        $('.complain-id-frame').removeClass('has-error has-success');
        $('.complain-id-status').html('');
        $('.complain-email-frame').removeClass('has-error has-success');
        $('.complain-email-status').html('');
        $('.complain-complain-frame').removeClass('has-error has-success');
        $('.complain-complain-status').html('');
        $('.complain-type-frame').removeClass('has-error has-success');
        $('.complain-type-status').html('');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            data:{
                id
            },
            dataType: 'JSON',
            method: 'POST',
            success: function(response){
                console.log(response);
                $('.complain-select-type').empty();
                // $('.complain-select-unit').empty();
                $('.edit-complain-code').val(response.result.complain_code);
                $('.edit-complain-name').val(response.result.name);
                // let selection = '';
                // response.units.forEach(unit => {
                //     selection += `<option value="${unit.id}">
                //         ${unit.name}
                //     </option>`
                // });
                // $('.complain-select-unit').append(selection);
                $('.edit-complain-unit').val(response.result.unit.name);
                $('.edit-complain-id').val(response.result.id_number);
                $('.edit-complain-email').val(response.result.email);
                $('.edit-complain-description').val(response.result.description);
                $('.complain-select-type').append('<option value="'+response.result.complain_type.id+'">'+response.result.complain_type.title+'</option>');
                let type = '';
                response.complain_types.forEach(complain_type => {
                    if(complain_type.id != response.result.complain_type.id){
                        type += `<option value=${complain_type.id}>
                            ${complain_type.title}
                        </option>`;
                    }
                });
                $('.complain-select-type').append(type);
            },
            fails: function(response){
                console.log(response);
            } 
        });
    });

    function isEmail(email){
        let filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(filter.test(email)){
          return true;
        }else{
          return false;
        }
    }
});
  