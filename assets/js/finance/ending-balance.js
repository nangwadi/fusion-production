$(document).ready(function(){
    list_balance(0);
    list_cash_account(0, 0, 0);
})

function list_cash_account(id_cash_account_get, coa_cd_get, coa_name_get){
    $('#id_cash_account').html('');
    $.ajax({
        url: base_url+'coa/list-cash-account/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (id_cash_account_get!='0') {
                trList += '<option value="'+id_cash_account_get+'">'+coa_cd_get+' / '+coa_name_get+'</option>';
            }
            else {
                trList += '<option value="">Select COA</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_cash_account = responseList.id_cash_account;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var id_coa_type = responseList.id_coa_type;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+id_cash_account+'">'+coa_cd+' / '+coa_name+'</option>';
                        }
                    })
                }
            })            
            $('#id_cash_account').append(trList);
        }
    });
}

function list_balance(id_cash_account_get){
    var transaction_periode = $('#transaction_periode').val();
    $('#list_balance').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'finance/list-balance/'+key_session+'/'+transaction_periode+'/'+id_cash_account_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_balance tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_balance').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_balance = responseList.id_balance;
                        var company_id = responseList.company_id;
                        var id_cash_account = responseList.id_cash_account;
                        var cash_account_cd = responseList.cash_account_cd;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;
                        var transaction_periode = responseList.transaction_periode;
                        var begin_balance = responseList.begin_balance;
                        var total_debet = responseList.total_debet;
                        var total_credit = responseList.total_credit;
                        var ending_balance = responseList.ending_balance;
                        var transaction_periode_format = responseList.transaction_periode_format;
                        var begin_balance_format = responseList.begin_balance_format;
                        var total_debet_format = responseList.total_debet_format;
                        var total_credit_format = responseList.total_credit_format;
                        var ending_balance_format = responseList.ending_balance_format;

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="div_cash_account_cd_'+(i+1)+'">'+cash_account_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_cd_'+(i+1)+'">'+transaction_periode_format+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_name_'+(i+1)+'">'+begin_balance_format+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_nominal_'+(i+1)+'">'+total_debet_format+'</div></td>';
                            trList += '<td style="color:white;"><div id="div_coa_currency_cd_'+(i+1)+'">'+total_credit_format+'</div></td>';
                            trList += '<td style="color:white;">'+ending_balance_format+'</td>';
                            trList += '<td><button class="btn btn-md btn-info" onclick="update_balance(\''+id_balance+'\', \''+id_cash_account+'\', \''+coa_cd+'\', \''+coa_name+'\', \''+transaction_periode+'\', \''+begin_balance+'\', \''+total_debet+'\', \''+total_credit+'\', \''+ending_balance+'\');"><i class="mdi mdi-lead-pencil"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_balance tbody').append(trList);
                    $('#list_balance').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_balance(){
    var id_balance = $('#id_balance').val();
    var id_cash_account = $('#id_cash_account').val();
    var transaction_periode = $('#transaction_periode').val();
    var begin_balance = $('#begin_balance').val();
    var total_debet = $('#total_debet').val();
    var total_credit = $('#total_credit').val();
    var ending_balance = $('#ending_balance').val();

    if (id_cash_account == '' || transaction_periode == '' || begin_balance == '' || total_debet == '' || total_credit == '' || ending_balance == '') {
        alert ('Data cannot empty, please try again.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');
        $.ajax({
            url: base_url+'finance/add-balance/'+key_session,
            type: 'post',
            data: 'id_balance='+id_balance+'&id_cash_account='+id_cash_account+'&transaction_periode='+transaction_periode+'&begin_balance='+begin_balance+'&ending_balance='+ending_balance+'&total_debet='+total_debet+'&total_credit='+total_credit,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            list_balance(0);
                            modal_loading_hide();
                            reset_form();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error :'+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 10000);
                    }
                })
            }
        })

    }
}

function update_balance(id_balance_get, id_cash_account_get, coa_cd_get, coa_name_get, transaction_periode_get, begin_balance_get, total_debet_get, total_credit_get, ending_balance_get){
    list_cash_account(id_cash_account_get, coa_cd_get, coa_name_get);
    $('#id_balance').val('');
    $('#transaction_periode').val('');
    $('#begin_balance').val('');
    $('#total_debet').val('');
    $('#total_credit').val('');
    $('#ending_balance').val('');

    $('#id_balance').val(id_balance_get);
    $('#transaction_periode').val(transaction_periode_get);
    $('#begin_balance').val(begin_balance_get);
    $('#total_debet').val(total_debet_get);
    $('#total_credit').val(total_credit_get);
    $('#ending_balance').val(ending_balance_get);
}

function reset_form(){
    list_cash_account(0, 0, 0);
    $('#id_balance').val('');
    $('#transaction_periode').val(transaction_periode_default);
    $('#begin_balance').val('');
    $('#total_debet').val('');
    $('#total_credit').val('');
    $('#ending_balance').val('');
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