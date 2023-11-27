$(document).ready(function(){
    list_module(0);
    list_module_category(0, 0);
})

function list_module_category(id_module_category_get, module_category_name_get){
    $('#id_module_category').html('');
    $.ajax({
        url: base_url+'distribution/list-module-category/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (id_module_category_get=='0') {
                trList += '<option value="">Select Module Category</option>';
            }
            else {
                trList += '<option value="'+id_module_category_get+'">'+module_category_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_module_category = responseList.id_module_category;
                        var module_category_cd = responseList.module_category_cd;
                        var module_category_name = responseList.module_category_name;
                        var ar_ap = responseList.ar_ap;
                        var ar_ap_lower = responseList.ar_ap_lower;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_module_category+'">'+module_category_name+'</option>';
                        }
                    })
                }
            })
            $('#id_module_category').append(trList);
        }
    });
}

function add_module(){
    var id_module = $('#id_module').val();
    var module_cd = $('#module_cd').val();
    var module_name = $('#module_name').val();
    var file_name = $('#file_name').val();
    var id_module_category = $('#id_module_category').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'distribution/add-module/'+key_session,
        type: 'post',
        data: 'id_module='+id_module+'&module_cd='+module_cd+'&module_name='+module_name+'&file_name='+file_name+'&id_module_category='+id_module_category,
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
                        list_module(0);
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

function list_module(id_module){
    $('#list_module').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-module/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_module tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_module').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_module = responseList.id_module;
                        var module_cd = responseList.module_cd;
                        var module_name = responseList.module_name;
                        var file_name = responseList.file_name;
                        var id_module_category = responseList.id_module_category;
                        var module_category_cd = responseList.module_category_cd;
                        var module_category_name = responseList.module_category_name;

                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_module+'\', \''+module_cd+'\', \''+module_name+'\', \''+file_name+'\', \''+id_module_category+'\', \''+module_category_name+'\');" title="Update Company - '+module_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_module+'\', \''+module_name+'\', \''+1+'\');" title="Disable Company - '+module_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_module+'\', \''+module_name+'\', \''+0+'\');" title="Enable Company - '+module_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+module_category_name+'</td>';
                            trList += '<td style="color:white;">'+module_cd+'</td>';
                            trList += '<td style="color:white;">'+module_name+'</td>';
                            trList += '<td style="color:white;">'+file_name+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_module tbody').append(trList);
                    $('#list_module').dataTable();
                }
            })
        }
    });
}

function update(id_module_get, module_cd_get, module_name_get, file_name_get, id_module_category_get, module_category_name_get){
    $('#id_module').val(id_module_get);
    $('#module_cd').val(module_cd_get);
    $('#module_name').val(module_name_get);
    $('#file_name').val(file_name_get);

    list_module_category(id_module_category_get, module_category_name_get)
}

function reset_form(){
    $('#id_module').val('');
    $('#module_cd').val('');
    $('#module_name').val('');
    $('#file_name').val('');

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