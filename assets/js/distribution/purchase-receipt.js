$(document).ready(function(){
    list_employee_permission(id_module);
    purchase_receipt_line_blank(0);

    if ((transaction_number_db*1) == 1) {
        //console.log(transaction_number_format_db);
        detail_header_purchase_order(transaction_number_format_db);
    }
    else if ((transaction_number_db*1) != 0) {
        detail_header_purchase_receipt(transaction_number_format_db);
    }
})

// ======================================================================= header =============================================================

// Header

function hold_check(){
    var hold = $('#hold').prop('checked');
    var transaction_number = $('#purchase_receipt_number').val();
    var id_transaction_role = $('#id_transaction_role').val();
    if (transaction_number == '') {
        alert ('Please choose Purchase Receipt to release the hold.');
        $('#hold').prop('checked', 'checked');
    }
    else {
        if (hold == false) {
            if (confirm('Are you sure you want to release the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-purchase-receipt-hold/'+key_session+'/0',
                    type: 'POST',
                    data: 'purchase_receipt_number='+transaction_number+'&id_module='+id_module+'&id_transaction_role='+id_transaction_role,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header_purchase_receipt(transaction_number);
                            }
                            else {
                                var response = responseGetList.response;
                                alert('Data not updated. '+response);
                                $('#hold').prop('checked', true);
                            }
                        })
                    }
                })
            }
            else {
                $('#hold').prop('checked', true);
            }
        }
        else {
            if (confirm('Are you sure you want to unrelease the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-purchase-receipt-hold/'+key_session+'/1',
                    type: 'POST',
                    data: 'purchase_receipt_number='+transaction_number+'&id_module='+id_module+'&id_transaction_role='+id_transaction_role,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header_purchase_receipt(transaction_number);
                            }
                            else {
                                var response = responseGetList.response;
                                alert('Data not updated. '+response);
                                $('#hold').prop('checked', false);
                            }
                        })
                    }
                })
            }
            else {
                $('#hold').prop('checked', false);
            }
        }
    }
}

// Button

function list_purchase_receipt_detail(){
    window.open(base_url+'distribution/list-purchase/purchase-receipt');
}

// Purchase Order

function list_purchase_order(){
    $('#list_purchase_order').dataTable().fnDestroy();
    $('#modal_purchase_order').modal('show');

    $('#list_purchase_order').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-purchase-order-select-for-purchase-receipt-datatable/'+key_session+'/0',
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

function select_change_purchase_order(no_get){
    $('#no_select_purchase_order').val('');
    $('#no_select_purchase_order').val(no_get);

    $('.purchase_order_cd').prop('checked', false);
    $('#purchase_order_cd_'+no_get).prop('checked', true);
}

function list_purchase_order_add(){
    $('#id_purchase_order').val('');
    $('#purchase_order_number').val('');
    var no_select_purchase_order = $('#no_select_purchase_order').val();
    //console.log(no_select_purchase_order);

    if (no_select_purchase_order=='0') {
        alert ('You must select purchase order to this action.');
    }
    else {
        var purchase_order_number_value = $('#purchase_order_number_'+no_select_purchase_order).val();
        let purchase_order_cd_split = purchase_order_number_value.split(" // ");
        let id_purchase_order = purchase_order_cd_split[0];
        var purchase_order_number = purchase_order_cd_split[1];
            
        $('#id_purchase_order').val(id_purchase_order);
        $('#purchase_order_number').val(purchase_order_number);
        list_purchase_order_close();

        detail_header_purchase_order(purchase_order_number);
    }
}

function list_purchase_order_close(){
    $('#modal_purchase_order').modal('hide');
}

// Purchase receipt

function list_purchase_receipt(){
    $('#list_purchase_receipt').dataTable().fnDestroy();
    $('#modal_purchase_receipt').modal('show');

    $('#list_purchase_receipt').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-purchase-receipt-select-datatable/'+key_session+'/0',
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "receiptable": false, 
            },
        ],
    });
}

function select_change_purchase_receipt(no_get){
    $('#no_select_purchase_receipt').val('');
    $('#no_select_purchase_receipt').val(no_get);

    $('.purchase_receipt_number').prop('checked', false);
    $('#purchase_receipt_number_'+no_get).prop('checked', true);
}

function list_purchase_receipt_add(){
    $('#id_purchase_receipt').val('');
    $('#purchase_receipt_number').val('');
    var no_select_purchase_receipt = $('#no_select_purchase_receipt').val();

    var purchase_receipt_number_value = $('#purchase_receipt_number_'+no_select_purchase_receipt).val();
    let purchase_receipt_cd_split = purchase_receipt_number_value.split(" // ");
    let id_purchase_receipt = purchase_receipt_cd_split[0];
    var purchase_receipt_number = purchase_receipt_cd_split[1];
        
    $('#id_purchase_receipt').val(id_purchase_receipt);
    $('#purchase_receipt_number').val(purchase_receipt_number);
    list_purchase_receipt_close();

    detail_header_purchase_receipt(purchase_receipt_number);
}

function list_purchase_receipt_close(){
    $('#modal_purchase_receipt').modal('hide');
}

// Employee

function list_approval_permission(){
    $('#list_employee').dataTable().fnDestroy();
    $('#modal_employee').modal('show');

    $('#list_employee').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-approval-permission-datatable/'+key_session+'/'+id_module,
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

    $('#cNIK_approval').val('');
    $('#cNIK_approval').val(cNmPegawai);

    list_employee_close();
}

