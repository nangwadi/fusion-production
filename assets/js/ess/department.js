$(document).ready(function(){
    list_department(0);
})

function list_department(cIDDept){
    $('#list_department').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/'+cIDDept,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_department tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_department').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDDept+'\', \''+cNmDept+'\');" title="Update Company - '+cNmDept+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDDept+'\', \''+cNmDept+'\', \''+1+'\');" title="Disable Company - '+cNmDept+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDDept+'\', \''+cNmDept+'\', \''+0+'\');" title="Enable Company - '+cNmDept+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIDDept+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_department tbody').append(trList);
                    $('#list_department').dataTable();
                }
            })
        }
    });
}

function add_department(){
    var cIDDept = $('#cIDDept').val();
    var cNmDept = $('#cNmDept').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-department/'+key_session,
        type: 'post',
        data: 'cIDDept='+cIDDept+'&cNmDept='+cNmDept,
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
                        list_department(0);
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

function update(cIDDept, cNmDept){
    $('#cIDDept').val(cIDDept);
    $('#cNmDept').val(cNmDept);
    document.getElementById('cIDDept').setAttribute('readonly', 'readonly');
    document.getElementById('cIDDept').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#cIDDept').val('');
    $('#cNmDept').val('');
    document.getElementById('cIDDept').removeAttribute('readonly');
    document.getElementById('cIDDept').removeAttribute('style');
    document.getElementById('cIDDept').setAttribute('style', 'color:white');
}

function disable_enable(cIDDept_get, cNmDept_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDDept_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDDept_disen').val(cIDDept_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+cNmDept_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+cNmDept_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+cNmDept_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+cNmDept_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_department(){
    var cIDDept = $('#cIDDept_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-department/'+key_session,
        type: 'post',
        data: 'cIDDept='+cIDDept+'&deleted='+deleted,
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
                        list_department(0);
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