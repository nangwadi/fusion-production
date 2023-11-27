$(document).ready(function(){
    list_job_type(0);
})

function list_job_type(id_job_type){
    $('#list_job_type').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-job-type/'+key_session+'/'+id_job_type,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_job_type tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_job_type').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_job_type = responseList.id_job_type;
                        var job_type_cd = responseList.job_type_cd;
                        var job_type_name = responseList.job_type_name;
                        var job_type_format = responseList.job_type_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_job_type+'\', \''+job_type_cd+'\', \''+job_type_name+'\', \''+job_type_format+'\');" title="Update Company - '+job_type_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_job_type+'\', \''+job_type_name+'\', \''+1+'\');" title="Disable Company - '+job_type_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_job_type+'\', \''+job_type_name+'\', \''+0+'\');" title="Enable Company - '+job_type_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+job_type_cd+'</td>';
                            trList += '<td style="color:white;">'+job_type_name+'</td>';
                            trList += '<td style="color:white;">'+job_type_format+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_job_type tbody').append(trList);
                    $('#list_job_type').dataTable();
                }
            })
        }
    });
}

function add_job_type(){
    var id_job_type = $('#id_job_type').val();
    var job_type_cd = $('#job_type_cd').val();
    var job_type_name = $('#job_type_name').val();
    var job_type_format = $('#job_type_format').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-job-type/'+key_session,
        type: 'post',
        data: 'id_job_type='+id_job_type+'&job_type_cd='+job_type_cd+'&job_type_name='+job_type_name+'&job_type_format='+job_type_format,
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
                        list_job_type(0);
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

function update(id_job_type_get, job_type_cd_get, job_type_name_get, job_type_format_get){
    $('#id_job_type').val(id_job_type_get);
    $('#job_type_cd').val(job_type_cd_get);
    $('#job_type_name').val(job_type_name_get);
    $('#job_type_format').val(job_type_format_get);
}

function reset_form(){
    $('#id_job_type').val('');
    $('#job_type_cd').val('');
    $('#job_type_name').val('');
    $('#job_type_format').val('');
}

function disable_enable(id_job_type_get, job_type_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_job_type_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_job_type_disen').val(id_job_type_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+job_type_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+job_type_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+job_type_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+job_type_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_job_type(){
    var id_job_type = $('#id_job_type_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-job-type/'+key_session,
        type: 'post',
        data: 'id_job_type='+id_job_type+'&deleted='+deleted,
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
                        list_job_type(0);
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