function list_employee_close(){
    $('#modal_employee').modal('hide');
}

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
    //console.log(no_get);
    /*$('.id_account').prop('checked', false);
    $('#id_account_'+no_get).prop('checked', true);*/
    $('.id_account').prop('checked', false);
    $('#id_account_material_'+no_get).prop('checked', true);
    $('#no_select_account').val('');
    $('#no_select_account').val(no_get);
}

function list_account_add(){
    $('#id_account').val('');
    $('#id_coa_currency').val('');
    var no_select_account = $('#no_select_account').val();

    var id_account_value = $('#id_account_material_'+no_select_account).val();
    var coa_currency_cd = $('#coa_currency_cd_'+no_select_account).val();
        
    $('#id_coa_currency').val(coa_currency_cd);
    $('#id_account').val(id_account_value);
    list_account_close();
}

function list_account_close(){
    $('#modal_account').modal('hide');
}

// Blank PO Line

function line_use(){
    var line_use = $('#line_use').val();
    document.getElementById('qty_order_'+line_use).removeAttribute('readonly');
}

function add_line(){
    let line_use = $('#total_line').val();

    let id_inventory_line = $('#id_inventory_line_'+line_use).val();
    if (id_inventory_line=='') {
        alert ('Line '+line_use+' cannot empty, please try again.')
    }
    else {
        let new_line_use = (line_use*1)+1;

        $('#line_use').val('');
        $('#line_use').val(new_line_use);

        $('#total_line').val('');
        $('#total_line').val(new_line_use);

        for (var i = 1; i <= 17; i++) {
            $('#div_line_'+i+'_'+new_line_use).show();
        }
    }
}

function list_employee_permission(id_module){
    $('#list_employee_permission').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-employee-permission/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_employee_permission tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_employee_permission = responseList[0].id_employee_permission;
                        var cNmPegawai = responseList[0].cNmPegawai;
                        
                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td><button class="btn btn-danger" onclick="delete_employee(\''+id_employee_permission+'\', \''+cNmPegawai+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_employee_permission tbody').append(trList);
                    $('#list_employee_permission').dataTable();
                }
                else {
                    $('#list_employee_permission').dataTable();
                }
            })
        }
    });
}

// ===================== Read ==================================================

function detail_header_purchase_order(transaction_number_get){
    //console.log(transaction_number_get);
    $.ajax({
        url: base_url+'distribution/list-purchase-order-by-purchase-order-number-for-purchase-receipt/'+key_session,
        type: 'POST',
        data: 'purchase_order_number='+transaction_number_get,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert ('Purcahse order with number '+transaction_number_get+' is not ready, please select other.');
                }
                else {
                    $('#id_purchase_order').val('');
                    $('#purchase_order_number').val('');
                    $('#id_purchase_receipt').val('');
                    $('#purchase_receipt_number').val('');
                    //$('#hold').val('');
                    //$('#id_transaction_role').val('');
                    //$('#transaction_name').html('');
                    //$('#purchase_receipt_date').val('');
                    //$('#note').val('');
                    $('#total_line').val('');
                    $('#total_qty').val('');
                    $('#id_account').val('');
                    $('#vendor_receipt_number').val('');
                    $('#id_coa_currency').val('');
                    $('#rate').val('');
                    //$('#purchase_receipt_owner').val('');
                    //$('#cNIK_receipt').val('');

                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_purchase_order = responseList.id_purchase_order;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var purchase_order_number = responseList.purchase_order_number;
                        var purchase_order_number_format = responseList.purchase_order_number_format;
                        var hold = responseList.hold;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var year = responseList.year;
                        var periode = responseList.periode;
                        var purchase_order_date = responseList.purchase_order_date;
                        var vendor_quotation_number = responseList.vendor_quotation_number;
                        var cNIK_approval = responseList.cNIK_approval;
                        var cNmPegawai_approval = responseList.cNmPegawai_approval;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var rate = responseList.rate;
                        var total_line = responseList.total_line;
                        var total_qty = responseList.total_qty;
                        var cury_sub_amount = responseList.cury_sub_amount;
                        var sub_amount = responseList.sub_amount;
                        var cury_discount_amount = responseList.cury_discount_amount;
                        var discount_amount = responseList.discount_amount;
                        var cury_amount = responseList.cury_amount;
                        var amount = responseList.amount;
                        var ppn = responseList.ppn;
                        var pph = responseList.pph;
                        var cury_total_amount = responseList.cury_total_amount;
                        var total_amount = responseList.total_amount;
                        var id_transaction_role = responseList.id_transaction_role;
                        var transaction_name = responseList.transaction_name;
                        var write = responseList.write;
                        var email_approval = responseList.email_approval;
                        var email_vendor = responseList.email_vendor;
                        var close_transaction = responseList.close_transaction;
                        var note = responseList.note;
                        var purchase_order_owner = responseList.purchase_order_owner;
                        var cNmPegawai_owner = responseList.cNmPegawai_owner;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        var responseLine = responseList.responseLine;

                        $('#id_purchase_order').val(id_purchase_order);
                        $('#purchase_order_number').val(purchase_order_number);
                        $('#purchase_order_date').val(purchase_order_date);
                        $('#note').val(note);
                        $('#total_line').val(total_line);
                        $('#total_qty').val(total_qty);
                        $('#id_account').val(account_name);
                        $('#vendor_quotation_number').val(vendor_quotation_number);
                        $('#id_coa_currency').val(coa_currency_cd);
                        $('#rate').val(rate);
                        //$('#purchase_order_owner').val(cNmPegawai_owner);
                        //$('#cNIK_approval').val(cNmPegawai_approval);
                        $('#sub_amount').val(sub_amount);
                        $('#discount_amount').val(discount_amount);
                        $('#amount').val(amount);
                        $('#ppn').val(ppn);
                        $('#pph').val(pph);
                        $('#total_amount').val(total_amount);

                        //$('#id_transaction_role').val(id_transaction_role);
                        //$('#transaction_name').append(transaction_name);

                        document.getElementById('id_account').removeAttribute('onclick');

                        purchase_receipt_line_blank(purchase_order_number_format);

                    })
                }
            })
        }
    })
}

