$(document).ready(function(){
    list_uom(0);
})

function list_uom(id_uom){
    $('#list_uom').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'inventory/list-uom/'+key_session+'/'+id_uom,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_uom tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_uom').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_uom = responseList.id_uom;
                        var uom_cd = responseList.uom_cd;
                        var uom_name = responseList.uom_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="update_'+(i+1)+'" onclick="update(\''+id_uom+'\', \''+uom_cd+'\', \''+uom_name+'\', \''+(i+1)+'\');" title="Update Company - '+uom_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="disable_enable_'+(i+1)+'" onclick="disable_enable(\''+id_uom+'\', \''+uom_name+'\', \''+1+'\');" title="Disable Company - '+uom_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_uom+'\', \''+uom_name+'\', \''+0+'\');" title="Enable Company - '+uom_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="uom_cd_'+(i+1)+'">'+uom_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="uom_name_'+(i+1)+'">'+uom_name+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_uom tbody').append(trList);
                    $('#list_uom').dataTable({
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

function add_uom(){
    var id_uom = $('#id_uom').val();
    var uom_cd = $('#uom_cd').val();
    var uom_name = $('#uom_name').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-uom/'+key_session,
        type: 'post',
        data: 'id_uom='+id_uom+'&uom_cd='+uom_cd+'&uom_name='+uom_name,
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
                        if (id_uom=='') {
                            list_uom(0);
                        }
                        else {
                            $('#uom_cd_'+no).html('');
                            $('#uom_name_'+no).html('');
                            document.getElementById('update_'+no).removeAttribute('onclick');

                            $('#uom_cd_'+no).append(uom_cd);
                            $('#uom_name_'+no).append(uom_name);

                            document.getElementById('update_'+no).setAttribute('onclick', 'update(\''+id_uom+'\', \''+uom_cd+'\', \''+uom_name+'\', \''+no+'\')');
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

function update(id_uom_get, uom_cd_get, uom_name_get, no_get){
    $('#id_uom').val(id_uom_get);
    $('#uom_cd').val(uom_cd_get);
    $('#uom_name').val(uom_name_get);
    $('#no').val(no_get);
}

function reset_form(){
    $('#id_uom').val('');
    $('#uom_cd').val('');
    $('#uom_name').val('');
    $('#no').val('');
}

function disable_enable(id_uom_get, uom_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_uom_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_uom_disen').val(id_uom_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+uom_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+uom_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+uom_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+uom_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_uom(){
    var id_uom = $('#id_uom_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/update-uom/'+key_session,
        type: 'post',
        data: 'id_uom='+id_uom+'&deleted='+deleted,
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
                        list_uom(0);
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