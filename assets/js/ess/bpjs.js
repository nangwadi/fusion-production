$(document).ready(function(){
    list_bpjs(0);
})

function list_bpjs(id_bpjs){
    $('#list_bpjs').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-bpjs/'+key_session+'/'+id_bpjs,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_bpjs tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_bpjs').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_bpjs = responseList.id_bpjs;
                        var nama_bpjs = responseList.nama_bpjs;
                        var alias = responseList.alias;
                        var company = responseList.company;
                        var max_salary_company = responseList.max_salary_company;
                        var max_salary_company_format = responseList.max_salary_company_format;
                        var personal = responseList.personal;
                        var max_salary_personal = responseList.max_salary_personal;
                        var max_salary_personal_format = responseList.max_salary_personal_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_bpjs+'\', \''+nama_bpjs+'\', \''+alias+'\', \''+company+'\', \''+max_salary_company+'\', \''+personal+'\', \''+max_salary_personal+'\');" title="Update BPJS - '+nama_bpjs+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_bpjs+'\', \''+nama_bpjs+'\', \''+alias+'\', \''+company+'\', \''+personal+'\', \''+1+'\');" title="Disable BPJS - '+nama_bpjs+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_bpjs+'\', \''+nama_bpjs+'\', \''+alias+'\', \''+company+'\', \''+personal+'\', \''+0+'\');" title="Enable BPJS - '+nama_bpjs+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+nama_bpjs+'</td>';
                            trList += '<td style="color:white;">'+alias+'</td>';
                            trList += '<td style="color:white;">'+company+'</td>';
                            trList += '<td style="color:white;">'+max_salary_company_format+'</td>';
                            trList += '<td style="color:white;">'+personal+'</td>';
                            trList += '<td style="color:white;">'+max_salary_personal_format+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_bpjs tbody').append(trList);
                    $('#list_bpjs').dataTable();
                }
            })
        }
    });
}

function add_bpjs(){
    var id_bpjs = $('#id_bpjs').val();
    var nama_bpjs = $('#nama_bpjs').val();
    var alias = $('#alias').val();
    var company = $('#company').val();
    var max_salary_company = $('#max_salary_company').val();
    var personal = $('#personal').val();
    var max_salary_personal = $('#max_salary_personal').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-bpjs/'+key_session,
        type: 'post',
        data: 'id_bpjs='+id_bpjs+'&nama_bpjs='+nama_bpjs+'&alias='+alias+'&company='+company+'&max_salary_company='+max_salary_company+'&personal='+personal+'&max_salary_personal='+max_salary_personal,
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
                        list_bpjs(0);
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

function update(id_bpjs_get, nama_bpjs_get, alias_get, company_get, max_salary_company_get, personal_get, max_salary_personal_get){
    $('#id_bpjs').val('');
    $('#nama_bpjs').val('');
    $('#alias').val('');
    $('#company').val('');
    $('#personal').val('');
    $('#max_salary').val('');

    $('#id_bpjs').val(id_bpjs_get);
    $('#nama_bpjs').val(nama_bpjs_get);
    $('#alias').val(alias_get);
    $('#company').val(company_get);
    $('#max_salary_company').val(max_salary_company_get);
    $('#personal').val(personal_get);
    $('#max_salary_personal').val(max_salary_personal_get);
    document.getElementById('id_bpjs').setAttribute('readonly', 'readonly');
    document.getElementById('id_bpjs').setAttribute('style', 'color:black');
}

function reset_form(){
    $('#id_bpjs').val('');
    $('#nama_bpjs').val('');
    $('#alias').val('');
    $('#company').val('');
    $('#personal').val('');
    $('#max_salary').val('');
    document.getElementById('id_bpjs').removeAttribute('readonly');
    document.getElementById('id_bpjs').removeAttribute('style');
    document.getElementById('id_bpjs').setAttribute('style', 'color:white');
}

function disable_enable(id_bpjs_get, nama_bpjs_get, alias_get, company_get, personal_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_bpjs_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_bpjs_disen').val(id_bpjs_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable bpjs - "+nama_bpjs_get+".");
        $('#modal_body_disen').append("Are you sure will disable bpjs "+nama_bpjs_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable bpjs - "+nama_bpjs_get+".");
        $('#modal_body_disen').append("Are you sure will enable bpjs "+nama_bpjs_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_bpjs(){
    var id_bpjs = $('#id_bpjs_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-bpjs/'+key_session,
        type: 'post',
        data: 'id_bpjs='+id_bpjs+'&deleted='+deleted,
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
                        list_bpjs(0);
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