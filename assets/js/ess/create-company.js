$(document).ready(function(){
	list_country('', '');
    list_company(0);
})

function list_country(id_country_get, country_name_get){
    $('#company_country').html('');
    var trList = '';
    if (country_name_get=='') {
        trList += '<option value="">Select Country</option>';
    }
    else {
        trList += '<option value="'+id_country_get+'">'+country_name_get+'</option>';
    }

	$.ajax({
        url: base_url+'jom/list-country/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;           
                    response.map(function(responseList){
                        var id_country = responseList.id_country;
                        var country_name = responseList.country_name;
                        trList += '<option value="'+id_country+'">'+country_name+'</option>';
                    });
                }
            })
            $('#company_country').append(trList);
        }
    });
}

function list_company(company_id){
    $('#list_company').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-company/'+key_session+'/'+company_id,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_company tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_company').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_code = responseList.company_code;
                        var company_name = responseList.company_name;
                        var company_address = responseList.company_address;
                        var company_city = responseList.company_city;
                        var company_phone = responseList.company_phone;
                        var company_fax = responseList.company_fax;
                        var company_province = responseList.company_province;
                        var company_country = responseList.company_country;
                        var country_name = responseList.country_name;
                        var company_postal_code = responseList.company_postal_code;
                        var deleted = responseList.deleted;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+company_id+'\');" title="Update Company - '+company_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+company_id+'\', \''+company_name+'\', \''+1+'\');" title="Disable Company - '+company_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+company_id+'\', \''+company_name+'\', \''+0+'\');" title="Enable Company - '+company_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+company_code+'</td>';
                            trList += '<td style="color:white;">'+company_name+'</td>';
                            trList += '<td style="color:white;">'+company_address+', '+company_city+', '+company_province+'</td>';
                            trList += '<td style="color:white;">'+country_name+'</td>';
                            trList += '<td style="color:white;">'+company_phone+'</td>';
                            trList += '<td style="color:white;">'+company_fax+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_company tbody').append(trList);
                    $('#list_company').dataTable();
                }
            })
        }
    });
}

function add_company(){
    var company_id = $('#company_id').val();
    var company_code = $('#company_code').val();
    var company_name = $('#company_name').val();
    var company_address = $('#company_address').val();
    var company_city = $('#company_city').val();
    var company_phone = $('#company_phone').val();
    var company_fax = $('#company_fax').val();
    var company_province = $('#company_province').val();
    var company_country = $('#company_country').val();
    var company_postal_code = $('#company_postal_code').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-company/'+key_session,
        type: 'post',
        data: 'company_id='+company_id+'&company_code='+company_code+'&company_name='+company_name+'&company_address='+company_address+'&company_city='+company_city+'&company_phone='+company_phone+'&company_fax='+company_fax+'&company_province='+company_province+'&company_country='+company_country+'&company_postal_code='+company_postal_code,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        list_company(0);
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

function update(company_id){
    $.ajax({
        url: base_url+'ess/list-company/'+key_session+'/'+company_id,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_company').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_code = responseList.company_code;
                        var company_name = responseList.company_name;
                        var company_address = responseList.company_address;
                        var company_city = responseList.company_city;
                        var company_phone = responseList.company_phone;
                        var company_fax = responseList.company_fax;
                        var company_province = responseList.company_province;
                        var company_country = responseList.company_country;
                        var country_name = responseList.country_name;
                        var country_name = responseList.country_name;
                        var company_postal_code = responseList.company_postal_code;
                        var deleted = responseList.deleted;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        $('#company_id').val(company_id);
                        $('#company_code').val(company_code);
                        $('#company_name').val(company_name);
                        $('#company_address').val(company_address);
                        $('#company_city').val(company_city);
                        $('#company_phone').val(company_phone);
                        $('#company_fax').val(company_fax);
                        $('#company_province').val(company_province);
                        list_country(company_country, country_name);
                        $('#company_postal_code').val(company_postal_code);

                        document.getElementById('company_code').setAttribute('readonly', 'readonly');
                        document.getElementById('company_code').setAttribute('style', 'color:black');
                    })
                }
            });
        }
    })
}

function reset_form(){
    $('#company_id').val('');
    $('#company_code').val('');
    $('#company_name').val('');
    $('#company_address').val('');
    $('#company_city').val('');
    $('#company_phone').val('');
    $('#company_fax').val('');
    $('#company_province').val('');
    list_country('');
    $('#company_postal_code').val('');
    document.getElementById('company_code').removeAttribute('readonly');
    document.getElementById('company_code').removeAttribute('style');
    document.getElementById('company_code').setAttribute('style', 'color:white');
}

function disable_enable(company_id_get, company_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#company_id_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#company_id_disen').val(company_id_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable company - "+company_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable company "+company_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable company - "+company_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable company "+company_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_company(){
    var company_id = $('#company_id_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-company/'+key_session,
        type: 'post',
        data: 'company_id='+company_id+'&deleted='+deleted,
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
                        list_company(0);
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