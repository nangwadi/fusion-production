$(document).ready(function(){
    sales_invoice_line_blank(0);
    list_payment_methode(0, 0);
    list_payment_terms(0, 0);

    if ((transaction_number_db*1) == 1) {
        //console.log(transaction_number_format_db);
        detail_header_delivery_order(transaction_number_format_db);
    }
    else if ((transaction_number_db*1) != 0) {
        detail_header(transaction_number_format_db);
    }
})

// ======================================================================= header =============================================================

// Delivery Order Number

    function list_sales_invoice(){
        $('#list_sales_invoice').dataTable().fnDestroy();
        $('#modal_sales_invoice').modal('show');

        $('#list_sales_invoice').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "ajax" : {
                'url' : base_url+'distribution/list-sales-invoice-select-datatable/'+key_session+'/0',
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

    function select_change_sales_invoice(no_get){
        $('#no_select_sales_invoice').val('');
        $('#no_select_sales_invoice').val(no_get);

        $('.sales_invoice_number').prop('checked', false);
        $('#sales_invoice_number_'+no_get).prop('checked', true);
    }

    function list_sales_invoice_add(){
        $('#id_sales_invoice').val('');
        $('#sales_invoice_number').val('');
        var no_select_sales_invoice = $('#no_select_sales_invoice').val();

        var id_sales_invoice = $('#id_sales_invoice_'+no_select_sales_invoice).val();
        var sales_invoice_number = $('#sales_invoice_number_'+no_select_sales_invoice).val();
        var sales_invoice_number_format = $('#sales_invoice_number_format_'+no_select_sales_invoice).val();
            
        $('#id_sales_invoice').val(id_sales_invoice);
        $('#sales_invoice_number').val(sales_invoice_number);
        list_sales_invoice_close();

        detail_header(sales_invoice_number);
    }

    function list_sales_invoice_close(){
        $('#modal_sales_invoice').modal('hide');
    }

// Hold

function hold_check(){
    var hold = $('#hold').prop('checked');
    var transaction_number = $('#sales_invoice_number').val();
    if (transaction_number == '') {
        alert ('Please choose delivery Order to release the hold.');
        $('#hold').prop('checked', 'checked');
    }
    else {
        if (hold == false) {
            if (confirm('Are you sure you want to release the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-sales-invoice-hold/'+key_session+'/0',
                    type: 'POST',
                    data: 'sales_invoice_number='+transaction_number+'&id_module='+id_module,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header(transaction_number);
                            }
                            else {
                                alert('Data not updated');
                            }
                        })
                    }
                })
            }
        }
        else {
            if (confirm('Are you sure you want to unrelease the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-sales-invoice-hold/'+key_session+'/1',
                    type: 'POST',
                    data: 'sales_invoice_number='+transaction_number+'&id_module='+id_module,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header(transaction_number);
                            }
                            else {
                                alert('Data not updated');
                            }
                        })
                    }
                })
            }
        }
    }
}

function list_payment_methode(id_payment_methode_get, payment_methode_name_get){
    $.ajax({
        url: base_url+'distribution/list-payment-methode/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#id_payment_methode').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                
                if (id_payment_methode_get != '0') {
                    trList += '<option value="'+id_payment_methode_get+'">'+payment_methode_name_get+'</option>';
                }

                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_payment_methode = responseList.id_payment_methode;
                        var payment_methode_cd = responseList.payment_methode_cd;
                        var payment_methode_name = responseList.payment_methode_name;
                        var category = responseList.category;
                        var category_format = responseList.category_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            if (category=='receivable') {
                                trList += '<option value="'+id_payment_methode+'">'+payment_methode_name+'</option>';
                            }
                        }
                    })
                }
                $('#id_payment_methode').append(trList);
            })
        }
    });
}

function list_payment_terms(id_payment_terms_get, payment_terms_name_get){
    $.ajax({
        url: base_url+'distribution/list-payment-terms/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#id_payment_terms').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                
                if (id_payment_terms_get != '0') {
                    trList += '<option value="'+id_payment_terms_get+'">'+payment_terms_name_get+'</option>';
                }

                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_payment_terms = responseList.id_payment_terms;
                        var payment_terms_cd = responseList.payment_terms_cd;
                        var payment_terms_name = responseList.payment_terms_name;
                        var category = responseList.category;
                        var category_format = responseList.category_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_payment_terms+'">'+payment_terms_name+'</option>';
                        }
                    })
                }
                $('#id_payment_terms').append(trList);
            })
        }
    });
}

// ============================================================== Detail after select sales Order Number