function purchase_receipt_line_blank(transaction_number){
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
            'url' : base_url+'distribution/purchase-receipt-line-blank/'+key_session+'/'+transaction_number,
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
}

function detail_header_purchase_receipt(transaction_number){

    $.ajax({
        url: base_url+'distribution/list-purchase-receipt-by-purchase-receipt-number/'+key_session,
        type: 'POST',
        data: 'purchase_receipt_number='+transaction_number,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert ('Purcahse receipt with number '+transaction_number+' is not ready, please select other.');
                }
                else {
                    $('#id_purchase_order').val('');
                    $('#purchase_order_number').val('');
                    $('#id_purchase_receipt').val('');
                    $('#purchase_receipt_number_format').val('');
                    $('#purchase_receipt_number').val('');
                    $('#hold').val('');
                    $('#id_transaction_role').val('');
                    $('#transaction_name').html('');
                    $('#purchase_receipt_date').val('');
                    $('#note').val('');
                    $('#total_line').val('');
                    $('#total_qty').val('');
                    $('#id_account').val('');
                    $('#vendor_receipt_number').val('');
                    $('#id_coa_currency').val('');
                    $('#rate').val('');
                    $('#purchase_receipt_owner').val('');
                    $('#cNIK_receipt').val('');

                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');
                    
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_purchase_receipt = responseList.id_purchase_receipt;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var purchase_receipt_number = responseList.purchase_receipt_number;
                        var purchase_receipt_number_format = responseList.purchase_receipt_number_format;
                        var id_purchase_order = responseList.id_purchase_order;
                        var purchase_order_number = responseList.purchase_order_number;
                        var hold = responseList.hold;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var year = responseList.year;
                        var periode = responseList.periode;
                        var purchase_receipt_date = responseList.purchase_receipt_date;
                        var vendor_receipt_number = responseList.vendor_receipt_number;
                        var cNIK_receipt = responseList.cNIK_receipt;
                        var cNmPegawai = responseList.cNmPegawai;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var decimal_after = responseList.decimal_after;
                        var rate = responseList.rate;
                        var total_line = responseList.total_line;
                        var total_qty = responseList.total_qty;
                        var cury_sub_amount = responseList.cury_sub_amount;
                        var sub_amount = responseList.sub_amount;
                        var cury_discount_amount = responseList.cury_discount_amount;
                        var discount_amount = responseList.discount_amount;
                        var cury_amount = responseList.cury_amount;
                        var amount = responseList.amount;
                        var ppn = responseList.ppn;
                        var pph = responseList.pph;
                        var cury_total_amount = responseList.cury_total_amount;
                        var total_amount = responseList.total_amount;
                        var id_transaction_role = responseList.id_transaction_role;
                        var transaction_name = responseList.transaction_name;
                        var write = responseList.write;
                        var email_approval = responseList.email_approval;
                        var email_vendor = responseList.email_vendor;
                        var close_transaction = responseList.close_transaction;
                        var note = responseList.note;
                        var sequence = responseList.sequence;
                        var purchase_receipt_owner = responseList.purchase_receipt_owner;
                        var cNmPegawai_receipt = responseList.cNmPegawai_receipt;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        var responseLine = responseList.responseLine;

                        $('#id_purchase_order').val(id_purchase_order);
                        $('#purchase_order_number').val(purchase_order_number);
                        $('#id_purchase_receipt').val(id_purchase_receipt);
                        $('#purchase_receipt_number_format').val(purchase_receipt_number_format);
                        $('#purchase_receipt_number').val(purchase_receipt_number);

                        console.log(sequence);
                        
                        if (hold==1) {
                            $('#hold').prop('checked', true);
                            $('#btn_receipt').prop('onclick', false);
                            $('#btn_request_release').prop('onclick', false);
                            $('#btn_release').prop('onclick', false);
                            $('#btn_purchase_invoice').prop('onclick', false);
                        }
                        else {
                            $('#hold').prop('checked', false);
                            if (sequence==2) { // Open
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_request_release').prop('onclick', false);
                                $('#btn_release').prop('onclick', false);
                                $('#btn_purchase_invoice').prop('onclick', false);
                            }
                            else if (sequence==3) { // Receipt
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_receipt').prop('onclick', false);
                                $('#btn_purchase_invoice').prop('onclick', false);
                                $('#btn_release').prop('onclick', false);
                            }
                            else if (sequence==4) { // Request Release
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_receipt').prop('onclick', false);
                                //$('#btn_purchase_invoice').prop('onclick', false);
                            }
                            else if ((sequence*1)==5) { // Release
                                $('#btn_save').prop('onclick', false);
                                $('#btn_receipt').prop('onclick', false);
                                $('#btn_request_release').prop('onclick', false);
                                $('#btn_release').prop('onclick', false);
                                //$('#btn_purchase_invoice').prop('onclick', true);
                            }
                            else if (sequence==6) { // Close
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_receipt').prop('onclick', false);
                                $('#btn_request_release').prop('onclick', false);
                                $('#btn_release').prop('onclick', false);
                                $('#btn_purchase_invoice').prop('onclick', false);
                            }
                        }

                        $('#id_transaction_role').val(id_transaction_role);
                        $('#transaction_name').append(transaction_name);
                        $('#purchase_receipt_date').val(purchase_receipt_date);
                        $('#note').val(note);
                        $('#total_line').val(total_line);
                        $('#total_qty').val(total_qty);
                        $('#id_account').val(account_name);
                        $('#vendor_receipt_number').val(vendor_receipt_number);
                        $('#id_coa_currency').val(coa_currency_cd);
                        $('#rate').val(rate);
                        $('#purchase_receipt_owner').val(cNmPegawai_receipt);
                        $('#cNIK_receipt').val(cNmPegawai);

                        $('#sub_amount').val(sub_amount);
                        $('#discount_amount').val(discount_amount);
                        $('#amount').val(amount);
                        $('#ppn').val(ppn);
                        $('#pph').val(pph);
                        $('#total_amount').val(total_amount);

                        if ((write)*1 == 0) {
                            $('#btn_save').prop('onclick', false);
                        }

                        //console.log(sequence);

                        if (sequence==2) {
                            document.getElementById('cNIK_receipt').setAttribute('onclick', 'set_session();');
                        }

                        document.getElementById('id_account').removeAttribute('onclick');

                        purchase_receipt_line_blank_receipt(purchase_receipt_number_format);

                    })
                }
            })
        }
    })
}

