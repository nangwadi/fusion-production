$(document).ready(function(){
    list_mandatory_overtime(0);
    list_sift_group('', '');
})

function list_mandatory_overtime(id_lembur_wajib){
    $('#list_mandatory_overtime').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-mandatory-overtime/'+key_session+'/'+id_lembur_wajib,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_mandatory_overtime tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_mandatory_overtime').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_lembur_wajib = responseList.id_lembur_wajib;
                        var tanggal_lembur_wajib = responseList.tanggal_lembur_wajib;
                        var nama_hari_libur = responseList.nama_hari_libur;
                        var cGroupID = responseList.cGroupID;
                        var deleted = responseList.deleted;

                        var cGroupNm = '';

                        if (cGroupID=='ALL') {
                            cGroupNm = cGroupID;
                        }
                        else {
                            cGroupNm = responseList.cGroupNm;
                        }

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_lembur_wajib+'\', \''+tanggal_lembur_wajib+'\', \''+cGroupID+'\', \''+cGroupNm+'\');" title="Update Company - '+tanggal_lembur_wajib+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_lembur_wajib+'\', \''+tanggal_lembur_wajib+'\', \''+1+'\');" title="Disable Company - '+tanggal_lembur_wajib+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_lembur_wajib+'\', \''+tanggal_lembur_wajib+'\', \''+0+'\');" title="Enable Company - '+tanggal_lembur_wajib+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tanggal_lembur_wajib+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_mandatory_overtime tbody').append(trList);
                    $('#list_mandatory_overtime').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_sift_group(cGroupID_get, cGroupNm_get){
    $('#cGroupID').html('');
    $.ajax({
        url: base_url+'ess/list-sift-group/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cGroupID_get!='') {
                if (cGroupID_get=="ALL") {
                    trList += '<option value="ALL">ALL</option>';
                }
                else {
                    trList += '<option value="'+cGroupID_get+'">'+cGroupNm_get+'</option>';
                }
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_sift_group').dataTable();
                }
                else {
                    trList += '<option value="ALL">ALL</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cGroupID = responseList.cGroupID;
                        var deleted = responseList.deleted;

                        var cGroupNm = responseList.cGroupNm;


                        if (deleted==0) {
                            trList += '<option value="'+cGroupID+'">'+cGroupNm+'</option>';
                        }
                    })
                }
            })
            $('#cGroupID').append(trList);
        }
    });
}

function update(id_lembur_wajib_get, tanggal_lembur_wajib_get, cGroupID_get, cGroupNm_get){
    $('#id_lembur_wajib').val(id_lembur_wajib_get);
    $('#tanggal_lembur_wajib').val(tanggal_lembur_wajib_get);
    list_sift_group(cGroupID_get, cGroupNm_get);
}

function add_mandatory_overtime(){
    var id_lembur_wajib = $('#id_lembur_wajib').val();
    var tanggal_lembur_wajib = $('#tanggal_lembur_wajib').val();
    var cGroupID = $('#cGroupID').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-mandatory-overtime/'+key_session,
        type: 'post',
        data: 'id_lembur_wajib='+id_lembur_wajib+'&tanggal_lembur_wajib='+tanggal_lembur_wajib+'&cGroupID='+cGroupID,
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
                        list_mandatory_overtime(0);
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
    $('#id_lembur_wajib').val('');
    $('#tanggal_lembur_wajib').val('');

    document.getElementById('id_lembur_wajib').removeAttribute('readonly');
    document.getElementById('id_lembur_wajib').removeAttribute('style');
    document.getElementById('id_lembur_wajib').setAttribute('style', 'color:black');
}

function disable_enable(id_lembur_wajib_get, tanggal_lembur_wajib_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_lembur_wajib_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_lembur_wajib_disen').val(id_lembur_wajib_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable mandatory overtime - "+tanggal_lembur_wajib_get+".");
        $('#modal_body_disen').append("Are you sure will disable mandatory overtime "+tanggal_lembur_wajib_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable mandatory overtime - "+tanggal_lembur_wajib_get+".");
        $('#modal_body_disen').append("Are you sure will enable mandatory overtime "+tanggal_lembur_wajib_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_mandatory_overtime(){
    var id_lembur_wajib = $('#id_lembur_wajib_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-mandatory-overtime/'+key_session,
        type: 'post',
        data: 'id_lembur_wajib='+id_lembur_wajib+'&deleted='+deleted,
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
                        list_mandatory_overtime(0);
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