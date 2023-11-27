$(document).ready(function(){
    list_transaction_role(id_module);
})

function add_transaction_role(){
    var id_transaction_role = $('#id_transaction_role').val();
    var sequence = $('#sequence').val();
    var transaction_name = $('#transaction_name').val();
    var write_check = $('#write').prop('checked');
    var email_approval_check = $('#email_approval').prop('checked');
    var email_vendor_check = $('#email_vendor').prop('checked');
    var close_transaction_check = $('#close_transaction').prop('checked');
    var no = $('#no').val();

    let write = 0;
    let email_approval = 0;
    let email_vendor = 0;
    let close_transaction = 0;

    if (write_check==true) {
        write = 1;
    }

    if (email_approval_check==true) {
        email_approval = 1;
    }

    if (email_vendor_check==true) {
        email_vendor = 1;
    }

    if (close_transaction_check==true) {
        close_transaction = 1;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'distribution/add-transaction-role/'+key_session,
        type: 'post',
        data: 'id_transaction_role='+id_transaction_role+'&sequence='+sequence+'&transaction_name='+transaction_name+'&write='+write+'&email_approval='+email_approval+'&email_vendor='+email_vendor+'&close_transaction='+close_transaction+'&id_module='+id_module,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        if (id_transaction_role=='') {
                            list_transaction_role(id_module);
                        }
                        else {
                            $('#sequence_'+no).html('');
                            $('#transaction_name_'+no).html('');
                            $('#write_'+no).html('');
                            $('#email_approval_'+no).html('');
                            $('#email_vendor_'+no).html('');
                            $('#close_transaction_'+no).html('');
                            $('#sequence_'+no).append(sequence);
                            $('#transaction_name_'+no).append(transaction_name);

                            if (write_check==true) {
                                $('#write_'+no).append('Yes');
                            }
                            else {
                                $('#write_'+no).append('No');
                            }

                            if (email_approval_check==true) {
                                $('#email_approval_'+no).append('Yes');
                            }
                            else {
                                $('#email_approval_'+no).append('No');
                            }

                            if (email_vendor_check==true) {
                                $('#email_vendor_'+no).append('Yes');
                            }
                            else {
                                $('#email_vendor_'+no).append('No');
                            }

                            if (close_transaction_check==true) {
                                $('#close_transaction_'+no).append('Yes');
                            }
                            else {
                                $('#close_transaction_'+no).append('No');
                            }

                            document.getElementById('btn_update_'+no).removeAttribute('onclick');
                            document.getElementById('btn_delete_'+no).removeAttribute('onclick');

                            document.getElementById('btn_update_'+no).setAttribute('onclick', 'update_transaction_role(\''+id_transaction_role+'\', \''+sequence+'\', \''+transaction_name+'\', \''+write+'\', \''+email_approval+'\', \''+email_vendor+'\', \''+close_transaction+'\', \''+no+'\');');
                            document.getElementById('btn_delete_'+no).setAttribute('onclick', 'update_transaction_role(\''+id_transaction_role+'\', \''+sequence+'\', \''+transaction_name+'\');');
                        }

                        modal_loading_hide();
                        $('#sequence').val('');
                        $('#transaction_name').val('');
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function list_transaction_role(id_module){
    $('#list_transaction_role').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-transaction-role/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_transaction_role tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_transaction_role = responseList.id_transaction_role;
                        var sequence = responseList.sequence;
                        var transaction_name = responseList.transaction_name;
                        let write = (responseList.write)*1;
                        let email_approval = (responseList.email_approval)*1;
                        let email_vendor = (responseList.email_vendor)*1;
                        let close_transaction = (responseList.close_transaction)*1;

                        var write_descr = '';
                        var email_approval_descr = '';
                        var email_vendor_descr = '';
                        var close_transaction_descr = '';

                        if (write==1) {
                            write_descr = 'Yes';
                        }
                        else {
                            write_descr = 'No';
                        }

                        if (email_approval==1) {
                            email_approval_descr = 'Yes';
                        }
                        else {
                            email_approval_descr = 'No';
                        }

                        if (email_vendor==1) {
                            email_vendor_descr = 'Yes';
                        }
                        else {
                            email_vendor_descr = 'No';
                        }

                        if (close_transaction==1) {
                            close_transaction_descr = 'Yes';
                        }
                        else {
                            close_transaction_descr = 'No';
                        }
                        
                        trList += '<tr>';
                            //trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="sequence_'+(i+1)+'">'+sequence+'</div></td>';
                            trList += '<td style="color:white;"><div id="transaction_name_'+(i+1)+'">'+transaction_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="write_'+(i+1)+'">'+write_descr+'</div></td>';
                            trList += '<td style="color:white;"><div id="email_approval_'+(i+1)+'">'+email_approval_descr+'</div></td>';
                            trList += '<td style="color:white;"><div id="email_vendor_'+(i+1)+'">'+email_vendor_descr+'</div></td>';
                            trList += '<td style="color:white;"><div id="close_transaction_'+(i+1)+'">'+close_transaction_descr+'</div></td>';
                            trList += '<td>';
                                trList +='<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update_transaction_role(\''+id_transaction_role+'\', \''+sequence+'\', \''+transaction_name+'\', \''+write+'\', \''+email_approval+'\', \''+email_vendor+'\', \''+close_transaction+'\', \''+(i+1)+'\');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                                trList +='<button class="btn btn-danger" id="btn_delete_'+(i+1)+'" onclick="delete_transaction_role(\''+id_transaction_role+'\', \''+sequence+'\', \''+transaction_name+'\');"><i class="mdi mdi-delete-forever"></i></button>';
                            trList += '</td>';
                        trList += '</tr>';
                    })
                    $('#list_transaction_role tbody').append(trList);
                    $('#list_transaction_role').dataTable();
                }
                else {
                    $('#list_transaction_role').dataTable();
                }
            })
        }
    });
}

