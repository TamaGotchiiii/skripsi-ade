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

    $(document).on('click', '#addAttachmentBtn', function(){
        let attachmentCounter = $('#addAttachmentCounter').val();
        attachmentCounter++;
        $('#addAttachmentCounter').val(attachmentCounter);
        $('#addAttachmentField').append(`
            <input type="file" class="attachment-file" style="display:none" data-counter="${attachmentCounter}" id="addAttachment${attachmentCounter}">
        `);
        let html = '';
        html += `<tr>
            <td class="text-center" style="vertical-align:middle">${attachmentCounter}</td>
            <td>
            <input type="text" class="form-control attachment-name-field" data-counter="${attachmentCounter}" id="addAttachmentName${attachmentCounter}">
            <b><span id="addAttachmentStatus${attachmentCounter}"></span></b>
            </td>
            <td class="text-center" style="vertical-align:middle"><span id="fileStatus${attachmentCounter}">Belum ada file</span></td>
            <td class="text-center" style="vertical-align:middle">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-xs btn-primary add-attachment-upload" data-counter="${attachmentCounter}"><i class="fa fa-upload"></i></button>
                    <button type="button" class="btn btn-xs btn-danger remove-attachment" data-counter="${attachmentCounter}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>`;
        $('#addAttachmentTable').append(html);
        $('#addAttachmentName'+attachmentCounter).focus();
    });

    $(document).on('click', '#editAttachmentBtn', function(){
        let attachmentCounter = $('#editAttachmentCounter').val();
        attachmentCounter++;
        $('#editAttachmentCounter').val(attachmentCounter);
        $('#editAttachmentField').append(`
            <input type="file" class="attachment-file" style="display:none" data-counter="${attachmentCounter}" id="editAttachment${attachmentCounter}">
        `);
        let html = '';
        html += `<tr>
            <td class="text-center" style="vertical-align:middle">${attachmentCounter}</td>
            <td>
            <input type="text" class="form-control attachment-name-field" data-counter="${attachmentCounter}" id="editAttachmentName${attachmentCounter}">
            <b><span id="editAttachmentStatus${attachmentCounter}"></span></b>
            </td>
            <td class="text-center" style="vertical-align:middle"><span id="fileStatus${attachmentCounter}">Belum ada file</span></td>
            <td class="text-center" style="vertical-align:middle">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-xs btn-primary edit-attachment-upload" data-counter="${attachmentCounter}"><i class="fa fa-upload"></i></button>
                    <button type="button" class="btn btn-xs btn-danger remove-attachment" data-counter="${attachmentCounter}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>`;
        $('#editAttachmentTable').append(html);
        $('#editAttachmentName'+attachmentCounter).focus();
    });

    $(document).on('click', '.remove-attachment', function(){
        let el = $(this),
            counter = el.data('counter');
        $('#attachment'+counter).val('');
        el.closest('tr').remove();
    });

    $(document).on('click', '.add-attachment-upload', function(){
        let el = $(this),
            counter = el.data('counter');
        name = $('#addAttachmentName'+counter).val();

        if(name == ''){
            $('#addAttachmentStatus'+counter).css('color', 'red');
            $('#addAttachmentStatus'+counter).html('Silahkan masukkan nama lampiran!');
            $('#addAttachmentName'+counter).focus();
        }else{
            $('#addAttachment'+counter).click();
        }
    });

    $(document).on('click', '.edit-attachment-upload', function(){
        let el = $(this),
            counter = el.data('counter');
        name = $('#editAttachmentName'+counter).val();

        if(name == ''){
            $('#editAttachmentStatus'+counter).css('color', 'red');
            $('#editAttachmentStatus'+counter).html('Silahkan masukkan nama lampiran!');
            $('#editAttachmentName'+counter).focus();
        }else{
            $('#editAttachment'+counter).click();
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
        let el = $(this),
            auth = el.data('auth');
        console.log('hit');
        el.prop('disabled',true);
        $('.add-cancel-complain').prop('disabled', true);
        let name = $('#addComplainName').val();
        let unit;
        if(auth == 0){
            unit = $('#addComplainUnit').val();
        }else{
            unit = $('#addComplainUnitField').val();
        }
        console.log(unit+' '+auth);
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
            let counter = $('#addAttachmentCounter').val();
            if(counter != 0){
                for(let i = 1; i<=counter; i++){
                    let file = $('#addAttachment'+i).val();
                    if(file != ''){
                        data.append('files[]', $('#addAttachment'+i)[0].files[0]);
                        data.append('attachmentsname[]', $('#addAttachmentName'+i).val());
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
            el.removeAttr('disabled');
            $('.add-cancel-complain').removeAttr('disabled');
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

    $('.add-complain-modal').on('hidden.bs.modal', function(){
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
        $('#addAttachmentCounter').val('0');
        $('#addAttachmentTable tbody').empty();
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
                $('.complain-select-type').empty();
                $('.edit-attachment-table tbody').empty();
                $('#editComplainUnit').empty();
                $('.edit-complain-code').val(response.result.complain_code);
                $('.edit-complain-name').val(response.result.name);
                $('.edit-complain-status').val(response.result.status);
                $('.edit-complain-unit').append('<option value="'+response.result.unit.id+'">'+response.result.unit.name+'</option>');
                let selection = '';
                response.units.forEach(unit => {
                    if(unit.id != response.result.unit.id){
                        selection += `<option value="${unit.id}">${unit.name}</option>`;
                    }
                });
                $('.edit-complain-unit').append(selection);
                $('.edit-complain-unit-field').val(response.result.unit.name);
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
                let attach = '';
                let counter = 0;
                response.result.attachments.forEach(attachment => {
                    ++counter;
                    attach += `<tr>
                        <td class="text-center" style="vertical-align:middle">${counter}</td>
                        <td class="text-center" style="vertical-align:middle">${attachment.title}</td>
                        <td class="text-center" style="vertical-align:middle">File Ok</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-danger delete-attachment" data-id="${attachment.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
                });
                $('#editAttachmentCounter').val(counter);
                $('#editStartCounter').val(counter+1);
                $('.edit-attachment-table').append(attach);
                $('.complain-select-type').append(type);
                $('.edit-submit-complain').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            } 
        });
    });

    $(document).on('click', '.edit-with-confirm', function(){
        let el = $(this),
            id = el.data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            dataType: 'json',
            data: {
                id
            },
            method: 'post',
            success: function(response){
                $('.complain-code').html(response.result.complain_code);
                $('.complain-name').html(response.result.name);
                $('.edit-confirm-button').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            } 
        });
    });

    $(document).on('click', '.take-complain', function(){
        let el = $(this),
            id = el.data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            dataType: 'json',
            data: {
                id
            },
            method: 'POST',
            success: function(response){
                $('.complain-code').html(response.result.complain_code);
                $('.complain-name').html(response.result.name);
                $('.complain-type').html(response.result.complain_type.title);
                $('.confirm-take-complain').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.confirm-take-complain', function(){
        let el = $(this),
            id = el.data('id');
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'take-complain',
            data: {
                id
            },
            dataType: 'json',
            method: 'post',
            success: function(response){
                console.log(response);
                alert('Status keluhan berubah menjadi dalam pengerjaan!');
                window.location.href = '/keluhan-dalam-pengerjaan';
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.edit-confirm-button', function(){
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
                $('.complain-select-type').empty();
                $('.edit-attachment-table tbody').empty();
                $('#editComplainUnit').empty();
                $('.edit-complain-code').val(response.result.complain_code);
                $('.edit-complain-name').val(response.result.name);
                $('.edit-complain-status').val(response.result.status);
                $('.edit-complain-unit').append('<option value="'+response.result.unit.id+'">'+response.result.unit.name+'</option>');
                let selection = '';
                response.units.forEach(unit => {
                    if(unit.id != response.result.unit.id){
                        selection += `<option value="${unit.id}">${unit.name}</option>`;
                    }
                });
                $('.edit-complain-unit').append(selection);
                $('.edit-complain-unit-field').val(response.result.unit.name);
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
                let attach = '';
                let counter = 0;
                response.result.attachments.forEach(attachment => {
                    ++counter;
                    attach += `<tr>
                        <td class="text-center" style="vertical-align:middle">${counter}</td>
                        <td class="text-center" style="vertical-align:middle">${attachment.title}</td>
                        <td class="text-center" style="vertical-align:middle">File Ok</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-danger delete-attachment" data-id="${attachment.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
                });
                $('#editAttachmentCounter').val(counter);
                $('#editStartCounter').val(counter+1);
                $('.edit-attachment-table').append(attach);
                $('.complain-select-type').append(type);
                $('.edit-submit-complain').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            } 
        });
    });

    $(document).on('click', '.delete-attachment', function(){
        let el = $(this),
            id = el.data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete-attachment',
            data: {
                id
            },
            dataType: 'HTML',
            method: 'DELETE',
            success: function(response){
                console.log(response);
                el.closest('tr').remove();
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.edit-submit-complain', function(){
        let el = $(this),
            id = el.data('id'),
            auth = el.data('auth');
        el.prop('disabled', true);
        $('.edit-cancel-complain').prop('disabled', true);
        let name = $('.edit-complain-name').val();
        let unit;
        if(auth == 0){
            unit = $('.edit-complain-unit').val();
        }else{
            unit = $('.edit-complain-unit-field').val();
        }
        let id_num = $('.edit-complain-id').val();
        let email = $('.edit-complain-email').val();
        let complain = $('.edit-complain-description').val();
        let complain_type = $('.complain-select-type').val();
        let status = $('.edit-complain-status').val();
        if(name != '' && unit != '' && id_num != '' && email != '' && complain != '' && complain_type != '' && isEmail(email)){
            let data = new FormData();
            data.append('id', id);
            data.append('name', name);
            data.append('unit', unit);
            data.append('id_num', id_num);
            data.append('email', email);
            data.append('complain', complain);
            data.append('complain_type', complain_type);
            data.append('status', status);
            let counter = $('#editAttachmentCounter').val();
            let startCounter = $('#editStartCounter').val();
            console.log(startCounter);
            if(counter != 0){
                for(let i = startCounter; i<=counter; ++i){
                    let file = $('#attachment'+i).val();
                    if(file != ''){
                        data.append('files[]', $('#editAttachment'+i)[0].files[0]);
                        data.append('attachmentsname[]', $('#editAttachmentName'+i).val());
                        console.log('hai');
                    }
                }
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update-complain',
                data: data,
                type: 'POST',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                success: function(response){
                    console.log(response);
                    alert('Berhasil update keluhan!');
                    window.location.reload();
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
            if(id_num == ''){
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
    
    $(document).on('click', '.confirm-done', function(){
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
            method: 'post',
            success: function(response){
                $('.complain-code').html(response.result.complain_code);
                $('.complain-name').html(response.result.name);
                $('.complain-type').html(response.result.complain_type.title);
                $('.submit-confirm-done').data('id', response.result.id);
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.submit-confirm-done', function(){
        let el = $(this),
            id = el.data('id');
        el.prop('disabled', true);
        $('.cancel-confirm-done').prop('disabled', true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'complain-done',
            data: {
                id
            },
            dataType: ' json',
            method: 'post',
            success: function(response){
                console.log(response);
                alert('Status keluhan berubah menjadi selesai');
                window.location.reload();
            },
            fails: function(response){
                console.log(response);
            }
        });
    });

    $(document).on('click', '.attachment-download', function(){
        let el = $(this),
            id = el.data('id');
        $('#downloadTable tbody').empty();   
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'get-complain',
            data: {
                id
            },
            dataType: 'json',
            method: 'post',
            success: function(response){
                let attach = '';
                let counter = 0;
                response.result.attachments.forEach(attachment => {
                    ++counter;
                    attach += `<tr>
                        <td class="text-center" style="vertical-align:middle">${counter}</td>
                        <td class="text-center" style="vertical-align:middle">${attachment.title}</td>
                        <td class="text-center" style="vertical-align:middle">File Ok</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-danger delete-attachment" data-id="${attachment.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
                });
                $('#downloadTable').append(attach);
                $('.confirm-download').attr('href', '/download-attachment/'+response.result.id);
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
  