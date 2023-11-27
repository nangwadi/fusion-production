$(document).ready(function(){
    list_sub_tax(0);
    list_tax(0, 0);
})

function list_tax(id_tax_get, tax_name_get){
    $('#id_tax').html('');
    $.ajax({
        url: base_url+'jom/list-tax/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_tax_get=='0') {
                trList += '<option value="">Select Tax</option>';
            }
            else {
                trList += '<option value="'+id_tax_get+'">'+tax_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_tax = responseList.id_tax;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var tax_cd = responseList.tax_cd;
                        var tax_name = responseList.tax_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_tax+'">'+tax_name+'</option>';
                        }
                    })
                    $('#id_tax').append(trList);
                }
            })
        }
    });
}

function list_sub_tax(id_sub_tax){
    $('#list_sub_tax').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-sub-tax/'+key_session+'/'+id_sub_tax,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_sub_tax tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_sub_tax').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_sub_tax = responseList.id_sub_tax;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var sub_tax_cd = responseList.sub_tax_cd;
                        var sub_tax_name = responseList.sub_tax_name;
                        var sub_tax_percent_plus = responseList.sub_tax_percent_plus;
                        var sub_tax_percent_minus = responseList.sub_tax_percent_minus;
                        var coa_name_percent_plus = responseList.coa_name_percent_plus;
                        var coa_name_percent_minus = responseList.coa_name_percent_minus;
                        var coa_cd_percent_plus = responseList.coa_cd_percent_plus;
                        var coa_cd_percent_minus = responseList.coa_cd_percent_minus;
                        var sub_tax_percent_plus_coa = responseList.sub_tax_percent_plus_coa;
                        var sub_tax_percent_minus_coa = responseList.sub_tax_percent_minus_coa;
                        var id_tax = responseList.id_tax;
                        var tax_name = responseList.tax_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_sub_tax+'\', \''+sub_tax_cd+'\', \''+sub_tax_name+'\', \''+sub_tax_percent_plus+'\', \''+sub_tax_percent_minus+'\', \''+coa_name_percent_plus+'\', \''+coa_name_percent_minus+'\', \''+id_tax+'\', \''+tax_name+'\');" title="Update Company - '+sub_tax_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_sub_tax+'\', \''+sub_tax_name+'\', \''+1+'\');" title="Disable Company - '+sub_tax_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_sub_tax+'\', \''+sub_tax_name+'\', \''+0+'\');" title="Enable Company - '+sub_tax_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tax_name+'</td>';
                            trList += '<td style="color:white;">'+sub_tax_cd+'</td>';
                            trList += '<td style="color:white;">'+sub_tax_name+'</td>';
                            trList += '<td style="color:white;">'+sub_tax_percent_plus+'</td>';
                            trList += '<td style="color:white;">'+coa_name_percent_plus+'</td>';
                            trList += '<td style="color:white;">'+sub_tax_percent_minus+'</td>';
                            trList += '<td style="color:white;">'+coa_name_percent_minus+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_sub_tax tbody').append(trList);
                    $('#list_sub_tax').dataTable();
                }
            })
        }
    });
}

function add_sub_tax(){
    var id_tax = $('#id_tax').val();
    var id_sub_tax = $('#id_sub_tax').val();
    var sub_tax_cd = $('#sub_tax_cd').val();
    var sub_tax_name = $('#sub_tax_name').val();
    var sub_tax_percent_plus = $('#sub_tax_percent_plus').val();
    var sub_tax_percent_minus = $('#sub_tax_percent_minus').val();
    var sub_tax_percent_plus_coa = $('#sub_tax_percent_plus_coa').val();
    var sub_tax_percent_minus_coa = $('#sub_tax_percent_minus_coa').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-sub-tax/'+key_session,
        type: 'post',
        data: 'id_sub_tax='+id_sub_tax+'&id_tax='+id_tax+'&sub_tax_cd='+sub_tax_cd+'&sub_tax_name='+sub_tax_name+'&sub_tax_percent_plus='+sub_tax_percent_plus+'&sub_tax_percent_minus='+sub_tax_percent_minus+'&sub_tax_percent_plus_coa='+sub_tax_percent_plus_coa+'&sub_tax_percent_minus_coa='+sub_tax_percent_minus_coa,
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
                        list_sub_tax(0);
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

function update(id_sub_tax_get, sub_tax_cd_get, sub_tax_name_get, sub_tax_percent_plus_get, sub_tax_percent_minus_get, coa_name_percent_plus_get, coa_name_percent_minus_get, id_tax_get, tax_name_get){
    $('#id_sub_tax').val(id_sub_tax_get);
    $('#sub_tax_cd').val(sub_tax_cd_get);
    $('#sub_tax_name').val(sub_tax_name_get);
    $('#sub_tax_percent_plus').val(sub_tax_percent_plus_get*1);
    $('#sub_tax_percent_minus').val(sub_tax_percent_minus_get*1);
    $('#sub_tax_percent_plus_coa').val(coa_name_percent_plus_get);
    $('#sub_tax_percent_minus_coa').val(coa_name_percent_minus_get);
    list_tax(id_tax_get, tax_name_get);
}

function reset_form(){
    $('#id_sub_tax').val('');
    $('#sub_tax_cd').val('');
    $('#sub_tax_name').val('');
    $('#sub_tax_percent_plus').val('');
    $('#sub_tax_percent_minus').val('');
    list_tax(0, 0);
}

function disable_enable(id_sub_tax_get, sub_tax_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_sub_tax_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_sub_tax_disen').val(id_sub_tax_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+sub_tax_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+sub_tax_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+sub_tax_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+sub_tax_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_sub_tax(){
    var id_sub_tax = $('#id_sub_tax_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-sub-tax/'+key_session,
        type: 'post',
        data: 'id_sub_tax='+id_sub_tax+'&deleted='+deleted,
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
                        list_sub_tax(0);
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

// coa

function list_coa(category_get){
    $('#list_coa').dataTable().fnDestroy();
    $('#modal_coa').modal('show');

    $('#category').val('');
    $('#category').val(category_get);

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

    $('#no_select_coa').val('');
    $('#no_select_coa').val(no_get);
}

function list_coa_add(){

    var no_select_coa = $('#no_select_coa').val();
    var no_line_coa = $('#no_line_coa').val();

    var coa_cd_value = $('#coa_cd_'+no_select_coa).val();
    let coa_cd_split = coa_cd_value.split(" // ");

    var coa_cd = coa_cd_split[0];
    var coa_name = coa_cd_split[1];
        
    var category_get = $('#category').val();
    $('#sub_tax_percent_'+category_get+'_coa').val('');
    $('#sub_tax_percent_'+category_get+'_coa').val(coa_name);

    console.log(category_get);

    list_coa_close();
}

function list_coa_close(){
    $('#modal_coa').modal('hide');
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