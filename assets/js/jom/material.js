$(document).ready(function(){
    list_material(0);
})

// Account vendor

function list_account(){
    $('#list_account').dataTable().fnDestroy();
    $('#modal_account').modal('show');

    $('#list_account').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-account-material-datatable/'+key_session+'/vendor/0',
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

function select_change_account(no_get){
    console.log(no_get);
    /*$('.id_account').prop('checked', false);
    $('#id_account_'+no_get).prop('checked', true);*/
    $('.id_account').prop('checked', false);
    $('#id_account_material_'+no_get).prop('checked', true);
    $('#no_select_account').val('');
    $('#no_select_account').val(no_get);
}

function list_account_add(){
    $('#id_account').val('');
    var no_select_account = $('#no_select_account').val();

    var id_account_value = $('#id_account_material_'+no_select_account).val();
        
    $('#id_account').val(id_account_value);
    list_account_close();
}

function list_account_close(){
    $('#modal_account').modal('hide');
}

function list_material(id_material){
    $('#list_material').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-material/'+key_session+'/'+id_material,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_material tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_material').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_material = responseList.id_material;
                        var material_cd = responseList.material_cd;
                        var material_name = responseList.material_name;
                        var account_name = responseList.account_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_material+'\', \''+material_cd+'\', \''+material_name+'\', \''+account_name+'\', \''+(i+1)+'\');" title="Update Company - '+material_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_material+'\', \''+material_name+'\', \''+1+'\');" title="Disable Company - '+material_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_material+'\', \''+material_name+'\', \''+0+'\');" title="Enable Company - '+material_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="material_cd_'+(i+1)+'">'+material_cd+'</td>';
                            trList += '<td style="color:white;"><div id="material_name_'+(i+1)+'">'+material_name+'</td>';
                            trList += '<td style="color:white;"><div id="id_account_'+(i+1)+'">'+account_name+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_material tbody').append(trList);
                    $('#list_material').dataTable();
                }
            })
        }
    });
}

function add_material(){
    var id_material = $('#id_material').val();
    var material_cd = $('#material_cd').val();
    var material_name = $('#material_name').val();
    var id_account = $('#id_account').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-material/'+key_session,
        type: 'post',
        data: 'id_material='+id_material+'&material_cd='+material_cd+'&material_name='+material_name+'&id_account='+id_account,
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
                        if (id_material != '') {
                            $('#material_cd_'+no).html('');
                            $('#material_name_'+no).html('');
                            $('#id_account_'+no).html('');

                            $('#material_cd_'+no).append(material_cd);
                            $('#material_name_'+no).append(material_name);
                            $('#id_account_'+no).append(id_account);

                            $('#btn_update_'+no).removeProp('onclick');
                            $('#btn_update_'+no).attr('onclick', 'update(\''+id_material+'\', \''+material_cd+'\', \''+material_name+'\', \''+id_account+'\', \''+no+'\')');
                        }
                        else {
                            list_material(0);
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

function update(id_material_get, material_cd_get, material_name_get, account_name_get, no_get){
    $('#id_material').val(id_material_get);
    $('#material_cd').val(material_cd_get);
    $('#material_name').val(material_name_get);
    $('#id_account').val(account_name_get);

    $('#no').val(no_get);
}

function reset_form(){
    $('#id_material').val('');
    $('#no').val('');
    $('#material_cd').val('');
    $('#material_name').val('');
    $('#id_account').val('');
}

/*function delete_part_list(id_material_get, part_name_get){
    if (confirm('Are you sure you want to delete '+part_name_get+' ?')) {
        
    }
}*/

function disable_enable(id_material_get, material_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_material_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_material_disen').val(id_material_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+material_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+material_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+material_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+material_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_material(){
    var id_material = $('#id_material_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-material/'+key_session,
        type: 'post',
        data: 'id_material='+id_material+'&deleted='+deleted,
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
                        list_material(0);
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