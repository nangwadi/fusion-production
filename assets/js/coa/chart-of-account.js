$(document).ready(function(){
    list_coa(0);
    list_coa_classes(0, 0, 0);
    list_coa_currency(0, 0);
})

function list_coa_classes(id_coa_classes_get, coa_classes_cd_get, coa_classes_name_get){
    $('#id_coa_classes').html('');
    $.ajax({
        url: base_url+'coa/list-coa-classes/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (id_coa_classes_get!='') {
                    trList += '<option value="'+id_coa_classes_get+'">'+coa_classes_cd_get+' / '+coa_classes_name_get+'</option>';
                }
                else {
                    trList += '<option value="">Select COA Class</option>';
                }
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_classes = responseList.id_coa_classes;
                        var coa_classes_cd = responseList.coa_classes_cd;
                        var coa_classes_name = responseList.coa_classes_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_coa_classes+'">'+coa_classes_cd+' / '+coa_classes_name+'</option>';
                        }

                    })
                    $('#id_coa_classes').append(trList);
                }
            })
        }
    });
}

function list_coa_currency(id_coa_currency_get, coa_currency_cd_get){
    $('#id_coa_currency').html('');
    $.ajax({
        url: base_url+'coa/list-coa-currency/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (id_coa_currency_get!='0') {
                    trList += '<option value="'+id_coa_currency_get+'">'+coa_currency_cd_get+'</option>';
                }
                else {
                    trList += '<option value="">Select Currency</option>';
                }
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_coa_currency+'">'+coa_currency_cd+'</option>';
                        }
                    })
                    $('#id_coa_currency').append(trList);
                }
            })
        }
    });
}

