$(document).ready(function(){
    list_change_day(0);
    list_sift_group('', '');
})

function list_change_day(id_ganti_hari){
    $('#list_change_day').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-change-day/'+key_session+'/'+id_ganti_hari,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_change_day tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_change_day').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_ganti_hari = responseList.id_ganti_hari;
                        var tanggal_ganti_hari = responseList.tanggal_ganti_hari;
                        var cGroupID = responseList.cGroupID;
                        var deleted = responseList.deleted;

                        var cGroupNm = '';

                        if (cGroupID=='ALL') {
                            cGroupNm = cGroupID;
                        }
                        else {
                            cGroupNm = responseList.cGroupNm;
                        }

                        var calendar ='<button class="btn btn-success" onclick="modal_schedule(\''+id_ganti_hari+'\', \''+tanggal_ganti_hari+'\');" title="Schedule - '+tanggal_ganti_hari+'."><i class="mdi mdi-calendar"></i></button>';

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_ganti_hari+'\', \''+tanggal_ganti_hari+'\', \''+cGroupID+'\', \''+cGroupNm+'\');" title="Update Company - '+tanggal_ganti_hari+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_ganti_hari+'\', \''+tanggal_ganti_hari+'\', \''+1+'\');" title="Disable Company - '+tanggal_ganti_hari+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_ganti_hari+'\', \''+tanggal_ganti_hari+'\', \''+0+'\');" title="Enable Company - '+tanggal_ganti_hari+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tanggal_ganti_hari+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_change_day tbody').append(trList);
                    $('#list_change_day').dataTable();
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

function update(id_ganti_hari, tanggal_ganti_hari, cGroupID_get, cGroupNm_get){
    $('#id_ganti_hari').val(id_ganti_hari);
    $('#tanggal_ganti_hari').val(tanggal_ganti_hari);
    list_sift_group(cGroupID_get, cGroupNm_get);
}

function add_change_day(){
    var id_ganti_hari = $('#id_ganti_hari').val();
    var tanggal_ganti_hari = $('#tanggal_ganti_hari').val();
    var cGroupID = $('#cGroupID').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-change-day/'+key_session,
        type: 'post',
        data: 'id_ganti_hari='+id_ganti_hari+'&tanggal_ganti_hari='+tanggal_ganti_hari+'&cGroupID='+cGroupID,
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
                        list_change_day(0);
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
    $('#id_ganti_hari').val('');
    $('#tanggal_ganti_hari').val('');
    $('#nama_hari_libur').val('');
    document.getElementById('id_ganti_hari').removeAttribute('readonly');
    document.getElementById('id_ganti_hari').removeAttribute('style');
    document.getElementById('id_ganti_hari').setAttribute('style', 'color:black');
}

function disable_enable(id_ganti_hari_get, tanggal_ganti_hari_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_ganti_hari_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_ganti_hari_disen').val(id_ganti_hari_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable change day - "+tanggal_ganti_hari_get+".");
        $('#modal_body_disen').append("Are you sure will disable change day "+tanggal_ganti_hari_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable change day - "+tanggal_ganti_hari_get+".");
        $('#modal_body_disen').append("Are you sure will enable change day "+tanggal_ganti_hari_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_change_day(){
    var id_ganti_hari = $('#id_ganti_hari_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-change-day/'+key_session,
        type: 'post',
        data: 'id_ganti_hari='+id_ganti_hari+'&deleted='+deleted,
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
                        list_change_day(0);
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