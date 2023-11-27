$(document).ready(function(){
    list_approval_permission(id_module);
})

// Employee

function list_employee(){
    $('#list_employee').dataTable().fnDestroy();
    $('#modal_employee').modal('show');

    $('#list_employee').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-employee-datatable/'+key_session+'/0',
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

function select_change_employee(no_get){
    $('#no_select_employee').val('');
    $('.employee_cd').prop('checked', false);
    
    $('#no_select_employee').val(no_get);
    $('#cNmPegawai_'+no_get).prop('checked', true);
}

function list_employee_add(){
    var no_select_employee = $('#no_select_employee').val();
    var cNmPegawai = $('#cNmPegawai_'+no_select_employee).val();

    $('#cNmPegawai').val('');
    $('#cNmPegawai').val(cNmPegawai);

    list_employee_close();
}

function list_employee_close(){
    $('#modal_employee').modal('hide');
}

function add_approval_permission(){
    var id_approval_permission = $('#id_approval_permission').val();
    var cNmPegawai = $('#cNmPegawai').val();

    //console.log()

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'distribution/add-approval-permission/'+key_session,
        type: 'post',
        data: 'id_approval_permission='+id_approval_permission+'&cNmPegawai='+cNmPegawai+'&id_module='+id_module,
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
                        list_approval_permission(id_module)
                        modal_loading_hide();
                        $('#cNmPegawai').val('');
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

function list_approval_permission(id_module){
    $('#list_approval_permission').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-approval-permission/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#list_approval_permission tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_approval_permission = responseList.id_approval_permission;
                        var cNmPegawai = responseList.cNmPegawai;
                        
                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td><button class="btn btn-danger" onclick="delete_employee(\''+id_approval_permission+'\', \''+cNmPegawai+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_approval_permission tbody').append(trList);
                    $('#list_approval_permission').dataTable();
                }
                else {
                    $('#list_approval_permission').dataTable();
                }
            })
        }
    });
}

function delete_employee(id_approval_permission_get, cNmPegawai_get){
    if (confirm('Are you sure you want to delete '+cNmPegawai_get+' from permission ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');

        $.ajax({
            url: base_url+'distribution/delete-approval-permission/'+key_session,
            type: 'post',
            data: 'id_approval_permission='+id_approval_permission_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            list_approval_permission(id_module)
                            modal_loading_hide();
                            $('#cNmPegawai').val('');
                        }, 5000);

                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
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
        url: base_url+'distribution/update-module/'+key_session,
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