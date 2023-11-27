$(document).ready(function(){
    if (transaction_number_format_db==0) {
        line_blank();
    }
    else {
        detail_header_purchase_invoice(transaction_number_format_db);
    }
})

// ======================================================================= HEADER =============================================================

// Purchase invoice

function list_purchase_invoice(){
    $('#list_purchase_invoice').dataTable().fnDestroy();
    $('#modal_transaction').modal('show');

    $('#list_purchase_invoice').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-purchase-invoice-select-datatable/'+key_session,
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

function select_change_purchase_invoice(no_get){
    $('#no_select_purchase_invoice').val('');
    $('#no_select_purchase_invoice').val(no_get);

    $('.purchase_invoice_number').prop('checked', false);
    $('#purchase_invoice_number_'+no_get).prop('checked', true);
}

function list_purchase_invoice_add(){
    $('#id_purchase_invoice').val('');
    $('#purchase_invoice_number').val('');
    var no_select_purchase_invoice = $('#no_select_purchase_invoice').val();

    var purchase_invoice_number_value = $('#purchase_invoice_number_'+no_select_purchase_invoice).val();
    let purchase_invoice_cd_split = purchase_invoice_number_value.split(" // ");
    let id_purchase_invoice = purchase_invoice_cd_split[0];
    var purchase_invoice_number = purchase_invoice_cd_split[1];
        
    $('#id_purchase_invoice').val(id_purchase_invoice);
    $('#purchase_invoice_number').val(purchase_invoice_number);
    list_purchase_invoice_close();

    detail_header_purchase_invoice(purchase_invoice_number);
}

function list_purchase_invoice_close(){
    $('#modal_transaction').modal('hide');
}

function detail_header_purchase_invoice(transaction_number){

    $.ajax({
        url: base_url+'distribution/list-purchase-invoice-by-purchase-invoice-number/'+key_session,
        type: 'POST',
        data: 'purchase_invoice_number='+transaction_number,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert ('Purcahse invoice with number '+transaction_number+' is not ready, please select other.');
                }
                else {
                    $('#id_purchase_order').val('');
                    $('#purchase_order_number').val('');
                    $('#id_purchase_invoice').val('');
                    $('#purchase_invoice_number_format').val('');
                    $('#purchase_invoice_number').val('');
                    $('#hold').val('');
                    $('#id_transaction_role').val('');
                    $('#close_transaction').val('');
                    $('#transaction_name').html('');
                    $('#purchase_invoice_date').val('');
                    $('#note').val('');
                    $('#total_line').val('');
                    $('#total_qty').val('');
                    $('#id_account').val('');
                    $('#vendor_invoice_number').val('');
                    $('#id_coa_currency').val('');
                    $('#rate').val('');
                    $('#purchase_invoice_owner').val('');
                    $('#cNIK_invoice').val('');

                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');
                    
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_purchase_invoice = responseList.id_purchase_invoice;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var purchase_invoice_number = responseList.purchase_invoice_number;
                        var purchase_invoice_number_format = responseList.purchase_invoice_number_format;
                        var id_purchase_order = responseList.id_purchase_order;
                        var purchase_order_number = responseList.purchase_order_number;
                        var hold = responseList.hold;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var year = responseList.year;
                        var periode = responseList.periode;
                        var purchase_invoice_date = responseList.purchase_invoice_date;
                        var vendor_invoice_number = responseList.vendor_invoice_number;
                        var vendor_tax_number = responseList.vendor_tax_number;
                        var cNIK_invoice = responseList.cNIK_invoice;
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
                        var purchase_invoice_owner = responseList.purchase_invoice_owner;
                        var cNmPegawai_invoice = responseList.cNmPegawai_invoice;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        //id_purchase_receipt_line_array = [];

                        var id_purchase_receipt_line_array_get = responseList.id_purchase_receipt_line_array;
                        id_purchase_receipt_line_array_get.map(function(responseListIdPurchaseReceiptLine){
                            let id_purchase_receipt_line_get = responseListIdPurchaseReceiptLine.id_purchase_receipt_line;
                            if ((id_purchase_receipt_line_get*1)!=0) {
                                //id_purchase_receipt_line_array.push(id_purchase_receipt_line_get*1);
                            }
                        })

                        //console.log(id_purchase_receipt_line_array);

                        $('#id_purchase_order').val(id_purchase_order);
                        $('#purchase_order_number').val(purchase_order_number);
                        $('#id_purchase_invoice').val(id_purchase_invoice);
                        $('#purchase_invoice_number_format').val(purchase_invoice_number_format);
                        $('#purchase_invoice_number').val(purchase_invoice_number);
                        
                        if (hold==1) {
                            $('#hold').prop('checked', true);
                            $('#btn_remove').prop('onclick', false);
                            $('#btn_release').prop('onclick', false);
                        }
                        else {
                            $('#hold').prop('checked', false);
                            if (sequence==2) { // Open
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_release').prop('onclick', true);
                            }
                            else if (sequence==3) { // Posting
                                $('#btn_save').prop('onclick', false);
                                $('#btn_remove').prop('onclick', false);
                                $('#btn_release').prop('onclick', false);
                            }
                        }

                        $('#id_transaction_role').val(id_transaction_role);
                        $('#close_transaction').val(close_transaction);
                        $('#transaction_name').append(transaction_name);
                        $('#purchase_invoice_date').val(purchase_invoice_date);
                        $('#note').val(note);
                        $('#total_line').val(total_line);
                        $('#total_qty').val(total_qty);
                        $('#id_account').val(id_account);
                        $('#account_name').val(account_name);
                        $('#vendor_invoice_number').val(vendor_invoice_number);
                        $('#vendor_tax_number').val(vendor_tax_number);
                        $('#id_coa_currency').val(coa_currency_cd);
                        $('#rate').val(rate);
                        $('#purchase_invoice_owner').val(cNmPegawai_invoice);
                        $('#cNIK_invoice').val(cNmPegawai);

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
                            document.getElementById('cNIK_invoice').setAttribute('onclick', 'set_session();');
                        }

                        document.getElementById('id_account').removeAttribute('onclick');

                        purchase_invoice_line_blank_invoice(purchase_invoice_number_format);

                    })
                }
            })
        }
    })
}

