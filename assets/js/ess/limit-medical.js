$(document).ready(function(){
    list_potition('', '');
    list_potition_medical(0);
})

function list_potition(cIDJbtn_get, cNmJbtn_get){
    //$('#list_potition').dataTable().fnDestroy();
    $('#cIDJbtn').html('');
    $.ajax({
        url: base_url+'ess/list-potition/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            //$('#list_potition tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">No Data Potition</option>';
                }
                else {
                    var trList = '';
                    if (cIDJbtn_get=='') {
                        trList += '<option value="">Select Potition</option>';
                    }
                    else {
                        trList += '<option value="'+cIDJbtn_get+'">'+cNmJbtn_get+'</option>';
                    }

                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDJbtn = responseList.cIDJbtn;
                        var cNmJbtn = responseList.cNmJbtn;
                        var nominal = responseList.nominal;
                        var nominal_format = responseList.nominal_format;
                        var nominal_istri = responseList.nominal_istri;
                        var nominal_istri_format = responseList.nominal_istri_format;
                        var nominal_anak = responseList.nominal_anak;
                        var nominal_anak_format = responseList.nominal_anak_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cIDJbtn+'">'+cNmJbtn+'</option>';
                        }
                    })
                    $('#cIDJbtn').append(trList);
                }
            })
        }
    });
}

function list_potition_medical(cIDJbtn){
    $('#list_potition').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-potition/'+key_session+'/'+cIDJbtn,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_potition tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_potition').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDJbtn = responseList.cIDJbtn;
                        var cNmJbtn = responseList.cNmJbtn;
                        var nominal = responseList.nominal;
                        var nominal_format = responseList.nominal_format;
                        var nominal_istri = responseList.nominal_istri;
                        var nominal_istri_format = responseList.nominal_istri_format;
                        var nominal_anak = responseList.nominal_anak;
                        var nominal_anak_format = responseList.nominal_anak_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDJbtn+'\', \''+cNmJbtn+'\', \''+nominal+'\', \''+nominal_istri+'\', \''+nominal_anak+'\');" title="Update Company - '+cNmJbtn+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDJbtn+'\', \''+cNmJbtn+'\', \''+1+'\');" title="Disable Company - '+cNmJbtn+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDJbtn+'\', \''+cNmJbtn+'\', \''+0+'\');" title="Enable Company - '+cNmJbtn+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            //trList += '<td style="color:white;">'+cIDJbtn+'</td>';
                            trList += '<td style="color:white;">'+cNmJbtn+'</td>';
                            trList += '<td style="color:white;"><a onclick="update_nominal(\''+cIDJbtn+'\', \''+cNmJbtn+'\', \''+nominal+'\', \''+nominal_istri+'\', \''+nominal_anak+'\');">'+nominal_format+'</a></td>';
                            trList += '<td style="color:white;">'+nominal_istri_format+'</td>';
                            trList += '<td style="color:white;">'+nominal_anak_format+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_potition tbody').append(trList);
                    $('#list_potition').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function update(cIDJbtn_get, cNmJbtn_get, nominal_get, nominal_istri_get, nominal_anak_get){
    list_potition(cIDJbtn_get, cNmJbtn_get);

    $('#nominal').val('');
    $('#nominal_istri').val('');
    $('#nominal_anak').val('');

    $('#nominal').val(nominal_get);
    $('#nominal_istri').val(nominal_istri_get);
    $('#nominal_anak').val(nominal_anak_get);
}

function add_limit_medical(){
    var cIDJbtn = $('#cIDJbtn').val();
    var nominal = $('#nominal').val();
    var nominal_istri = $('#nominal_istri').val();
    var nominal_anak = $('#nominal_anak').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-limit-medical/'+key_session,
        type: 'post',
        data: 'cIDJbtn='+cIDJbtn+'&nominal='+nominal+'&nominal_istri='+nominal_istri+'&nominal_anak='+nominal_anak,
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
                        list_potition_medical(0);
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
    list_potition('', '');
    $('#nominal').val('0');
    $('#nominal_istri').val('0');
    $('#nominal_anak').val('0');
}

function disable_enable(cIDJbtn_get, cNmJbtn_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDJbtn_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDJbtn_disen').val(cIDJbtn_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable Potition - "+cNmJbtn_get+".");
        $('#modal_body_disen').append("Are you sure will disable Potition "+cNmJbtn_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable Potition - "+cNmJbtn_get+".");
        $('#modal_body_disen').append("Are you sure will enable Potition "+cNmJbtn_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_potition(){
    var cIDJbtn = $('#cIDJbtn_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-potition/'+key_session,
        type: 'post',
        data: 'cIDJbtn='+cIDJbtn+'&deleted='+deleted,
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
                        list_potition(0);
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

function update_nominal(cIDJbtn_get, cNmJbtn_get, nominal_get, nominal_istri_get, nominal_anak_get){
    $('#cIDJbtn_medical').val('');
    $('#cNmJbtn_medical').val('');
    $('#nominal').val('');
    $('#nominal_istri').val('');
    $('#nominal_anak').val('');

    $('#cIDJbtn_medical').val(cIDJbtn_get);
    $('#cNmJbtn_medical').val(cNmJbtn_get);
    $('#nominal').val(nominal_get);
    $('#nominal_istri').val(nominal_istri_get);
    $('#nominal_anak').val(nominal_anak_get);
    $('#modal_medical').modal('show');
}

function update_nominal_close(){
    $('#modal_medical').modal('hide');
}

function save_medical(){
    var cIDJbtn = $('#cIDJbtn_medical').val();
    var cNmJbtn = $('#cNmJbtn_medical').val();
    var nominal = $('#nominal').val();
    var nominal_istri = $('#nominal_istri').val();
    var nominal_anak = $('#nominal_anak').val();

    update_nominal_close();
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

     $.ajax({
        url: base_url+'ess/add-limit-medical/'+key_session,
        type: 'post',
        data: 'cIDJbtn='+cIDJbtn+'&nominal='+nominal+'&nominal_istri='+nominal_istri+'&nominal_anak='+nominal_anak,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        list_potition(0);
                        //reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        update_nominal(cIDJbtn, cNmJbtn, nominal);
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