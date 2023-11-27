$(document).ready(function(){
    list_ramadhan(0);
})

function list_ramadhan(id_ramadhan){
    $('#list_ramadhan').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-ramadhan/'+key_session+'/'+id_ramadhan,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_ramadhan tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_ramadhan').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_ramadhan = responseList.id_ramadhan;
                        var tahun = responseList.tahun;
                        var tanggal_awal = responseList.tanggal_awal;
                        var tanggal_akhir = responseList.tanggal_akhir;
                        var deleted = responseList.deleted;

                        var calendar ='<button class="btn btn-success" onclick="modal_schedule(\''+id_ramadhan+'\', \''+tahun+'\', \''+tanggal_awal+'\', \''+tanggal_akhir+'\');" title="Schedule - '+tahun+'."><i class="mdi mdi-calendar"></i></button>';

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_ramadhan+'\', \''+tahun+'\', \''+tanggal_awal+'\', \''+tanggal_akhir+'\');" title="Update Ramadhan - '+tahun+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_ramadhan+'\', \''+tahun+'\', \''+tanggal_awal+'\', \''+tanggal_akhir+'\', \''+1+'\');" title="Disable Ramadhan - '+tahun+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_ramadhan+'\', \''+tahun+'\', \''+tanggal_awal+'\', \''+tanggal_akhir+'\', \''+0+'\');" title="Enable Ramadhan - '+tahun+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tahun+'</td>';
                            trList += '<td style="color:white;">'+tanggal_awal+'</td>';
                            trList += '<td style="color:white;">'+tanggal_akhir+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_ramadhan tbody').append(trList);
                    $('#list_ramadhan').dataTable();
                }
            })
        }
    });
}

function update(id_ramadhan, tahun, tanggal_awal, tanggal_akhir){
    $('#id_ramadhan').val(id_ramadhan);
    $('#tahun').val(tahun);
    $('#tanggal_awal').val(tanggal_awal);
    $('#tanggal_akhir').val(tanggal_akhir);
}

function add_ramadhan(){
    var id_ramadhan = $('#id_ramadhan').val();
    var tahun = $('#tahun').val();
    var tanggal_awal = $('#tanggal_awal').val();
    var tanggal_akhir = $('#tanggal_akhir').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-ramadhan/'+key_session,
        type: 'post',
        data: 'id_ramadhan='+id_ramadhan+'&tahun='+tahun+'&tanggal_awal='+tanggal_awal+'&tanggal_akhir='+tanggal_akhir,
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
                        list_ramadhan(0);
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
    $('#id_ramadhan').val('');
    $('#tahun').val('');
    $('#tanggal_awal').val('');
    $('#tanggal_akhir').val('');
    document.getElementById('id_ramadhan').removeAttribute('readonly');
    document.getElementById('id_ramadhan').removeAttribute('style');
    document.getElementById('id_ramadhan').setAttribute('style', 'color:black');
}

function disable_enable(id_ramadhan_get, tahun_get, tanggal_awal_get, tanggal_akhir_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_ramadhan_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_ramadhan_disen').val(id_ramadhan_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable ramadhan - "+tahun_get+".");
        $('#modal_body_disen').append("Are you sure will disable ramadhan "+tahun_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable ramadhan - "+tahun_get+".");
        $('#modal_body_disen').append("Are you sure will enable ramadhan "+tahun_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_ramadhan(){
    var id_ramadhan = $('#id_ramadhan_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-ramadhan/'+key_session,
        type: 'post',
        data: 'id_ramadhan='+id_ramadhan+'&deleted='+deleted,
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
                        list_ramadhan(0);
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