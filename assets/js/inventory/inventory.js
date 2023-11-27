$(document).ready(function(){
    list_inventory_datatable();
})

// Item Class

function list_item_class(){
    $('#list_item_class').dataTable().fnDestroy();
    $('#modal_item_class').modal('show');

    $('#list_item_class').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-item-class-datatable/'+key_session+'/0',
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

function select_change_item_class(no_get){
    $('.item_class_cd').prop('checked', false);
    $('#item_class_cd_'+no_get).prop('checked', true);
}

function list_item_class_add(){
    $('#id_item_class').val('');
    var item_class_cd
    for (var i = 0; i < 11; i++) {
        var item_class_cd_cb = $('#item_class_cd_'+i).prop('checked');
        if (item_class_cd_cb == true) {
            var item_class_cd_value = $('#item_class_cd_'+i).val();
            item_class_cd = item_class_cd_value;
        }
    }
    $('#id_item_class').val(item_class_cd);
    list_item_class_close();
}

function list_item_class_close(){
    $('#modal_item_class').modal('hide');
}

// Tax

function list_sub_tax(){
    $('#list_sub_tax').dataTable().fnDestroy();
    $('#modal_sub_tax').modal('show');

    $('#list_sub_tax').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-sub-tax-datatable/'+key_session+'/0',
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

function select_change_sub_tax(no_get){
    $('.sub_tax_cd').prop('checked', false);
    $('#sub_tax_cd_'+no_get).prop('checked', true);
}

function list_sub_tax_add(){
    $('#id_sub_tax').val('');
    var sub_tax_cd
    for (var i = 0; i < 11; i++) {
        var sub_tax_cd_cb = $('#sub_tax_cd_'+i).prop('checked');
        if (sub_tax_cd_cb == true) {
            var sub_tax_cd_value = $('#sub_tax_cd_'+i).val();
            sub_tax_cd = sub_tax_cd_value;
        }
    }
    $('#id_sub_tax').val(sub_tax_cd);
    list_sub_tax_close();
}

function list_sub_tax_close(){
    $('#modal_sub_tax').modal('hide');
}

// UOM

function list_uom(){
    $('#list_uom').dataTable().fnDestroy();
    $('#modal_uom').modal('show');

    $('#list_uom').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-uom-datatable/'+key_session+'/0',
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

function select_change_uom(no_get){
    $('.uom_cd').prop('checked', false);
    $('#uom_cd_'+no_get).prop('checked', true);
}

function list_uom_add(){
    $('#id_uom').val('');
    var uom_cd
    for (var i = 0; i < 11; i++) {
        var uom_cd_cb = $('#uom_cd_'+i).prop('checked');
        if (uom_cd_cb == true) {
            var uom_cd_value = $('#uom_cd_'+i).val();
            uom_cd = uom_cd_value;
        }
    }
    $('#id_uom').val(uom_cd);
    list_uom_close();
}

function list_uom_close(){
    $('#modal_uom').modal('hide');
}

// coa

function list_coa(){
    $('#list_coa').dataTable().fnDestroy();
    $('#modal_coa').modal('show');

    $('#list_coa').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-coa-datatable/'+key_session+'/0',
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

function select_change_coa(no_get){
    $('.coa_cd').prop('checked', false);
    $('#coa_cd_'+no_get).prop('checked', true);
}

function list_coa_add(){
    $('#id_coa').val('');
    var coa_cd
    for (var i = 0; i < 11; i++) {
        var coa_cd_cb = $('#coa_cd_'+i).prop('checked');
        if (coa_cd_cb == true) {
            var coa_cd_value = $('#coa_cd_'+i).val();
            coa_cd = coa_cd_value;
        }
    }
    $('#id_coa').val(coa_cd);
    list_coa_close();
}

function list_coa_close(){
    $('#modal_coa').modal('hide');
}

// List Maker

function list_maker(id_inv_maker_get, maker_name_get){
    $.ajax({
        url: base_url+'inventory/list-maker/'+key_session,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#id_inv_maker').html('');
            var trList = '';
            if (id_inv_maker_get != '' && id_inv_maker_get != 'null' && id_inv_maker_get != null) {
                trList += '<option value="'+id_inv_maker_get+'" style="color:white;">'+maker_name_get+'</option>';
            }
            else {
                trList += '<option value="" style="color:white;">Select Maker</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status == 0) {
                    trList += '<option value="" style="color:white;">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_inv_maker = responseList.id_inv_maker;
                        var maker_name = responseList.maker_name;

                        trList += '<option value="'+id_inv_maker+'" style="color:white;">'+maker_name+'</option>';
                    })
                }
            })
            $('#id_inv_maker').append(trList);
        }
    })
}