function purchase_receipt_line_blank_receipt(transaction_number){
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
            'url' : base_url+'distribution/purchase-receipt-line-blank-receipt/'+key_session+'/'+transaction_number,
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
}

function set_session(){
    $('#cNIK_receipt').val(cNmPegawai_session);
}

// ===================== Button Header ==================================================


// Save

function save_transaction(){
    var id_purchase_order = $('#id_purchase_order').val();
    var purchase_order_number = $('#purchase_order_number').val();
    var id_purchase_receipt = $('#id_purchase_receipt').val();
    var purchase_receipt_number = $('#purchase_receipt_number').val();
    var hold = $('#hold').prop('checked');
    var id_transaction_role = $('#id_transaction_role').val();
    var purchase_receipt_date = $('#purchase_receipt_date').val();
    var note = $('#note').val();
    var total_line = $('#total_line').val();
    var total_qty = $('#total_qty').val();
    var id_account = $('#id_account').val();
    var vendor_receipt_number = $('#vendor_receipt_number').val();
    var id_coa_currency = $('#id_coa_currency').val();
    var rate = $('#rate').val();
    var purchase_receipt_owner = $('#purchase_receipt_owner').val();
    var cNIK_receipt = $('#cNIK_receipt').val();
    var sub_amount = $('#sub_amount').val();
    var discount_amount = $('#discount_amount').val();
    var amount = $('#amount').val();
    var ppn = $('#ppn').val();
    var pph = $('#pph').val();
    var total_amount = $('#total_amount').val();

    if (total_qty==0) {
        alert('Qty cannot zero, please try again.');
    }
    else {
        if (vendor_receipt_number == '') {
            alert ('Vendor DO number cannot empty, please try again.')
        }
        else {
            var id_purchase_receipt_line_array = [];
            var id_purchase_order_line_array = [];
            var id_part_list_line_array = [];
            var id_inventory_line_array = [];
            var inventory_cd_line_array = [];
            var inventory_name_line_array = [];
            var JobNo_line_array = [];
            var qty_order_line_array = [];
            var qty_receipt_line_array = [];
            var uom_cd_line_array = [];
            var unit_price_line_array = [];
            var line_sub_amount_line_array = [];
            var discount_amount_line_array = [];
            var discount_percent_line_array = [];
            var line_amount_line_array = [];
            var item_class_cd_line_array = [];
            var sub_tax_cd_line_array = [];
            var coa_cd_line_array = [];
            var coa_name_line_array = [];
            var warehouse_name_line_array = [];

            let total_line_real = 0;

            for (var a=1; a<=total_line; a++){
                var id_inventory_line = $('#id_inventory_line_'+a).val();
                if (id_inventory_line != '') {

                    total_line_real += 1;
                    
                    var id_purchase_receipt_line = $('#id_purchase_receipt_line_'+a).val();
                    var id_purchase_order_line = $('#id_purchase_order_line_'+a).val();
                    var id_part_list_line = $('#id_part_list_line_'+a).val();
                    var id_inventory_line = $('#id_inventory_line_'+a).val();
                    var inventory_cd_line = $('#inventory_cd_line_'+a).val();
                    var inventory_name_line = $('#inventory_name_line_'+a).val();
                    var JobNo_line = $('#JobNo_line_'+a).val();
                    var qty_order_line = $('#qty_order_line_'+a).val();
                    var qty_receipt_line = $('#qty_receipt_line_'+a).val();
                    var uom_cd_line = $('#uom_cd_line_'+a).val();
                    var unit_price_line = $('#unit_price_line_'+a).val();
                    var line_sub_amount_line = $('#line_sub_amount_line_'+a).val();
                    var discount_amount_line = $('#discount_amount_line_'+a).val();
                    var discount_percent_line = $('#discount_percent_line_'+a).val();
                    var line_amount_line = $('#line_amount_line_'+a).val();
                    var item_class_cd_line = $('#item_class_cd_line_'+a).val();
                    var sub_tax_cd_line = $('#sub_tax_cd_line_'+a).val();
                    var coa_cd_line = $('#coa_cd_line_'+a).val();
                    var coa_name_line = $('#coa_name_line_'+a).val();
                    var warehouse_name_line = $('#warehouse_name_line_'+a).val();

                    id_purchase_receipt_line_array.push(id_purchase_receipt_line);
                    id_purchase_order_line_array.push(id_purchase_order_line);
                    id_part_list_line_array.push(id_part_list_line);
                    id_inventory_line_array.push(id_inventory_line);
                    inventory_cd_line_array.push(inventory_cd_line);
                    inventory_name_line_array.push(inventory_name_line);
                    JobNo_line_array.push(JobNo_line);
                    qty_order_line_array.push(qty_order_line);
                    qty_receipt_line_array.push(qty_receipt_line);
                    uom_cd_line_array.push(uom_cd_line);
                    unit_price_line_array.push(unit_price_line);
                    line_sub_amount_line_array.push(line_sub_amount_line);
                    discount_amount_line_array.push(discount_amount_line);
                    discount_percent_line_array.push(discount_percent_line);
                    line_amount_line_array.push(line_amount_line);
                    item_class_cd_line_array.push(item_class_cd_line);
                    sub_tax_cd_line_array.push(sub_tax_cd_line);
                    coa_cd_line_array.push(coa_cd_line);
                    coa_name_line_array.push(coa_name_line);
                    warehouse_name_line_array.push(warehouse_name_line);
                }
            }

            if (purchase_order_number == '') {
                modal_loading_open('bg-info', 'Saving data', 'Please wait...');
            }
            else {
                modal_loading_open('bg-info', 'Updating data', 'Please wait...');
            }

            $.ajax({
                url: base_url+'distribution/add-purchase-receipt/'+key_session,
                type: 'POST',
                data: 'id_purchase_receipt='+id_purchase_receipt+'&purchase_receipt_number='+purchase_receipt_number+'&id_purchase_order='+id_purchase_order+'&purchase_order_number='+purchase_order_number+'&id_module='+id_module+'&hold='+hold+'&id_transaction_role='+id_transaction_role+'&purchase_receipt_date='+purchase_receipt_date+'&note='+note+'&total_line='+total_line_real+'&total_qty='+total_qty+'&id_account='+id_account+'&vendor_receipt_number='+vendor_receipt_number+'&id_coa_currency='+id_coa_currency+'&rate='+rate+'&purchase_receipt_owner='+purchase_receipt_owner+'&cNIK_receipt='+cNIK_receipt+'&sub_amount='+sub_amount+'&discount_amount='+discount_amount+'&amount='+amount+'&ppn='+ppn+'&pph='+pph+'&total_amount='+total_amount+'&id_purchase_receipt_line='+id_purchase_receipt_line_array+'&id_purchase_order_line='+id_purchase_order_line_array+'&id_part_list_line='+id_part_list_line_array+'&id_inventory_line='+id_inventory_line_array+'&inventory_cd_line='+inventory_cd_line_array+'&inventory_name_line='+inventory_name_line_array+'&JobNo_line='+JobNo_line_array+'&qty_order_line='+qty_order_line_array+'&qty_receipt_line='+qty_receipt_line_array+'&uom_cd_line='+uom_cd_line_array+'&unit_price_line='+unit_price_line_array+'&line_sub_amount_line='+line_sub_amount_line_array+'&discount_amount_line='+discount_amount_line_array+'&discount_percent_line='+discount_percent_line_array+'&line_amount_line='+line_amount_line_array+'&item_class_cd_line='+item_class_cd_line_array+'&sub_tax_cd_line='+sub_tax_cd_line_array+'&coa_cd_line='+coa_cd_line_array+'&coa_name_line='+coa_name_line_array+'&warehouse_name_line='+warehouse_name_line_array,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    modal_loading_hide();
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status[0]==1) {
                            if (purchase_receipt_number == '') {
                                modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                            }
                            else {
                                modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                            }
                            setTimeout(function () {
                                modal_loading_hide();
                                var purchase_receipt_number_db = responseGetList.purchase_receipt_number;
                                $('#purchase_receipt_number').val(purchase_receipt_number_db);
                            }, 5000)
                        }
                        else {
                            var response = responseGetList.response;
                            if (purchase_receipt_number == '') {
                                modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                            }
                            else {
                                modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                            }
                            
                            setTimeout(function () {
                                modal_loading_hide();
                            }, 5000);
                        }
                        //console.log();
                    })
                }
            })
        }
    }
}