function delete_transaction_role(id_transaction_role_get, sequence_get, transaction_name_get){
    if (confirm('Are you sure you want to delete '+transaction_name_get+' from permission ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');

        $.ajax({
            url: base_url+'distribution/delete-transaction-role/'+key_session,
            type: 'post',
            data: 'id_transaction_role='+id_transaction_role_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            list_transaction_role(id_module)
                            modal_loading_hide();
                            $('#transaction_name').val('');
                        }, 5000);

                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function update_transaction_role(id_transaction_role_get, sequence_get, transaction_name_get, write_check, email_approval_check, email_vendor_check, close_transaction_check, no_get){
    $('#id_transaction_role').val(id_transaction_role_get);
    $('#sequence').val(sequence_get);
    $('#transaction_name').val(transaction_name_get);
    $('#no').val(no_get);
    
    if (write_check==1) {
        $('#write').prop('checked', true);
    }
    else {
        $('#write').prop('checked', false);
    }

    if (email_approval_check==1) {
        $('#email_approval').prop('checked', true);
    }
    else {
        $('#email_approval').prop('checked', false);
    }

    if (email_vendor_check==1) {
        $('#email_vendor').prop('checked', true);
    }
    else {
        $('#email_vendor').prop('checked', false);
    }

    if (close_transaction_check==1) {
        $('#close_transaction').prop('checked', true);
    }
    else {
        $('#close_transaction').prop('checked', false);
    }
}

function reset_form(){
    $('#id_transaction_role').val('');
    $('#sequence').val('');
    $('#transaction_name').val('');
    $('#no').val('');

    list_module_category(0, 0);
}

function disable_enable(id_module_get, module_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_module_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_module_disen').val(id_module_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+module_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+module_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_module(){
    var id_module = $('#id_module_disen').val();
    var deleted = $('#value_disen').val();

    //console.log(id_module+' '+deleted);

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'distribution/update-module/'+key_session,
        type: 'post',
        data: 'id_module='+id_module+'&deleted='+deleted,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        list_module(0);
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Updating data unsuccessfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function modal_loading_open(backgroundcolor, values_header, values_body){
    document.getElementById('modal_header').setAttribute('class', 'modal-header '+backgroundcolor);
    $('#modal_title').append(values_header);
    $('#modal_body').append(values_body);
    $('#modal_loading').modal('show');
}

function modal_loading_hide(){
    document.getElementById('modal_header').removeAttribute('class');
    $('#modal_title').html('');
    $('#modal_body').html('');
    $('#modal_loading').modal('hide');
}