$(document).ready(function(){
    list_coa(0);
    list_coa_coa(0, 0, 0);
})

function list_coa_coa(id_coa_get, coa_cd_get, coa_name_get){
    $('#id_coa').html('');
    $.ajax({
        url: base_url+'coa/list-chart-of-account/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_coa_get!='0') {
                trList += '<option value="'+id_coa_get+'">'+coa_cd_get+' / '+coa_name_get+'</option>';
            }
            else {
                trList += '<option value="">Select COA</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var id_coa_type = responseList.id_coa_type;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            if (id_coa_type==1) {
                                trList += '<option value="'+id_coa+'">'+coa_cd+' / '+coa_name+'</option>';
                            }
                        }
                    })
                }
            })            
            $('#id_coa').append(trList);
        }
    });
}

function list_coa(id_cash_account_get){
    $('#list_coa').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'coa/list-cash-account/'+key_session+'/'+id_cash_account_get,
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
                        var id_cash_account = responseList.id_cash_account;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var cash_account_cd = responseList.cash_account_cd;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var deleted = responseList.deleted;
                        var decimal_after = responseList.decimal_after;
                        var nominal = responseList.nominal;
                        var nominal_format = responseList.nominal;
                        var set_default = responseList.set_default;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var default_checkbox = '';
                        if (set_default==0) {
                            default_checkbox = '<input type="checkbox" style="width:25px; height:25px;" id="set_default_'+(i+1)+'" onchange="update_default(\''+(i+1)+'\', \''+id_cash_account+'\', \''+coa_name+'\');">';
                        }
                        else {
                            default_checkbox = '<input type="checkbox" style="width:25px; height:25px;" id="set_default_'+(i+1)+'" onchange="update_default(\''+(i+1)+'\', \''+id_cash_account+'\', \''+coa_name+'\');" checked="checked">';
                        }

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_cash_account+'\', \''+cash_account_cd+'\', \''+id_coa+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+nominal+'\', \''+(i+1)+'\');" title="Update Company - '+coa_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_cash_account+'\', \''+cash_account_cd+'\', \''+1+'\');" title="Disable Company - '+cash_account_cd+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_cash_account+'\', \''+cash_account_cd+'\', \''+0+'\');" title="Enable Company - '+cash_account_cd+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="div_cash_account_cd_'+(i+1)+'">'+cash_account_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_cd_'+(i+1)+'">'+coa_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_name_'+(i+1)+'">'+coa_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_nominal_'+(i+1)+'">'+nominal_format+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_currency_cd_'+(i+1)+'">'+coa_currency_cd+'</div></td>';
                            trList += '<td style="color:white;">'+default_checkbox+'</td>';
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
    var id_cash_account = $('#id_cash_account').val();
    var id_coa = $('#id_coa').val();
    var cash_account_cd = $('#cash_account_cd').val();
    var nominal = $('#nominal').val();

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/add-cash-account/'+key_session,
        type: 'post',
        data: 'id_cash_account='+id_cash_account+'&id_coa='+id_coa+'&cash_account_cd='+cash_account_cd+'&nominal='+nominal,
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
                        if (id_cash_account=='') {
                            list_coa(0);
                        }
                        else {
                            $('#div_cash_account_cd_'+no).html('');
                            $('#div_coa_cd_'+no).html('');
                            $('#div_coa_name_'+no).html('');
                            $('#div_nominal_'+no).html('');
                            $('#div_coa_currency_cd_'+no).html('');

                            document.getElementById('btn_update_'+no).removeAttribute('onclick');
                            document.getElementById('btn_disable_'+no).removeAttribute('onclick');

                            var response = responseGetList.response;
                            response.map(function(responseList){
                                var id_cash_account_db = responseList.id_cash_account;
                                var company_id_db = responseList.company_id;
                                var company_name_db = responseList.company_name;
                                var id_coa_db = responseList.id_coa;
                                var coa_cd_db = responseList.coa_cd;
                                var coa_name_db = responseList.coa_name;
                                var cash_account_cd_db = responseList.cash_account_cd;
                                var coa_currency_cd_db = responseList.coa_currency_cd;
                                var deleted_db = responseList.deleted;
                                var decimal_after_db = responseList.decimal_after;
                                var nominal_db = responseList.nominal;
                                var nominal_format_db = responseList.nominal;

                                $('#div_cash_account_cd_'+no).append(cash_account_cd_db);
                                $('#div_coa_cd_'+no).append(coa_cd_db);
                                $('#div_coa_name_'+no).append(coa_name_db);
                                $('#div_nominal_'+no).append(nominal_format_db);
                                $('#div_coa_currency_cd_'+no).append(coa_currency_cd_db);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_cash_account_db+'\', \''+cash_account_cd_db+'\', \''+id_coa_db+'\', \''+coa_cd_db+'\', \''+coa_name_db+'\', \''+nominal_format_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_cash_account_db+'\', \''+cash_account_cd_db+'\', \''+1+'\')');
                            })
                        }
                        reset_form();
                        modal_loading_hide();
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

function update(id_cash_account_get, cash_account_cd_get, id_coa_get, coa_cd_get, coa_name_get, nominal_get, no_get){
    $('#id_cash_account').val('');
    $('#cash_account_cd').val('');
    $('#nominal').val('');
    $('#no').val('');

    $('#id_cash_account').val(id_cash_account_get);
    $('#cash_account_cd').val(cash_account_cd_get);
    $('#nominal').val(nominal_get);
    $('#no').val(no_get);
    list_coa_coa(id_coa_get, coa_cd_get, coa_name_get);
}

function update_default(no_get, id_cash_account_get, coa_name_get){
    var check_default = $('#set_default_'+no_get).prop('checked');
    if (check_default == false) {
        alert ('You must set one of more checked to process this action.');
        $('#set_default_'+no_get).prop('checked', 'checked');
    }
    else {
        if (confirm('Are you sure you want set '+coa_name_get+' as default currency ?')) {
            modal_loading_open('bg-info', 'Updating data', 'Please wait...');
            $.ajax({
                url: base_url+'coa/set-default-cash-account/'+key_session,
                type: 'POST',
                data: 'id_cash_account='+id_cash_account_get,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    modal_loading_hide();
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait for hide this view...');
                            setTimeout(function () {
                                list_coa(0);
                                modal_loading_hide();
                            }, 5000);
                        }
                        else {
                            var response = responseGetList.response;
                            modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error :'+response, 'Please wait for hide this view...');
                            setTimeout(function () {
                                modal_loading_hide();
                            }, 10000);
                        }
                    })
                },
                error : function(error){
                    console.log(error.responseText);
                }
            })
        }
    }
}

function reset_form(){
    $('#id_cash_account').val('');
    $('#cash_account_cd').val('');
    $('#nominal').val('');
    list_coa_coa(0, 0, 0);
}

function disable_enable(id_cash_account_get, cash_account_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_cash_account_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_cash_account_disen').val(id_cash_account_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable coa - "+cash_account_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable coa "+cash_account_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else if (values==0){
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable coa - "+cash_account_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable coa "+cash_account_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_coa(){
    var id_cash_account = $('#id_cash_account_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/update-cash-account/'+key_session,
        type: 'post',
        data: 'id_cash_account='+id_cash_account+'&deleted='+deleted,
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
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error :'+response, 'Please wait for hide this view...');
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