// Add

function refresh(){
    location.href = base_url+'distribution/purchase/purchase-receipt/0';
}

// Remove 

function remove(){
    var purchase_order_number = $('#purchase_order_number').val();
    if (purchase_order_number=='') {
        alert ('Please select purchase order number to remove purchase order.');
    }
    else {
        //alert ('remove');
        var cNIK_receipt = $('#cNIK_receipt').val();
        var id_transaction_role = $('#id_transaction_role').val();
        if (cNIK_receipt=='') {
            alert ('Receipt By cannot empty, please click on Receipt By coloumn to process this action.');
        }
        else {
            $.ajax({
                url: base_url+'distribution/update-purchase-receipt-remove/'+key_session,
                type: 'POST',
                data: 'purchase_receipt_number='+purchase_receipt_number+'&id_module='+id_module+'&cNIK_receipt='+cNIK_receipt+'&id_transaction_role='+id_transaction_role,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            detail_header_purchase_receipt(purchase_receipt_number);
                        }
                        else {
                            var response = responseGetList.response;
                            alert('Data not updated. '+response);
                        }
                    })
                }
            })
        }
    }
}

// Receipt

function receipt(){
    var purchase_receipt_number = $('#purchase_receipt_number').val();
    if (purchase_receipt_number=='') {
        alert ('Please select purchase order number to create purchase receipt.');
    }
    else {
        //alert ('receipt');
        var cNIK_receipt = $('#cNIK_receipt').val();
        var id_transaction_role = $('#id_transaction_role').val();
        if (cNIK_receipt=='') {
            alert ('Receipt By cannot empty, please click on Receipt By coloumn to process this action.');
        }
        else {
            $.ajax({
                url: base_url+'distribution/update-purchase-receipt-receipt/'+key_session,
                type: 'POST',
                data: 'purchase_receipt_number='+purchase_receipt_number+'&id_module='+id_module+'&cNIK_receipt='+cNIK_receipt+'&id_transaction_role='+id_transaction_role,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status[0]==1) {
                            detail_header_purchase_receipt(purchase_receipt_number);
                        }
                        else {
                            var response = responseGetList.response;
                            alert('Data not updated. '+response);
                        }
                    })
                }
            })
        }
    }
}