function detail_header(transaction_number_get){
    $.ajax({
        url: base_url+'distribution/list-sales-invoice-by-sales-invoice-number/'+key_session,
        type: 'POST',
        data: 'sales_invoice_number='+transaction_number_get,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert (transaction_number_get+' not ready, please select other.');
                }
                else {
                    $('#id_sales_invoice').val('');
                    $('#sales_invoice_number_format').val('');
                    $('#sales_invoice_number').val('');
                    $('#id_transaction_role').val('');
                    $('#transaction_name').html('');
                    $('#sales_invoice_date').val('');
                    $('#tax_number').val('');
                    $('#customer_order_number').val('');
                    $('#quotation_number').val('');
                    $('#note').val('');
                    $('#total_line').val('');
                    $('#total_qty').val('');
                    $('#id_account').val('');
                    $('#account_name').val('');
                    $('#id_account_project').val('');
                    $('#account_name_project').val('');
                    $('#id_coa_currency').val('');
                    $('#rate').val('');
                    $('#customer_order_number').val('');
                    $('#sales_invoice_owner').val('');
                    $('#cNIK_approval').val('');
                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_sales_invoice = responseList.id_sales_invoice;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var sales_invoice_number = responseList.sales_invoice_number;
                        var sales_invoice_number_format = responseList.sales_invoice_number_format;
                        var hold = responseList.hold;
                        var id_transaction_role = responseList.id_transaction_role;
                        var transaction_name = responseList.transaction_name;
                        var sales_invoice_date = responseList.sales_invoice_date;
                        var year = responseList.year;
                        var periode = responseList.periode;
                        var quotation_number = responseList.quotation_number;
                        var note = responseList.note;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var id_account_project = responseList.id_account_project;
                        var account_cd_project = responseList.account_cd_project;
                        var account_name_project = responseList.account_name_project;
                        var id_coa_currency = responseList.id_coa_currency;
                        var coa_currency_cd = responseList.coa_currency_cd;
                        var coa_currency_name = responseList.coa_currency_name;
                        var decimal_after = responseList.decimal_after;
                        var rate = responseList.rate;
                        var customer_order_number = responseList.customer_order_number;
                        var sales_invoice_owner = responseList.sales_invoice_owner;
                        var cNmPegawai_sales_invoice_owner = responseList.cNmPegawai_sales_invoice_owner;
                        var cNIK_approval = responseList.cNIK_approval;
                        var cNmPegawai_approval = responseList.cNmPegawai_approval;
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
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;
                        var id_payment_methode = responseList.id_payment_methode;
                        var payment_methode_cd = responseList.payment_methode_cd;
                        var payment_methode_name = responseList.payment_methode_name;
                        var id_payment_terms = responseList.id_payment_terms;
                        var payment_terms_cd = responseList.payment_terms_cd;
                        var payment_terms_name = responseList.payment_terms_name;
                        var tax_number = responseList.tax_number;
                        var close_transaction = responseList.close_transaction;

                        $('#id_sales_invoice').val(id_sales_invoice);
                        $('#sales_invoice_number').val(sales_invoice_number);
                        $('#sales_invoice_number_format').val(sales_invoice_number_format);
                        $('#id_transaction_role').val(id_transaction_role);
                        $('#customer_order_number').val(customer_order_number);
                        $('#transaction_name').append(transaction_name);
                        $('#sales_invoice_date').val(sales_invoice_date);
                        $('#quotation_number').val(quotation_number);
                        $('#note').val(note);
                        $('#total_line').val(total_line+1);
                        $('#total_qty').val(total_qty);
                        $('#id_account').val(id_account);
                        $('#account_name').val(account_name);
                        $('#id_account_project').val(id_account_project);
                        $('#account_name_project').val(account_name_project);
                        $('#id_coa_currency').val(coa_currency_cd);
                        $('#rate').val(rate);
                        $('#customer_order_number').val(customer_order_number);
                        $('#sales_invoice_owner').val(cNmPegawai_sales_invoice_owner);
                        $('#cNIK_approval').val(cNmPegawai_approval);
                        $('#sub_amount').val(sub_amount);
                        $('#discount_amount').val(discount_amount);
                        $('#amount').val(amount);
                        $('#ppn').val(ppn);
                        $('#pph').val(pph);
                        $('#total_amount').val(total_amount);
                        $('#tax_number').val(tax_number);
                        $('#close_transaction').val(close_transaction);

                        list_payment_methode(id_payment_methode, payment_methode_name);
                        list_payment_terms(id_payment_terms, payment_terms_name);

                        if (hold==1) {
                            $('#hold').prop('checked', true);
                        }
                        else {
                            $('#hold').prop('checked', false);   
                        }

                        sales_invoice_line_blank(sales_invoice_number_format);

                    })
                }
            })
        }
    })
}