// List group

function list_group(id_inv_group_get, group_cd_get, group_name_get){
    $.ajax({
        url: base_url+'inventory/list-group/'+key_session,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#id_inv_group').html('');
            var trList = '';
            if (id_inv_group_get != '' && id_inv_group_get != 'null' && id_inv_group_get != null) {
                trList += '<option value="'+id_inv_group_get+'" style="color:white;">'+group_name_get+' / '+group_cd_get+'</option>';
            }
            else {
                trList += '<option value="" style="color:white;">Select group</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status == 0) {
                    trList += '<option value="" style="color:white;">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_inv_group = responseList.id_inv_group;
                        var group_cd = responseList.group_cd;
                        var group_name = responseList.group_name;

                        trList += '<option value="'+id_inv_group+'" style="color:white;">'+group_name+' / '+group_cd+'</option>';
                    })
                }
            })
            $('#id_inv_group').append(trList);
        }
    })
}

function list_inventory_datatable(){
    $('#list_inventory').dataTable().fnDestroy();

    $('#list_inventory').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-inventory-datatable/'+key_session+'/0',
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

function add_inventory_form(){
    list_maker('', '');
    list_group('', '', '');
    var add_value = $('#add_value').val();
    if (add_value==0) {
        $('#add_value').val('1');
        $('#add_inventory_form').prop('style', 'display:block');
        $('#btn_add').prop('class', 'card-title btn btn-md btn-warning');
    }
    else if (add_value==1) {
        $('#add_value').val('0');
        $('#add_inventory_form').prop('style', 'display:none');
        $('#btn_add').prop('class', 'card-title btn btn-md btn-primary');
    }
}

function add_inventory(){
    var id_inventory = $('#id_inventory').val();
    var inventory_cd = $('#inventory_cd').val();
    var inventory_name = $('#inventory_name').val();
    var id_item_class = $('#id_item_class').val();
    var id_sub_tax = $('#id_sub_tax').val();
    var id_inv_maker = $('#id_inv_maker').val();
    var id_inv_group = $('#id_inv_group').val();
    var id_uom = $('#id_uom').val();
    var id_coa = $('#id_coa').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-inventory/'+key_session,
        type: 'post',
        data: 'id_inventory='+id_inventory+'&inventory_cd='+inventory_cd+'&inventory_name='+inventory_name+'&id_item_class='+id_item_class+'&id_sub_tax='+id_sub_tax+'&id_uom='+id_uom+'&id_coa='+id_coa+'&id_inv_maker='+id_inv_maker+'&id_inv_group='+id_inv_group,
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
                        if ((id_inventory)*1 != 0) {
                            add_inventory_form();

                            $('#inventory_cd_'+no).html('');
                            $('#inventory_name_'+no).html('');
                            $('#id_item_class_'+no).html('');
                            $('#id_sub_tax_'+no).html('');
                            $('#id_uom_'+no).html('');
                            $('#id_coa_'+no).html('');
                            $('#maker_name_'+no).html('');

                            var response = responseGetList.response;
                            
                            var id_inventory = response[0].id_inventory;
                            var inventory_cd = response[0].inventory_cd;
                            var inventory_name = response[0].inventory_name;
                            var item_class_cd = response[0].item_class_cd;
                            var item_class_name = response[0].item_class_name;
                            var sub_tax_cd = response[0].sub_tax_cd;
                            var sub_tax_name = response[0].sub_tax_name;
                            var uom_cd = response[0].uom_cd;
                            var uom_name = response[0].uom_name;
                            var coa_cd = response[0].coa_cd;
                            var coa_name = response[0].coa_name;
                            var maker_name = response[0].maker_name;
                            var group_name = response[0].group_name;

                            $('#inventory_cd_'+no).append(inventory_cd);
                            $('#inventory_name_'+no).append(inventory_name);
                            $('#id_item_class_'+no).append(item_class_cd);
                            $('#id_sub_tax_'+no).append(sub_tax_cd);
                            $('#id_uom_'+no).append(uom_cd);
                            $('#id_coa_'+no).append(coa_cd);
                            $('#maker_name_'+no).append(maker_name);
                            $('#group_name_'+no).append(group_name);

                            $('#id_item_class_'+no).prop('title', item_class_name);
                            $('#id_sub_tax_'+no).prop('title', sub_tax_name);
                            $('#id_uom_'+no).prop('title', uom_name);
                            $('#id_coa_'+no).prop('title', coa_name);
                            $('#maker_name_'+no).prop('title', maker_name);
                            $('#group_name_'+no).prop('title', group_name);

                        }
                        else {
                            add_inventory_form();
                            list_inventory_datatable();
                        }
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

function update(id_inventory_get, no_get){
    reset_form();
    add_inventory_form();
    $.ajax({
        url: base_url+'inventory/list-inventory/'+key_session+'/'+id_inventory_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_inventory = responseList.id_inventory;
                        var inventory_cd = responseList.inventory_cd;
                        var inventory_name = responseList.inventory_name;
                        var item_class_cd = responseList.item_class_cd;
                        var item_class_name = responseList.item_class_name;
                        var sub_tax_cd = responseList.sub_tax_cd;
                        var sub_tax_name = responseList.sub_tax_name;
                        var uom_cd = responseList.uom_cd;
                        var uom_name = responseList.uom_name;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var id_inv_maker = responseList.id_inv_maker;
                        var maker_name = responseList.maker_name;
                        var id_inv_group = responseList.id_inv_group;
                        var group_cd = responseList.group_cd;
                        var group_name = responseList.group_name;

                        $('#id_inventory').val('');
                        $('#id_inventory').val(id_inventory);
                        $('#inventory_cd').val(inventory_cd);
                        $('#inventory_name').val(inventory_name);
                        $('#id_item_class').val(item_class_cd+' // '+item_class_name);
                        $('#id_sub_tax').val(sub_tax_cd+' // '+sub_tax_name);
                        $('#id_uom').val(uom_cd+' // '+uom_name);
                        $('#id_coa').val(coa_cd+' // '+coa_name);
                        $('#no').val(no_get);
                        list_maker(id_inv_maker, maker_name);
                        list_group(id_inv_group, group_cd, group_name);
                    })
                }
            })
        }
    })
}

