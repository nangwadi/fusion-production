$(document).ready(function(){
    list_maker_datatable();
})

function list_maker_datatable(){
    console.log(base_url+'inventory/list-maker-datatable/'+key_session);
    $('#list_maker').dataTable().fnDestroy();

    $('#list_maker').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-maker-datatable/'+key_session,
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],
    });
}

function add_maker(){
    var id_inv_maker = $('#id_inv_maker').val();
    var maker_cd = $('#maker_cd').val();
    var maker_name = $('#maker_name').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-maker/'+key_session,
        type: 'post',
        data: 'id_inv_maker='+id_inv_maker+'&maker_cd='+maker_cd+'&maker_name='+maker_name,
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
                        list_maker_datatable();
                        reset_form();
                        modal_loading_hide();
                    }, 3000);

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

function update(id_inv_maker_get, maker_cd_get, maker_name_get, no_get){
    reset_form();
    $('#id_inv_maker').val('');

    $('#id_inv_maker').val(id_inv_maker_get);
    $('#maker_cd').val(maker_cd_get);
    $('#maker_name').val(maker_name_get);
    $('#no').val(no_get);
}

function reset_form(){
    $('#id_inv_maker').val('');
    $('#id_inv_maker').val('0');
    $('#maker_cd').val('');
    $('#maker_name').val('');
    $('#no').val('');
}

function disable_enable(id_inv_maker_get, maker_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_inv_maker_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_inv_maker_disen').val(id_inv_maker_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable maker - "+maker_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable maker "+maker_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable maker - "+maker_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable maker "+maker_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
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