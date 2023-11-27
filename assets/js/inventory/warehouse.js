$(document).ready(function(){
    list_warehouse(0);
})

function list_warehouse(id_warehouse){
    $('#list_warehouse').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'inventory/list-warehouse/'+key_session+'/'+id_warehouse,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_warehouse tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_warehouse').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_warehouse = responseList.id_warehouse;
                        var warehouse_cd = responseList.warehouse_cd;
                        var warehouse_name = responseList.warehouse_name;
                        var full_address = responseList.full_address;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="update_'+(i+1)+'" onclick="update(\''+id_warehouse+'\', \''+warehouse_cd+'\', \''+warehouse_name+'\', \''+full_address+'\', \''+(i+1)+'\');" title="Update Company - '+warehouse_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="disable_enable_'+(i+1)+'" onclick="disable_enable(\''+id_warehouse+'\', \''+warehouse_name+'\', \''+full_address+'\', \''+1+'\');" title="Disable Company - '+warehouse_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_warehouse+'\', \''+warehouse_name+'\', \''+full_address+'\', \''+0+'\');" title="Enable Company - '+warehouse_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="warehouse_cd_'+(i+1)+'">'+warehouse_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="warehouse_name_'+(i+1)+'">'+warehouse_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="full_address_'+(i+1)+'">'+full_address+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_warehouse tbody').append(trList);
                    $('#list_warehouse').dataTable({
                        scrollY:        "400px",
                        scrollX:        false,
                        scrollCollapse: true,
                        paging:         false
                    });
                }
            })
        }
    });
}

function add_warehouse(){
    var id_warehouse = $('#id_warehouse').val();
    var warehouse_cd = $('#warehouse_cd').val();
    var warehouse_name = $('#warehouse_name').val();
    var full_address = $('#full_address').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-warehouse/'+key_session,
        type: 'post',
        data: 'id_warehouse='+id_warehouse+'&warehouse_cd='+warehouse_cd+'&warehouse_name='+warehouse_name+'&full_address='+full_address,
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
                        if (id_warehouse=='') {
                            list_warehouse(0);
                        }
                        else {
                            $('#warehouse_cd_'+no).html('');
                            $('#warehouse_name_'+no).html('');
                            $('#full_address_'+no).html('');
                            document.getElementById('update_'+no).removeAttribute('onclick');

                            $('#warehouse_cd_'+no).append(warehouse_cd);
                            $('#warehouse_name_'+no).append(warehouse_name);
                            $('#full_address_'+no).append(full_address);

                            document.getElementById('update_'+no).setAttribute('onclick', 'update(\''+id_warehouse+'\', \''+warehouse_cd+'\', \''+warehouse_name+'\', \''+full_address+'\', \''+no+'\')');
                        }
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

function update(id_warehouse_get, warehouse_cd_get, warehouse_name_get, full_address_get, no_get){
    $('#id_warehouse').val(id_warehouse_get);
    $('#warehouse_cd').val(warehouse_cd_get);
    $('#warehouse_name').val(warehouse_name_get);
    $('#full_address').val(full_address_get);
    $('#no').val(no_get);
}

function reset_form(){
    $('#id_warehouse').val('');
    $('#warehouse_cd').val('');
    $('#warehouse_name').val('');
    $('#full_address').val('');
    $('#no').val('');
}

function disable_enable(id_warehouse_get, warehouse_name_get, full_address_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_warehouse_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_warehouse_disen').val(id_warehouse_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+warehouse_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+warehouse_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+warehouse_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+warehouse_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_warehouse(){
    var id_warehouse = $('#id_warehouse_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/update-warehouse/'+key_session,
        type: 'post',
        data: 'id_warehouse='+id_warehouse+'&deleted='+deleted,
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
                        list_warehouse(0);
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