function purchase_invoice_line_blank_invoice(transaction_number){
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
            'url' : base_url+'distribution/purchase-invoice-line-blank-invoice/'+key_session+'/'+transaction_number,
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

// Hold

function hold_check(){
    var hold = $('#hold').prop('checked');
    var transaction_number = $('#purchase_invoice_number').val();
    var id_transaction_role = $('#id_transaction_role').val();
    if (transaction_number == '') {
        alert ('Please choose Purchase invoice to release the hold.');
        $('#hold').prop('checked', 'checked');
    }
    else {
        if (hold == false) {
            if (confirm('Are you sure you want to release the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-purchase-invoice-hold/'+key_session+'/0',
                    type: 'POST',
                    data: 'purchase_invoice_number='+transaction_number+'&id_module='+id_module+'&id_transaction_role='+id_transaction_role,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header_purchase_invoice(transaction_number);
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
                    url: base_url+'distribution/update-purchase-invoice-hold/'+key_session+'/1',
                    type: 'POST',
                    data: 'purchase_invoice_number='+transaction_number+'&id_module='+id_module+'&id_transaction_role='+id_transaction_role,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header_purchase_invoice(transaction_number);
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
    $('.id_account').prop('checked', false);
    $('#id_account_material_'+no_get).prop('checked', true);
    $('#no_select_account').val('');
    $('#no_select_account').val(no_get);
}

function list_account_add(){
    $('#id_account').val('');
    $('#account_name').val('');
    $('#id_coa_currency').val('');
    $('#vendor_invoice_number').val('');
    //$('#purchase_invoice_date').val('');
    var no_select_account = $('#no_select_account').val();

    var id_account_value = $('#id_account_'+no_select_account).val();
    var account_name = $('#account_name_'+no_select_account).val();
    var coa_currency_cd = $('#coa_currency_cd_'+no_select_account).val();
        
    $('#id_coa_currency').val(coa_currency_cd);
    $('#id_account').val(id_account_value);
    $('#account_name').val(account_name);

    line_blank();
    list_account_close();
}

function list_account_close(){
    $('#modal_account').modal('hide');
}

// ================================================ BUTTON HEADER ==================================================

// Save

function save_transaction(){
    var id_purchase_invoice = $('#id_purchase_invoice').val();
    var purchase_invoice_number = $('#purchase_invoice_number').val();
    var purchase_invoice_number_format = $('#purchase_invoice_number_format').val();
    var hold = $('#hold').prop('checked');
    var id_transaction_role = $('#id_transaction_role').val();
    var purchase_invoice_date = $('#purchase_invoice_date').val();
    var note = $('#note').val();
    var id_account = $('#id_account').val();
    var account_name = $('#account_name').val();
    var vendor_invoice_number = $('#vendor_invoice_number').val();
    var id_coa_currency = $('#id_coa_currency').val();
    var rate = $('#rate').val();
    var total_line = $('#total_line').val();
    var total_qty = $('#total_qty').val();
    var sub_amount = $('#sub_amount').val();
    var discount_amount = $('#discount_amount').val();
    var amount = $('#amount').val();
    var ppn = $('#ppn').val();
    var pph = $('#pph').val();
    var total_amount = $('#total_amount').val();

    console.log(close_transaction*1);

    if (total_line*1==0) {
        alert ('No line selected.');
    }
    else {
        if (hold==false) {
            alert ('Cannot process this action because status is not hold');
        }
        
        else {
            const coa_cd_line_array = [];
            const id_purchase_invoice_line_array = [];
            for (var i = 1; i <= total_line*1; i++) {
                var id_purchase_invoice_line = $('#id_purchase_invoice_line_'+i).val();
                var coa_cd_line = $('#coa_cd_line_'+i).val();
                coa_cd_line_array.push(coa_cd_line);
                id_purchase_invoice_line_array.push(id_purchase_invoice_line);
            }

            if (purchase_invoice_number == '') {
                modal_loading_open('bg-info', 'Saving data', 'Please wait...');
            }
            else {
                modal_loading_open('bg-info', 'Updating data', 'Please wait...');
            }

            $.ajax({
                url: base_url+'distribution/add-purchase-invoice/'+key_session,
                type: 'POST',
                data: 'id_module='+id_module+'&id_purchase_invoice='+id_purchase_invoice+'&purchase_invoice_number='+purchase_invoice_number+'&hold='+hold+'&id_transaction_role='+id_transaction_role+'&purchase_invoice_date='+purchase_invoice_date+'&note='+note+'&id_account='+id_account+'&vendor_invoice_number='+vendor_invoice_number+'&id_coa_currency='+id_coa_currency+'&rate='+rate+'&total_line='+total_line+'&total_qty='+total_qty+'&sub_amount='+sub_amount+'&discount_amount='+discount_amount+'&amount='+amount+'&ppn='+ppn+'&pph='+pph+'&total_amount='+total_amount+'&id_purchase_receipt_line_array='+JSON.stringify(id_purchase_receipt_line_array)+'&id_purchase_invoice_line_array='+JSON.stringify(id_purchase_invoice_line_array)+'&coa_cd_line_array='+JSON.stringify(coa_cd_line_array),
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    modal_loading_hide();
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status[0]==1) {
                            if (purchase_invoice_number == '') {
                                modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                            }
                            else {
                                modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                            }
                            setTimeout(function () {
                                modal_loading_hide();
                                var purchase_invoice_number_db = responseGetList.purchase_invoice_number;
                                $('#purchase_invoice_number').val(purchase_invoice_number_db);
                            }, 5000)
                        }
                        else {
                            var response = responseGetList.response;
                            if (purchase_invoice_number == '') {
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

// Print

function print_purchase_invoice(){
    var purchase_invoice_number = $('#purchase_invoice_number').val();
    var id_transaction_role = $('#id_transaction_role').val();

    if (purchase_invoice_number=='') {
        alert ('Select purchase invoice number to process this action.');
    }
    else {
        if (id_transaction_role<=1) {
            alert ('Cannot process this action because status this transaction is hold.');
        }
        else {
            var purchase_invoice_number_format = $('#purchase_invoice_number_format').val();
            window.open(base_url+'report/pdf/purchase-invoice/'+key_session+'/'+purchase_invoice_number_format);
        }
    }
}

// Detail

function list_purchase_invoice_detail(){
    window.open(base_url+'distribution/list-purchase/purchase-invoice');
}

// Release Posting

function release(){
    var purchase_invoice_number = $('#purchase_invoice_number').val();
    var close_transaction = $('#close_transaction').val();
    var hold = $('#hold').prop('checked');
    if (purchase_invoice_number == '') {
        alert ('Please select purchase number is want you release.');
    }
    else {
        if (hold == true) {
            alert ('Cannot process this action because status is not open.');
        }
        else if (close_transaction*1 == 1) {
            alert ('Cannot process this action because status is posted.');
        }
        else {
            $.ajax({
                url: base_url+'distribution/release-purchase-invoice/'+key_session,
                type: 'POST',
                data: 'purchase_invoice_number='+purchase_invoice_number,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            detail_header_purchase_invoice(purchase_invoice_number);
                        }
                        else {
                            var response = responseGetList.response;
                            alert('Data not updated. '+response);
                        }
                    })
                }
            })
            //console.log('OK');
        }
    }
}

// ================================================ LINE ==========================================================================================

function list_purchase_receipt_line(){
    var purchase_invoice_date = $('#purchase_invoice_date').val();
    var id_account = $('#id_account').val();
    var vendor_invoice_number = $('#vendor_invoice_number').val();

    if (purchase_invoice_date=='') {
        alert ('Please choose date to process this action.')
    }
    else {
        if (id_account=='') {
            alert ('Please select vendor to process this action.');
        }
        else {
            if (vendor_invoice_number=='') {
                alert ('Please insert vendor invoice number to process this action.');
            }
            else {
                $('#list_purchase_receipt_line').dataTable().fnDestroy();
                $('#modal_purchase_receipt_line').modal('show');

                $('#list_purchase_receipt_line').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order": [],
                    "ajax" : {
                        'url' : base_url+'distribution/list-purchase-receipt-line-by-vendor-datatable/'+key_session+'/'+id_account,
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
        }        
    }
}

function select_change_purchase_receipt(no_get){
    Array.prototype.remove = function() {
        var what, a = arguments, L = a.length, ax;
        while (L && this.length) {
            what = a[--L];
            while ((ax = this.indexOf(what)) !== -1) {
                this.splice(ax, 1);
            }
        }
        return this;
    };

    const id_purchase_receipt_line = $('#id_purchase_receipt_line_'+no_get).prop('checked');
    //console.log(id_purchase_receipt_line);
    let id_purchase_receipt_line_value = $('#id_purchase_receipt_line_'+no_get).val();
    if (id_purchase_receipt_line==true) {
        id_purchase_receipt_line_array.push(id_purchase_receipt_line_value);
    }
    else {
        id_purchase_receipt_line_array.remove(id_purchase_receipt_line_value);
    }
    console.log(id_purchase_receipt_line_array);
}

function list_purchase_receipt_line_add(){
    $('#line_description').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'distribution/list-purchase-receipt-by-purchase-receipt-line-id/'+key_session,
        type: 'POST',
        data: 'id_purchase_receipt_line_array='+JSON.stringify(id_purchase_receipt_line_array),
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            //list_account_close();
            //$('#line_description tbody').html('');
            let total_line = 0;
            let total_qty = 0;
            let total_sub_amount = 0;
            let total_discount_amount = 0;
            let total_amount = 0;
            let total_ppn = 0;
            let total_pph = 0;
            //let total_total_amount = 0;
            var trList = '';
            let total_line_get = $('#total_line').val();
            responseGet.map(function(responseGetList){
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var id_purchase_receipt_line = responseList.id_purchase_receipt_line;
                    var id_inventory = responseList.id_inventory;
                    var inventory_cd = responseList.inventory_cd;
                    var description = responseList.description;
                    var purchase_receipt_line_qty = responseList.purchase_receipt_line_qty;
                    var uom_cd = responseList.uom_cd;
                    var cury_unit_price = responseList.cury_unit_price;
                    var cury_sub_amount = responseList.cury_sub_amount;
                    var cury_discount_amount = responseList.cury_discount_amount;
                    var cury_amount = responseList.cury_amount;
                    var sub_tax_cd = responseList.sub_tax_cd;
                    var warehouse_name = responseList.warehouse_name;
                    var id_coa = responseList.id_coa;
                    var coa_cd = responseList.coa_cd;
                    var coa_name = responseList.coa_name;
                    var sub_tax_percent_plus = responseList.sub_tax_percent_plus;
                    var sub_tax_percent_minus = responseList.sub_tax_percent_minus;

                    ppn = ((sub_tax_percent_plus*1)/100)*(cury_amount*1);
                    pph = (((sub_tax_percent_minus*1)/100)*(cury_amount*1))*-1;

                    total_line += 1;
                    total_qty += purchase_receipt_line_qty*1;
                    total_sub_amount += cury_sub_amount*1;
                    total_discount_amount += cury_discount_amount*1;
                    total_amount += cury_amount*1;
                    total_ppn += ppn*1;
                    total_pph += pph*1;

                    let no_line = (total_line_get*1)+i+1;

                    trList += '<tr>';
                        trList += '<td style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><button class="btn btn-danger" onclick="delete_purchase_receipt_line(\''+id_purchase_receipt_line+'\', \''+description+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
                        trList += '<td style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'+inventory_cd+'</td>';
                        trList += '<td style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'+description+'</td>';
                        trList += '<td>'+purchase_receipt_line_qty+'</td>';
                        trList += '<td>'+uom_cd+'</td>';
                        trList += '<td>'+cury_unit_price+'</td>';
                        trList += '<td>'+cury_sub_amount+'</td>';
                        trList += '<td>'+cury_discount_amount+'</td>';
                        trList += '<td>'+cury_amount+'</td>';
                        trList += '<td>'+sub_tax_cd+'</td>';
                        trList += '<td>'+warehouse_name+'</td>';
                        trList += '<td><input type="hidden" id="id_purchase_invoice_line_'+(no_line*1)+'"><input type="text" class="form-control" style="color:black;" id="coa_cd_line_'+(no_line*1)+'" onclick="list_coa(\''+(no_line*1)+'\');" value="'+coa_cd+'" readonly></td>';
                        trList += '<td><div id="coa_name_line_'+(no_line*1)+'">'+coa_name+'</div></td>';
                    trList += '</tr>';
                })
            })
            $('#line_description tbody').append(trList);
            $('#line_description').dataTable({
                "scrollY":        "500px",
                "scrollX":        true,
                "scrollCollapse": true,
                
                "bPaginate" : false,
                "order": [],
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

            $('#total_qty').val('');
            $('#total_qty').val(total_qty*1);

            $('#total_line').val('');
            $('#total_line').val(total_line*1);

            $('#sub_amount').val('');
            $('#sub_amount').val(total_sub_amount*1);

            $('#discount_amount').val('');
            $('#discount_amount').val(total_discount_amount*1);

            $('#amount').val('');
            $('#amount').val(total_amount*1);

            $('#ppn').val('');
            $('#ppn').val(total_ppn*1);

            $('#pph').val('');
            $('#pph').val(total_pph*1);

            let total_total_amount = (total_amount+total_ppn+total_pph);

            $('#total_amount').val('');
            $('#total_amount').val(total_total_amount*1);

            list_purchase_receipt_line_close();
        }
    })
}

function list_purchase_receipt_line_close(){
    $('#modal_purchase_receipt_line').modal('hide');
}

function delete_purchase_receipt_line(id_purchase_receipt_line_get, description_get){
    if (confirm('Are you sure you want to delete '+description_get+' ?')) {
        //console.log('Thing was saved to the database.');
        Array.prototype.remove = function() {
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        const id_purchase_receipt_line = id_purchase_receipt_line_get;
        id_purchase_receipt_line_array.remove(id_purchase_receipt_line);
        list_purchase_receipt_line_add();
    }
}

// ========================================= LINE BLANK ===========================================

function line_blank(){
    $('#line_description').dataTable().fnDestroy();
    $('#line_description').dataTable({
        "scrollY":        "500px",
        "scrollX":        true,
        "scrollCollapse": true,
        
        "bPaginate" : false,
        "order": [],
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false,
                "searchable" : false
            },
        ],
    });
}

// coa

function list_coa(no_line_get){
    $('#list_coa').dataTable().fnDestroy();
    $('#modal_coa').modal('show');

    $('#no_line_coa').val('');
    $('#no_line_coa').val(no_line_get);

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

    var  coa_cd = coa_cd_split[0];
    var coa_name = coa_cd_split[1];
        
    $('#coa_cd_line_'+no_line_coa).val('');
    $('#coa_cd_line_'+no_line_coa).val(coa_cd);

    $('#coa_name_line_'+no_line_coa).html('');
    $('#coa_name_line_'+no_line_coa).append(coa_name);

    list_coa_close();
}

function list_coa_close(){
    $('#modal_coa').modal('hide');
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