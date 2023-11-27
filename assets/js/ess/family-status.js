$(document).ready(function(){
    list_family_status(0);
})

function list_family_status(cIDSts_Keluarga){
    $('#list_family_status').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-family-status/'+key_session+'/'+cIDSts_Keluarga,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_family_status tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_family_status').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDSts_Keluarga = responseList.cIDSts_Keluarga;
                        var cNmSts_Keluarga = responseList.cNmSts_Keluarga;
                        var istri = responseList.istri;
                        var anak = responseList.anak;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDSts_Keluarga+'\', \''+cNmSts_Keluarga+'\', \''+istri+'\', \''+anak+'\');" title="Update Company - '+cNmSts_Keluarga+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDSts_Keluarga+'\', \''+cNmSts_Keluarga+'\', \''+1+'\');" title="Disable Company - '+cNmSts_Keluarga+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDSts_Keluarga+'\', \''+cNmSts_Keluarga+'\', \''+0+'\');" title="Enable Company - '+cNmSts_Keluarga+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIDSts_Keluarga+'</td>';
                            trList += '<td style="color:white;">'+cNmSts_Keluarga+'</td>';
                            trList += '<td style="color:white;">'+istri+'</td>';
                            trList += '<td style="color:white;">'+anak+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_family_status tbody').append(trList);
                    $('#list_family_status').dataTable();
                }
            })
        }
    });
}

function update(cIDSts_Keluarga_get, cNmSts_Keluarga_get, istri_get, anak_get){
    $('#cIDSts_Keluarga').val('');
    $('#cNmSts_Keluarga').val('');
    $('#istri').val('');
    $('#anak').val('');
    $('#cIDSts_Keluarga').val(cIDSts_Keluarga_get);
    $('#cNmSts_Keluarga').val(cNmSts_Keluarga_get);
    $('#istri').val(istri_get);
    $('#anak').val(anak_get);
    document.getElementById('cIDSts_Keluarga').setAttribute('readonly', 'readonly');
    document.getElementById('cIDSts_Keluarga').setAttribute('style', 'color:black');
}

function add_family_status(){
    var cIDSts_Keluarga = $('#cIDSts_Keluarga').val();
    var cNmSts_Keluarga = $('#cNmSts_Keluarga').val();
    var istri = $('#istri').val();
    var anak = $('#anak').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-family-status/'+key_session,
        type: 'post',
        data: 'cIDSts_Keluarga='+cIDSts_Keluarga+'&cNmSts_Keluarga='+cNmSts_Keluarga+'&istri='+istri+'&anak='+anak,
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
                        list_family_status(0);
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
    $('#cIDSts_Keluarga').val('');
    $('#cNmSts_Keluarga').val('');
    document.getElementById('cIDSts_Keluarga').removeAttribute('readonly');
    document.getElementById('cIDSts_Keluarga').removeAttribute('style');
    document.getElementById('cIDSts_Keluarga').setAttribute('style', 'color:black');
}

function disable_enable(cIDSts_Keluarga_get, cNmSts_Keluarga_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDSts_Keluarga_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDSts_Keluarga_disen').val(cIDSts_Keluarga_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+cNmSts_Keluarga_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+cNmSts_Keluarga_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+cNmSts_Keluarga_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+cNmSts_Keluarga_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_family_status(){
    var cIDSts_Keluarga = $('#cIDSts_Keluarga_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-family-status/'+key_session,
        type: 'post',
        data: 'cIDSts_Keluarga='+cIDSts_Keluarga+'&deleted='+deleted,
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
                        list_family_status(0);
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