function reset_form(){
    $('#id_inventory').val('0');
    $('#inventory_cd').val('');
    $('#inventory_name').val('');
    $('#id_item_class').val('');
    $('#id_sub_tax').val('');
    $('#id_uom').val('');
    $('#id_coa').val('');
    $('#no').val('');
    list_maker('', '');
}

function disable_enable(id_inventory_get, inventory_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_inventory_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_inventory_disen').val(id_inventory_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable inventory - "+inventory_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable inventory "+inventory_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable inventory - "+inventory_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable inventory "+inventory_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_inventory(){
    var id_inventory = $('#id_inventory_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/update-inventory/'+key_session,
        type: 'post',
        data: 'id_inventory='+id_inventory+'&deleted='+deleted,
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
                        list_inventory_datatable();
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

function upload_img(id_inventory_get, inventory_name_get){
    list_inventory_img(id_inventory_get);
    $('#id_inventory_img').val('');
    $('#id_inventory_img').val(id_inventory_get);
    $('#modal_title_img').html('');
    $('#modal_title_img').append('Upload Image for '+inventory_name_get);
    $('#modal_img').modal('show');
}

function list_inventory_img(id_inventory_get){
    $.ajax({
        url: base_url+'inventory/list-inventory-img/'+key_session+'/'+id_inventory_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                var trList_list = '';
                $('#div_load_img').html('');
                $('#div_load_img_little').html('');
                if (status==0) {
                    trList += '<div class="col-md-12" align="center"><div class="item" id="div_img_main"><img src="'+base_url+'assets/images/inventory/no-img.png" style="width:100%; height:100%; display: block; margin-left: auto; margin-right: auto;"></div></div>';
                    trList_list += '<div class="col-md-2" align="center"><div class="item-little"><img src="'+base_url+'assets/images/inventory/no-img.png" style="width:100%; height:100%;"></div></div>';
                    //trList += '<div class="col-md-12" align="center">Image not found.</div>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_inventory_img = responseList.id_inventory_img;
                        var img_name = responseList.img_name;
                        var set_banner = responseList.set_banner;

                        if (set_banner*1 == 1) {
                            trList += '<div class="col-md-12" align="center" onclick="delete_img(\''+id_inventory_img+'\', \''+id_inventory_get+'\');"><div class="item" id="div_img_main"><img src="'+base_url+'assets/images/inventory/'+img_name+'" style="width:100%; height:100%; display: block; margin-left: auto; margin-right: auto;"></div></div>';
                            trList_list += '<div class="col-md-2" align="center" onclick="chenge_img(\''+img_name+'\');"><div class="item-little"><img src="'+base_url+'assets/images/inventory/'+img_name+'" style="width:100%; height:100%;"></div></div>';
                        }
                        else {
                            trList_list += '<div class="col-md-2" align="center" onclick="chenge_img(\''+img_name+'\');"><div class="item-little"><img src="'+base_url+'assets/images/inventory/'+img_name+'" style="width:100%; height:100%;"></div></div>';
                        }

                    })
                }
                $('#div_load_img').append(trList);
                $('#div_load_img_little').append(trList_list);
            })
        }
    })
}

