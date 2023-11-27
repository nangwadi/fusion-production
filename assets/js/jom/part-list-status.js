$(document).ready(function(){
    list_part_list_status(0);
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
            'url' : base_url+'jom/list-account-part-list-status-datatable/'+key_session+'/vendor/0',
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
    $('#id_account_part_list_status_'+no_get).prop('checked', true);
    $('#no_select_account').val('');
    $('#no_select_account').val(no_get);
}

function list_account_add(){
    $('#id_account').val('');
    var no_select_account = $('#no_select_account').val();

    var id_account_value = $('#id_account_part_list_status_'+no_select_account).val();
        
    $('#id_account').val(id_account_value);
    list_account_close();
}

function list_account_close(){
    $('#modal_account').modal('hide');
}

function list_part_list_status(id_part_list_status){
    $('#list_part_list_status').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-part-list-status/'+key_session+'/'+id_part_list_status,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_part_list_status tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_part_list_status').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_part_list_status = responseList.id_part_list_status;
                        var part_list_status_cd = responseList.part_list_status_cd;
                        var part_list_status_name = responseList.part_list_status_name;
                        var sequence = responseList.sequence;
                        var email_pic = responseList.email_pic;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_part_list_status+'\', \''+part_list_status_cd+'\', \''+part_list_status_name+'\', \''+sequence+'\', \''+email_pic+'\', \''+(i+1)+'\');" title="Update Company - '+part_list_status_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_part_list_status+'\', \''+part_list_status_name+'\', \''+1+'\');" title="Disable Company - '+part_list_status_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_part_list_status+'\', \''+part_list_status_name+'\', \''+0+'\');" title="Enable Company - '+part_list_status_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;"><div id="sequence_'+(i+1)+'">'+(sequence*1)+'</div></td>';
                            trList += '<td style="color:white;"><div id="part_list_status_cd_'+(i+1)+'">'+part_list_status_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="part_list_status_name_'+(i+1)+'">'+part_list_status_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="email_pic_'+(i+1)+'">'+email_pic+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_part_list_status tbody').append(trList);
                    $('#list_part_list_status').dataTable({
                        'paging': false,
                        'scrollY': '500px',
                    });
                }
            })
        }
    });
}

function add_part_list_status(){
    var id_part_list_status = $('#id_part_list_status').val();
    var part_list_status_cd = $('#part_list_status_cd').val();
    var part_list_status_name = $('#part_list_status_name').val();
    var sequence = $('#sequence').val();
    var email_pic = $('#email_pic').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-part-list-status/'+key_session,
        type: 'post',
        data: 'id_part_list_status='+id_part_list_status+'&part_list_status_cd='+part_list_status_cd+'&part_list_status_name='+part_list_status_name+'&sequence='+sequence+'&email_pic='+email_pic,
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
                        if (id_part_list_status != '') {
                            $('#sequence_'+no).html('');
                            $('#part_list_status_cd_'+no).html('');
                            $('#part_list_status_name_'+no).html('');
                            $('#email_pic_'+no).html('');

                            $('#sequence_'+no).append(sequence);
                            $('#part_list_status_cd_'+no).append(part_list_status_cd);
                            $('#part_list_status_name_'+no).append(part_list_status_name);
                            $('#email_pic_'+no).append(email_pic);

                            $('#btn_update_'+no).removeProp('onclick');
                            $('#btn_update_'+no).attr('onclick', 'update(\''+id_part_list_status+'\', \''+part_list_status_cd+'\', \''+part_list_status_name+'\', \''+sequence+'\', \''+email_pic+'\', \''+no+'\')');
                        }
                        else {
                            list_part_list_status(0);
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

function update(id_part_list_status_get, part_list_status_cd_get, part_list_status_name_get, sequence_get, email_pic_get, no_get){
    $('#id_part_list_status').val('');
    $('#part_list_status_cd').val('');
    $('#part_list_status_name').val('');
    $('#sequence').val('');
    $('#email_pic').val('');

    $('#id_part_list_status').val(id_part_list_status_get);
    $('#part_list_status_cd').val(part_list_status_cd_get);
    $('#part_list_status_name').val(part_list_status_name_get);
    $('#sequence').val(sequence_get);
    $('#email_pic').val(email_pic_get);

    $('#no').val(no_get);
}

function reset_form(){
    $('#id_part_list_status').val('');
    $('#sequence').val('');
    $('#part_list_status_cd').val('');
    $('#part_list_status_name').val('');
    $('#email_pic').val('');
}

function disable_enable(id_part_list_status_get, part_list_status_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_part_list_status_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_part_list_status_disen').val(id_part_list_status_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+part_list_status_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+part_list_status_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+part_list_status_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+part_list_status_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_part_list_status(){
    var id_part_list_status = $('#id_part_list_status_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-part-list-status/'+key_session,
        type: 'post',
        data: 'id_part_list_status='+id_part_list_status+'&deleted='+deleted,
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
                        list_part_list_status(0);
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