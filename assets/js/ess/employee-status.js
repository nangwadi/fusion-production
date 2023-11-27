$(document).ready(function(){
    list_employee_status(0);
})

function list_employee_status(cIDStsKrj){
    $('#list_employee_status').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-employee-status/'+key_session+'/'+cIDStsKrj,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_employee_status tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_employee_status').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDStsKrj = responseList.cIDStsKrj;
                        var cNmStsKrj = responseList.cNmStsKrj;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDStsKrj+'\', \''+cNmStsKrj+'\');" title="Update Company - '+cNmStsKrj+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDStsKrj+'\', \''+cNmStsKrj+'\', \''+1+'\');" title="Disable Company - '+cNmStsKrj+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDStsKrj+'\', \''+cNmStsKrj+'\', \''+0+'\');" title="Enable Company - '+cNmStsKrj+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIDStsKrj+'</td>';
                            trList += '<td style="color:white;">'+cNmStsKrj+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_employee_status tbody').append(trList);
                    $('#list_employee_status').dataTable();
                }
            })
        }
    });
}

function update(cIDStsKrj, cNmStsKrj){
    $('#cIDStsKrj').val(cIDStsKrj);
    $('#cNmStsKrj').val(cNmStsKrj);
    document.getElementById('cIDStsKrj').setAttribute('readonly', 'readonly');
    document.getElementById('cIDStsKrj').setAttribute('style', 'color:black');
}

function add_employee_status(){
    var cIDStsKrj = $('#cIDStsKrj').val();
    var cNmStsKrj = $('#cNmStsKrj').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-employee-status/'+key_session,
        type: 'post',
        data: 'cIDStsKrj='+cIDStsKrj+'&cNmStsKrj='+cNmStsKrj,
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
                        list_employee_status(0);
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
    $('#cIDStsKrj').val('');
    $('#cNmStsKrj').val('');
    document.getElementById('cIDStsKrj').removeAttribute('readonly');
    document.getElementById('cIDStsKrj').removeAttribute('style');
    document.getElementById('cIDStsKrj').setAttribute('style', 'color:black');
}

function disable_enable(cIDStsKrj_get, cNmStsKrj_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDStsKrj_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDStsKrj_disen').val(cIDStsKrj_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable employee status - "+cNmStsKrj_get+".");
        $('#modal_body_disen').append("Are you sure will disable employee status "+cNmStsKrj_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable employee status - "+cNmStsKrj_get+".");
        $('#modal_body_disen').append("Are you sure will enable employee status "+cNmStsKrj_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_employee_status(){
    var cIDStsKrj = $('#cIDStsKrj_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-employee-status/'+key_session,
        type: 'post',
        data: 'cIDStsKrj='+cIDStsKrj+'&deleted='+deleted,
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
                        list_employee_status(0);
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