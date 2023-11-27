$(document).ready(function(){
    list_module_category(0);
})

function select_ar_ap(category){
    var checkbox = $('#checkbox_'+category).prop('checked');
    if (category=='ap') {
        if (checkbox == true) {
            $('#checkbox_'+category).prop('checked', true);
            $('#checkbox_ar').prop('checked', false);
        }
        else {
            $('#checkbox_'+category).prop('checked', false);
            $('#checkbox_ar').prop('checked', true);
        }
    }
    else if (category=='ar') {
        if (checkbox == true) {
            $('#checkbox_'+category).prop('checked', true);
            $('#checkbox_ap').prop('checked', false);
        }
        else {
            $('#checkbox_'+category).prop('checked', false);
            $('#checkbox_ap').prop('checked', true);
        }
    }
}

function add_module_category(){
    var id_module_category = $('#id_module_category').val();
    var module_category_cd = $('#module_category_cd').val();
    var module_category_name = $('#module_category_name').val();

    var checkbox_ap = $('#checkbox_ap').prop('checked');

    var ar_ap = '';
    if (checkbox_ap==true) {
        ar_ap = 'AP';
    }
    else if (checkbox_ap==false) {
        ar_ap = 'AR';
    }

    $.ajax({
        url: base_url+'finance/add-module-category/'+key_session,
        type: 'post',
        data: 'id_module_category='+id_module_category+'&module_category_cd='+module_category_cd+'&module_category_name='+module_category_name+'&ar_ap='+ar_ap,
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
                        list_module_category(0);
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

function list_module_category(id_module_category){
    $('#list_module_category').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'finance/list-module-category/'+key_session+'/'+id_module_category,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_module_category tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_module_category').dataTable();
                }
                else {
                    var trList = '';
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
                            action += '<button class="btn btn-info" onclick="update(\''+id_module_category+'\', \''+module_category_cd+'\', \''+module_category_name+'\', \''+ar_ap_lower+'\');" title="Update Company - '+module_category_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_module_category+'\', \''+module_category_name+'\', \''+1+'\');" title="Disable Company - '+module_category_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_module_category+'\', \''+module_category_name+'\', \''+0+'\');" title="Enable Company - '+module_category_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+module_category_cd+'</td>';
                            trList += '<td style="color:white;">'+module_category_name+'</td>';
                            trList += '<td style="color:white;">'+ar_ap+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_module_category tbody').append(trList);
                    $('#list_module_category').dataTable();
                }
            })
        }
    });
}

function update(id_module_category_get, module_category_cd_get, module_category_name_get, ar_ap_get){
    $('#id_module_category').val(id_module_category_get);
    $('#module_category_cd').val(module_category_cd_get);
    $('#module_category_name').val(module_category_name_get);

    var category = ar_ap_get;

    if (category=='ap') {
        $('#checkbox_'+category).prop('checked', true);
        $('#checkbox_ar').prop('checked', false);
    }
    else if (category=='ar') {
        $('#checkbox_'+category).prop('checked', true);
        $('#checkbox_ap').prop('checked', false);
    }
}

function reset_form(){
    $('#id_module_category').val('');
    $('#module_category_cd').val('');
    $('#module_category_name').val('');

    $('#checkbox_ap').prop('checked', true);
    $('#checkbox_ar').prop('checked', false);
}

function disable_enable(id_module_category_get, module_category_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_module_category_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_module_category_disen').val(id_module_category_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+module_category_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+module_category_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+module_category_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+module_category_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_module_category(){
    var id_module_category = $('#id_module_category_disen').val();
    var deleted = $('#value_disen').val();

    //console.log(id_module_category+' '+deleted);

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'finance/update-module-category/'+key_session,
        type: 'post',
        data: 'id_module_category='+id_module_category+'&deleted='+deleted,
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
                        list_module_category(0);
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