function sales_invoice_line_blank(transaction_number){
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
            'url' : base_url+'distribution/sales-invoice-line-blank/'+key_session+'/'+transaction_number,
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

// Header

    // Customer

    function list_account(control_get){
        var id_account = $('#id_account').val();
        if (control_get==0) {
            $('#list_account').dataTable().fnDestroy();
            $('#modal_account').modal('show');

            $('#account_control').val('');
            $('#account_control').val(control_get);

            $('#list_account').DataTable({
                "processing" : true,
                "serverSide" : true,
                "order": [],
                "ajax" : {
                    'url' : base_url+'jom/list-account-material-datatable/'+key_session+'/customer/0',
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
        else {
            if (id_account=='') {
                alert ('Please select customer to process this action.');
            }
            else {
                $('#list_account').dataTable().fnDestroy();
                $('#modal_account').modal('show');

                $('#account_control').val('');
                $('#account_control').val(control_get);

                $('#list_account').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order": [],
                    "ajax" : {
                        'url' : base_url+'jom/list-account-material-datatable/'+key_session+'/customer/0',
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

    function select_change_account(no_get){
        $('.id_account').prop('checked', false);
        $('#id_account_material_'+no_get).prop('checked', true);
        $('#no_select_account').val('');
        $('#no_select_account').val(no_get);
    }

    function list_account_add(){
        
        var no_select_account = $('#no_select_account').val();

        var id_account_value = $('#id_account_'+no_select_account).val();
        var account_name_value = $('#account_name_'+no_select_account).val();
        var coa_currency_cd = $('#coa_currency_cd_'+no_select_account).val();
        
        $('#id_account').val('');
        $('#account_name').val('');

        $('#id_account').val(id_account_value);
        $('#account_name').val(account_name_value);        

        $('#id_coa_currency').val('');
        $('#id_coa_currency').val(coa_currency_cd);

        list_account_close();
    }

    function list_account_close(){
        $('#modal_account').modal('hide');
    }

    // Approve By

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

    // List Delivery Order Line

    function list_delivery_order_line(no_get){
        var id_account = $('#id_account').val();
        var customer_order_number = $('#customer_order_number').val();
        var cNIK_approval = $('#cNIK_approval').val();
        var tax_number = $('#tax_number').val();
        $('#no_sales_invoice_line').val('');
        $('#no_sales_invoice_line').val(no_get);
        if (id_account == '') {
            alert ('Customer cannot empty.')
        }
        else {
            if (customer_order_number == '') {
                alert ('Customer order number cannot empty.');
            }
            else {
                if (cNIK_approval == '') {
                    alert ('Sign cannot empty.');
                }
                else {
                    if (tax_number=='') {
                        alert('Tax Number cannot empty.');
                    }
                    else {
                        $('#list_delivery_order_line').dataTable().fnDestroy();
                        $('#modal_delivery_order_line').modal('show');

                        $('#list_delivery_order_line').DataTable({
                            "processing" : true,
                            "serverSide" : true,
                            "order": [],
                            "ajax" : {
                                'url' : base_url+'distribution/list-delivery-order-line-for-sales-invoice-datatable/'+key_session+'/'+id_account,
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
    }

    function select_change_delivery_order_line(no_get){
        $('.delivery_order_number').prop('checked', false);
        $('#delivery_order_number_'+no_get).prop('checked', true);
        $('#no_delivery_order_line').val('');
        $('#no_delivery_order_line').val(no_get);
    }

    function list_delivery_order_line_add(){
        var no = $('#no_delivery_order_line').val();
        var id_delivery_order_line_get = $('#id_delivery_order_linex_'+no).val();

        ///console.log(no+' '+id_delivery_order_line_get);

        if (id_delivery_order_line_array.includes(id_delivery_order_line_get*1) == true) {
            alert ('This sales order line was used, please select other.');
        }
        else {
            var no_sales_invoice_line = $('#no_sales_invoice_line').val();
            
            var checkbox_chek = $('#delivery_order_number_'+no).prop('checked');
            if (checkbox_chek==true) {
                $.ajax({
                    url: base_url+'distribution/list-delivery-order-line/'+key_session+'/'+id_delivery_order_line_get,
                    type: 'get',
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==0) {
                                alert ('Data not found.');
                            }
                            else {
                                list_delivery_order_line_close();
                                var response = responseGetList.response;
                                response.map(function(responseList){
                                    var id_delivery_order_line = responseList.id_delivery_order_line;
                                    var company_id = responseList.company_id;
                                    var company_name = responseList.company_name;
                                    var delivery_order_number = responseList.delivery_order_number;
                                    var id_sales_order_line = responseList.id_sales_order_line;
                                    var line_number = responseList.line_number;
                                    var id_job_order = responseList.id_job_order;
                                    var description = responseList.description;
                                    var id_kit_assy = responseList.id_kit_assy;
                                    var qty_order_line = responseList.qty_order_line;
                                    var qty_shipment_line = responseList.qty_shipment_line;
                                    var id_uom = responseList.id_uom;
                                    var uom_cd = responseList.uom_cd;
                                    var uom_name = responseList.uom_name;
                                    var cury_unit_price = responseList.cury_unit_price;
                                    var unit_price = responseList.unit_price;
                                    var cury_sub_amount = responseList.cury_sub_amount;
                                    var sub_amount = responseList.sub_amount;
                                    var cury_discount_amount = responseList.cury_discount_amount;
                                    var discount_amount = responseList.discount_amount;
                                    var discount_percent = responseList.discount_percent;
                                    var cury_amount = responseList.cury_amount;
                                    var amount = responseList.amount;
                                    var id_sub_tax = responseList.id_sub_tax;
                                    var sub_tax_cd = responseList.sub_tax_cd;
                                    var sub_tax_name = responseList.sub_tax_name;
                                    var id_coa = responseList.id_coa;
                                    var coa_cd = responseList.coa_cd;
                                    var coa_name = responseList.coa_name;
                                    var line_status = responseList.line_status;
                                    var create_by = responseList.create_by;
                                    var cNmPegawai_create = responseList.cNmPegawai_create;
                                    var create_date = responseList.create_date;
                                    var last_by = responseList.last_by;
                                    var cNmPegawai_last = responseList.cNmPegawai_last;
                                    var last_update = responseList.last_update;
                                    var sales_order_number = responseList.sales_order_number;
                                    var line_status_sales_order_line = responseList.line_status_sales_order_line;
                                    var total_qty = responseList.total_qty;
                                    var JobNo = responseList.JobNo;
                                    var JobName = responseList.JobName;
                                    var kit_assy_number = responseList.kit_assy_number;
                                    var id_account = responseList.id_account;
                                    var id_account_project = responseList.id_account_project;
                                    var decimal_after = responseList.decimal_after;
                                    var coa_currency_name = responseList.coa_currency_name;
                                    var coa_currency_cd = responseList.coa_currency_cd;
                                    var sequence = responseList.sequence;
                                    var transaction_name = responseList.transaction_name;

                                    id_delivery_order_line_array.push(id_delivery_order_line);

                                    $('#id_delivery_order_line_'+no_sales_invoice_line).val('');
                                    $('#id_delivery_order_line_'+no_sales_invoice_line).val(id_delivery_order_line);

                                    $('#delivery_order_number_'+no_sales_invoice_line).val('');
                                    $('#delivery_order_number_'+no_sales_invoice_line).val(delivery_order_number);

                                    $('#id_job_order_'+no_sales_invoice_line).val('');
                                    $('#id_job_order_'+no_sales_invoice_line).val(id_job_order);

                                    $('#JobNo_'+no_sales_invoice_line).val('');
                                    $('#JobNo_'+no_sales_invoice_line).val(JobNo);

                                    $('#description_'+no_sales_invoice_line).val('');
                                    $('#description_'+no_sales_invoice_line).val(description);

                                    $('#qty_invoice_line_'+no_sales_invoice_line).val('');
                                    $('#qty_invoice_line_'+no_sales_invoice_line).val(0);

                                    $('#qty_shipment_line_'+no_sales_invoice_line).val('');
                                    $('#qty_shipment_line_'+no_sales_invoice_line).val(qty_shipment_line*1);

                                    $('#qty_open_line_'+no_sales_invoice_line).val('');
                                    $('#qty_open_line_'+no_sales_invoice_line).val(qty_order_line);

                                    $('#uom_cd_line_'+no_sales_invoice_line).val('');
                                    $('#uom_cd_line_'+no_sales_invoice_line).val(uom_cd);

                                    $('#unit_price_line_'+no_sales_invoice_line).val('');
                                    $('#unit_price_line_'+no_sales_invoice_line).val(unit_price*1);

                                    $('#sub_amount_line_'+no_sales_invoice_line).val('');
                                    $('#sub_amount_line_'+no_sales_invoice_line).val(0);

                                    $('#discount_amount_line_'+no_sales_invoice_line).val('');
                                    $('#discount_amount_line_'+no_sales_invoice_line).val(discount_amount*1);

                                    $('#discount_percent_line_'+no_sales_invoice_line).val('');
                                    $('#discount_percent_line_'+no_sales_invoice_line).val(discount_percent*1);

                                    $('#amount_line_'+no_sales_invoice_line).val('');
                                    $('#amount_line_'+no_sales_invoice_line).val(0);

                                    $('#sub_tax_cd_line_'+no_sales_invoice_line).val('');
                                    $('#sub_tax_cd_line_'+no_sales_invoice_line).val(sub_tax_cd);

                                    $('#coa_cd_line_'+no_sales_invoice_line).val('');
                                    $('#coa_cd_line_'+no_sales_invoice_line).val(coa_cd);

                                    $('#coa_name_line_'+no_sales_invoice_line).val('');
                                    $('#coa_name_line_'+no_sales_invoice_line).val(coa_name);

                                })
                            }
                        })
                    }
                })
            }
            else {
                alert ('Please select Sales Order Line First.')
            }
        }
    }

    function list_delivery_order_line_close(){
        $('#modal_delivery_order_line').modal('hide');
    }

// Line

function price_calculation(no_get){
    var qty_shipment_line = $('#qty_shipment_line_'+no_get).val();
    var qty_invoice_line = $('#qty_invoice_line_'+no_get).val();

    if (qty_invoice_line*1 > qty_shipment_line*1) {
        alert ('Qty invoice cannot more than qty shipment.');
        $('#qty_invoice_line_'+no_get).val('0')
    }
    else {
        var unit_price_line = $('#unit_price_line_'+no_get).val();
        var discount_amount_line = $('#discount_amount_line_'+no_get).val();
        var discount_percent_line = $('#discount_percent_line_'+no_get).val();

        let sub_amount = (qty_invoice_line*1)*(unit_price_line*1);
        let amount = sub_amount - ((discount_amount_line*1)+(((discount_percent_line*1)/100)*sub_amount));

        $('#sub_amount_line_'+no_get).val('');
        $('#sub_amount_line_'+no_get).val(sub_amount);

        $('#amount_line_'+no_get).val('');
        $('#amount_line_'+no_get).val(amount);

        let qty_open = 0;

        if (qty_shipment_line*1 == 0) {
            qty_open = 0;
        }
        else {
            qty_open = (qty_shipment_line*1)-(qty_invoice_line*1);
        }

        $('#qty_open_line_'+no_get).val('');
        $('#qty_open_line_'+no_get).val(qty_open);

        price_calculation_header();
    }
}

function price_calculation_header(){
    var total_line = $('#total_line').val();
    var sub_tax_cd_line = $('#sub_tax_cd_line_1').val();

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

                    for (var a=1; a<=total_line; a++){
                        let qty_shipment_line = $('#qty_shipment_line_'+a).val();
                        total_qty += qty_shipment_line*1;

                        let discount_amount_line = $('#discount_amount_line_'+a).val();
                        discount_amount += discount_amount_line*1;

                        let sub_amount_line = $('#sub_amount_line_'+a).val();
                        sub_amount += sub_amount_line*1;
                    }

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

function getTax(sub_tax_cd_get, callback){
    $.ajax({
        url: base_url+'jom/list-sub-tax-by-sub-tax-cd/'+key_session+'/'+sub_tax_cd_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: callback,
    })
}

function add_line(){
    let line_use = $('#total_line').val();

    let JobNo = $('#JobNo_'+line_use).val();
    let description = $('#description_'+line_use).val();
    let qty_shipment_line = $('#qty_shipment_line_'+line_use).val();
    let uom_cd_line = $('#uom_cd_line_'+line_use).val();
    let unit_price_line = $('#unit_price_line_'+line_use).val();
    let amount_line = $('#amount_line_'+line_use).val();
    let discount_amount_line = $('#discount_amount_line_'+line_use).val();
    let discount_percent_line = $('#discount_percent_line_'+line_use).val();
    let sub_tax_cd_line = $('#sub_tax_cd_line_'+line_use).val();
    let coa_cd_line = $('#coa_cd_line_'+line_use).val();

    if (description == '' || qty_shipment_line == '0' || uom_cd_line == '' || unit_price_line == '0' || amount_line == '0' || sub_tax_cd_line =='') {
        alert ('Line '+line_use+' may be empty or zero value, please try again.')
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

function remove_line(no_line_get){
    if (confirm('Are you sure you want to reset line number '+no_line_get+' ?')) {
        let id_delivery_order_line = $('#id_delivery_order_line_'+no_line_get).val();
        
        $('#id_sales_invoice_line_'+no_line_get).val('');        
        $('#id_delivery_order_line_'+no_line_get).val('');
        $('#delivery_order_number_'+no_line_get).val('');
        $('#id_job_order_'+no_line_get).val('');
        $('#JobNo_'+no_line_get).val('');
        $('#description_'+no_line_get).val('');
        $('#qty_order_line_'+no_line_get).val('');
        $('#qty_shipment_line_'+no_line_get).val('');
        $('#qty_open_line_'+no_line_get).val('');
        $('#uom_cd_line_'+no_line_get).val('');
        $('#unit_price_line_'+no_line_get).val('');
        $('#sub_amount_line_'+no_line_get).val('');
        $('#discount_amount_line_'+no_line_get).val('');
        $('#discount_percent_line_'+no_line_get).val('');
        $('#amount_line_'+no_line_get).val('');
        $('#sub_tax_cd_line_'+no_line_get).val('');
        $('#kit_assy_line_'+no_line_get).val('');

        let total_line = 0;

        if ((no_line_get*1)>1) {
            let total_line_old = $('#total_line').val();
            total_line = total_line_old-1;

            for (var i = 1; i <= 17; i++) {
                $('#div_line_'+i+'_'+no_line_get).hide();
            }
        }
        else {
            total_line = 1;
        }

        const index = id_delivery_order_line_array.indexOf((id_delivery_order_line*1));

        if (index > -1) { // only splice array when item is found
            id_delivery_order_line_array.splice(index, 1); // 2nd parameter means remove one item only
        }
        
        $('#total_line').val('');
        $('#total_line').val(total_line);
    }
}

    // UOM

    function list_uom(no_line_get){
        $('#list_uom').dataTable().fnDestroy();
        $('#modal_uom').modal('show');

        $('#no_line_uom').val('');
        $('#no_line_uom').val(no_line_get);

        $('#list_uom').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "ajax" : {
                'url' : base_url+'inventory/list-uom-datatable/'+key_session+'/0',
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

    function select_change_uom(no_get){
        $('.uom_cd').prop('checked', false);
        $('#uom_cd_'+no_get).prop('checked', true);

        $('#no_select_uom').val('');
        $('#no_select_uom').val(no_get);
    }

    function list_uom_add(){

        var no_select_uom = $('#no_select_uom').val();
        var no_line_uom = $('#no_line_uom').val();

        var uom_cd_value = $('#uom_cd_'+no_select_uom).val();
        let uom_cd_split = uom_cd_value.split(" // ");
        var uom_cd = uom_cd_split[0];
            
        $('#uom_cd_line_'+no_line_uom).val('');
        $('#uom_cd_line_'+no_line_uom).val(uom_cd);

        list_uom_close();
    }

    function list_uom_close(){
        $('#modal_uom').modal('hide');
    }

    // Tax

    function list_sub_tax(no_line_get){
        $('#list_sub_tax').dataTable().fnDestroy();
        $('#modal_sub_tax').modal('show');

        $('#no_line_sub_tax').val('');
        $('#no_line_sub_tax').val(no_line_get);

        $('#list_sub_tax').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "ajax" : {
                'url' : base_url+'inventory/list-sub-tax-datatable/'+key_session+'/0',
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

    function select_change_sub_tax(no_get){
        $('.sub_tax_cd').prop('checked', false);
        $('#sub_tax_cd_'+no_get).prop('checked', true);

        $('#no_select_sub_tax').val('');
        $('#no_select_sub_tax').val(no_get);
    }

    function list_sub_tax_add(){

        var no_select_sub_tax = $('#no_select_sub_tax').val();
        var no_line_sub_tax = $('#no_line_sub_tax').val();

        var sub_tax_cd_value = $('#sub_tax_cd_'+no_select_sub_tax).val();
        let sub_tax_cd_split = sub_tax_cd_value.split(" // ");
        var sub_tax_cd = sub_tax_cd_split[0];
            
        $('#sub_tax_cd_line_'+no_line_sub_tax).val('');
        $('#sub_tax_cd_line_'+no_line_sub_tax).val(sub_tax_cd);

        list_sub_tax_close();
        price_calculation(no_line_sub_tax);
    }

    function list_sub_tax_close(){
        $('#modal_sub_tax').modal('hide');
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
                'url' : base_url+'inventory/list-coa-income-datatable/'+key_session+'/0',
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

        $('#coa_name_line_'+no_line_coa).val('');
        $('#coa_name_line_'+no_line_coa).val(coa_name);

        list_coa_close();
    }

    function list_coa_close(){
        $('#modal_coa').modal('hide');
    }

// ===================== Button Header ==================================================

// Add

function refresh(){
    location.href = base_url+'distribution/sales/sales-invoice/0';
}

// Save

function save_transaction(){
    var id_sales_invoice = $('#id_sales_invoice').val();
    var sales_invoice_number = $('#sales_invoice_number').val();
    var hold = $('#hold').prop('checked');
    var id_transaction_role = $('#id_transaction_role').val();
    var sales_invoice_date = $('#sales_invoice_date').val();
    var customer_order_number = $('#customer_order_number').val();
    var note = $('#note').val();
    var tax_number = $('#tax_number').val();
    var id_account = $('#id_account').val();
    var id_coa_currency = $('#id_coa_currency').val();
    var rate = $('#rate').val();
    var id_payment_methode = $('#id_payment_methode').val();
    var id_payment_terms = $('#id_payment_terms').val();
    var sales_invoice_owner = $('#sales_invoice_owner').val();
    var cNIK_approval = $('#cNIK_approval').val();
    var total_line = $('#total_line').val();
    var total_qty = $('#total_qty').val();
    var sub_amount = $('#sub_amount').val();
    var discount_amount = $('#discount_amount').val();
    var amount = $('#amount').val();
    var ppn = $('#ppn').val();
    var pph = $('#pph').val();
    var total_amount = $('#total_amount').val();
    
    let alert_count = 0;
    let total_line_real = 0;

    if (hold==false) {
        alert('This transaction not in hold status, please hold first to process this action.');
    }
    else {
        if (total_qty==0) {
            alert('Qty cannot zerro, please try again.');
        }
        else {
            if (id_account == '') {
                alert ('Customer cannot empty, please try again.')
            }
            else {
                const id_sales_invoice_line_array = [];
                const id_delivery_order_line_array = [];
                const id_job_order_array = [];
                const description_array = [];
                const qty_invoice_line_array = [];
                const qty_shipment_line_array = [];
                const uom_cd_line_array = [];
                const unit_price_line_array = [];
                const sub_amount_line_array = [];
                const discount_amount_line_array = [];
                const discount_percent_line_array = [];
                const amount_line_array = [];
                const sub_tax_cd_line_array = [];
                const coa_cd_line_array = [];

                for (var a=1; a<=total_line; a++){
                    var id_sales_invoice_line = $('#id_sales_invoice_line_'+a).val();
                    var id_delivery_order_line = $('#id_delivery_order_line_'+a).val();
                    var id_job_order = $('#id_job_order_'+a).val();
                    var description = $('#description_'+a).val();
                    var qty_invoice_line = $('#qty_invoice_line_'+a).val();
                    var qty_shipment_line = $('#qty_shipment_line_'+a).val();
                    var uom_cd_line = $('#uom_cd_line_'+a).val();
                    var unit_price_line = $('#unit_price_line_'+a).val();
                    var sub_amount_line = $('#sub_amount_line_'+a).val();
                    var discount_amount_line = $('#discount_amount_line_'+a).val();
                    var discount_percent_line = $('#discount_percent_line_'+a).val();
                    var amount_line = $('#amount_line_'+a).val();
                    var sub_tax_cd_line = $('#sub_tax_cd_line_'+a).val();
                    var coa_cd_line = $('#coa_cd_line_'+a).val();

                    if (description != '') {
                        if (qty_shipment_line=='' || (qty_shipment_line)*1 == 0 || uom_cd_line == '' || unit_price_line == '' || (unit_price_line)*1 == 0 || sub_amount_line == '' || (sub_amount_line)*1 == 0 || amount_line == '' || (amount_line)*1 == 0 || sub_tax_cd_line == '') {
                            alert ('Line '+a+' may be empty, please review again.');
                            alert_count += 1;
                        }
                        else {
                            total_line_real += 1;

                            id_sales_invoice_line_array.push(id_sales_invoice_line);
                            id_delivery_order_line_array.push(id_delivery_order_line);
                            id_job_order_array.push(id_job_order);
                            description_array.push(description);
                            qty_invoice_line_array.push(qty_invoice_line);
                            qty_shipment_line_array.push(qty_shipment_line);
                            uom_cd_line_array.push(uom_cd_line);
                            unit_price_line_array.push(unit_price_line);
                            sub_amount_line_array.push(sub_amount_line);
                            discount_amount_line_array.push(discount_amount_line);
                            discount_percent_line_array.push(discount_percent_line);
                            amount_line_array.push(amount_line);
                            sub_tax_cd_line_array.push(sub_tax_cd_line);
                            coa_cd_line_array.push(coa_cd_line);
                        }                                
                    }
                }
                
                if (alert_count==0) {
                    if (sales_invoice_number == '') {
                        modal_loading_open('bg-info', 'Saving data', 'Please wait...');
                    }
                    else {
                        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
                    }
                    
                    $.ajax({
                        url: base_url+'distribution/add-sales-invoice/'+key_session,
                        type: 'POST',
                        data: 'id_sales_invoice='+id_sales_invoice+'&id_module='+id_module+'&sales_invoice_number='+sales_invoice_number+'&hold='+hold+'&id_transaction_role='+id_transaction_role+'&tax_number='+tax_number
                        +'&sales_invoice_date='+sales_invoice_date+'&note='+note+'&total_line='+total_line_real+'&total_qty='+total_qty+'&id_account='+id_account+'&id_payment_methode='+id_payment_methode+'&id_payment_terms='+id_payment_terms
                        +'&id_coa_currency='+id_coa_currency+'&rate='+rate+'&sales_invoice_owner='+sales_invoice_owner+'&cNIK_approval='+cNIK_approval+'&customer_order_number='+customer_order_number+'&sub_amount='+sub_amount+'&discount_amount='+discount_amount+'&amount='+amount+'&ppn='+ppn+'&pph='+pph+'&total_amount='+total_amount

                        +'&id_sales_invoice_line='+(JSON.stringify(id_sales_invoice_line_array))+'&id_delivery_order_line='+(JSON.stringify(id_delivery_order_line_array))+'&id_job_order='+(JSON.stringify(id_job_order_array))+'&description='+(JSON.stringify(description_array
                        ))+'&qty_invoice_line='+(JSON.stringify(qty_invoice_line_array))+'&qty_shipment_line='+(JSON.stringify(qty_shipment_line_array))+'&uom_cd_line='+(JSON.stringify(uom_cd_line_array))+'&unit_price_line='+(JSON.stringify(unit_price_line_array))+'&sub_amount_line='+(JSON.stringify(sub_amount_line_array
                        ))+'&discount_amount_line='+(JSON.stringify(discount_amount_line_array))+'&discount_percent_line='+(JSON.stringify(discount_percent_line_array))+'&amount_line='+(JSON.stringify(amount_line_array
                        ))+'&sub_tax_cd_line='+(JSON.stringify(sub_tax_cd_line_array))+'&coa_cd_line='+(JSON.stringify(coa_cd_line_array)),
                        crossDomain: true,
                        dataType: 'JSON',
                        success: function(responseGet){
                            console.log(responseGet);
                            modal_loading_hide();
                            responseGet.map(function(responseGetList){
                                var status = responseGetList.status;
                                if (status[0]==1) {
                                    if (sales_invoice_number == '') {
                                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                                    }
                                    else {
                                        modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                                    }
                                    setTimeout(function () {
                                        modal_loading_hide();
                                        var sales_invoice_number_db = responseGetList.sales_invoice_number;
                                        $('#sales_invoice_number').val(sales_invoice_number_db);
                                    }, 5000)
                                }
                                else {
                                    if (sales_invoice_number == '') {
                                        modal_loading_open('bg-danger', 'Saving data unsuccessfully.', 'Please wait for hide this view...');
                                    }
                                    else {
                                        modal_loading_open('bg-danger', 'Updating data unsuccessfully.', 'Please wait for hide this view...');
                                    }
                                    
                                    setTimeout(function () {
                                        modal_loading_hide();
                                    }, 5000);
                                }
                            })
                        },
                        error : function(xhr){
                            console.log(xhr.responseText)
                        }
                    })
                }
            }
        }
    }
}

// Delete 

/*function remove(){
    var id_transaction_role = $('#id_transaction_role').val();
    if (id_transaction_role==1) {
        var purchase_order_number = $('#purchase_order_number').val();
        if (purchase_order_number=='') {
            alert ('Please select purchase order number to remove purchase order.');
        }
        else {
            if (confirm('Are you sure you want to delete transaction number '+purchase_order_number+' ?')) {
                modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
                $.ajax({
                    url: base_url+'distribution/delete-purchase-order/'+key_session,
                    type: 'POST',
                    data: 'purchase_order_number='+purchase_order_number,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        modal_loading_hide();
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait...');
                                setTimeout(function () {
                                    modal_loading_hide();
                                    location.reload(true);
                                }, 5000)
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
    }
    else {
        alert ('cannot delete this transaction.');
    }
}*/

// Print

function print_sales_invoice(){
    var sales_invoice_number = $('#sales_invoice_number').val();
    var id_transaction_role = $('#id_transaction_role').val();

    if (sales_invoice_number=='') {
        alert ('Select sales invoice number to process this action.');
    }
    else {
        if (id_transaction_role<=1) {
            alert ('Cannot process this action because status this transaction is hold.');
        }
        else {
            if (confirm('Are you sure you want to print this sales invoice ?')) {
                $.ajax({
                    url: base_url+'distribution/update-sales-invoice-print/'+key_session+'/1',
                    type: 'POST',
                    data: 'sales_invoice_number='+sales_invoice_number+'&id_transaction_role='+id_transaction_role+'&id_module='+id_module,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header(sales_invoice_number);
                                var sales_invoice_number_format = $('#sales_invoice_number_format').val();
                                window.open(base_url+'report/pdf/sales-invoice/'+key_session+'/'+sales_invoice_number_format);
                            }
                            else {
                                alert('Data not updated');
                            }
                        })
                    }
                })
            }
        }
    }
}

// List

function list_sales_invoice_detail(){
    window.open(base_url+'distribution/list-sales/sales-invoice');
}

// Release Posting

function release(){
    var sales_invoice_number = $('#sales_invoice_number').val();
    var close_transaction = $('#close_transaction').val();
    var hold = $('#hold').prop('checked');
    if (sales_invoice_number == '') {
        alert ('Please select sales invoice number is you want to release.');
    }
    else {
        if (hold == true) {
            alert ('Cannot process this action because status is not open.');
        }
        else if (close_transaction*1 == 1) {
            alert ('Cannot process this action because status is posted.');
        }
        else {
            if (confirm('Are you sure you want posting sales invoice number '+sales_invoice_number+' ?')) {
                $.ajax({
                    url: base_url+'distribution/release-sales-invoice/'+key_session,
                    type: 'POST',
                    data: 'sales_invoice_number='+sales_invoice_number,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header(sales_invoice_number);
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