// Request Release

function request_release(){
    var purchase_receipt_number = $('#purchase_receipt_number').val();
    if (purchase_receipt_number=='') {
        alert ('Please select purchase receipt number to process this action.');
    }
    else {
        //alert ('receipt');
        var cNIK_receipt = $('#cNIK_receipt').val();
        var id_transaction_role = $('#id_transaction_role').val();
        if (cNIK_receipt=='') {
            alert ('Receipt By cannot empty, please click on Receipt By coloumn to process this action.');
        }
        else {
            modal_loading_open('bg-info', 'Sending a request release', 'Please wait...');
            $.ajax({
                url: base_url+'distribution/update-purchase-receipt-request-release/'+key_session,
                type: 'POST',
                data: 'purchase_receipt_number='+purchase_receipt_number+'&id_module='+id_module+'&cNIK_receipt='+cNIK_receipt+'&id_transaction_role='+id_transaction_role,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    //console.log(responseGet);
                    modal_loading_hide();
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            //detail_header_purchase_receipt(purchase_receipt_number);
                            modal_loading_open('bg-primary', 'Request release sending successfully', 'Please wait in someday to our accounting proses your request.');
                            setTimeout(function () {
                                modal_loading_hide();
                                detail_header_purchase_receipt(purchase_receipt_number);
                            }, 5000);
                        }
                        else {
                            var response = responseGetList.response;
                            modal_loading_open('bg-danger', 'Request release sending unsuccessfully', 'Error page : '+response+'. Please screen shoot this page and sent to tarwadi@meiwa-m.co.id');
                            setTimeout(function () {
                                modal_loading_hide();
                                //detail_header_purchase_receipt(purchase_receipt_number);
                            }, 5000);
                        }
                    })
                }
            })
        }
    }
}

// Release

function release(){
    var purchase_receipt_number = $('#purchase_receipt_number').val();
    if (purchase_receipt_number=='') {
        alert ('Please select purchase receipt number to process this action.');
    }
    else {
        //alert ('receipt');
        var cNIK_receipt = $('#cNIK_receipt').val();
        var id_transaction_role = $('#id_transaction_role').val();
        if (cNIK_receipt=='') {
            alert ('Receipt By cannot empty, please click on Receipt By coloumn to process this action.');
        }
        else {
            modal_loading_open('bg-info', 'Releasing purchase receipt.', 'Please wait...');
            $.ajax({
                url: base_url+'distribution/update-purchase-receipt-release/'+key_session,
                type: 'POST',
                data: 'purchase_receipt_number='+purchase_receipt_number+'&id_module='+id_module+'&cNIK_receipt='+cNIK_receipt+'&id_transaction_role='+id_transaction_role,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            modal_loading_open('bg-primary', 'Releasing purchase receipt successfully', 'Please wait, closing this view...');
                            setTimeout(function () {
                                modal_loading_hide();
                                detail_header_purchase_receipt(purchase_receipt_number);
                            }, 5000);
                        }
                        else {
                            var response = responseGetList.response;
                            modal_loading_open('bg-danger', 'Releasing purchase receipt unsuccessfully', 'Error page : '+response+'. Please screen shoot this page and sent to tarwadi@meiwa-m.co.id');
                            setTimeout(function () {
                                modal_loading_hide();
                            }, 5000);
                        }
                    })
                }
            })
        }
    }
}

// Purchase Invoice

