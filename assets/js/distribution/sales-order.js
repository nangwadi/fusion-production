$(document).ready(function(){
    sales_order_line_blank(0);

    if ((transaction_number_db*1) != 0) {
        //console.log(transaction_number_format_db);
        detail_header(transaction_number_format_db);
    }
})

// ============================================================= POP UP DATATABLE =======================================================

// Sales Order Number

function list_sales_order(){
    $('#list_sales_order').dataTable().fnDestroy();
    $('#modal_sales_order').modal('show');

    $('#list_sales_order').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-sales-order-select-datatable/'+key_session+'/0',
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

function select_change_sales_order(no_get){
    $('#no_select_sales_order').val('');
    $('#no_select_sales_order').val(no_get);

    $('.sales_order_number').prop('checked', false);
    $('#sales_order_number_'+no_get).prop('checked', true);
}

function list_sales_order_add(){
    $('#id_sales_order').val('');
    $('#sales_order_number').val('');
    var no_select_sales_order = $('#no_select_sales_order').val();

    var id_sales_order = $('#id_sales_order_'+no_select_sales_order).val();
    var sales_order_number = $('#sales_order_number_'+no_select_sales_order).val();
    var sales_order_number_format = $('#sales_order_number_format_'+no_select_sales_order).val();
        
    $('#id_sales_order').val(id_sales_order);
    $('#sales_order_number').val(sales_order_number);
    list_sales_order_close();

    detail_header(sales_order_number);
}

function list_sales_order_close(){
    $('#modal_sales_order').modal('hide');
}

// Hold

function hold_check(){
    var hold = $('#hold').prop('checked');
    var transaction_number = $('#sales_order_number').val();
    if (transaction_number == '') {
        alert ('Please choose sales Order to release the hold.');
        $('#hold').prop('checked', 'checked');
    }
    else {
        if (hold == false) {
            if (confirm('Are you sure you want to release the hold ?')) {
                $.ajax({
                    url: base_url+'distribution/update-sales-order-hold/'+key_session+'/0',
                    type: 'POST',
                    data: 'sales_order_number='+transaction_number+'&id_module='+id_module,
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
                    url: base_url+'distribution/update-sales-order-hold/'+key_session+'/1',
                    type: 'POST',
                    data: 'sales_order_number='+transaction_number+'&id_module='+id_module,
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

// Customer

function list_account(control_get){
    //console.log(control_get);
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
    //console.log(no_get);
    /*$('.id_account').prop('checked', false);
    $('#id_account_'+no_get).prop('checked', true);*/
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

// ============================================================== Detail after select sales Order Number

function detail_header(transaction_number_get){
    //console.log(transaction_number_get);

    $.ajax({
        url: base_url+'distribution/list-sales-order-by-sales-order-number/'+key_session,
        type: 'POST',
        data: 'sales_order_number='+transaction_number_get,
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
                    $('#id_sales_order').val('');
                    $('#sales_order_number_format').val('');
                    $('#sales_order_number').val('');
                    $('#id_transaction_role').val('');
                    $('#transaction_name').html('');
                    $('#sales_order_date').val('');
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
                    $('#sales_order_owner').val('');
                    $('#cNIK_approval').val('');
                    $('#sub_amount').val('');
                    $('#discount_amount').val('');
                    $('#amount').val('');
                    $('#ppn').val('');
                    $('#pph').val('');
                    $('#total_amount').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_sales_order = responseList.id_sales_order;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var sales_order_number = responseList.sales_order_number;
                        var sales_order_number_format = responseList.sales_order_number_format;
                        var hold = responseList.hold;
                        var id_transaction_role = responseList.id_transaction_role;
                        var transaction_name = responseList.transaction_name;
                        var sales_order_date = responseList.sales_order_date;
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
                        var sales_order_owner = responseList.sales_order_owner;
                        var cNmPegawai_sales_order_owner = responseList.cNmPegawai_sales_order_owner;
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

                        $('#id_sales_order').val(id_sales_order);
                        $('#sales_order_number').val(sales_order_number);
                        $('#sales_order_number_format').val(sales_order_number_format);
                        $('#id_transaction_role').val(id_transaction_role);
                        $('#transaction_name').append(transaction_name);
                        $('#sales_order_date').val(sales_order_date);
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
                        $('#sales_order_owner').val(cNmPegawai_sales_order_owner);
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

                        //$('#id_transaction_role').val(id_transaction_role);

                        //document.getElementById('id_account').removeAttribute('onclick');

                        sales_order_line_blank(sales_order_number_format);

                    })
                }
            })
        }
    })
}

// ===================== Button Header ==================================================

// Save

function save_transaction(){
    var id_sales_order = $('#id_sales_order').val();
    var sales_order_number = $('#sales_order_number').val();
    var hold = $('#hold').prop('checked');
    var id_transaction_role = $('#id_transaction_role').val();
    var sales_order_date = $('#sales_order_date').val();
    var quotation_number = $('#quotation_number').val();
    var note = $('#note').val();
    var total_line = $('#total_line').val();
    var total_qty = $('#total_qty').val();
    var id_account = $('#id_account').val();
    var id_account_project = $('#id_account_project').val();
    var id_coa_currency = $('#id_coa_currency').val();
    var rate = $('#rate').val();
    var customer_order_number = $('#customer_order_number').val();
    var sales_order_owner = $('#sales_order_owner').val();
    var cNIK_approval = $('#cNIK_approval').val();
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
                if (cNIK_approval == '') {
                    alert ('Approval cannot empty, please try again.');
                }
                else {
                    if (quotation_number == '') {
                        alert ('Quotation number cannot empty, please try again.');
                    }
                    else {
                        if (customer_order_number == '') {
                            alert ('Customer order number cannot empty, please try again.');
                        }
                        else {
                            var id_sales_order_line_array = [];
                            var JobNo_array = [];
                            var description_array = [];
                            var qty_order_line_array = [];
                            var uom_cd_line_array = [];
                            var unit_price_line_array = [];
                            var line_sub_amount_line_array = [];
                            var discount_amount_line_array = [];
                            var discount_percent_line_array = [];
                            var line_amount_line_array = [];
                            var sub_tax_cd_line_array = [];
                            var coa_cd_line_array = [];
                            var coa_name_line_array = [];

                            for (var a=1; a<=total_line; a++){
                                var id_sales_order_line = $('#id_sales_order_line_'+a).val();
                                var JobNo = $('#JobNo_'+a).val();
                                var description = $('#description_'+a).val();
                                var qty_order_line = $('#qty_order_line_'+a).val();
                                var uom_cd_line = $('#uom_cd_line_'+a).val();
                                var unit_price_line = $('#unit_price_line_'+a).val();
                                var line_sub_amount_line = $('#line_sub_amount_line_'+a).val();
                                var discount_amount_line = $('#discount_amount_line_'+a).val();
                                var discount_percent_line = $('#discount_percent_line_'+a).val();
                                var line_amount_line = $('#line_amount_line_'+a).val();
                                var sub_tax_cd_line = $('#sub_tax_cd_line_'+a).val();
                                var coa_cd_line = $('#coa_cd_line_'+a).val();
                                var coa_name_line = $('#coa_name_line_'+a).val();

                                if (description != '') {
                                    if (qty_order_line=='' || (qty_order_line)*1 == 0 || uom_cd_line == '' || unit_price_line == '' || (unit_price_line)*1 == 0 || line_sub_amount_line == '' || (line_sub_amount_line)*1 == 0 || line_amount_line == '' || (line_amount_line)*1 == 0 || sub_tax_cd_line == '' || coa_cd_line == '') {
                                        alert ('Line '+a+' may be empty, please review again.');
                                        alert_count += 1;
                                    }
                                    else {
                                        total_line_real += 1;

                                        id_sales_order_line_array.push(id_sales_order_line);
                                        JobNo_array.push(JobNo);
                                        description_array.push(description);
                                        qty_order_line_array.push(qty_order_line);
                                        uom_cd_line_array.push(uom_cd_line);
                                        unit_price_line_array.push(unit_price_line);
                                        line_sub_amount_line_array.push(line_sub_amount_line);
                                        discount_amount_line_array.push(discount_amount_line);
                                        discount_percent_line_array.push(discount_percent_line);
                                        line_amount_line_array.push(line_amount_line);
                                        sub_tax_cd_line_array.push(sub_tax_cd_line);
                                        coa_cd_line_array.push(coa_cd_line);
                                        coa_name_line_array.push(coa_name_line);
                                    }                                
                                }
                            }
                            
                            if (alert_count==0) {
                                if (sales_order_number == '') {
                                    modal_loading_open('bg-info', 'Saving data', 'Please wait...');
                                }
                                else {
                                    modal_loading_open('bg-info', 'Updating data', 'Please wait...');
                                }

                                console.log(qty_order_line_array);

                                $.ajax({
                                    url: base_url+'distribution/add-sales-order/'+key_session,
                                    type: 'POST',
                                    data: 'id_sales_order='+id_sales_order+'&id_module='+id_module+'&sales_order_number='+sales_order_number+'&hold='+hold+'&id_transaction_role='+id_transaction_role
                                    +'&sales_order_date='+sales_order_date+'&quotation_number='+quotation_number+'&note='+note+'&total_line='+total_line_real+'&total_qty='+total_qty+'&id_account='+id_account+'&id_account_project='+id_account_project
                                    +'&id_coa_currency='+id_coa_currency+'&rate='+rate+'&customer_order_number='+customer_order_number+'&sales_order_owner='+sales_order_owner+'&cNIK_approval='+cNIK_approval+'&sub_amount='+sub_amount+'&discount_amount='+discount_amount
                                    +'&amount='+amount+'&ppn='+ppn+'&pph='+pph+'&total_amount='+total_amount

                                    +'&id_sales_order_line='+(JSON.stringify(id_sales_order_line_array))+'&JobNo='+(JSON.stringify(JobNo_array))+'&description='+(JSON.stringify(description_array
                                    ))+'&qty_order_line='+(JSON.stringify(qty_order_line_array))+'&uom_cd_line='+(JSON.stringify(uom_cd_line_array))+'&unit_price_line='+(JSON.stringify(unit_price_line_array))+'&line_sub_amount_line='+(JSON.stringify(line_sub_amount_line_array
                                    ))+'&discount_amount_line='+(JSON.stringify(discount_amount_line_array))+'&discount_percent_line='+(JSON.stringify(discount_percent_line_array))+'&line_amount_line='+(JSON.stringify(line_amount_line_array
                                    ))+'&sub_tax_cd_line='+(JSON.stringify(sub_tax_cd_line_array))+'&coa_cd_line='+(JSON.stringify(coa_cd_line_array))+'&coa_name_line='+(JSON.stringify(coa_name_line_array)),
                                    crossDomain: true,
                                    dataType: 'JSON',
                                    success: function(responseGet){
                                        console.log(responseGet);
                                        modal_loading_hide();
                                        responseGet.map(function(responseGetList){
                                            var status = responseGetList.status;
                                            if (status[0]==1) {
                                                if (sales_order_number == '') {
                                                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                                                }
                                                else {
                                                    modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                                                }
                                                setTimeout(function () {
                                                    modal_loading_hide();
                                                    var sales_order_number_db = responseGetList.sales_order_number;
                                                    $('#sales_order_number').val(sales_order_number_db);
                                                }, 5000)
                                            }
                                            else {
                                                if (sales_order_number == '') {
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
        }
    }
}

// Add

function refresh(){
    location.href = base_url+'distribution/sales/sales-order/0';
}

// Copy

function copy_transaction(){
    var JobNo = '';
    for (var a=1; a<=100; a++){
        var JobNo_line = $('#JobNo_line_'+a).val();
        if (JobNo_line != '') {
            JobNo = JobNo_line;
        }
    }

    if (JobNo != '') {
        alert ('This purchase order cannot copy because this is project purchase order.');
    }
    else {
        //alert ('ok');
        $('#id_purchase_order').val('');
        $('#purchase_order_number').val('');
        $('#purchase_order_date').val('');
        $('#purchase_order_date').val(today);
        $('#hold').prop('checked', true);
        $('#id_transaction_role').val('');
        $('#id_transaction_role').val(1);
        $('#transaction_name').html('');
        $('#transaction_name').append('Hold');

        for (var aa=1; aa<=100; aa++){
            $('#id_purchase_order_line_'+aa).val('');
            $('#qty_receipt_line_'+aa).val('0');
        }

        document.getElementById('btn_save').removeAttribute('onclick');
        document.getElementById('btn_save').setAttribute('onclick', 'save_transaction()');
    }
}

// Delete 

function remove(){
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
}

// Receipt

function create_receipt(){
    var id_transaction_role = $('#id_transaction_role').val();
    console.log(id_transaction_role);
    if (id_transaction_role != 3) {
        alert ('Cannot create purchase receipt because status not open.');
    }
    else {
        var purchase_order_number = $('#purchase_order_number').val();
        if (purchase_order_number=='') {
            alert ('Please select purchase order number to create purchase receipt.');
        }
        else {
            //alert ('receipt');
            var mapForm = document.createElement("form");
            mapForm.target = "Map";
            mapForm.method = "POST"; // or "post" if appropriate
            mapForm.action = base_url+"distribution/purchase/purchase-receipt/1";

            var mapInput = document.createElement("input");
            mapInput.type = "text";
            mapInput.name = "transaction_number";
            mapInput.value = purchase_order_number;
            mapForm.appendChild(mapInput);

            document.body.appendChild(mapForm);

            map = window.open("", "Map", "status=0, title=0, height=800, width=1200, scrollbars=1");

            if (map) {
                mapForm.submit();
            } else {
                alert('You must allow popups for this map to work.');
            }
        }
    }
}

// List

function list_sales_order_detail(){
    window.open(base_url+'distribution/list-sales/sales-order');
}

// Print

function print_sales_order(){
    var sales_order_number = $('#sales_order_number').val();
    var id_transaction_role = $('#id_transaction_role').val();

    if (sales_order_number=='') {
        alert ('Select sales order number to process this action.');
    }
    else {
        if (id_transaction_role<=1) {
            alert ('Cannot process this action because status this transaction is hold.');
        }
        else {
            var sales_order_number_format = $('#sales_order_number_format').val();
            window.open(base_url+'report/pdf/sales-order/'+key_session+'/'+sales_order_number_format);
        }
    }
}

// ====================================================== LINE ======================================================================

function add_line(){
    let line_use = $('#total_line').val();

    let id_sales_order = $('#id_sales_order_line_'+line_use).val();
    let id_job_order = $('#id_job_order_'+line_use).val();
    let JobNo = $('#JobNo_'+line_use).val();
    let JobName = $('#JobName_'+line_use).val();
    let description = $('#description_'+line_use).val();
    let qty_order_line = $('#qty_order_line_'+line_use).val();
    let qty_shipment_line = $('#qty_shipment_line_'+line_use).val();
    let uom_cd_line = $('#uom_cd_line_'+line_use).val();
    let unit_price_line = $('#unit_price_line_'+line_use).val();
    let line_amount_line = $('#line_amount_line_'+line_use).val();
    let discount_amount_line = $('#discount_amount_line_'+line_use).val();
    let discount_percent_line = $('#discount_percent_line_'+line_use).val();
    let sub_tax_cd_line = $('#sub_tax_cd_line_'+line_use).val();
    let coa_cd_line = $('#coa_cd_line_'+line_use).val();
    let coa_name_line = $('#coa_name_line_'+line_use).val();

    console.log(description);

    if (description =='' || qty_order_line =='' || uom_cd_line =='' || unit_price_line =='' || line_amount_line =='' || sub_tax_cd_line =='' || coa_cd_line =='') {
        alert ('Line '+line_use+' may be empty, please try again.')
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

function view_purchase_receipt(){
    var id_purchase_order = $('#id_purchase_order').val();
    if (id_purchase_order=='') {
        alert ('Please select purchase order number to process this action.');
    }
    else {
        $('#list_purchase_receipt').dataTable().fnDestroy();
        $.ajax({
            url: base_url+'distribution/list-purchase-receipt-by-id-purchase-order/'+key_session+'/'+id_purchase_order,
            type: 'GET',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        $('#list_purchase_receipt').dataTable();
                    }
                    else {
                        $('#list_purchase_receipt tbody').html('');
                        var trList = '';
                        var response = responseGetList.response;
                        response.map(function(responseList){
                            var purchase_receipt_number = responseList.purchase_receipt_number;
                            var purchase_receipt_number_format = responseList.purchase_receipt_number_format;
                            var purchase_receipt_date = responseList.purchase_receipt_date;
                            var total_qty = responseList.total_qty;
                            var total_amount = responseList.total_amount;
                            var cNmPegawai_receipt = responseList.cNmPegawai_receipt;
                            var cNmPegawai = '';

                            if (responseList.cNmPegawai == null) {
                                cNmPegawai = '';
                            }
                            else {
                                cNmPegawai = responseList.cNmPegawai;
                            }

                            trList += '<tr>';  
                                trList += '<td><div onclick="purchase_receipt_detail(\''+purchase_receipt_number_format+'\');" style="color:blue;">'+purchase_receipt_number+'</div></td>';
                                trList += '<td>'+purchase_receipt_date+'</td>';
                                trList += '<td align="center">'+total_qty+'</td>';
                                trList += '<td align="right">'+total_amount+'</td>';
                                trList += '<td align="center">'+cNmPegawai_receipt+'</td>';
                                trList += '<td align="center">'+cNmPegawai+'</td>';
                            trList += '</tr>';
                        })
                        $('#list_purchase_receipt tbody').append(trList);
                        $('#list_purchase_receipt').dataTable();
                    }
                })
                $('#modal_purchase_receipt').modal('show');
            }
        })
    }
}

function list_purchase_receipt_close(){
    $('#modal_purchase_receipt').modal('hide');
}

function purchase_receipt_detail(purchase_receipt_number_format_get){
    window.open(base_url+'distribution/purchase/purchase-receipt/'+purchase_receipt_number_format_get)
}

// inventory 

function list_inventory(no_line_get){
    var vendor_quotation_number = $('#vendor_quotation_number').val();

    if (vendor_quotation_number=='') {
        alert('Please type quotation number to process this action.');
    }
    else {
        var id_account_project = $('#id_account_project').val();

        if (id_account_project=='') {
            alert('Please select project from to process this action.');
        }
        else {
            var cNIK_approval = $('#cNIK_approval').val();

            if (cNIK_approval=='') {
                alert('Please select Approval to process this action.');
            }
            else {
                $('#list_inventory').dataTable().fnDestroy();
                $('#modal_inventory').modal('show');
                
                $('#no_line_category').val(no_line_get);

                $('#list_inventory').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order": [],
                    "ajax" : {
                        'url' : base_url+'distribution/list-job-order-for-sales-order-datatable/'+key_session+'/'+id_account_project,
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

function select_change_inventory(no_get){
    $('.id_inventory').prop('checked', false);
    $('#id_inventory_'+no_get).prop('checked', true);
    $('#no_select_inventory').val('');
    $('#no_select_inventory').val(no_get);
}

function list_inventory_add(){
    var no_select = $('#no_select_inventory').val();
    var no_line_category = $('#no_line_category').val();

    console.log(no_line_category);
    
    $('#id_sales_order_line_'+no_line_category).val('');
    $('#id_job_order'+no_line_category).val('');
    $('#JobNo_'+no_line_category).val('');
    $('#JobName_'+no_line_category).val('');
    $('#description_'+no_line_category).val('');
    $('#qty_order_line_'+no_line_category).val('');
    $('#qty_shipment_line_'+no_line_category).val('');
    $('#uom_cd_line_'+no_line_category).val('');
    $('#unit_price_line_'+no_line_category).val('');
    $('#line_amount_line_'+no_line_category).val('');
    $('#discount_amount_line_'+no_line_category).val('');
    $('#discount_percent_line_'+no_line_category).val('');
    $('#sub_tax_cd_line_'+no_line_category).val('');
    $('#coa_cd_line_'+no_line_category).val('');
    $('#coa_name_line_'+no_line_category).val('');

    var id_account_project = $('#id_account_project').val();

    var part_no_hide = $('#part_no_hide').val();

    $.ajax({
        url: base_url+'jom/list-job-order/'+key_session+'/'+id_account_project+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    alert ('Data not found, please try again.');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        
                        var id_job_order = responseList.id_job_order;
                        
                        if (id_job_order_array.includes(id_job_order)) {
                            alert('Job order has already, please select other job.');
                        }
                        else {
                            var JobNo = responseList.JobNo;
                            var JobName = responseList.JobName;
                            var part_name = responseList.part_name;
                            var Qty = responseList.Qty;
                            var Amount = responseList.Amount;

                            id_job_order_array.push(id_job_order);                        

                            $('#id_sales_order_line_'+no_line_category).val(id_job_order);
                            $('#JobNo_'+no_line_category).val(JobNo);
                            $('#JobName_'+no_line_category).val(JobName);
                            $('#description_'+no_line_category).val(JobName);
                            $('#qty_order_line_'+no_line_category).val(Qty);
                            $('#qty_shipment_line_'+no_line_category).val(0);
                            $('#unit_price_line_'+no_line_category).val(Amount);
                            $('#line_sub_amount_line_'+no_line_category).val(Amount);
                            $('#discount_amount_line_'+no_line_category).val(0);
                            $('#discount_percent_line_'+no_line_category).val(0);
                            $('#line_amount_line_'+no_line_category).val(Amount);

                            list_inventory_close();
                        }
                        
                    })
                }
            })
        }
    })
}

function list_inventory_close(){
    $('#modal_inventory').modal('hide');
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

// warehouse

function list_warehouse(no_line_get){
    $('#list_warehouse').dataTable().fnDestroy();
    $('#modal_warehouse').modal('show');

    $('#no_line_warehouse').val('');
    $('#no_line_warehouse').val(no_line_get);

    $('#list_warehouse').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-warehouse-datatable/'+key_session+'/0',
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

function select_change_warehouse(no_get){
    $('.warehouse_cd').prop('checked', false);
    $('#warehouse_cd_'+no_get).prop('checked', true);

    $('#no_select_warehouse').val('');
    $('#no_select_warehouse').val(no_get);
}

function list_warehouse_add(){

    var no_select_warehouse = $('#no_select_warehouse').val();
    var no_line_warehouse = $('#no_line_warehouse').val();

    var warehouse_cd_value = $('#warehouse_cd_'+no_select_warehouse).val();
    let warehouse_cd_split = warehouse_cd_value.split(" // ");

    var  warehouse_cd = warehouse_cd_split[0];
    var warehouse_name = warehouse_cd_split[1];
        
    $('#warehouse_name_line_'+no_line_warehouse).val('');
    $('#warehouse_name_line_'+no_line_warehouse).val(warehouse_cd);

    list_warehouse_close();
}

function list_warehouse_close(){
    $('#modal_warehouse').modal('hide');
}

// Blank PO Line

function sales_order_line_blank(transaction_number){
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
            'url' : base_url+'distribution/sales-order-line-blank/'+key_session+'/'+transaction_number,
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

function line_use(){
    var line_use = $('#line_use').val();
    document.getElementById('qty_order_'+line_use).removeAttribute('readonly');
}

// ============================================================== PRICE CALCULATION ===============================================================

function price_calculation(no_line_get){
    console.log(no_line_get);

    var qty_order_line = $('#qty_order_line_'+no_line_get).val();
    var unit_price_line = $('#unit_price_line_'+no_line_get).val();
    var discount_amount_line = $('#discount_amount_line_'+no_line_get).val();
    var discount_percent_line = $('#discount_percent_line_'+no_line_get).val();

    let line_amount_line = '';
    let line_sub_amount_line = '';
    
    if (isNaN(qty_order_line*1)) {
        alert ('Your qty field is not number, please try again. '+(qty_order_line)+' / '+no_line_get);
        $('#qty_order_line_'+no_line_get).val('0');
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
            line_sub_amount_line = qty_order_line*unit_price_line;
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

function price_header(){
    var line_use = $('#total_line').val();
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

                    for (var a=1; a<=line_use; a++){
                        let qty_order_line = $('#qty_order_line_'+a).val();
                        total_qty += qty_order_line*1;

                        let discount_amount_line = $('#discount_amount_line_'+a).val();
                        discount_amount += discount_amount_line*1;

                        let line_sub_amount_line = $('#line_sub_amount_line_'+a).val();
                        sub_amount += line_sub_amount_line*1;
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

// =========================================================== REMOVE LINE =========================================================================

function remove_line(no_line_get){
    if (confirm('Are you sure you want to reset line number '+no_line_get+' ?')) {
        $('#id_sales_order_line_'+no_line_get).val('');
        $('#id_job_order'+no_line_get).val('');
        $('#JobNo_'+no_line_get).val('');
        $('#JobName_'+no_line_get).val('');
        $('#description_'+no_line_get).val('');
        $('#qty_order_line_'+no_line_get).val('');
        $('#qty_shipment_line_'+no_line_get).val('');
        $('#uom_cd_line_'+no_line_get).val('');
        $('#unit_price_line_'+no_line_get).val('');
        $('#line_amount_line_'+no_line_get).val('');
        $('#discount_amount_line_'+no_line_get).val('');
        $('#discount_percent_line_'+no_line_get).val('');
        $('#sub_tax_cd_line_'+no_line_get).val('');
        $('#coa_cd_line_'+no_line_get).val('');
        $('#coa_name_line_'+no_line_get).val('');
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