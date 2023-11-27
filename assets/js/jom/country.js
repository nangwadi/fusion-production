$(document).ready(function(){
    list_country(0);
})

function list_country(id_country){
    $('#list_country').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-country/'+key_session+'/'+id_country,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_country tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_country').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_country = responseList.id_country;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var country_cd = responseList.country_cd;
                        var country_name = responseList.country_name;
                        var country_phone_code = (responseList.country_phone_code)*1;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_country+'\', \''+country_cd+'\', \''+country_name+'\', \''+country_phone_code+'\');" title="Update Company - '+country_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_country+'\', \''+country_name+'\', \''+1+'\');" title="Disable Company - '+country_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_country+'\', \''+country_name+'\', \''+0+'\');" title="Enable Company - '+country_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+country_cd+'</td>';
                            trList += '<td style="color:white;">'+country_name+'</td>';
                            trList += '<td style="color:white;">'+country_phone_code+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_country tbody').append(trList);
                    $('#list_country').dataTable();
                }
            })
        }
    });
}

function add_country(){
    var id_country = $('#id_country').val();
    var country_cd = $('#country_cd').val();
    var country_name = $('#country_name').val();
    var country_phone_code = $('#country_phone_code').val();

    console.log(country_cd+' '+country_name+' '+country_phone_code);

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-country/'+key_session,
        type: 'post',
        data: 'id_country='+id_country+'&country_cd='+country_cd+'&country_name='+country_name+'&country_phone_code='+country_phone_code,
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
                        list_country(0);
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

function update(id_country_get, country_cd_get, country_name_get, country_phone_code_get){
    $('#id_country').val(id_country_get);
    $('#country_cd').val(country_cd_get);
    $('#country_name').val(country_name_get);
    $('#country_phone_code').val(country_phone_code_get);
}

function reset_form(){
    $('#id_country').val('');
    $('#country_cd').val('');
    $('#country_name').val('');
    $('#country_phone_code').val('');
}

function disable_enable(id_country_get, country_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_country_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_country_disen').val(id_country_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+country_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+country_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+country_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+country_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_country(){
    var id_country = $('#id_country_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-country/'+key_session,
        type: 'post',
        data: 'id_country='+id_country+'&deleted='+deleted,
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
                        list_country(0);
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