function list_coa(id_coa_classes_get){
    $('#list_coa').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'coa/list-chart-of-account/'+key_session+'/'+id_coa_classes_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_coa tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_coa').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_coa = responseList.id_coa;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_classes = responseList.id_coa_classes;
                        var coa_classes_cd = responseList.coa_classes_cd;
                        var coa_classes_name = responseList.coa_classes_name;
                        var id_coa_type = responseList.id_coa_type;
                        var coa_type_cd = responseList.coa_type_cd;
                        var coa_type_name = responseList.coa_type_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_cd_desc = responseList.coa_currency_cd_desc;
                        var coa_currency_name = responseList.coa_currency_name;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            if (coa_classes_cd=='AP' || coa_classes_cd=='AR') {
                                action += '<button class="btn btn-success" id="btn_bank_'+(i+1)+'" onclick="add_bank_open(\''+id_coa+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+(i+1)+'\');" title="Bank Account - '+coa_name+'."><i class="mdi mdi-bank"></i></button>&nbsp;&nbsp;';
                                action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_coa+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+id_coa_classes+'\', \''+coa_classes_cd+'\', \''+coa_classes_name+'\', \''+id_coa_currency+'\', \''+coa_currency_cd+'\', \''+(i+1)+'\');" title="Update Company - '+coa_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                                action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_coa+'\', \''+coa_name+'\', \''+1+'\');" title="Disable Company - '+coa_name+'."><i class="mdi mdi-delete"></i></button>';
                            }
                            else {
                                action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_coa+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+id_coa_classes+'\', \''+coa_classes_cd+'\', \''+coa_classes_name+'\', \''+id_coa_currency+'\', \''+coa_currency_cd+'\', \''+(i+1)+'\');" title="Update Company - '+coa_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                                action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_coa+'\', \''+coa_name+'\', \''+1+'\');" title="Disable Company - '+coa_name+'."><i class="mdi mdi-delete"></i></button>';
                            }
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_coa+'\', \''+coa_name+'\', \''+0+'\');" title="Enable Company - '+coa_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_cd_'+(i+1)+'">'+coa_cd+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_name_'+(i+1)+'">'+coa_name+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_classes_name_'+(i+1)+'">'+coa_classes_name+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_type_name_'+(i+1)+'">'+coa_type_name+'</td>';
                            trList += '<td style="color:white;"><div id="div_coa_currency_cd_'+(i+1)+'">'+coa_currency_cd_desc+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_coa tbody').append(trList);
                    $('#list_coa').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_coa(){
    var id_coa = $('#id_coa').val();
    var coa_cd = $('#coa_cd').val();
    var coa_name = $('#coa_name').val();
    var id_coa_classes = $('#id_coa_classes').val();
    var id_coa_currency = $('#id_coa_currency').val();

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/add-chart-of-account/'+key_session,
        type: 'post',
        data: 'id_coa='+id_coa+'&coa_cd='+coa_cd+'&coa_name='+coa_name+'&id_coa_classes='+id_coa_classes+'&id_coa_currency='+id_coa_currency,
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
                        if (id_coa=='') {
                            list_coa(0);
                        }
                        else {
                            $('#div_coa_cd_'+no).html('');
                            $('#div_coa_name_'+no).html('');
                            $('#div_coa_classes_name_'+no).html('');
                            $('#div_coa_type_name_'+no).html('');
                            $('#div_coa_currency_cd_'+no).html('');

                            document.getElementById('btn_update_'+no).removeAttribute('onclick');
                            document.getElementById('btn_disable_'+no).removeAttribute('onclick');

                            var response = responseGetList.response;
                            response.map(function(responseList){
                                var coa_cd_db = responseList.coa_cd;
                                var coa_name_db = responseList.coa_name;
                                var id_coa_classes_db = responseList.id_coa_classes;
                                var coa_classes_cd_db = responseList.coa_classes_cd;
                                var coa_classes_name_db = responseList.coa_classes_name;
                                var id_coa_type_db = responseList.id_coa_type;
                                var coa_type_name_db = responseList.coa_type_name;
                                var id_coa_currency_db = responseList.id_coa_currency;
                                var coa_currency_cd_db = responseList.coa_currency_cd;
                                var coa_currency_cd_db_desc = responseList.coa_currency_cd_desc;

                                $('#div_coa_cd_'+no).append(coa_cd_db);
                                $('#div_coa_name_'+no).append(coa_name_db);
                                $('#div_coa_classes_name_'+no).append(coa_classes_name_db);
                                $('#div_coa_type_name_'+no).append(coa_type_name_db);
                                $('#div_coa_currency_cd_'+no).append(coa_currency_cd_db_desc);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_coa+'\', \''+coa_cd_db+'\', \''+coa_name_db+'\', \''+id_coa_classes_db+'\', \''+coa_classes_cd_db+'\', \''+coa_classes_name_db+'\', \''+id_coa_currency_db+'\', \''+coa_currency_cd_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_coa+'\', \''+coa_name_db+'\', \''+1+'\')');
                            })
                        }
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

function update(id_coa_get, coa_cd_get, coa_name_get, id_coa_classes_get, coa_classes_cd_get, coa_classes_name_get, id_coa_currency_get, coa_currency_cd_get, no_get){
    $('#id_coa').val('');
    $('#coa_cd').val('');
    $('#coa_name').val('');
    $('#no').val('');

    $('#id_coa').val(id_coa_get);
    $('#coa_cd').val(coa_cd_get);
    $('#coa_name').val(coa_name_get);
    $('#no').val(no_get);
    list_coa_classes(id_coa_classes_get, coa_classes_cd_get, coa_classes_name_get)
    list_coa_currency(id_coa_currency_get, coa_currency_cd_get)
}

function reset_form(){
    $('#id_coa').val('');
    $('#coa_cd').val('');
    $('#coa_name').val('');
    list_coa_classes(0, 0, 0);
    list_coa_currency(0, 0);
}

function disable_enable(id_coa_get, coa_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_coa_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_coa_disen').val(id_coa_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable coa - "+coa_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable coa "+coa_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else if (values==0){
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable coa - "+coa_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable coa "+coa_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_coa(){
    var id_coa = $('#id_coa_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'coa/update-chart-of-account/'+key_session,
        type: 'post',
        data: 'id_coa='+id_coa+'&deleted='+deleted,
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
                        list_coa(0);
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error :'+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function add_bank_open(id_coa_get, coa_cd_get, coa_name_get, no_get){
    $.ajax({
        url: base_url+'coa/list-bank-account-by-id-coa/'+key_session+'/'+id_coa_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#id_coa_bank').val('');
            $('#id_coa').val('');
            $('#id_coa_currency_bank').val('');
            $('#cIDBank').val('');
            $('#bank_account_no').val('');
            $('#bank_account_name').val('');
            $('#bank_account_branch').val('');
            $('#bank_account_address').val('');
            $('#bank_account_va').val('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status == 0) {
                    $('#id_coa').val(id_coa_get);
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_coa_bank = responseList.id_coa_bank;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var cIDBank = responseList.cIDBank;
                        var cNmBank = responseList.cNmBank;
                        var cSandiBank = responseList.cSandiBank;
                        var bank_account_no = responseList.bank_account_no;
                        var bank_account_name = responseList.bank_account_name;
                        var bank_account_branch = responseList.bank_account_branch;
                        var bank_account_address = responseList.bank_account_address;
                        var bank_account_va = responseList.bank_account_va;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        $('#id_coa_bank').val(id_coa_bank);
                        $('#id_coa').val(id_coa);
                        $('#id_coa_currency_bank').val(coa_currency_cd);
                        $('#cIDBank').val(cNmBank);
                        $('#bank_account_no').val(bank_account_no);
                        $('#bank_account_name').val(bank_account_name);
                        $('#bank_account_branch').val(bank_account_branch);
                        $('#bank_account_address').val(bank_account_address);
                        $('#bank_account_va').val(bank_account_va);
                    })
                }
            })

            $('#modal_title_bank_account').html('');
            $('#modal_title_bank_account').append('Bank Account Of '+coa_name_get);
            id_coa_currency();
            list_bank();
            $('#modal_bank_account').modal('show');
        }
    })
}

