$(document).ready(function(){
    list_group_datatable();
})

function list_group_datatable(){
    //console.log(base_url+'inventory/list-group-datatable/'+key_session);
    $('#list_group').dataTable().fnDestroy();

    $('#list_group').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-group-datatable/'+key_session,
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

function add_group(){
    var id_inv_group = $('#id_inv_group').val();
    var group_cd = $('#group_cd').val();
    var group_name = $('#group_name').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-group/'+key_session,
        type: 'post',
        data: 'id_inv_group='+id_inv_group+'&group_cd='+group_cd+'&group_name='+group_name,
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
                        list_group_datatable();
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

function update_inv_group(){
    var id_inv_group = $('#id_inv_group_disen').val();
    var value_disen = $('#value_disen').val();

    $.ajax({
        url: base_url+'inventory/update-group/'+key_session,
        type: 'post',
        data: 'id_inv_group='+id_inv_group+'&deleted='+value_disen,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            //modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    alert('Updating data successfully');
                    location.reload();
                }
                else {
                    alert('Updating data unsuccessfully');
                }
            })
        }
    })
}

function update(id_inv_group_get, group_cd_get, group_name_get, no_get){
    reset_form();
    $('#id_inv_group').val('');

    $('#id_inv_group').val(id_inv_group_get);
    $('#group_cd').val(group_cd_get);
    $('#group_name').val(group_name_get);
    $('#no').val(no_get);
}

function modal_upload(id_inv_group_get, group_name_get, banner_inside_get, img_get){
    $('#id_inv_group_upload').val('');
    $('#id_inv_group_upload').val(id_inv_group_get);
    $('#banner_inside').val('');
    $('#banner_inside').val(banner_inside_get);

    $('#modal_title_upload').html('');
    if (banner_inside_get == 1) {
        $('#modal_title_upload').append('Upload Banner Image - '+group_name_get);
    }
    else {
        $('#modal_title_upload').append('Upload Inside Image - '+group_name_get);
    }

    $('#div_img').html('');

    var img = document.createElement("IMG");
    img.src = "../assets/images/inventory/"+img_get;
    img.className = "img-scale-down";
    document.getElementById('div_img').appendChild(img);

    $('#modal_upload').modal('show');
}

function save_upload_img(){
    var id_inv_group = $('#id_inv_group_upload').val();
    var banner_inside = $('#banner_inside').val();
    var img_name = $('#img_name')[0].files[0];

    const img_fd = new FormData();
    img_fd.append('id_inv_group', id_inv_group);
    img_fd.append('banner_inside', banner_inside);
    img_fd.append('img_name', img_name);

    div_loading('Saving image...');

    $.ajax({
        url: base_url+'inventory/add-inventory-group-img/'+key_session,
        type: 'post',
        data: img_fd,
        crossDomain: true,
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var loading_display = '';
                if (status == 0) {
                    loading_display = 'Data cannot save in database.';
                    div_loading(loading_display);
                }
                else if (status == 1) {
                    loading_display = 'Saving data successfully.';
                    div_loading(loading_display);
                    setTimeout(function () {
                        list_inventory_img(id_inventory);
                    }, 5000);
                }
                else if (status == 2) {
                    loading_display = 'Your file is not allowed.';
                    div_loading(loading_display);
                }
                else if (status == 3) {
                    loading_display = 'Image cannot save to server.';
                    div_loading(loading_display);
                }
            })
            setTimeout(function () {
                $('#div_loading_upload').html('');
            }, 5000);
        },
        error: function(error){
            console.log(error);
        }
    })
}

function modal_upload_close(){
    $('#modal_upload').modal('hide');
}

function reset_form(){
    $('#id_inv_group').val('');
    $('#id_inv_group').val('0');
    $('#group_cd').val('');
    $('#group_name').val('');
    $('#no').val('');
}

function disable_enable(id_inv_group_get, group_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_inv_group_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_inv_group_disen').val(id_inv_group_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable group - "+group_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable group "+group_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable group - "+group_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable group "+group_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function div_loading(text_get){
    $('#div_loading_upload').html('');
    $('#div_loading_upload').append(text_get);
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