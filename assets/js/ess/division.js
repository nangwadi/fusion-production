$(document).ready(function(){
    list_department(0, '');
    list_division(0)
})

function list_department(cIDDept_get, cNmDept_get){
    $('#cIDDept').html('');
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){

                var trList = '';

                if (cIDDept_get=='0') {
                    trList += '<option value="" style="color:white;">Select Department</option>';
                }
                else {
                    trList += '<option value="'+cIDDept_get+'" style="color:white;">'+cNmDept_get+'</option>';
                }

                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var cIDDept = responseList.cIDDept;
                    var cNmDept = responseList.cNmDept;

                    trList += '<option value="'+cIDDept+'">'+cNmDept+'</option>';
                })
                $('#cIDDept').append(trList);
            })

        }
    });
}

function list_division(cIDBag){
    $('#list_division').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-division/'+key_session+'/'+cIDBag,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_division tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_division').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDBag+'\', \''+cNmBag+'\', \''+cIDDept+'\', \''+cNmDept+'\');" title="Update Company - '+cNmBag+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDBag+'\', \''+cNmBag+'\', \''+1+'\');" title="Disable Company - '+cNmBag+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDBag+'\', \''+cNmBag+'\', \''+0+'\');" title="Enable Company - '+cNmBag+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+cIDBag+'</td>';
                            trList += '<td style="color:white;">'+cNmBag+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_division tbody').append(trList);
                    $('#list_division').dataTable();
                }
            })
        }
    });
}

function update(cIDBag, cNmBag, cIDDept, cNmDept){
    $('#cIDBag').val('');
    $('#cNmBag').val('');
    $('#cIDBag').val(cIDBag);
    $('#cNmBag').val(cNmBag);
    list_department(cIDDept, cNmDept)
    document.getElementById('cIDBag').setAttribute('readonly', 'readonly');
    document.getElementById('cIDBag').setAttribute('style', 'color:black');
}

function add_division(){
    var cIDDept = $('#cIDDept').val();
    var cIDBag = $('#cIDBag').val();
    var cNmBag = $('#cNmBag').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-division/'+key_session,
        type: 'post',
        data: 'cIDDept='+cIDDept+'&cIDBag='+cIDBag+'&cNmBag='+cNmBag,
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
                        list_division(0);
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
    $('#cIDBag').val('');
    $('#cNmBag').val('');
    list_department(0, '');
    document.getElementById('cIDBag').removeAttribute('readonly');
    document.getElementById('cIDBag').removeAttribute('style');
    document.getElementById('cIDBag').setAttribute('style', 'color:white');
}

function disable_enable(cIDBag_get, cNmBag_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDBag_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDBag_disen').val(cIDBag_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable division - "+cNmBag_get+".");
        $('#modal_body_disen').append("Are you sure will disable division "+cNmBag_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable division - "+cNmBag_get+".");
        $('#modal_body_disen').append("Are you sure will enable division "+cNmBag_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_division(){
    var cIDBag = $('#cIDBag_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-division/'+key_session,
        type: 'post',
        data: 'cIDBag='+cIDBag+'&deleted='+deleted,
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
                        list_division(0);
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