$(document).ready(function(){
    list_plant(0);
})

function list_plant(id_plant){
    $('#list_plant').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-plant/'+key_session+'/'+id_plant,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_plant tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_plant').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_plant = responseList.id_plant;
                        var plant = responseList.plant;
                        var note = responseList.note;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_plant+'\', \''+plant+'\', \''+note+'\');" title="Update Plant - '+plant+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_plant+'\', \''+plant+'\', \''+note+'\', \''+1+'\');" title="Disable Plant - '+plant+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_plant+'\', \''+plant+'\', \''+note+'\', \''+0+'\');" title="Enable Plant - '+plant+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+company_name+'</td>';
                            trList += '<td style="color:white;">'+plant+'</td>';
                            trList += '<td style="color:white;">'+note+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_plant tbody').append(trList);
                    $('#list_plant').dataTable();
                }
            })
        }
    });
}

function add_plant(){
    var id_plant = $('#id_plant').val();
    var plant = $('#plant').val();
    var note = $('#note').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-plant/'+key_session,
        type: 'post',
        data: 'id_plant='+id_plant+'&plant='+plant+'&note='+note,
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
                        list_plant(0);
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

function update(id_plant, plant, note){
    $('#id_plant').val('');
    $('#plant').val('');
    $('#note').val('');

    $('#id_plant').val(id_plant);
    $('#plant').val(plant);
    $('#note').val(note);
    //document.getElementById('id_plant').setAttribute('readonly', 'readonly');
    //document.getElementById('id_plant').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#id_plant').val('');
    $('#plant').val('');
    $('#note').val('');
    //document.getElementById('id_plant').removeAttribute('readonly');
    //document.getElementById('id_plant').removeAttribute('style');
    //document.getElementById('id_plant').setAttribute('style', 'color:white');
}

function disable_enable(id_plant_get, plant_get, note_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_plant_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_plant_disen').val(id_plant_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable plant - "+plant_get+".");
        $('#modal_body_disen').append("Are you sure will disable plant "+plant_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable plant - "+plant_get+".");
        $('#modal_body_disen').append("Are you sure will enable plant "+plant_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_plant(){
    var id_plant = $('#id_plant_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-plant/'+key_session,
        type: 'post',
        data: 'id_plant='+id_plant+'&deleted='+deleted,
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
                        list_plant(0);
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