function create_purchase_invoice(){
    var id_transaction_role = $('#id_transaction_role').val();
    console.log(id_transaction_role);
    if (id_transaction_role != 8) {
        alert ('Cannot create purchase invouce because status not released.');
    }
    else {
        var purchase_receipt_number = $('#purchase_receipt_number').val();
        if (purchase_receipt_number=='') {
            alert ('Please select purchase receipt number to create purchase invoice.');
        }
        else {
            //alert ('receipt');
            var mapForm = document.createElement("form");
            mapForm.target = "Map";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = base_url+"distribution/purchase/purchase-invoice/1";

            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "transaction_number";
            mapInput.value = purchase_receipt_number;
            mapForm.appendChild(mapInput);
            document.body.appendChild(mapForm);
            map = window.open("", "Map", "status=0, title=0, height=800, width=1200, scrollbars=1");
            if (map) {
                mapForm.submit();
            } 
            else {
                alert('You must allow popups for this map to work.');
            }
        }
    }
}

// Print

function print_purchase_receipt(){
    var purchase_receipt_number = $('#purchase_receipt_number').val();
    var id_transaction_role = $('#id_transaction_role').val();

    if (purchase_receipt_number=='') {
        alert ('Select purchase receipt number to process this action.');
    }
    else {
        if (id_transaction_role<=1) {
            alert ('Cannot process this action because status this transaction is hold.');
        }
        else {
            var purchase_receipt_number_format = $('#purchase_receipt_number_format').val();
            window.open(base_url+'report/pdf/purchase-receipt/'+key_session+'/'+purchase_receipt_number_format);
        }
    }
}



// ======================================================== LINE ==================================================================================

// Line

function price_calculation(no_line_get){
    var qty_order_line = $('#qty_order_line_'+no_line_get).val();
    var qty_receipt_line = $('#qty_receipt_line_'+no_line_get).val();
    var unit_price_line = $('#unit_price_line_'+no_line_get).val();
    var discount_amount_line = $('#discount_amount_line_'+no_line_get).val();
    var discount_percent_line = $('#discount_percent_line_'+no_line_get).val();
    var qty_receipt_line_old = $('#qty_receipt_line_old_'+no_line_get).val();

    let qty_open_line = $('#qty_open_line_'+no_line_get).val();

    if (qty_open_line==0){
        alert ('Qty line order is completed.');
        $('#qty_receipt_line_'+no_line_get).val('');
        $('#qty_receipt_line_'+no_line_get).val(qty_receipt_line_old);
    }
    else {
        let line_amount_line = '';
        let line_sub_amount_line = '';

        if (qty_receipt_line>qty_open_line) {
            alert ('Qty receipt cannot more than qty open.');
            $('#qty_receipt_line_'+no_line_get).val(qty_receipt_line_old);
        }
        else {
            if (qty_receipt_line<=0) {
                alert ('Qty receipt must more than zero.');
                $('#qty_receipt_line_'+no_line_get).val(qty_order_line);
            }
            else {
                if (isNaN(qty_receipt_line*1)) {
                    alert ('Your qty field is not number, please try again. '+(qty_receipt_line)+' / '+no_line_get);
                    $('#qty_receipt_line_'+no_line_get).val('0');
                    line_sub_amount_line = 0;
                    line_amount_line = 0;
                }
                else {
                    if (isNaN(unit_price_line*1)) {
                        alert ('Your unit price field is not number, please try again.');
                        $('#unit_price_line_'+no_line_get).val('0');
                        line_sub_amount_line = 0;
                        line_amount_line = 0;
                    }
                    else {
                        line_sub_amount_line = qty_receipt_line*unit_price_line;
                        if (discount_percent_line != 0) {
                            let discount_percent_line_amount = (discount_percent_line/100)*line_sub_amount_line;
                            $('#discount_amount_line_'+no_line_get).val('');
                            $('#discount_amount_line_'+no_line_get).val(discount_percent_line_amount);
                            line_amount_line = (line_sub_amount_line)-(discount_percent_line_amount);
                        }
                        else {
                            line_amount_line = (line_sub_amount_line)-(discount_amount_line);
                        }
                        price_header();
                    }
                }
                $('#line_sub_amount_line_'+no_line_get).val('');
                $('#line_sub_amount_line_'+no_line_get).val(line_sub_amount_line);

                $('#line_amount_line_'+no_line_get).val('');
                $('#line_amount_line_'+no_line_get).val(line_amount_line);
            }
        }
    }
}

