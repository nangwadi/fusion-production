$(document).ready(function(){
    list_payment_terms(0);
})

function add_payment_terms(){
    var id_payment_terms = $('#id_payment_terms').val();
    var payment_terms_cd = $('#payment_terms_cd').val();
    var payment_terms_name = $('#payment_terms_name').val();

    $.ajax({
        url: base_url+'distribution/add-payment-terms/'+key_session,
        type: 'post',
        data: 'id_payment_terms='+id_payment_terms+'&payment_terms_cd='+payment_terms_cd+'&payment_terms_name='+payment_terms_name,
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
                        list_payment_terms(0);
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function list_payment_terms(id_payment_terms){
    $('#list_payment_terms').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-payment-terms/'+key_session+'/'+id_payment_terms,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_payment_terms tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_payment_terms').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_payment_terms = responseList.id_payment_terms;
                        var payment_terms_cd = responseList.payment_terms_cd;
                        var payment_terms_name = responseList.payment_terms_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_payment_terms+'\', \''+payment_terms_cd+'\', \''+payment_terms_name+'\');" title="Update Company - '+payment_terms_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_payment_terms+'\', \''+payment_terms_name+'\', \''+1+'\');" title="Disable Company - '+payment_terms_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_payment_terms+'\', \''+payment_terms_name+'\', \''+0+'\');" title="Enable Company - '+payment_terms_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+payment_terms_cd+'</td>';
                            trList += '<td style="color:white;">'+payment_terms_name+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_payment_terms tbody').append(trList);
                    $('#list_payment_terms').dataTable();
                }
            })
        }
    });
}

function update(id_payment_terms_get, payment_terms_cd_get, payment_terms_name_get){
    $('#id_payment_terms').val('');
    $('#payment_terms_cd').val('');
    $('#payment_terms_name').val('');

    $('#id_payment_terms').val(id_payment_terms_get);
    $('#payment_terms_cd').val(payment_terms_cd_get);
    $('#payment_terms_name').val(payment_terms_name_get);
}

function reset_form(){
    $('#id_payment_terms').val('');
    $('#payment_terms_cd').val('');
    $('#payment_terms_name').val('');
}

function disable_enable(id_payment_terms_get, payment_terms_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_payment_terms_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_payment_terms_disen').val(id_payment_terms_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+payment_terms_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+payment_terms_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+payment_terms_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+payment_terms_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_payment_terms(){
    var id_payment_terms = $('#id_payment_terms_disen').val();
    var deleted = $('#value_disen').val();

    console.log(id_payment_terms+' '+deleted);

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'distribution/update-payment-terms/'+key_session,
        type: 'post',
        data: 'id_payment_terms='+id_payment_terms+'&deleted='+deleted,
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
                        list_payment_terms(0);
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