$(document).ready(function(){
    $('#line_description').dataTable();
    list_cash_account();
})

// ======================================================================= HEADER =============================================================

// Purchase invoice

function list_transaction(){
    $('#list_transaction').dataTable().fnDestroy();
    $('#modal_transaction').modal('show');

    $('#list_transaction').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'finance/list-transaction-select-datatable/'+key_session+'/'+id_module,
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "invoiceable": false, 
            },
        ],
    });
}

function select_change_transaction(no_get){
    $('#no_select_transaction').val('');
    $('#no_select_transaction').val(no_get);

    $('.transaction_number').prop('checked', false);
    const transaction_number = $('#transaction_number_'+no_get).prop('checked');
    //console.log(transaction_number);
    if (transaction_number==false) {
        $('#transaction_number_'+no_get).prop('checked', true);
    }
    else {
        $('#transaction_number_'+no_get).prop('checked', false);
    }
}

function list_transaction_add(){
    $('#id_transaction').val('');
    $('#transaction_number').val('');
    var no_select_transaction = $('#no_select_transaction').val();

    var transaction_number_value = $('#transaction_number_value_'+no_select_transaction).val();
    let transaction_cd_split = transaction_number_value.split(" // ");
    let id_transaction = transaction_cd_split[0];
    var transaction_number = transaction_cd_split[1];
    var account_name = transaction_cd_split[2];
    var total_line = transaction_cd_split[3];
        
    $('#id_transaction').val(id_transaction);
    $('#transaction_number').val(transaction_number);
    $('#account_name').val(account_name);
    $('#total_line').val(total_line);
    list_transaction_close();

    //console.log(transaction_number_value);

    transaction_line(transaction_number);
}

function list_transaction_close(){
    $('#modal_transaction').modal('hide');
}

function transaction_line(transaction){
    var transaction_number_format = transaction.replace(/\//g, '-');
    $('#line_description').dataTable().fnDestroy();
    $('#line_description').dataTable({
        "scrollY":        "500px",
        "scrollX":        true,
        "scrollCollapse": true,
        "processing" : true,
        "serverSide" : true,
        "bPaginate" : false,
        "order": [],
        "ajax" : {
            'url' : base_url+'finance/list-transaction-line-datatable/'+key_session+'/'+transaction_number_format,
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false,
                "searchable" : false
            },
        ],
        "fixedColumns":   {
            'leftColumns': 3
        }
    });
    list_cash_account();
}

/*function set_payment_date(){
    var transaction_number = $('#transaction_number').val();
    if (transaction_number == '') {
        alert('Payment number cannot empty, please try again.');
    }
    else {
        var total_line = $('#total_line').val();
        var transfer_date = $('#transfer_date').val();
        if(transfer_date==''){
            alert('Transfer Date cannot empty, please try again.');
        }
        else {
            if (total_line*1 == 0) {
                alert('Invoice total line cannot zero, please try again.');       
            }
            else {
                const id_transaction_distribution_array = [];
                for (var a=1; a<=(total_line*1); a++){
                    var id_transaction_distribution = $('#id_transaction_distribution_'+a).val();
                    id_transaction_distribution_array.push(id_transaction_distribution);
                    //console.log(id_transaction_distribution);
                }
                console.log(id_transaction_distribution_array);
                modal_loading_open('bg-danger', 'Deleting data', 'Please wait...');
                $.ajax({
                    url: base_url+'finance/update-transaction-distribution-payment-date/'+key_session,
                    type: 'POST',
                    data: 'id_transaction_distribution_array='+(JSON.stringify(id_transaction_distribution_array))+'&transfer_date='+transfer_date,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        console.log(responseGet);
                        modal_loading_hide();
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status[0]==1){
                                modal_loading_open('bg-primary', 'Updating payment date successfully', 'Please wait...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                    transaction_line(transaction_number);
                                }, 5000);
                            }
                            else {
                                modal_loading_open('bg-danger', 'Updating payment date unsuccessfully.', 'Please wait for hide this view...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                }, 5000);
                            }
                        })
                    }
                })                
            }
        }
    }
}

function set_bank_account(){
    var transaction_number = $('#transaction_number').val();
    if (transaction_number == '') {
        alert('Payment number cannot empty, please try again.');
    }
    else {
        var total_line = $('#total_line').val();
        var id_bank_account = $('#id_bank_account').val();
        if(id_bank_account==''){
            alert('Transfer Date cannot empty, please try again.');
        }
        else {
            if (total_line*1 == 0) {
                alert('Invoice total line cannot zero, please try again.');       
            }
            else {
                const id_transaction_distribution_array = [];
                for (var a=1; a<=(total_line*1); a++){
                    var id_transaction_distribution = $('#id_transaction_distribution_'+a).val();
                    id_transaction_distribution_array.push(id_transaction_distribution);
                    //console.log(id_transaction_distribution);
                }
                console.log(id_transaction_distribution_array);
                modal_loading_open('bg-danger', 'Deleting data', 'Please wait...');
                $.ajax({
                    url: base_url+'finance/update-transaction-distribution-bank-account/'+key_session,
                    type: 'POST',
                    data: 'id_transaction_distribution_array='+(JSON.stringify(id_transaction_distribution_array))+'&id_bank_account='+id_bank_account,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        console.log(responseGet);
                        modal_loading_hide();
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status[0]==1){
                                modal_loading_open('bg-primary', 'Updating bank account successfully', 'Please wait...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                    transaction_line(transaction_number);
                                }, 5000);
                            }
                            else {
                                modal_loading_open('bg-danger', 'Updating bank account unsuccessfully.', 'Please wait for hide this view...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                }, 5000);
                            }
                        })
                    }
                })                
            }
        }
    }
}*/