function price_header(){
    var line_use = $('#total_line').val();
    var sub_tax_cd_line = '';

    if ($('#sub_tax_cd_line_1').val() == '') {
        for (var i = 2; i<=100; i++) {
            var sub_tax_cd_line_check = $('#sub_tax_cd_line_'+i).val();
            if (typeof sub_tax_cd_line_check !== 'undefined'){
                sub_tax_cd_line = sub_tax_cd_line_check;
            }
        }
    }
    else {
        sub_tax_cd_line = $('#sub_tax_cd_line_1').val();
    }

    //console.log(sub_tax_cd_line);

    if (sub_tax_cd_line=='') {
        $('#total_line').val('');
        $('#total_line').val(0);

        $('#total_qty').val('');
        $('#total_qty').val(0);

        $('#sub_amount').val('');
        $('#sub_amount').val(0);

        $('#discount_amount').val('');
        $('#discount_amount').val(0);

        let amount = 0;

        $('#amount').val('');
        $('#amount').val(amount*1);

        ppn = 0;
        pph = 0;

        total_amount = ((amount*1)+ppn)+pph;


        $('#ppn').val('');
        $('#ppn').val(ppn*1);

        $('#pph').val('');
        $('#pph').val(pph*1);

        $('#total_amount').val('');
        $('#total_amount').val(total_amount*1);
    }
    else {
        getTax(sub_tax_cd_line, function(responseGet) {
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert ('Tax category not null, please try again.');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        let sub_tax_percent_plus = responseList.sub_tax_percent_plus;
                        let sub_tax_percent_minus = responseList.sub_tax_percent_minus;

                        let total_qty = 0;
                        let sub_amount = 0;
                        let ppn = 0;
                        let pph = 0;
                        let total_amount = 0;

                        let discount_amount = 0;

                        let line_use_new = 0;

                        for (var a=1; a<=line_use; a++){

                            var id_inventory_line = $('#id_inventory_line_'+a).val();

                            if (id_inventory_line!='') {
                                let qty_receipt_line = $('#qty_receipt_line_'+a).val();
                                total_qty += qty_receipt_line*1;

                                let discount_amount_line = $('#discount_amount_line_'+a).val();
                                discount_amount += discount_amount_line*1;

                                let unit_price_line = $('#unit_price_line_'+a).val();

                                //let line_sub_amount_line = $('#line_sub_amount_line_'+a).val();
                                sub_amount += unit_price_line*qty_receipt_line;

                                line_use_new += 1;
                            }                   
                        }

                        $('#total_line').val('');
                        $('#total_line').val(line_use_new*1);

                        $('#total_qty').val('');
                        $('#total_qty').val(total_qty*1);

                        $('#sub_amount').val('');
                        $('#sub_amount').val(sub_amount*1);

                        $('#discount_amount').val('');
                        $('#discount_amount').val(discount_amount*1);

                        let amount = (sub_amount*1)-(discount_amount*1);

                        $('#amount').val('');
                        $('#amount').val(amount*1);

                        ppn = ((sub_tax_percent_plus*1)/100)*(amount*1);
                        pph = (((sub_tax_percent_minus*1)/100)*(amount*1))*-1;

                        total_amount = ((amount*1)+ppn)+pph;


                        $('#ppn').val('');
                        $('#ppn').val(ppn*1);

                        $('#pph').val('');
                        $('#pph').val(pph*1);

                        $('#total_amount').val('');
                        $('#total_amount').val(total_amount*1);
                    })
                }
            })
        })
    }    
}

function getTax(sub_tax_cd_get, callback){
    $.ajax({
        url: base_url+'jom/list-sub-tax-by-sub-tax-cd/'+key_session+'/'+sub_tax_cd_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: callback,
    })
}

function discount_header_calculation(){
    let sub_amount = $('#sub_amount').val();
    let discount_amount = $('#discount_amount').val();
    let amount = $('#amount').val();
    let ppn = $('#ppn').val();
    let pph = $('#pph').val();

    let sub_tax_percent_plus = 0;
    if (ppn==0) {
        sub_tax_percent_plus = 0;
    }
    else {
        sub_tax_percent_plus = (ppn/amount)*100;
    }

    let sub_tax_percent_minus = 0;
    if (pph==0) {
        sub_tax_percent_minus = 0;
    }
    else {
        sub_tax_percent_minus = ((pph/amount)*100)*-1;
    }

    let amount_new = sub_amount-discount_amount;
    $('#amount').val('');
    $('#amount').val(amount_new);

    let ppn_new = (sub_tax_percent_plus/100)*amount_new;
    let pph_new = ((sub_tax_percent_minus/100)*amount_new)*-1;

    $('#ppn').val('');
    $('#ppn').val(ppn_new);
    $('#pph').val('');
    $('#pph').val(pph_new);

    let total_amount_new = amount_new + ppn_new + pph_new;
    $('#total_amount').val('');
    $('#total_amount').val(total_amount_new);
}

function remove_line(no_line_get){
    if (confirm('Are you sure you want to reset line number '+no_line_get+' ?')) {
        $('#id_part_list_line_'+no_line_get).val('');
        $('#id_inventory_line_'+no_line_get).val('');
        $('#inventory_cd_line_'+no_line_get).val('');
        $('#inventory_name_line_'+no_line_get).val('');
        $('#JobNo_line_'+no_line_get).val('');
        $('#qty_order_line_'+no_line_get).val(0);
        $('#qty_open_line_'+no_line_get).val(0);
        $('#qty_receipt_line_'+no_line_get).val(0);
        $('#uom_cd_line_'+no_line_get).val('');
        $('#unit_price_line_'+no_line_get).val(0);
        $('#line_sub_amount_line_'+no_line_get).val(0);
        $('#discount_amount_line_'+no_line_get).val(0);
        $('#discount_percent_line_'+no_line_get).val(0);
        $('#line_amount_line_'+no_line_get).val(0);
        $('#item_class_cd_line_'+no_line_get).val('');
        $('#sub_tax_cd_line_'+no_line_get).val('');
        $('#coa_cd_line_'+no_line_get).val('');
        $('#coa_name_line_'+no_line_get).val('');
        $('#warehouse_name_line_'+no_line_get).val('');

        price_header();
    }
}

function readonly_line(){
    for (var a=1; a<=100; a++){
        $('#inventory_cd_line_'+a).prop('onclick', false);
        $('#inventory_name_line_'+a).prop('readonly', 'readonly');
    }
}

// ====================================================== Loading

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