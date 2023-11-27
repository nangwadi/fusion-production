$(document).ready(function(){
    list_class_category(0);
})

function list_class_category(id_class_category){
    $('#list_class_category').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'inventory/list-class-category/'+key_session+'/'+id_class_category,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_class_category tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_class_category').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_class_category = responseList.id_class_category;
                        var class_category_cd = responseList.class_category_cd;
                        var class_category_name = responseList.class_category_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="update_'+(i+1)+'" onclick="update(\''+id_class_category+'\', \''+class_category_cd+'\', \''+class_category_name+'\', \''+(i+1)+'\');" title="Update Company - '+class_category_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="disable_enable_'+(i+1)+'" onclick="disable_enable(\''+id_class_category+'\', \''+class_category_name+'\', \''+1+'\');" title="Disable Company - '+class_category_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_class_category+'\', \''+class_category_name+'\', \''+0+'\');" title="Enable Company - '+class_category_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="class_category_cd_'+(i+1)+'">'+class_category_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="class_category_name_'+(i+1)+'">'+class_category_name+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_class_category tbody').append(trList);
                    $('#list_class_category').dataTable({
                        scrollY:        "400px",
                        scrollX:        false,
                        scrollCollapse: true,
                        paging:         false
                    });
                }
            })
        }
    });
}

function add_class_category(){
    var id_class_category = $('#id_class_category').val();
    var class_category_cd = $('#class_category_cd').val();
    var class_category_name = $('#class_category_name').val();
    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-class-category/'+key_session,
        type: 'post',
        data: 'id_class_category='+id_class_category+'&class_category_cd='+class_category_cd+'&class_category_name='+class_category_name,
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
                        if (id_class_category=='') {
                            list_class_category(0);
                        }
                        else {
                            $('#class_category_cd_'+no).html('');
                            $('#class_category_name_'+no).html('');
                            document.getElementById('update_'+no).removeAttribute('onclick');

                            $('#class_category_cd_'+no).append(class_category_cd);
                            $('#class_category_name_'+no).append(class_category_name);

                            document.getElementById('update_'+no).setAttribute('onclick', 'update(\''+id_class_category+'\', \''+class_category_cd+'\', \''+class_category_name+'\', \''+no+'\')');
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

function update(id_class_category_get, class_category_cd_get, class_category_name_get, no_get){
    $('#id_class_category').val(id_class_category_get);
    $('#class_category_cd').val(class_category_cd_get);
    $('#class_category_name').val(class_category_name_get);
    $('#no').val(no_get);
}

function reset_form(){
    $('#id_class_category').val('');
    $('#class_category_cd').val('');
    $('#class_category_name').val('');
    $('#no').val('');
}

function disable_enable(id_class_category_get, class_category_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_class_category_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_class_category_disen').val(id_class_category_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+class_category_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+class_category_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+class_category_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+class_category_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_class_category(){
    var id_class_category = $('#id_class_category_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/update-class-category/'+key_session,
        type: 'post',
        data: 'id_class_category='+id_class_category+'&deleted='+deleted,
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
                        list_class_category(0);
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