function id_coa_currency(){
    $.ajax({
        url: base_url+'coa/list-coa-currency/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_currency').html('');
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var decimal_after = responseList.decimal_after;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+coa_currency_cd+'">';
                        }
                    })
                }
            })
            $('#list_currency').append(trList);
        }
    });
}

function list_bank(){
    $.ajax({
        url: base_url+'ess/list-bank/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_bank').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">';
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDBank = responseList.cIDBank;
                        var cNmBank = responseList.cNmBank;
                        var cSandiBank = responseList.cSandiBank;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cNmBank+'">';
                        }

                    })
                    $('#list_bank').append(trList);
                }
            })
        }
    });
}

function add_bank(){
    var id_coa_bank = $('#id_coa_bank').val();
    var id_coa = $('#id_coa').val();
    var id_coa_currency = $('#id_coa_currency_bank').val();
    var cIDBank = $('#cIDBank').val();
    var bank_account_no = $('#bank_account_no').val();
    var bank_account_name = $('#bank_account_name').val();
    var bank_account_branch = $('#bank_account_branch').val();
    var bank_account_address = $('#bank_account_address').val();
    var bank_account_va = $('#bank_account_va').val();

    console.log(id_coa_currency+' / '+cIDBank+' / '+bank_account_no+' / '+bank_account_name+' / '+bank_account_branch+' / '+bank_account_address);

    if (id_coa_currency == '' || cIDBank == '' || bank_account_no == '' || bank_account_name == '' || bank_account_branch == '' || bank_account_address == '') {
        alert ('Data cannot empty, please try again.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');
        $.ajax({
            url: base_url+'coa/add-bank-account/'+key_session,
            type: 'post',
            data: 'id_coa_bank='+id_coa_bank+'&id_coa='+id_coa+'&id_coa_currency='+id_coa_currency+'&cIDBank='+cIDBank+'&bank_account_no='+bank_account_no+'&bank_account_name='+bank_account_name+'&bank_account_branch='+bank_account_branch+'&bank_account_address='+bank_account_address+'&bank_account_va='+bank_account_va,
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
                            reset_form_bank();
                            modal_loading_hide();
                            add_bank_close();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            add_bank_close();
                        }, 5000);
                    }
                })
            }
        })        
    }
   
}

function add_bank_close(){
    $('#modal_bank_account').modal('hide');
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