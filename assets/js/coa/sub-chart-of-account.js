$(document).ready(function(){
    list_coa(0);
    list_coa_account(0, 0, 0);
})

function list_coa_account(id_coa_get, coa_cd_get, coa_name_get){
    $('#id_coa').html('');
    $.ajax({
        url: base_url+'coa/list-chart-of-account/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (id_coa_get!='') {
                    trList += '<option value="'+id_coa_get+'">'+coa_cd_get+' / '+coa_name_get+'</option>';
                }
                else {
                    trList += '<option value="">Select COA</option>';
                }
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_coa+'">'+coa_cd+' / '+coa_name+'</option>';
                        }

                    })
                    $('#id_coa').append(trList);
                }
            })
        }
    });
}

function list_coa(id_coa_classes_get){
    $('#list_coa').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'coa/list-sub-chart-of-account/'+key_session+'/'+id_coa_classes_get,
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
                        var id_coa_sub = responseList.id_coa_sub;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var coa_sub_cd = responseList.coa_sub_cd;
                        var coa_sub_name = responseList.coa_sub_name;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_coa_sub+'\', \''+coa_sub_cd+'\', \''+coa_sub_name+'\', \''+id_coa+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+(i+1)+'\');" title="Update Company - '+coa_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_coa+'\', \''+coa_name+'\', \''+1+'\');" title="Disable Company - '+coa_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_coa+'\', \''+coa_name+'\', \''+0+'\');" title="Enable Company - '+coa_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_sub_cd_'+(i+1)+'">'+coa_sub_cd+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_sub_name_'+(i+1)+'">'+coa_sub_name+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_cd_'+(i+1)+'">'+coa_cd+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_name_'+(i+1)+'">'+coa_name+'</td>';
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
    var id_coa_sub = $('#id_coa_sub').val();
    var coa_sub_cd = $('#coa_sub_cd').val();
    var coa_sub_name = $('#coa_sub_name').val();
    var id_coa = $('#id_coa').val();

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/add-sub-chart-of-account/'+key_session,
        type: 'post',
        data: 'id_coa_sub='+id_coa_sub+'&coa_sub_cd='+coa_sub_cd+'&coa_sub_name='+coa_sub_name+'&id_coa='+id_coa,
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
                        if (id_coa_sub=='') {
                            list_coa(0);
                        }
                        else {
                            $('#div_coa_sub_cd_'+no).html('');
                            $('#div_coa_sub_name_'+no).html('');
                            $('#div_coa_cd_'+no).html('');
                            $('#div_coa_name_'+no).html('');

                            document.getElementById('btn_update_'+no).removeAttribute('onclick');
                            document.getElementById('btn_disable_'+no).removeAttribute('onclick');

                            var response = responseGetList.response;
                            response.map(function(responseList){
                                var id_coa_sub_db = responseList.id_coa_sub;
                                var company_id_db = responseList.company_id;
                                var company_name_db = responseList.company_name;
                                var id_coa_db = responseList.id_coa;
                                var coa_cd_db = responseList.coa_cd;
                                var coa_name_db = responseList.coa_name;
                                var coa_sub_cd_db = responseList.coa_sub_cd;
                                var coa_sub_name_db = responseList.coa_sub_name;

                                $('#div_coa_sub_cd_'+no).append(coa_sub_cd_db);
                                $('#div_coa_sub_name_'+no).append(coa_sub_name_db);
                                $('#div_coa_cd_'+no).append(coa_cd_db);
                                $('#div_coa_name_'+no).append(coa_name_db);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_coa_sub+'\', \''+coa_sub_cd_db+'\', \''+coa_sub_name_db+'\', \''+id_coa_db+'\', \''+coa_cd_db+'\', \''+coa_name_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_coa_sub+'\', \''+coa_sub_name_db+'\', \''+1+'\')');
                            })
                        }
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

function update(id_coa_sub_get, coa_sub_cd_get, coa_sub_name_get, id_coa_get, coa_cd_get, coa_name_get, no_get){
    $('#id_coa_sub').val('');
    $('#coa_sub_cd').val('');
    $('#coa_sub_name').val('');
    $('#no').val('');

    $('#id_coa_sub').val(id_coa_sub_get);
    $('#coa_sub_cd').val(coa_sub_cd_get);
    $('#coa_sub_name').val(coa_sub_name_get);
    $('#no').val(no_get);
    list_coa_account(id_coa_get, coa_cd_get, coa_name_get);
}

function reset_form(){
    $('#id_coa_sub').val('');
    $('#coa_sub_cd').val('');
    $('#coa_sub_name').val('');
    list_coa_account(0, 0, 0);
}

function disable_enable(id_coa_sub_get, coa_sub_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_coa_sub_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_coa_sub_disen').val(id_coa_sub_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable coa_sub - "+coa_sub_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable coa_sub "+coa_sub_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else if (values==0){
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable coa_sub - "+coa_sub_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable coa_sub "+coa_sub_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_coa(){
    var id_coa_sub = $('#id_coa_sub_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/update-sub-chart-of-account/'+key_session,
        type: 'post',
        data: 'id_coa_sub='+id_coa_sub+'&deleted='+deleted,
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