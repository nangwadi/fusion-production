$(document).ready(function(){
    list_personal_sift(0);
    list_employee_active(1, 0, 0);
    list_sift_group(0, 0);
})

function list_personal_sift(cNIK){
    $('#list_personal_sift').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-change-sift/'+key_session+'/'+cNIK,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_personal_sift tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_personal_sift').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cGroupID = responseList.cGroupID;
                        var cGroupNm = responseList.cGroupNm;
                        var deleted = responseList.deleted;

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_personal_sift tbody').append(trList);
                    $('#list_personal_sift').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
    $('#cNIK').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cNIK_get !=0) {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
                $('#cNIK').append(trList);
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;

                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    });
                }
                $('#cNIK').append(trList);
            })
        }
    });
}

function view_personal_sift(){
    var cNIK = $('#cNIK').val();
    $('#cGroupID_old').val('');
    $.ajax({
        url: base_url+'ess/list-change-sift/'+key_session+'/'+cNIK,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#cGroupID_old').val('');
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cGroupID = responseList.cGroupID;
                        var cGroupNm = responseList.cGroupNm;

                        $('#cGroupID_old').val(cGroupNm);
                    })
                }
            })
        }
    });
}

function list_sift_group(cGroupID_get, cGroupNm_get){
    $('#cGroupID_new').html('');
    $.ajax({
        url: base_url+'ess/list-sift-group/'+key_session+'/'+cGroupID_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cGroupID_get!=0) {
                trList += '<option value="'+cGroupID_get+'">'+cGroupNm_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }

                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cGroupID = responseList.cGroupID;
                        var cGroupNm = responseList.cGroupNm;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cGroupID+'">'+cGroupNm+'</option>';
                        }
                    })
                }
            })
            $('#cGroupID_new').html(trList);
        }
    });
}

function add_personal_sift(){
    var cNIK = $('#cNIK').val();
    var cGroupID = $('#cGroupID_new').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-change-sift/'+key_session,
        type: 'post',
        data: 'cGroupID='+cGroupID+'&cNIK='+cNIK,
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
                        list_personal_sift(0);
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

function update(cGroupID, cGroupNm){
    $('#cGroupID').val(cGroupID);
    $('#cGroupNm').val(cGroupNm);
    document.getElementById('cGroupID').setAttribute('readonly', 'readonly');
    document.getElementById('cGroupID').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#cGroupID_old').val('');
    list_employee_active(1, 0, 0);
    list_sift_group(0, 0);
}

function disable_enable(cGroupID_get, cGroupNm_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cGroupID_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cGroupID_disen').val(cGroupID_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable personal_sift - "+cGroupNm_get+".");
        $('#modal_body_disen').append("Are you sure will disable personal_sift "+cGroupNm_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable personal_sift - "+cGroupNm_get+".");
        $('#modal_body_disen').append("Are you sure will enable personal_sift "+cGroupNm_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_personal_sift(){
    var cGroupID = $('#cGroupID_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-change-sift/'+key_session,
        type: 'post',
        data: 'cGroupID='+cGroupID+'&deleted='+deleted,
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
                        list_personal_sift(0);
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