function delete_transaction(id_transaction_distribution_get, distribution_number_get, transaction_number_get){
    if (confirm('Are you sure you want delete transaction '+distribution_number_get+' ?')) {
        modal_loading_open('bg-danger', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'finance/delete-transaction-distribution/'+key_session+'/'+id_transaction_distribution_get,
            type: 'get',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait...');
                        setTimeout(function(){
                            modal_loading_hide();
                            transaction_line(transaction_number_get);
                        }, 5000);
                    }
                    else {
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully.', 'Please wait for hide this view...');
                        setTimeout(function(){
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function list_cash_account(){
    $('.id_bank_account_list').html('');
    $.ajax({
        url: base_url+'coa/list-cash-account/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="Data Not Found.">';
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
                            trList += '<option value="'+coa_cd+' / '+coa_name+'">';
                        }
                    })
                }
            })            
            $('.id_bank_account_list').append(trList);
        }
    });
}

function save_bank_account(no_get, id_transaction_distribution_get){
    var transfer_date = $('#transfer_date_'+no_get).val();
    var id_bank_account = $('#id_bank_account_'+no_get).val();
    if (transfer_date == '' || id_bank_account == '') {
        alert('Payment Date or Cash Bank Account cannot empty, please try again.');
    }
    else {
        $.ajax({
            url: base_url+'finance/update-transaction-distribution-line/'+key_session,
            type: 'POST',
            data: 'id_transaction_distribution='+id_transaction_distribution_get+'&transfer_date='+transfer_date+'&id_bank_account='+id_bank_account+'&id_module='+id_module,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
            }
        })
    }
}

/*function transfer_date_change(no_get, distribution_number_get, transaction_number_get){
    var id_transaction_distribution = $('#id_transaction_distribution_'+no_get).val();
    var transfer_date = $('#transfer_date_'+no_get).val();
    if (confirm('Are you sure you want update payment date '+distribution_number_get+' ?')) {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'finance/update-transaction-distribution-payment-date-line/'+key_session,
            type: 'POST',
            data: 'id_transaction_distribution='+id_transaction_distribution+'&transfer_date='+transfer_date,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                        setTimeout(function(){
                            modal_loading_hide();
                            //transaction_line(transaction_number_get);
                        }, 5000);
                    }
                    else {
                        modal_loading_open('bg-danger', 'Updating data unsuccessfully.', 'Please wait for hide this view...');
                        setTimeout(function(){
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function cash_account_change(no_get, distribution_number_get, transaction_number_get){
    var id_transaction_distribution = $('#id_transaction_distribution_'+no_get).val();
    var id_bank_account = $('#id_bank_account_'+no_get).val();
    var cash_account_cd_old = $('#cash_account_cd_old_'+no_get).val();
    console.log(id_bank_account+' / '+cash_account_cd_old);
    if (id_bank_account != '') {
        if (id_bank_account != cash_account_cd_old) {
            if (confirm('Are you sure you want update cash account of '+distribution_number_get+' ?')) {
                modal_loading_open('bg-info', 'Updating data', 'Please wait...');
                $.ajax({
                    url: base_url+'finance/update-transaction-distribution-bank-account-line/'+key_session,
                    type: 'POST',
                    data: 'id_transaction_distribution='+id_transaction_distribution+'&id_bank_account='+id_bank_account,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        modal_loading_hide();
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1){
                                modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                    //transaction_line(transaction_number_get);
                                }, 5000);
                            }
                            else {
                                modal_loading_open('bg-danger', 'Updating data unsuccessfully.', 'Please wait for hide this view...');
                                setTimeout(function(){
                                    modal_loading_hide();
                                }, 5000);
                            }
                        })
                    }
                })
            }        
        }
    }
}*/

function list_transaction_list(){
    window.open(base_url+'finance/account-payable/list-vendor-payment/', '_blank')
}

// ====================================================== Loading ==================================================================================

function modal_loading_open(backgroundcolor, values_header, values_body){
    $('#modal_title').html('');
    $('#modal_body').html('');
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