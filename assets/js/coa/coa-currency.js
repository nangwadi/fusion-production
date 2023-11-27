$(document).ready(function(){
    list_coa(0);
})

function list_coa(id_coa_currency_get){
    $('#list_coa').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'coa/list-coa-currency/'+key_session+'/'+id_coa_currency_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_coa tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_coa').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var decimal_after = responseList.decimal_after;
                        var set_default = responseList.set_default;
                        var deleted = responseList.deleted;

                        var set_default_desc = '';
                        if (set_default==0) {
                            set_default_desc = 'No';
                        }
                        else {
                            set_default_desc = 'Yes';
                        }

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_coa_currency+'\', \''+coa_currency_cd+'\', \''+coa_currency_name+'\', \''+decimal_after+'\', \''+set_default+'\');" title="Update Company - '+coa_currency_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_coa_currency+'\', \''+coa_currency_name+'\', \''+1+'\');" title="Disable Company - '+coa_currency_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_coa_currency+'\', \''+coa_currency_name+'\', \''+0+'\');" title="Enable Company - '+coa_currency_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+coa_currency_cd+'</td>';
                            trList += '<td style="color:white;">'+coa_currency_name+'</td>';
                            trList += '<td style="color:white;">'+decimal_after+'</td>';
                            trList += '<td style="color:white;" align="center">'+set_default_desc+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_coa tbody').append(trList);
                    $('#list_coa').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_coa(){
    var id_coa_currency = $('#id_coa_currency').val();
    var coa_currency_cd = $('#coa_currency_cd').val();
    var coa_currency_name = $('#coa_currency_name').val();
    var decimal_after = $('#decimal_after').val();
    const set_default = $('#set_default').prop('checked');
    let set_default_value = 0;
    if (set_default == true) {
        set_default_value = 1;
    }
    else {
        set_default_value = 0;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/add-coa-currency/'+key_session,
        type: 'post',
        data: 'id_coa_currency='+id_coa_currency+'&coa_currency_cd='+coa_currency_cd+'&coa_currency_name='+coa_currency_name+'&decimal_after='+decimal_after+'&set_default='+set_default_value,
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
                        list_coa(0);
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

function update(id_coa_currency_get, coa_currency_cd_get, coa_currency_name_get, decimal_after_get, set_default_get){
    $('#id_coa_currency').val(id_coa_currency_get);
    $('#coa_currency_cd').val(coa_currency_cd_get);
    $('#coa_currency_name').val(coa_currency_name_get);
    $('#decimal_after').val(decimal_after_get);

    if (set_default_get==0) {
        $('#set_default').prop('checked', false);
    }
    else {
        $('#set_default').prop('checked', true);
    }
}

function reset_form(){
    $('#id_coa_currency').val('');
    $('#coa_currency_cd').val('');
    $('#coa_currency_name').val('');
    $('#decimal_after').val('');
    $('#set_default').prop('checked', false);
}

function disable_enable(id_coa_currency_get, coa_currency_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_coa_currency_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_coa_currency_disen').val(id_coa_currency_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable coa - "+coa_currency_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable coa "+coa_currency_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else if (values==0){
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable coa - "+coa_currency_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable coa "+coa_currency_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_coa(){
    var id_coa_currency = $('#id_coa_currency_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/update-coa-currency/'+key_session,
        type: 'post',
        data: 'id_coa_currency='+id_coa_currency+'&deleted='+deleted,
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
                        list_coa(0);
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