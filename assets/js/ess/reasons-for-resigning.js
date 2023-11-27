$(document).ready(function(){
    list_reasons_for_resigning(0);
})

function list_reasons_for_resigning(cIDJnsBerhenti){
    $('#list_reasons_for_resigning').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-reasons-for-resigning/'+key_session+'/'+cIDJnsBerhenti,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#list_reasons_for_resigning tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_reasons_for_resigning').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDJnsBerhenti = responseList.cIDJnsBerhenti;
                        var cNmJnsBerhenti = responseList.cNmJnsBerhenti;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDJnsBerhenti+'\', \''+cNmJnsBerhenti+'\');" title="Update Company - '+cNmJnsBerhenti+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDJnsBerhenti+'\', \''+cNmJnsBerhenti+'\', \''+1+'\');" title="Disable Company - '+cNmJnsBerhenti+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDJnsBerhenti+'\', \''+cNmJnsBerhenti+'\', \''+0+'\');" title="Enable Company - '+cNmJnsBerhenti+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            //trList += '<td style="color:white;">'+cIDJnsBerhenti+'</td>';
                            trList += '<td style="color:white;">'+cNmJnsBerhenti+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_reasons_for_resigning tbody').append(trList);
                    $('#list_reasons_for_resigning').dataTable();
                }
            })
        }
    });
}

function update(cIDJnsBerhenti, cNmJnsBerhenti){
    $('#cIDJnsBerhenti').val(cIDJnsBerhenti);
    $('#cNmJnsBerhenti').val(cNmJnsBerhenti);
    document.getElementById('cIDJnsBerhenti').setAttribute('readonly', 'readonly');
    document.getElementById('cIDJnsBerhenti').setAttribute('style', 'color:black');
}

function add_reasons_for_resigning(){
    var cIDJnsBerhenti = $('#cIDJnsBerhenti').val();
    var cNmJnsBerhenti = $('#cNmJnsBerhenti').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-reasons-for-resigning/'+key_session,
        type: 'post',
        data: 'cIDJnsBerhenti='+cIDJnsBerhenti+'&cNmJnsBerhenti='+cNmJnsBerhenti,
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
                        list_reasons_for_resigning(0);
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
    $('#cIDJnsBerhenti').val('');
    $('#cNmJnsBerhenti').val('');
    document.getElementById('cIDJnsBerhenti').removeAttribute('readonly');
    document.getElementById('cIDJnsBerhenti').removeAttribute('style');
    document.getElementById('cIDJnsBerhenti').setAttribute('style', 'color:black');
}

function disable_enable(cIDJnsBerhenti_get, cNmJnsBerhenti_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDJnsBerhenti_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDJnsBerhenti_disen').val(cIDJnsBerhenti_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+cNmJnsBerhenti_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+cNmJnsBerhenti_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+cNmJnsBerhenti_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+cNmJnsBerhenti_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_reasons_for_resigning(){
    var cIDJnsBerhenti = $('#cIDJnsBerhenti_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-reasons-for-resigning/'+key_session,
        type: 'post',
        data: 'cIDJnsBerhenti='+cIDJnsBerhenti+'&deleted='+deleted,
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
                        list_reasons_for_resigning(0);
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