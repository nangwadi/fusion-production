$(document).ready(function(){
    list_education(0);
})

function list_education(id_pendidikan){
    $('#list_education').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-education/'+key_session+'/'+id_pendidikan,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_education tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_education').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_pendidikan = responseList.id_pendidikan;
                        var nama_pendidikan = responseList.nama_pendidikan;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_pendidikan+'\', \''+nama_pendidikan+'\');" title="Update Company - '+nama_pendidikan+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_pendidikan+'\', \''+nama_pendidikan+'\', \''+1+'\');" title="Disable Company - '+nama_pendidikan+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_pendidikan+'\', \''+nama_pendidikan+'\', \''+0+'\');" title="Enable Company - '+nama_pendidikan+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            //trList += '<td style="color:white;">'+id_pendidikan+'</td>';
                            trList += '<td style="color:white;">'+nama_pendidikan+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_education tbody').append(trList);
                    $('#list_education').dataTable();
                }
            })
        }
    });
}

function update(id_pendidikan, nama_pendidikan){
    $('#id_pendidikan').val(id_pendidikan);
    $('#nama_pendidikan').val(nama_pendidikan);
    document.getElementById('id_pendidikan').setAttribute('readonly', 'readonly');
    document.getElementById('id_pendidikan').setAttribute('style', 'color:black');
}

function add_education(){
    var id_pendidikan = $('#id_pendidikan').val();
    var nama_pendidikan = $('#nama_pendidikan').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-education/'+key_session,
        type: 'post',
        data: 'id_pendidikan='+id_pendidikan+'&nama_pendidikan='+nama_pendidikan,
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
                        list_education(0);
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}


function reset_form(){
    $('#id_pendidikan').val('');
    $('#nama_pendidikan').val('');
    document.getElementById('id_pendidikan').removeAttribute('readonly');
    document.getElementById('id_pendidikan').removeAttribute('style');
    document.getElementById('id_pendidikan').setAttribute('style', 'color:black');
}

function disable_enable(id_pendidikan_get, nama_pendidikan_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_pendidikan_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_pendidikan_disen').val(id_pendidikan_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+nama_pendidikan_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+nama_pendidikan_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+nama_pendidikan_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+nama_pendidikan_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_education(){
    var id_pendidikan = $('#id_pendidikan_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-education/'+key_session,
        type: 'post',
        data: 'id_pendidikan='+id_pendidikan+'&deleted='+deleted,
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
                        list_education(0);
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