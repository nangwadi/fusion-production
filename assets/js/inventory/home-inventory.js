$(document).ready(function(){
    list_coa(0);
    list_coa_currency(0, 0);
})

function list_coa_currency(id_coa_currency_get, coa_currency_cd_get){
    $('#id_coa_currency').html('');
    $.ajax({
        url: base_url+'coa/list-coa-currency/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (id_coa_currency_get!='0') {
                    trList += '<option value="'+id_coa_currency_get+'">'+coa_currency_cd_get+'</option>';
                    $('#id_coa_currency').append(trList);
                }
                else {
                    trList += '<option value="">Select Currency</option>';
                    if (status==0) {
                        trList += '<option value="">Data Not Found.</option>';
                    }
                    else {
                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var company_id = responseList.company_id;
                            var company_name = responseList.company_name;
                            var id_coa_currency = responseList.id_coa_currency;
                            var coa_currency_cd = responseList.coa_currency_cd;
                            var coa_currency_name = responseList.coa_currency_name;
                            var deleted = responseList.deleted;

                            var action = '';
                            if (deleted==0) {
                                trList += '<option value="'+id_coa_currency+'">'+coa_currency_cd+'</option>';
                            }
                        })
                        $('#id_coa_currency').append(trList);
                    }
                }
            })
        }
    });
}

function list_coa(id_coa_classes_get){
    $('#list_coa').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'coa/list-rate/'+key_session+'/'+id_coa_classes_get,
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
                        var id_coa_rate = responseList.id_coa_rate;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var coa_rate_date = responseList.coa_rate_date;
                        var coa_rate_date_format = responseList.coa_rate_date_format;
                        var coa_rate_nominal = responseList.coa_rate_nominal;
                        var coa_rate_nominal_format = responseList.coa_rate_nominal_format;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var action = '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_coa_rate+'\', \''+coa_rate_date+'\', \''+coa_rate_nominal+'\', \''+id_coa_currency+'\', \''+coa_currency_cd+'\', \''+(i+1)+'\');" title="Update Rate - '+coa_currency_cd+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;'; 

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_cd_'+(i+1)+'">'+coa_currency_cd+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_name_'+(i+1)+'">'+coa_rate_date_format+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_classes_name_'+(i+1)+'">'+coa_rate_nominal_format+'</td>';
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
    var id_coa_rate = $('#id_coa_rate').val();
    var coa_rate_date = $('#coa_rate_date').val();
    var coa_rate_nominal = $('#coa_rate_nominal').val();
    var id_coa_currency = $('#id_coa_currency').val();

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/add-rate/'+key_session,
        type: 'post',
        data: 'id_coa_rate='+id_coa_rate+'&coa_rate_date='+coa_rate_date+'&coa_rate_nominal='+coa_rate_nominal+'&id_coa_currency='+id_coa_currency,
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
                        if (id_coa_rate=='') {
                            list_coa(0);
                        }
                        else {
                            $('#div_coa_cd_'+no).html('');
                            $('#div_coa_name_'+no).html('');
                            $('#div_coa_classes_name_'+no).html('');
                            $('#div_coa_type_name_'+no).html('');
                            $('#div_coa_currency_cd_'+no).html('');

                            document.getElementById('btn_update_'+no).removeAttribute('onclick');
                            document.getElementById('btn_disable_'+no).removeAttribute('onclick');

                            var response = responseGetList.response;
                            response.map(function(responseList){
                                var coa_cd_db = responseList.coa_cd;
                                var coa_name_db = responseList.coa_name;
                                var id_coa_classes_db = responseList.id_coa_classes;
                                var coa_classes_cd_db = responseList.coa_classes_cd;
                                var coa_classes_name_db = responseList.coa_classes_name;
                                var id_coa_type_db = responseList.id_coa_type;
                                var coa_type_name_db = responseList.coa_type_name;
                                var id_coa_currency_db = responseList.id_coa_currency;
                                var coa_currency_cd_db = responseList.coa_currency_cd;
                                var coa_currency_cd_db_desc = responseList.coa_currency_cd_desc;

                                $('#div_coa_cd_'+no).append(coa_cd_db);
                                $('#div_coa_name_'+no).append(coa_name_db);
                                $('#div_coa_classes_name_'+no).append(coa_classes_name_db);
                                $('#div_coa_type_name_'+no).append(coa_type_name_db);
                                $('#div_coa_currency_cd_'+no).append(coa_currency_cd_db_desc);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_coa+'\', \''+coa_cd_db+'\', \''+coa_name_db+'\', \''+id_coa_classes_db+'\', \''+coa_classes_cd_db+'\', \''+coa_classes_name_db+'\', \''+id_coa_currency_db+'\', \''+coa_currency_cd_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_coa+'\', \''+coa_name_db+'\', \''+1+'\')');
                            })
                        }
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error :'+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function update(id_coa_rate_get, coa_rate_date_get, coa_rate_nominal_get, id_coa_currency_get, coa_currency_cd_get, no_get){
    $('#id_coa_rate').val('');
    $('#coa_rate_date').val('');
    $('#coa_rate_nominal').val('');
    $('#no').val('');

    $('#id_coa_rate').val(id_coa_rate_get);
    $('#coa_rate_date').val(coa_rate_date_get);
    $('#coa_rate_nominal').val(coa_rate_nominal_get);
    $('#no').val(no_get);
    list_coa_currency(id_coa_currency_get, coa_currency_cd_get)
}

function reset_form(){
    $('#id_coa_rate').val('');
    $('#coa_rate_date').val('');
    $('#coa_rate_nominal').val('');
    list_coa_currency(0, 0);
}

function disable_enable(id_coa_rate_get, coa_rate_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_coa_rate_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_coa_rate_disen').val(id_coa_rate_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable coa - "+coa_rate_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable coa "+coa_rate_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else if (values==0){
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable coa - "+coa_rate_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable coa "+coa_rate_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_coa(){
    var id_coa = $('#id_coa_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/update-rate/'+key_session,
        type: 'post',
        data: 'id_coa='+id_coa+'&deleted='+deleted,
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