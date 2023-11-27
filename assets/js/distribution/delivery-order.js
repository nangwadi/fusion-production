$(document).ready(function(){
    delivery_order_line_blank(0);

    if ((transaction_number_db*1) == 1) {
        console.log(transaction_number_format_db);
        detail_header_sales_order(transaction_number_format_db);
    }
    else if ((transaction_number_db*1) != 0) {
        detail_header(transaction_number_format_db);
    }
})

// ======================================================================= header =============================================================

// Delivery Order Number

    function list_delivery_order(){
        $('#list_delivery_order').dataTable().fnDestroy();
        $('#modal_delivery_order').modal('show');

        $('#list_delivery_order').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order": [],
            "ajax" : {
                'url' : base_url+'distribution/list-delivery-order-select-datatable/'+key_session+'/0',
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

    function select_change_delivery_order(no_get){
        $('#no_select_delivery_order').val('');
        $('#no_select_delivery_order').val(no_get);

        $('.delivery_order_number').prop('checked', false);
        $('#delivery_order_number_'+no_get).prop('checked', true);
    }

    function list_delivery_order_add(){
        $('#id_delivery_order').val('');
        $('#delivery_order_number').val('');
        var no_select_delivery_order = $('#no_select_delivery_order').val();

        var id_delivery_order = $('#id_delivery_order_'+no_select_delivery_order).val();
        var delivery_order_number = $('#delivery_order_number_'+no_select_delivery_order).val();
        var delivery_order_number_format = $('#delivery_order_number_format_'+no_select_delivery_order).val();
            
        $('#id_delivery_order').val(id_delivery_order);
        $('#delivery_order_number').val(delivery_order_number);
        list_delivery_order_close();

        detail_header(delivery_order_number);
    }

    function list_delivery_order_close(){
        $('#modal_delivery_order').modal('hide');
    }

// Hold

function hold_check(){
    var hold = $('#hold').prop('checked');
    var transaction_number = $('#delivery_order_number').val();
    if (transaction_number == '') {
        alert ('Please choose delivery Order to release the hold.');
        $('#hold').prop('checked', 'checked');
    }
    else {
        if (hold == false) {
            if (confirm('Are you sure you want to release the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-delivery-order-hold/'+key_session+'/0',
                    type: 'POST',
                    data: 'delivery_order_number='+transaction_number+'&id_module='+id_module,
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
                    url: base_url+'distribution/update-delivery-order-hold/'+key_session+'/1',
                    type: 'POST',
                    data: 'delivery_order_number='+transaction_number+'&id_module='+id_module,
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

// ============================================================== Detail after select sales Order Number

function detail_header(transaction_number_get){
    $.ajax({
        url: base_url+'distribution/list-delivery-order-by-delivery-order-number/'+key_session,
        type: 'POST',
        data: 'delivery_order_number='+transaction_number_get,
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
                    $('#id_delivery_order').val('');
                    $('#delivery_order_number_format').val('');
                    $('#delivery_order_number').val('');
                    $('#id_transaction_role').val('');
                    $('#transaction_name').html('');
                    $('#delivery_order_date').val('');
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
                    $('#delivery_order_owner').val('');
                    $('#cNIK_approval').val('');
                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_delivery_order = responseList.id_delivery_order;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var delivery_order_number = responseList.delivery_order_number;
                        var delivery_order_number_format = responseList.delivery_order_number_format;
                        var hold = responseList.hold;
                        var id_transaction_role = responseList.id_transaction_role;
                        var transaction_name = responseList.transaction_name;
                        var delivery_order_date = responseList.delivery_order_date;
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
                        var delivery_order_owner = responseList.delivery_order_owner;
                        var cNmPegawai_delivery_order_owner = responseList.cNmPegawai_delivery_order_owner;
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

                        $('#id_delivery_order').val(id_delivery_order);
                        $('#delivery_order_number').val(delivery_order_number);
                        $('#delivery_order_number_format').val(delivery_order_number_format);
                        $('#id_transaction_role').val(id_transaction_role);
                        $('#transaction_name').append(transaction_name);
                        $('#delivery_order_date').val(delivery_order_date);
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
                        $('#delivery_order_owner').val(cNmPegawai_delivery_order_owner);
                        $('#cNIK_approval').val(cNmPegawai_approval);
                        $('#sub_amount').val(sub_amount);
                        $('#discount_amount').val(discount_amount);
                        $('#amount').val(amount);
                        $('#ppn').val(ppn);
                        $('#pph').val(pph);
                        $('#total_amount').val(total_amount);

                        if (hold==1) {
                            $('#hold').prop('checked', true);
                        }
                        else {
                            $('#hold').prop('checked', false);   
                        }

                        delivery_order_line_blank(delivery_order_number_format);

                    })
                }
            })
        }
    })
}

function delivery_order_line_blank(transaction_number){
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
            'url' : base_url+'distribution/delivery-order-line-blank/'+key_session+'/'+transaction_number,
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
        
        let account_control = $('#account_control').val();

        if (account_control==0) {
            $('#id_account').val('');
            $('#account_name').val('');
            $('#id_account_project').val('');
            $('#account_name_project').val('');

            $('#id_account').val(id_account_value);
            $('#account_name').val(account_name_value);

            $('#id_account_project').val(id_account_value);
            $('#account_name_project').val(account_name_value);
        }   
        else {
            $('#id_account_project').val('');
            $('#account_name_project').val('');

            $('#id_account_project').val(id_account_value);
            $('#account_name_project').val(account_name_value);
        }

        $('#id_coa_currency').val('');
        $('#id_coa_currency').val(coa_currency_cd);

        list_account_close();
    }

    function list_account_close(){
        $('#modal_account').modal('hide');
    }

    // List Sales Order Line

    function list_sales_order_line(no_get){
        var id_account = $('#id_account').val();
        var id_account_project = $('#id_account_project').val();
        $('#no_delivery_order_line').val('');
        $('#no_delivery_order_line').val(no_get);
        if (id_account == '' || id_account_project == '') {
            alert ('Customer or Delivery To cannot empty.')
        }
        else {
            $('#list_sales_order_line').dataTable().fnDestroy();
            $('#modal_sales_order_line').modal('show');

            $('#list_sales_order_line').DataTable({
                "processing" : true,
                "serverSide" : true,
                "order": [],
                "ajax" : {
                    'url' : base_url+'distribution/list-sales-order-line-for-delivery-order-datatable/'+key_session+'/'+id_account+'/'+id_account_project,
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

    function select_change_sales_order_line(no_get){
        $('.sales_order_number').prop('checked', false);
        $('#sales_order_number_'+no_get).prop('checked', true);
        $('#no_sales_order_line').val('');
        $('#no_sales_order_line').val(no_get);
    }

    function list_sales_order_line_add(){
        var no = $('#no_sales_order_line').val();
        var id_sales_order_line_get = $('#id_sales_order_line_'+no).val();

        if (id_sales_order_line_array.includes(id_sales_order_line_get*1) == true) {
            alert ('This sales order line was used, please select other.');
        }
        else {
            var no_delivery_order_line = $('#no_delivery_order_line').val();
            
            var checkbox_chek = $('#sales_order_number_'+no).prop('checked');
            if (checkbox_chek==true) {
                $.ajax({
                    url: base_url+'distribution/list-sales-order-line/'+key_session+'/'+id_sales_order_line_get,
                    type: 'get',
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==0) {
                                alert ('Data not found.');
                            }
                            else {
                                list_sales_order_line_close();
                                var response = responseGetList.response;
                                response.map(function(responseList){
                                    var id_sales_order_line = responseList.id_sales_order_line;
                                    var company_id  = responseList.company_id;
                                    var company_name    = responseList.company_name;
                                    var sales_order_number  = responseList.sales_order_number;
                                    var id_sales_order  = responseList.id_sales_order;
                                    var line_number = responseList.line_number;
                                    var id_job_order    = responseList.id_job_order;
                                    var JobNo   = responseList.JobNo;
                                    var JobName = responseList.JobName;
                                    var description = responseList.description;
                                    var qty_order_line  = responseList.qty_order_line;
                                    var qty_shipment_line   = responseList.qty_shipment_line;
                                    var id_uom  = responseList.id_uom;
                                    var uom_cd  = responseList.uom_cd;
                                    var uom_name    = responseList.uom_name;
                                    var cury_unit_price = responseList.cury_unit_price;
                                    var unit_price  = responseList.unit_price;
                                    var cury_sub_amount = responseList.cury_sub_amount;
                                    var sub_amount  = responseList.sub_amount;
                                    var cury_discount_amount    = responseList.cury_discount_amount;
                                    var discount_amount = responseList.discount_amount;
                                    var discount_percent    = responseList.discount_percent;
                                    var cury_amount = responseList.cury_amount;
                                    var amount  = responseList.amount;
                                    var id_sub_tax  = responseList.id_sub_tax;
                                    var sub_tax_cd  = responseList.sub_tax_cd;
                                    var sub_tax_name    = responseList.sub_tax_name;
                                    var id_coa  = responseList.id_coa;
                                    var coa_cd  = responseList.coa_cd;
                                    var coa_name    = responseList.coa_name;
                                    var line_status = responseList.line_status;
                                    var create_by   = responseList.create_by;
                                    var cNmPegawai_create   = responseList.cNmPegawai_create;
                                    var create_date = responseList.create_date;
                                    var last_by = responseList.last_by;
                                    var cNmPegawai_last = responseList.cNmPegawai_last;
                                    var last_update = responseList.last_update;
                                    var id_coa_currency = responseList.id_coa_currency;
                                    var coa_currency_cd = responseList.coa_currency_cd;
                                    var coa_currency_name   = responseList.coa_currency_name;
                                    var decimal_after   = responseList.decimal_after;

                                    id_sales_order_line_array.push(id_sales_order_line);

                                    $('#id_sales_order_line_on_delivery_order_line_'+no_delivery_order_line).val('');
                                    $('#id_sales_order_line_on_delivery_order_line_'+no_delivery_order_line).val(id_sales_order_line);

                                    $('#sales_order_number_'+no_delivery_order_line).val('');
                                    $('#sales_order_number_'+no_delivery_order_line).val(sales_order_number);

                                    $('#id_job_order_'+no_delivery_order_line).val('');
                                    $('#id_job_order_'+no_delivery_order_line).val(id_job_order);

                                    $('#JobNo_'+no_delivery_order_line).val('');
                                    $('#JobNo_'+no_delivery_order_line).val(JobNo);

                                    $('#description_'+no_delivery_order_line).val('');
                                    $('#description_'+no_delivery_order_line).val(description);

                                    $('#qty_order_line_'+no_delivery_order_line).val('');
                                    $('#qty_order_line_'+no_delivery_order_line).val(qty_order_line);

                                    $('#qty_shipment_line_'+no_delivery_order_line).val('');
                                    $('#qty_shipment_line_'+no_delivery_order_line).val(0);

                                    $('#qty_open_line_'+no_delivery_order_line).val('');
                                    $('#qty_open_line_'+no_delivery_order_line).val(qty_order_line);

                                    $('#uom_cd_line_'+no_delivery_order_line).val('');
                                    $('#uom_cd_line_'+no_delivery_order_line).val(uom_cd);

                                    $('#unit_price_line_'+no_delivery_order_line).val('');
                                    $('#unit_price_line_'+no_delivery_order_line).val(unit_price*1);

                                    $('#sub_amount_line_'+no_delivery_order_line).val('');
                                    $('#sub_amount_line_'+no_delivery_order_line).val(0);

                                    $('#discount_amount_line_'+no_delivery_order_line).val('');
                                    $('#discount_amount_line_'+no_delivery_order_line).val(discount_amount*1);

                                    $('#discount_percent_line_'+no_delivery_order_line).val('');
                                    $('#discount_percent_line_'+no_delivery_order_line).val(discount_percent*1);

                                    $('#amount_line_'+no_delivery_order_line).val('');
                                    $('#amount_line_'+no_delivery_order_line).val(0);

                                    $('#sub_tax_cd_line_'+no_delivery_order_line).val('');
                                    $('#sub_tax_cd_line_'+no_delivery_order_line).val(sub_tax_cd);

                                    $('#coa_cd_line_'+no_delivery_order_line).val('');
                                    $('#coa_cd_line_'+no_delivery_order_line).val(coa_cd);

                                    $('#coa_name_line_'+no_delivery_order_line).val('');
                                    $('#coa_name_line_'+no_delivery_order_line).val(coa_name);

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

    function list_sales_order_line_close(){
        $('#modal_sales_order_line').modal('hide');
    }


// Line

function price_calculation(no_get){
    var qty_order_line = $('#qty_order_line_'+no_get).val();
    var qty_shipment_line = $('#qty_shipment_line_'+no_get).val();

    if (qty_shipment_line*1 > qty_order_line*1) {
        alert ('Qty shipment cannot more than qty order.');
        $('#qty_shipment_line_'+no_get).val('0')
    }
    else {
        var unit_price_line = $('#unit_price_line_'+no_get).val();
        var discount_amount_line = $('#discount_amount_line_'+no_get).val();
        var discount_percent_line = $('#discount_percent_line_'+no_get).val();

        let sub_amount = (qty_shipment_line*1)*(unit_price_line*1);
        let amount = sub_amount - ((discount_amount_line*1)+(((discount_percent_line*1)/100)*sub_amount));

        $('#sub_amount_line_'+no_get).val('');
        $('#sub_amount_line_'+no_get).val(sub_amount);

        $('#amount_line_'+no_get).val('');
        $('#amount_line_'+no_get).val(amount);

        let qty_open = (qty_order_line*1)-(qty_shipment_line*1);

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
        let id_sales_order_line = $('#id_sales_order_line_on_delivery_order_line_'+no_line_get).val();
        
        $('#id_delivery_order_line_'+no_line_get).val('');        
        $('#id_sales_order_line_on_delivery_order_line_'+no_line_get).val('');
        $('#sales_order_number_'+no_line_get).val('');
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

        const index = id_sales_order_line_array.indexOf((id_sales_order_line*1));

        if (index > -1) { // only splice array when item is found
            id_sales_order_line_array.splice(index, 1); // 2nd parameter means remove one item only
        }
        
        $('#total_line').val('');
        $('#total_line').val(total_line);
    }
}

    function list_kit_assy(no_get){
        var JobNo = $('#JobNo_'+no_get).val();

        $('#no_kit_assy_delivery_order').val('');
        $('#no_kit_assy_delivery_order').val(no_get);

        if (JobNo == '') {
            alert ('Job Number Cannot Empty.');
        }
        else {
            $('#list_kit_assy').dataTable().fnDestroy();
            $('#modal_kit_assy').modal('show');
            $('#list_kit_assy').DataTable({
                "processing" : true,
                "serverSide" : true,
                "order": [],
                "ajax" : {
                    'url' : base_url+'inventory/list-kit-assy-by-jobno-for-delivery-order-datatable/'+key_session+'/'+JobNo,
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

    function select_change_kit_assy(no_get){
        $('.kit_assy_number').prop('checked', false);
        $('#kit_assy_number_'+no_get).prop('checked', true);
        $('#no_kit_assy').val('');
        $('#no_kit_assy').val(no_get);
    }

    function list_kit_assy_add(){
        var no_kit_assy = $('#no_kit_assy').val();
        var kit_assy_number = $('#kit_assy_number_'+no_kit_assy).val();
        var id_kit_assy = $('#id_kit_assy_'+no_kit_assy).val();

        var no_kit_assy_delivery_order = $('#no_kit_assy_delivery_order').val();

        $('#kit_assy_line_'+no_kit_assy_delivery_order).val('');
        $('#kit_assy_line_'+no_kit_assy_delivery_order).val(kit_assy_number);

        $('#id_kit_assy_line_'+no_kit_assy_delivery_order).val('');
        $('#id_kit_assy_line_'+no_kit_assy_delivery_order).val(id_kit_assy);

        list_kit_assy_close();
        //console.log(kit_assy_number);
    }

    function list_kit_assy_close(){
        $('#modal_kit_assy').modal('hide');
    }

// ===================== Button Header ==================================================

// Add

function refresh(){
    location.href = base_url+'distribution/sales/delivery-order/0';
}

// Save

function save_transaction(){
    var id_delivery_order = $('#id_delivery_order').val();
    var delivery_order_number = $('#delivery_order_number').val();
    var hold = $('#hold').prop('checked');
    var id_transaction_role = $('#id_transaction_role').val();
    var delivery_order_date = $('#delivery_order_date').val();
    var note = $('#note').val();
    var total_line = $('#total_line').val();
    var total_qty = $('#total_qty').val();
    var id_account = $('#id_account').val();
    var id_account_project = $('#id_account_project').val();
    var id_coa_currency = $('#id_coa_currency').val();
    var rate = $('#rate').val();
    var delivery_order_owner = $('#delivery_order_owner').val();
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
            if (id_account == '' || id_account_project == '') {
                alert ('Vendor cannot empty, please try again.')
            }
            else {
                const id_delivery_order_line_array = [];
                const id_sales_order_line_on_delivery_order_line_array = [];
                const id_job_order_array = [];
                const description_array = [];
                const qty_order_line_array = [];
                const qty_shipment_line_array = [];
                const uom_cd_line_array = [];
                const unit_price_line_array = [];
                const sub_amount_line_array = [];
                const discount_amount_line_array = [];
                const discount_percent_line_array = [];
                const amount_line_array = [];
                const sub_tax_cd_line_array = [];
                const coa_cd_line_array = [];
                const id_kit_assy_array = [];

                for (var a=1; a<=total_line; a++){
                    var id_delivery_order_line = $('#id_delivery_order_line_'+a).val();
                    var id_sales_order_line_on_delivery_order_line = $('#id_sales_order_line_on_delivery_order_line_'+a).val();
                    var id_job_order = $('#id_job_order_'+a).val();
                    var description = $('#description_'+a).val();
                    var qty_order_line = $('#qty_order_line_'+a).val();
                    var qty_shipment_line = $('#qty_shipment_line_'+a).val();
                    var uom_cd_line = $('#uom_cd_line_'+a).val();
                    var unit_price_line = $('#unit_price_line_'+a).val();
                    var sub_amount_line = $('#sub_amount_line_'+a).val();
                    var discount_amount_line = $('#discount_amount_line_'+a).val();
                    var discount_percent_line = $('#discount_percent_line_'+a).val();
                    var amount_line = $('#amount_line_'+a).val();
                    var sub_tax_cd_line = $('#sub_tax_cd_line_'+a).val();
                    var coa_cd_line = $('#coa_cd_line_'+a).val();
                    var id_kit_assy = $('#id_kit_assy_'+a).val();

                    if (description != '') {
                        if (qty_shipment_line=='' || (qty_shipment_line)*1 == 0 || uom_cd_line == '' || unit_price_line == '' || (unit_price_line)*1 == 0 || sub_amount_line == '' || (sub_amount_line)*1 == 0 || amount_line == '' || (amount_line)*1 == 0 || sub_tax_cd_line == '' || id_kit_assy == '') {
                            alert ('Line '+a+' may be empty, please review again.');
                            alert_count += 1;
                        }
                        else {
                            total_line_real += 1;

                            id_delivery_order_line_array.push(id_delivery_order_line);
                            id_sales_order_line_on_delivery_order_line_array.push(id_sales_order_line_on_delivery_order_line);
                            id_job_order_array.push(id_job_order);
                            description_array.push(description);
                            qty_order_line_array.push(qty_order_line);
                            qty_shipment_line_array.push(qty_shipment_line);
                            uom_cd_line_array.push(uom_cd_line);
                            unit_price_line_array.push(unit_price_line);
                            sub_amount_line_array.push(sub_amount_line);
                            discount_amount_line_array.push(discount_amount_line);
                            discount_percent_line_array.push(discount_percent_line);
                            amount_line_array.push(amount_line);
                            sub_tax_cd_line_array.push(sub_tax_cd_line);
                            coa_cd_line_array.push(coa_cd_line);
                            id_kit_assy_array.push(id_kit_assy);
                        }                                
                    }
                }
                
                if (alert_count==0) {
                    if (delivery_order_number == '') {
                        modal_loading_open('bg-info', 'Saving data', 'Please wait...');
                    }
                    else {
                        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
                    }
                    
                    $.ajax({
                        url: base_url+'distribution/add-delivery-order/'+key_session,
                        type: 'POST',
                        data: 'id_delivery_order='+id_delivery_order+'&id_module='+id_module+'&delivery_order_number='+delivery_order_number+'&hold='+hold+'&id_transaction_role='+id_transaction_role
                        +'&delivery_order_date='+delivery_order_date+'&note='+note+'&total_line='+total_line_real+'&total_qty='+total_qty+'&id_account='+id_account+'&id_account_project='+id_account_project
                        +'&id_coa_currency='+id_coa_currency+'&rate='+rate+'&delivery_order_owner='+delivery_order_owner+'&sub_amount='+sub_amount+'&discount_amount='+discount_amount+'&amount='+amount+'&ppn='+ppn+'&pph='+pph+'&total_amount='+total_amount

                        +'&id_delivery_order_line='+(JSON.stringify(id_delivery_order_line_array))+'&id_sales_order_line_on_delivery_order_line='+(JSON.stringify(id_sales_order_line_on_delivery_order_line_array))+'&id_job_order='+(JSON.stringify(id_job_order_array))+'&description='+(JSON.stringify(description_array
                        ))+'&qty_order_line='+(JSON.stringify(qty_order_line_array))+'&qty_shipment_line='+(JSON.stringify(qty_shipment_line_array))+'&uom_cd_line='+(JSON.stringify(uom_cd_line_array))+'&unit_price_line='+(JSON.stringify(unit_price_line_array))+'&sub_amount_line='+(JSON.stringify(sub_amount_line_array
                        ))+'&discount_amount_line='+(JSON.stringify(discount_amount_line_array))+'&discount_percent_line='+(JSON.stringify(discount_percent_line_array))+'&amount_line='+(JSON.stringify(amount_line_array
                        ))+'&sub_tax_cd_line='+(JSON.stringify(sub_tax_cd_line_array))+'&coa_cd_line='+(JSON.stringify(coa_cd_line_array))+'&id_kit_assy='+(JSON.stringify(id_kit_assy_array)),
                        crossDomain: true,
                        dataType: 'JSON',
                        success: function(responseGet){
                            //console.log(responseGet);
                            modal_loading_hide();
                            responseGet.map(function(responseGetList){
                                var status = responseGetList.status;
                                if (status[0]==1) {
                                    if (delivery_order_number == '') {
                                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                                    }
                                    else {
                                        modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                                    }
                                    setTimeout(function () {
                                        modal_loading_hide();
                                        var delivery_order_number_db = responseGetList.delivery_order_number;
                                        $('#delivery_order_number').val(delivery_order_number_db);
                                    }, 5000)
                                }
                                else {
                                    if (delivery_order_number == '') {
                                        modal_loading_open('bg-danger', 'Saving data unsuccessfully.', 'Please wait for hide this view...');
                                    }
                                    else {
                                        modal_loading_open('bg-danger', 'Updating data unsuccessfully.', 'Please wait for hide this view...');
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

function print_delivery_order(){
    var delivery_order_number = $('#delivery_order_number').val();
    var id_transaction_role = $('#id_transaction_role').val();

    if (delivery_order_number=='') {
        alert ('Select delivery order number to process this action.');
    }
    else {
        if (id_transaction_role<=1) {
            alert ('Cannot process this action because status this transaction is hold.');
        }
        else {
            if (confirm('Are you sure you want to print this delivery order ?')) {
                $.ajax({
                    url: base_url+'distribution/update-delivery-order-print/'+key_session+'/1',
                    type: 'POST',
                    data: 'delivery_order_number='+delivery_order_number+'&id_transaction_role='+id_transaction_role+'&id_module='+id_module,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                detail_header(delivery_order_number);
                                var delivery_order_number_format = $('#delivery_order_number_format').val();
                                window.open(base_url+'report/pdf/delivery-order/'+key_session+'/'+delivery_order_number_format);
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

function list_delivery_order_detail(){
    window.open(base_url+'distribution/list-sales/delivery-order');
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