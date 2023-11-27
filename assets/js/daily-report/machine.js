$(document).ready(function(){
    list_machine(0);
})

function list_machine(machine_id_get){
    $('#list_machine').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'daily-report/list-machine/'+key_session+'/'+machine_id_get,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_machine tbody').html('');
            trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_machine').dataTable();
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var machine_id = responseList.machine_id;
                        var machine_code = responseList.machine_code;
                        var machine_name = responseList.machine_name;

                        var deleted = responseList.deleted;
                        var button_action = '';
                        if (deleted==0) {
                            button_action += '<td><buttons class="btn btn-info" onclick="update(\''+machine_id+'\', \''+machine_code+'\', \''+machine_name+'\');"><i class="mdi mdi-lead-pencil"></i></buttons>&nbsp;&nbsp;<buttons class="btn btn-danger" onclick="disable_enable(\''+machine_id+'\', \''+machine_code+'\', \''+machine_name+'\', \''+1+'\');"><i class="mdi mdi-delete"></i></buttons></td>';
                        }
                        else {
                            button_action = '<td><buttons class="btn btn-warning" onclick="disable_enable(\''+machine_id+'\', \''+machine_code+'\', \''+machine_name+'\', \''+0+'\');"><i class="mdi mdi-backup-restore"></i></buttons></td>'
                        }

                        trList += '<tr>';
                        trList += '<td style="color:white;" align="center">'+(i+1)+'</td>';
                        trList += '<td style="color:white;">'+machine_code+'</td>';
                        trList += '<td style="color:white;">'+machine_name+'</td>';
                        trList += button_action;
                        trList += '</tr>';
                    })
                }
            })
            $('#list_machine tbody').append(trList);
            $('#list_machine').dataTable();
        }
    })
}

function add_machine(){
    var machine_id = $('#machine_id').val();
    var machine_code = $('#machine_code').val();
    var machine_code_koutei = $('#machine_code_koutei').val();
    var machine_name = $('#machine_name').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'daily-report/add-machine/'+key_session,
        type: 'post',
        data: 'machine_id='+machine_id+'&machine_code='+machine_code+'&machine_code_koutei='+machine_code_koutei+'&machine_name='+machine_name,
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
                        list_machine(0);
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
        },
        error: function(error){
            console.log(error.responseText);
        }
    })
}

function update(machine_id_get, machine_code_get, machine_name_get){
    $('#machine_id').val('');
    $('#machine_name').val('');
    $('#machine_code').val('');

    $('#machine_id').val(machine_id_get);
    $('#machine_name').val(machine_name_get);
    $('#machine_code').val(machine_code_get);

    document.getElementById('machine_id').setAttribute('readonly', 'readonly');
    document.getElementById('machine_id').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#machine_id').val('');
    $('#machine_name').val('');
    $('#machine_code').val('');

    document.getElementById('machine_id').removeAttribute('readonly');
    document.getElementById('machine_id').removeAttribute('style');
    document.getElementById('machine_id').setAttribute('style', 'color:white');
}

function disable_enable(machine_id_get, machine_code_get, machine_name_get, values_get){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#machine_id_disen').val('');
    $('#value_disen').val('');

    $('#machine_id_disen').val(machine_id_get);
    $('#value_disen').val(values_get);
    if (values_get==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable machine group - "+machine_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable machine group "+machine_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable machine group - "+machine_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable machine group "+machine_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}


function update_machine(){
    var machine_id_disen = $('#machine_id_disen').val();
    var value_disen = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'daily-report/update-machine/'+key_session,
        type: 'post',
        data: 'machine_id='+machine_id_disen+'&deleted='+value_disen,
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
                        list_machine(0);
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
        },
        error: function(error){
            console.log(error.responseText);
        }
    })
}
function disable_enable_hide(){
    $('#modal_disen').modal('hide');
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