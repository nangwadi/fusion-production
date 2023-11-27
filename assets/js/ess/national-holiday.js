$(document).ready(function(){
    list_national_holiday(0);
    list_sift_group('', '');
})

function list_national_holiday(id_libur_nasional){
    $('#list_national_holiday').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-national-holiday/'+key_session+'/'+id_libur_nasional,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_national_holiday tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_national_holiday').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_libur_nasional = responseList.id_libur_nasional;
                        var tanggal_libur_nasional = responseList.tanggal_libur_nasional;
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
                            action += '<button class="btn btn-info" onclick="update(\''+id_libur_nasional+'\', \''+tanggal_libur_nasional+'\', \''+nama_hari_libur+'\', \''+cGroupID+'\', \''+cGroupNm+'\');" title="Update Company - '+tanggal_libur_nasional+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_libur_nasional+'\', \''+tanggal_libur_nasional+'\', \''+nama_hari_libur+'\', \''+1+'\');" title="Disable Company - '+tanggal_libur_nasional+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_libur_nasional+'\', \''+tanggal_libur_nasional+'\', \''+nama_hari_libur+'\', \''+0+'\');" title="Enable Company - '+tanggal_libur_nasional+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tanggal_libur_nasional+'</td>';
                            trList += '<td style="color:white;">'+nama_hari_libur+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_national_holiday tbody').append(trList);
                    $('#list_national_holiday').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function update(id_libur_nasional, tanggal_libur_nasional, nama_hari_libur, cGroupID_get, cGroupNm_get){
    $('#id_libur_nasional').val(id_libur_nasional);
    $('#tanggal_libur_nasional').val(tanggal_libur_nasional);
    $('#nama_hari_libur').val(nama_hari_libur);
    list_sift_group(cGroupID_get, cGroupNm_get)
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

function add_national_holiday(){
    var id_libur_nasional = $('#id_libur_nasional').val();
    var tanggal_libur_nasional = $('#tanggal_libur_nasional').val();
    var nama_hari_libur = $('#nama_hari_libur').val();
    var cGroupID = $('#cGroupID').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-national-holiday/'+key_session,
        type: 'post',
        data: 'id_libur_nasional='+id_libur_nasional+'&tanggal_libur_nasional='+tanggal_libur_nasional+'&nama_hari_libur='+nama_hari_libur+'&cGroupID='+cGroupID,
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
                        list_national_holiday(0);
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully, error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function reset_form(){
    $('#id_libur_nasional').val('');
    $('#tanggal_libur_nasional').val('');
    $('#nama_hari_libur').val('');
    document.getElementById('id_libur_nasional').removeAttribute('readonly');
    document.getElementById('id_libur_nasional').removeAttribute('style');
    document.getElementById('id_libur_nasional').setAttribute('style', 'color:black');
}

function disable_enable(id_libur_nasional_get, tanggal_libur_nasional_get, nama_hari_libur_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_libur_nasional_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_libur_nasional_disen').val(id_libur_nasional_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable national holiday - "+tanggal_libur_nasional_get+" / "+nama_hari_libur_get+".");
        $('#modal_body_disen').append("Are you sure will disable national holiday "+tanggal_libur_nasional_get+" / "+nama_hari_libur_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable national holiday - "+tanggal_libur_nasional_get+" / "+nama_hari_libur_get+".");
        $('#modal_body_disen').append("Are you sure will enable national holiday "+tanggal_libur_nasional_get+" / "+nama_hari_libur_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_national_holiday(){
    var id_libur_nasional = $('#id_libur_nasional_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-national-holiday/'+key_session,
        type: 'post',
        data: 'id_libur_nasional='+id_libur_nasional+'&deleted='+deleted,
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
                        list_national_holiday(0);
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