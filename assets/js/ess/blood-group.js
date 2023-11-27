$(document).ready(function(){
    list_blood_group(0);
})

function list_blood_group(id_golongan_darah){
    $('#list_blood_group').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-blood-group/'+key_session+'/'+id_golongan_darah,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_blood_group tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_blood_group').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_golongan_darah = responseList.id_golongan_darah;
                        var nama_golongan_darah = responseList.nama_golongan_darah;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_golongan_darah+'\', \''+nama_golongan_darah+'\');" title="Update Company - '+nama_golongan_darah+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_golongan_darah+'\', \''+nama_golongan_darah+'\', \''+1+'\');" title="Disable Company - '+nama_golongan_darah+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_golongan_darah+'\', \''+nama_golongan_darah+'\', \''+0+'\');" title="Enable Company - '+nama_golongan_darah+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+id_golongan_darah+'</td>';
                            trList += '<td style="color:white;">'+nama_golongan_darah+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_blood_group tbody').append(trList);
                    $('#list_blood_group').dataTable();
                }
            })
        }
    });
}

function update(id_golongan_darah, nama_golongan_darah){
    $('#id_golongan_darah').val(id_golongan_darah);
    $('#nama_golongan_darah').val(nama_golongan_darah);
    document.getElementById('id_golongan_darah').setAttribute('readonly', 'readonly');
    document.getElementById('id_golongan_darah').setAttribute('style', 'color:black');
}

function add_blood_group(){
    var id_golongan_darah = $('#id_golongan_darah').val();
    var nama_golongan_darah = $('#nama_golongan_darah').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-blood-group/'+key_session,
        type: 'post',
        data: 'id_golongan_darah='+id_golongan_darah+'&nama_golongan_darah='+nama_golongan_darah,
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
                        list_blood_group(0);
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
    $('#id_golongan_darah').val('');
    $('#nama_golongan_darah').val('');
    document.getElementById('id_golongan_darah').removeAttribute('readonly');
    document.getElementById('id_golongan_darah').removeAttribute('style');
    document.getElementById('id_golongan_darah').setAttribute('style', 'color:white');
}

function disable_enable(id_golongan_darah_get, nama_golongan_darah_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_golongan_darah_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_golongan_darah_disen').val(id_golongan_darah_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+nama_golongan_darah_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+nama_golongan_darah_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+nama_golongan_darah_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+nama_golongan_darah_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_blood_group(){
    var id_golongan_darah = $('#id_golongan_darah_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-blood-group/'+key_session,
        type: 'post',
        data: 'id_golongan_darah='+id_golongan_darah+'&deleted='+deleted,
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
                        list_blood_group(0);
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