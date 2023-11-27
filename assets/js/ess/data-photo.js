$(document).ready(function(){
    list_data_photo(0);
})

function list_data_photo(id_data_photo){
    $('#list_data_photo').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-data-photo/'+key_session+'/'+id_data_photo,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_data_photo tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_data_photo').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_data_photo = responseList.id_data_photo;
                        var nama_data_photo = responseList.nama_data_photo;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_data_photo+'\', \''+nama_data_photo+'\');" title="Update Company - '+nama_data_photo+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_data_photo+'\', \''+nama_data_photo+'\', \''+1+'\');" title="Disable Company - '+nama_data_photo+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_data_photo+'\', \''+nama_data_photo+'\', \''+0+'\');" title="Enable Company - '+nama_data_photo+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+nama_data_photo+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_data_photo tbody').append(trList);
                    $('#list_data_photo').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_data_photo(){
    var id_data_photo = $('#id_data_photo').val();
    var nama_data_photo = $('#nama_data_photo').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-data-photo/'+key_session,
        type: 'post',
        data: 'id_data_photo='+id_data_photo+'&nama_data_photo='+nama_data_photo,
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
                        list_data_photo(0);
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

function update(id_data_photo, nama_data_photo){
    $('#id_data_photo').val(id_data_photo);
    $('#nama_data_photo').val(nama_data_photo);
    document.getElementById('id_data_photo').setAttribute('readonly', 'readonly');
    document.getElementById('id_data_photo').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#id_data_photo').val('');
    $('#nama_data_photo').val('');
    document.getElementById('id_data_photo').removeAttribute('readonly');
    document.getElementById('id_data_photo').removeAttribute('style');
    document.getElementById('id_data_photo').setAttribute('style', 'color:white');
}

function disable_enable(id_data_photo_get, nama_data_photo_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_data_photo_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_data_photo_disen').val(id_data_photo_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable data photo - "+nama_data_photo_get+".");
        $('#modal_body_disen').append("Are you sure will disable data photo "+nama_data_photo_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable data photo - "+nama_data_photo_get+".");
        $('#modal_body_disen').append("Are you sure will enable data photo "+nama_data_photo_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_data_photo(){
    var id_data_photo = $('#id_data_photo_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-data-photo/'+key_session,
        type: 'post',
        data: 'id_data_photo='+id_data_photo+'&deleted='+deleted,
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
                        list_data_photo(0);
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