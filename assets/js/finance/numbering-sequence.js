$(document).ready(function(){
    list_numbering_sequence(id_module);
    list_header_numbering(id_module);
    list_module_category(0, 0);
})

function list_module_category(id_module_category_get, module_category_name_get){
    $('#id_module_category').html('');
    $.ajax({
        url: base_url+'finance/list-module-category/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_module_category_get=='0') {
                trList += '<option value="">Select Module Category</option>';
            }
            else {
                trList += '<option value="'+id_module_category_get+'">'+module_category_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_module_category = responseList.id_module_category;
                        var module_category_cd = responseList.module_category_cd;
                        var module_category_name = responseList.module_category_name;
                        var ar_ap = responseList.ar_ap;
                        var ar_ap_lower = responseList.ar_ap_lower;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_module_category+'">'+module_category_name+'</option>';
                        }
                    })
                }
            })
            $('#id_module_category').append(trList);
        }
    });
}

function add_numbering_sequence(){
    var string_format = $('#string_format').val();
    var cut_1 = $('#cut_1').val();
    var cut_2 = $('#cut_2').val();
    var cut_3 = $('#cut_3').val();
    var number_length = $('#number_length').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'finance/add-numbering-sequence/'+key_session,
        type: 'post',
        data: 'string_format='+string_format+'&cut_1='+cut_1+'&cut_2='+cut_2+'&cut_3='+cut_3+'&number_length='+number_length+'&id_module='+id_module,
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

function add_header_numbering(){
    var string_format = $('#string_format_header').val();
    var cut_1 = $('#cut_1_header').val();
    var cut_2 = $('#cut_2_header').val();
    var number_length = $('#number_length_header').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'finance/add-header-numbering/'+key_session,
        type: 'post',
        data: 'string_format='+string_format+'&cut_1='+cut_1+'&cut_2='+cut_2+'&number_length='+number_length+'&id_module='+id_module,
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

function list_numbering_sequence(id_module){
    //$('#list_module').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'finance/list-numbering-sequence/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    $('#cut_1').html('');
                    $('#cut_2').html('');
                    $('#cut_3').html('');
                    $('#string_format').val('');
                    $('#number_length').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var string_format = responseList[0].string_format;
                        var number_length = responseList[0].number_length;
                        var cut_1 = responseList[0].cut_1;
                        var cut_2 = responseList[0].cut_2;
                        var cut_3 = responseList[0].cut_3;
                        
                        $('#string_format').val(string_format);
                        $('#number_length').val(number_length);

                        var options_1 = '';
                        if (cut_1=='/') {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="-">-</option>';
                        }
                        else {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="/">/</option>';
                        }

                        var options_2 = '';
                        if (cut_2=='/') {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="-">-</option>';
                        }
                        else {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="/">/</option>';
                        }

                        var options_3 = '';
                        if (cut_3=='/') {
                            options_3 += '<option value="'+cut_3+'">'+cut_3+'</option>';
                            options_3 += '<option value="-">-</option>';
                        }
                        else {
                            options_3 += '<option value="'+cut_3+'">'+cut_3+'</option>';
                            options_3 += '<option value="/">/</option>';
                        }

                        $('#cut_1').append(options_1);
                        $('#cut_2').append(options_2);
                        $('#cut_3').append(options_3);
                    })
                }
            })
        }
    });
}

function list_header_numbering(id_module){
    //$('#list_module').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'finance/list-header-numbering/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    $('#cut_1_header').html('');
                    $('#cut_2_header').html('');
                    $('#string_format_header').val('');
                    $('#number_length_header').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var string_format = responseList[0].string_format;
                        var number_length = responseList[0].number_length;
                        var cut_1 = responseList[0].cut_1;
                        var cut_2 = responseList[0].cut_2;
                        
                        $('#string_format_header').val(string_format);
                        $('#number_length_header').val(number_length);

                        var options_1 = '';
                        if (cut_1=='/') {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="-">-</option>';
                        }
                        else {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="/">/</option>';
                        }

                        var options_2 = '';
                        if (cut_2=='/') {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="-">-</option>';
                        }
                        else {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="/">/</option>';
                        }

                        $('#cut_1_header').append(options_1);
                        $('#cut_2_header').append(options_2);
                    })
                }
            })
        }
    });
}

function update(id_module_get, module_cd_get, module_name_get, file_name_get, id_module_category_get, module_category_name_get){
    $('#id_module').val(id_module_get);
    $('#module_cd').val(module_cd_get);
    $('#module_name').val(module_name_get);
    $('#file_name').val(file_name_get);

    list_module_category(id_module_category_get, module_category_name_get)
}

function reset_form(){
    $('#id_module').val('');
    $('#module_cd').val('');
    $('#module_name').val('');
    $('#file_name').val('');

    list_module_category(0, 0);
}

function disable_enable(id_module_get, module_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_module_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_module_disen').val(id_module_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+module_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+module_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_module(){
    var id_module = $('#id_module_disen').val();
    var deleted = $('#value_disen').val();

    //console.log(id_module+' '+deleted);

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'finance/update-module/'+key_session,
        type: 'post',
        data: 'id_module='+id_module+'&deleted='+deleted,
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
                        list_module(0);
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