function list_upload_img_close(){
    $('#modal_img').modal('hide');
}

function delete_img(id_inventory_img_get, id_inventory_get){
    if (confirm('Are you sure you want to delete this image ?')) {
        div_loading('Deleting image...');
        $.ajax({
            url: base_url+'inventory/delete-inventory-img/'+key_session+'/'+id_inventory_img_get+'/'+id_inventory_get,
            type: 'get',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    var id_inventory = responseGetList.id_inventory;
                    var loading_display = '';
                    if (status == 0) {
                        loading_display = 'Deleting data unsuccessfully.';
                        div_loading(loading_display);
                    }
                    else if (status == 1) {
                        loading_display = 'Deleting data successfully.';
                        div_loading(loading_display);
                        setTimeout(function () {
                            list_inventory_img(id_inventory_get);
                        }, 5000);
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
}

function chenge_img(img_name_get){
    $('#div_img_main').html('');
    $('#div_img_main').append('<img src="'+base_url+'assets/images/inventory/'+img_name_get+'" style="width:100%; height:100%; display: block; margin-left: auto; margin-right: auto;">');
}

function save_upload_img(){
    var id_inventory = $('#id_inventory_img').val();
    var img_name = $('#img_name')[0].files[0];

    const img_fd = new FormData();
    img_fd.append('id_inventory', id_inventory);
    img_fd.append('img_name', img_name);

    div_loading('Saving image...');

    $.ajax({
        url: base_url+'inventory/add-inventory-img/'+key_session,
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