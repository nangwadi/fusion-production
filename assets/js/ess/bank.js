$(document).ready(function(){
    list_bank(0);
})

function list_bank(cIDBank){
    $('#list_bank').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-bank/'+key_session+'/'+cIDBank,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_bank tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_bank').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDBank = responseList.cIDBank;
                        var cNmBank = responseList.cNmBank;
                        var cSandiBank = responseList.cSandiBank;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDBank+'\', \''+cNmBank+'\', \''+cSandiBank+'\');" title="Update Company - '+cNmBank+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDBank+'\', \''+cNmBank+'\', \''+cSandiBank+'\', \''+1+'\');" title="Disable Company - '+cNmBank+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDBank+'\', \''+cNmBank+'\', \''+cSandiBank+'\', \''+0+'\');" title="Enable Company - '+cNmBank+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIDBank+'</td>';
                            trList += '<td style="color:white;">'+cNmBank+'</td>';
                            trList += '<td style="color:white;">'+cSandiBank+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_bank tbody').append(trList);
                    $('#list_bank').dataTable();
                }
            })
        }
    });
}

function update(cIDBank, cNmBank, cSandiBank){
    $('#cIDBank').val(cIDBank);
    $('#cNmBank').val(cNmBank);
    $('#cSandiBank').val(cSandiBank);
    document.getElementById('cIDBank').setAttribute('readonly', 'readonly');
    document.getElementById('cIDBank').setAttribute('style', 'color:black');
}

function add_bank(){
    var cIDBank = $('#cIDBank').val();
    var cNmBank = $('#cNmBank').val();
    var cSandiBank = $('#cSandiBank').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-bank/'+key_session,
        type: 'post',
        data: 'cIDBank='+cIDBank+'&cNmBank='+cNmBank+'&cSandiBank='+cSandiBank,
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
                        list_bank(0);
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
    $('#cIDBank').val('');
    $('#cNmBank').val('');
    $('#cSandiBank').val('');
    document.getElementById('cIDBank').removeAttribute('readonly');
    document.getElementById('cIDBank').removeAttribute('style');
    document.getElementById('cIDBank').setAttribute('style', 'color:black');
}

function disable_enable(cIDBank_get, cNmBank_get, cSandiBank, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDBank_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDBank_disen').val(cIDBank_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+cNmBank_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+cNmBank_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+cNmBank_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+cNmBank_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_bank(){
    var cIDBank = $('#cIDBank_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-bank/'+key_session,
        type: 'post',
        data: 'cIDBank='+cIDBank+'&deleted='+deleted,
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
                        list_bank(0);
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