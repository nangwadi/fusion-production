$(document).ready(function(){
    list_cash_account(0);
    list_transaction_type('OUT');
})

// ========================== HEADER ===================================================

function list_cash_account(id_cash_account_get){
    $.ajax({
        url: base_url+'coa/list-cash-account/'+key_session+'/'+id_cash_account_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList_default = '';
            var trList = '';
            $('#id_cash_account').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_cash_account = responseList.id_cash_account;
                        var coa_name = responseList.coa_name;
                        var set_default = responseList.set_default;
                        var deleted = responseList.deleted;
                        
                        if (deleted==0) {
                            if (set_default==1) {
                                trList_default += '<option value="'+id_cash_account+'">'+coa_name+'</option>';
                                //list_balance(id_cash_account);
                                numbering_sequence(id_module, id_cash_account);
                                list_transaction_line(id_module, id_cash_account, 0);
                            }
                            else {
                                trList += '<option value="'+id_cash_account+'">'+coa_name+'</option>';
                            }
                        }
                    })
                }
            })
            $('#id_cash_account').append(trList_default);
            $('#id_cash_account').append(trList);
        }
    });
}

function list_balance(id_cash_account_get){
    var transaction_periode = '';
    var id_cash_account = '';
    if (id_cash_account_get==0) {
        id_cash_account = $('#id_cash_account').val();
        transaction_periode = $('#transaction_periode').val();
    }
    else {
        id_cash_account = id_cash_account_get;
        transaction_periode = transaction_periode_default;
    }

    $.ajax({
        url: base_url+'finance/list-balance/'+key_session+'/'+transaction_periode+'/'+id_cash_account,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);

            $('#begin_balance').val('');
            $('#total_debet').val('');
            $('#total_credit').val('');
            $('#ending_balance').val('');

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#begin_balance').val(0);
                    $('#total_debet').val(0);
                    $('#total_credit').val(0);
                    $('#ending_balance').val(0);
                }
                else {
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

                        $('#begin_balance').val(begin_balance_format);
                        $('#total_debet').val(total_debet_format);
                        $('#total_credit').val(total_credit_format);
                        $('#ending_balance').val(ending_balance_format);
                    })
                }
            })
        }
    });
}

function list_transaction_type(transaction_type_get){
    $('#transaction_type').html('');
    var trList = '';
    if (transaction_type_get=='IN') {
        trList += '<option value="IN">IN</option>';
        trList += '<option value="OUT">OUT</option>';
    }
    else {
        trList += '<option value="OUT">OUT</option>';
        trList += '<option value="IN">IN</option>';
    }
    $('#transaction_type').append(trList);
}

function numbering_sequence(id_module_get, id_cash_account_get){

    var transaction_periode = '';
    var id_cash_account = '';
    if (id_cash_account_get==0) {
        id_cash_account = $('#id_cash_account').val();
        transaction_periode = $('#transaction_periode').val();
    }
    else {
        id_cash_account = id_cash_account_get;
        transaction_periode = transaction_periode_default;
    }

    $.ajax({
        url: base_url+'finance/numbering-sequence/'+key_session+'/'+id_module_get+'/'+id_cash_account+'/'+transaction_periode,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var numbering_sequence = responseList.numbering_sequence;
                        $('#transaction_number').val('');
                        $('#transaction_number').val(numbering_sequence);
                    })
                }
            })
        },
        error : function(error){
            location.reload(true);
        }
    });
}

function button_add_line(){
    var total_line = $('#total_line').val();
    $('#total_line').val('');
    $('#total_line').val(((total_line*1)+1));

    var id_cash_account = $('#id_cash_account').val();
    var transaction_periode = $('#transaction_periode').val();
    var begin_balance = $('#begin_balance').val();
    var total_debet = $('#total_debet').val();
    var total_credit = $('#total_credit').val();
    var ending_balance = $('#ending_balance').val();
    var transaction_date = $('#transaction_date').val();
    var transaction_type = $('#transaction_type').val();
    var transaction_number = $('#transaction_number').val();
    var note = $('#note').val();

    if (id_cash_account == '' || transaction_periode == '' || begin_balance == '' || total_debet == '' || total_credit == '' || ending_balance == '' || transaction_date == '' || transaction_type == '' || transaction_number == '' || note == '') {
        alert ('Data header cannot empty, please review again.');
    }
    else {
        var trList = '';
        list_coa(((total_line*1)+1));

        div_button_save();

        trList += '<tr id="line_'+((total_line*1)+1)+'">';
            trList += '<td><input type="text" class="form-control" id="id_coa_'+((total_line*1)+1)+'" list="list_coa_line_'+((total_line*1)+1)+'"><datalist id="list_coa_line_'+((total_line*1)+1)+'"></datalist></td>';
            trList += '<td><input type="text" class="form-control" id="note_line_'+((total_line*1)+1)+'"></td>';
            trList += '<td><input type="text" class="form-control" value="0" onkeyup="currency_format(\''+((total_line*1)+1)+'\', \'debet\');" id="nominal_debet_'+((total_line*1)+1)+'"></td>';
            trList += '<td><input type="text" class="form-control" value="0" onkeyup="currency_format(\''+((total_line*1)+1)+'\', \'credit\');" id="nominal_credit_'+((total_line*1)+1)+'"></td>';
            trList += '<td align="center"><button class="btn btn-danger me-2" onclick="button_remove_line(\''+((total_line*1)+1)+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
        trList += '</tr>';

        $('#transaction_line tbody').append(trList);
    }
}

// ========================== END HEADER ===============================================

// ========================== LINE =====================================================

function button_remove_line(line_number_get){
    var row = document.getElementById('line_'+line_number_get);
    row.parentNode.removeChild(row);

    var total_line = $('#total_line').val();
    var total_line_new = total_line-1;
    $('#total_line').val('');
    $('#total_line').val(total_line_new*1);
}

function list_coa(line_number_get){
    $.ajax({
        url: base_url+'coa/list-chart-of-account/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            $('#list_coa_line_'+line_number_get).html('');
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    //$('#list_coa').dataTable();
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_coa = responseList.id_coa;
                        var coa_cd = responseList.coa_cd;
                        var coa_name = responseList.coa_name;

                        trList += '<option>'+coa_cd+' / '+coa_name+'</option>';
                    })
                }
            })
            $('#list_coa_line_'+line_number_get).append(trList);
        },
        error : function(error){
            location.reload(true);
        }
    });
}

function currency_format(line_number_get, category_get){
    if (category_get=='debet') {
        var nominal_debet = $('#nominal_debet_'+line_number_get).val();
        var nominal_debet_replace = nominal_debet.replace(/\,/g,'');
        if (isNaN(nominal_debet_replace*1) == true){
            alert ('Please type number only.');

            $('#nominal_debet_'+line_number_get).val('');
            $('#nominal_debet_'+line_number_get).val(0);
        }
        else {
            let nominal = (nominal_debet_replace*1);
            var currency_format = formatMoney(nominal);

            $('#nominal_debet_'+line_number_get).val('');
            $('#nominal_debet_'+line_number_get).val(currency_format);
        }
    }
    else if (category_get=='credit') {
        var nominal_credit = $('#nominal_credit_'+line_number_get).val();
        var nominal_credit_replace = nominal_credit.replace(/\,/g,'');
        if (isNaN(nominal_credit_replace*1) == true){
            alert ('Please type number only.');

            $('#nominal_credit_'+line_number_get).val('');
            $('#nominal_credit_'+line_number_get).val(0);
        }
        else {
            let nominal = (nominal_credit_replace*1);
            var currency_format = formatMoney(nominal);

            $('#nominal_credit_'+line_number_get).val('');
            $('#nominal_credit_'+line_number_get).val(currency_format);
        }
    }
}

function formatMoney(number_get){
    let number = number_get.toString();
    var number_format = '';
    if (number.length<=3) {
        number_format = number;
    }
    else if (number.length==4) {
        number_format = number.substring(0, 1)+','+number.substring(1, 4);
    }
    else if (number.length==5) {
        number_format = number.substring(0, 2)+','+number.substring(2, 5);
    }
    else if (number.length==6) {
        number_format = number.substring(0, 3)+','+number.substring(3, 6);
    }
    else if (number.length==7) {
        number_format = number.substring(0, 1)+','+number.substring(1, 4)+','+number.substring(4, 7);
    }
    else if (number.length==8) {
        number_format = number.substring(0, 2)+','+number.substring(2, 5)+','+number.substring(5, 8);
    }
    else if (number.length==9) {
        number_format = number.substring(0, 3)+','+number.substring(3, 6)+','+number.substring(6, 9);
    }
    else if (number.length==10) {
        number_format = number.substring(0, 1)+','+number.substring(1, 4)+','+number.substring(4, 7)+','+number.substring(7, 10);
    }
    else if (number.length==11) {
        number_format = number.substring(0, 2)+','+number.substring(2, 5)+','+number.substring(5, 8)+','+number.substring(8, 11);
    }
    else if (number.length==12) {
        number_format = number.substring(0, 4)+','+number.substring(3, 6)+','+number.substring(6, 9)+','+number.substring(9, 12);
    }
    //console.log(number.length);
    return number_format;
}

function div_button_save(){
    var total_line = $('#total_line').val();
    if (total_line*1 == 0) {
        $('#div_button_save').prop('style', 'display:none');
    }
    else {
        $('#div_button_save').prop('style', 'display:block');
    }
}

// ========================== END LINE =================================================

// ========================== BUTTON SAVE ==============================================

function save_transaction(){
    var total_line = $('#total_line').val();
    var id_transaction = $('#id_transaction').val();
    var id_cash_account = $('#id_cash_account').val();
    var transaction_periode = $('#transaction_periode').val();
    var begin_balance = ($('#begin_balance').val()).replace(/\,/g,'');
    var total_debet = ($('#total_debet').val()).replace(/\,/g,'');
    var total_credit = ($('#total_credit').val()).replace(/\,/g,'');
    var ending_balance = ($('#ending_balance').val()).replace(/\,/g,'');
    var transaction_date = $('#transaction_date').val();
    var transaction_type = $('#transaction_type').val();
    var transaction_number = $('#transaction_number').val();
    var note = $('#note').val();

    const id_coa_array = [];
    const note_line_array = [];
    const nominal_debet_array = [];
    const nominal_credit_array = [];

    let total_error = 0;

    if (total_line*1==0) {
        alert ('No transaction line, please try again.');
    }
    else {
        if (note=='') {
            alert ('Pay To / From cannot empty, please try again.');
        }
        else {
            for (var i = 1; i <= (total_line*1); i++) {
                var id_coa = ($('#id_coa_'+i).val()).replace(/\&/g, '');
                var note_line = $('#note_line_'+i).val();
                var nominal_debet_get = $('#nominal_debet_'+i).val();
                var nominal_credit_get = $('#nominal_credit_'+i).val();

                var nominal_debet = nominal_debet_get.replace(/\,/g,'');
                var nominal_credit = nominal_credit_get.replace(/\,/g,'');

                if (id_coa == '') {
                    alert ('Data COA line cannot empty.');
                    total_error += 1;
                }
                else {
                    if (note_line == '') {
                        alert ('Data Note line cannot empty.');
                        total_error += 1;
                    }
                    else {
                        if (nominal_debet == '') {
                            alert ('Data Debet line cannot empty.');
                            total_error += 1;
                        }
                        else {
                            if (nominal_credit == '') {
                                alert ('Data credit line cannot empty.');
                                total_error += 1;
                            }
                            else {
                                id_coa_array.push(id_coa);
                                note_line_array.push(note_line);
                                nominal_debet_array.push(nominal_debet);
                                nominal_credit_array.push(nominal_credit);
                            }
                        }
                    }
                }
            }
        }
    }
    if (total_error>=1) {
        alert ('Data line cannot empty, please try again.');
    }
    else {
        console.log(id_coa_array);
        console.log(note_line_array);
        console.log(nominal_debet_array);
        console.log(nominal_credit_array);

        if (id_transaction == '') {
            modal_loading_open('bg-info', 'Saving data', 'Please wait...');
        }
        else {
            modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        }

        $.ajax({
            url: base_url+'finance/add-petty-cash/'+key_session+'/'+id_module,
            type: 'POST',
            data: 'id_cash_account='+id_cash_account+'&total_line='+total_line+'&transaction_periode='+transaction_periode+'&begin_balance='+begin_balance+'&total_debet='+total_debet+'&total_credit='+total_credit+'&ending_balance='+ending_balance+'&transaction_date='+transaction_date+'&transaction_type='+transaction_type+'&transaction_number='+transaction_number+'&note='+note
                    +'&id_coa_array='+(JSON.stringify(id_coa_array))
                    +'&note_line_array='+(JSON.stringify(note_line_array))
                    +'&nominal_debet_array='+(JSON.stringify(nominal_debet_array))
                    +'&nominal_credit_array='+(JSON.stringify(nominal_credit_array)),
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status[0]==1) {
                        if (id_transaction == '') {
                            modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait...');
                        }
                        else {
                            modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait...');
                        }

                        setTimeout(function () {
                            modal_loading_hide();
                            location.reload(true);
                        }, 5000);
                    }
                    else {
                        if (id_transaction == '') {
                            modal_loading_open('bg-danger', 'Saving data unsuccessfully.', 'Please wait for hide this view...');
                        }
                        else {
                            modal_loading_open('bg-danger', 'Updating data unsuccessfully.', 'Please wait for hide this view...');
                        }
                        
                        setTimeout(function () {
                            modal_loading_hide();
                            location.reload(true);
                        }, 5000);
                    }
                })
            }
        })
    }
}

// ========================== END BUTTON SAVE ==========================================

function list_transaction_line(id_module_get, id_cash_account_get, id_transaction_line_get){

    transaction_periode = $('#transaction_periode').val();

    $.ajax({
        url: base_url+'finance/list-transaction-line/'+key_session+'/'+id_module_get+'/'+id_cash_account_get+'/'+transaction_periode+'/'+id_transaction_line_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#begin_balance').val('');
            $('#total_debet').val('');
            $('#total_credit').val('');
            $('#ending_balance').val('');
            var begin_balance_format_input = '';
            var total_debet_format_input = '';
            var total_credit_format_input = '';
            var ending_balance_format_input = '';

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_transaction_line').dataTable();
                    $('#begin_balance').val('0.00');
                    $('#total_debet').val('0.00');
                    $('#total_credit').val('0.00');
                    $('#ending_balance').val('0.00');
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var begin_balance_format = responseList.begin_balance_format;
                        var total_debet_format = responseList.total_debet_format;
                        var total_credit_format = responseList.total_credit_format;

                        var id_transaction_line = responseList.id_transaction_line;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var transaction_date = responseList.transaction_date;
                        var transaction_date_format = responseList.transaction_date_format;
                        var transaction_periode = responseList.transaction_periode;
                        var transaction_type = responseList.transaction_type;
                        var transaction_number = responseList.transaction_number;
                        var id_module = responseList.id_module;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var id_coa_debet = responseList.id_coa_debet;
                        var coa_cd_debet = responseList.coa_cd_debet;
                        var coa_name_debet = responseList.coa_name_debet;
                        var description_debet = responseList.description_debet;
                        var nominal_debet = responseList.nominal_debet;
                        var nominal_debet_format = responseList.nominal_debet_format;
                        var id_coa_credit = responseList.id_coa_credit;
                        var coa_cd_credit = responseList.coa_cd_credit;
                        var coa_name_credit = responseList.coa_name_credit;
                        var description_credit = responseList.description_credit;
                        var nominal_credit = responseList.nominal_credit;
                        var nominal_credit_format = responseList.nominal_credit_format;
                        var nominal_balance = responseList.nominal_balance;
                        var nominal_balance_format = responseList.nominal_balance_format;
                        var note_line = responseList.note_line;
                        var note_header = responseList.note_header;
                        var number_source = responseList.number_source;
                        var inventory_id = responseList.inventory_id;
                        var qty = responseList.qty;
                        var unit_price = responseList.unit_price;
                        var unit_price_format = responseList.unit_price_format;
                        var cury_unit_price = responseList.cury_unit_price;
                        var cury_unit_price_format = responseList.cury_unit_price_format;
                        var amount = responseList.amount;
                        var amount_format = responseList.amount;
                        var cury_amount = responseList.cury_amount;
                        var cury_amount_format = responseList.cury_amount_format;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        begin_balance_format_input = begin_balance_format;
                        total_debet_format_input = total_debet_format;
                        total_credit_format_input = total_credit_format;
                        ending_balance_format_input = nominal_balance_format;

                        var coa_cd = '';
                        if (id_coa_debet == null) {
                            coa_cd = coa_cd_credit+' / '+coa_name_credit;
                        }
                        else {
                            coa_cd = coa_cd_debet+' / '+coa_name_debet;
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+transaction_date_format+'</td>';
                            trList += '<td style="color:white;"><div onclick="print_petty_cash(\''+transaction_number+'\', \''+transaction_date+'\');">'+transaction_number+'</div></td>';
                            trList += '<td style="color:white;">'+note_header+'</td>';
                            trList += '<td style="color:white;">'+coa_cd+'</td>';
                            trList += '<td style="color:white;">'+note_line+'</td>';
                            trList += '<td style="color:white;" align="right">'+nominal_debet_format+'</td>';
                            trList += '<td style="color:white;" align="right">'+nominal_credit_format+'</td>';
                            trList += '<td style="color:white;" align="right">'+nominal_balance_format+'</td>';
                            trList += '<td style="color:white;"></td>';
                        trList += '</tr>';
                    })
                    $('#list_transaction_line tbody').append(trList);
                    $('#list_transaction_line').dataTable();


                    $('#begin_balance').val(begin_balance_format_input);
                    $('#total_debet').val(total_debet_format_input);
                    $('#total_credit').val(total_credit_format_input);
                    $('#ending_balance').val(ending_balance_format_input);
                }
            })
        }
    });
}

function print_petty_cash(transaction_number_get, transaction_date_get){
    window.open('https://fusion-server.meiwa-m.co.id/fusion-dev/report/pdf/petty-cash/'+key_session+'/'+transaction_number_get+'/'+transaction_date_get, '_blank');
}

/*function add_numbering_sequence(){
    var string_format = $('#string_format').val();
    var cut_1 = $('#cut_1').val();
    var cut_2 = $('#cut_2').val();
    var cut_3 = $('#cut_3').val();
    var number_length = $('#number_length').val();

    $.ajax({
        url: base_url+'finance/add-numbering-sequence/'+key_session,
        type: 'post',
        data: 'string_format='+string_format+'&cut_1='+cut_1+'&cut_2='+cut_2+'&cut_3='+cut_3+'&number_length='+number_length+'&id_module='+id_module,
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

function list_numbering_sequence(id_module){
    $('#list_module').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'finance/list-numbering-sequence/'+key_session+'/'+id_module,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    $('#cut_1').html('');
                    $('#cut_2').html('');
                    $('#cut_3').html('');
                    $('#string_format').val('');
                    $('#number_length').val('');

                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var string_format = responseList[0].string_format;
                        var number_length = responseList[0].number_length;
                        var cut_1 = responseList[0].cut_1;
                        var cut_2 = responseList[0].cut_2;
                        var cut_3 = responseList[0].cut_3;
                        
                        $('#string_format').val(string_format);
                        $('#number_length').val(number_length);

                        var options_1 = '';
                        if (cut_1=='/') {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="-">-</option>';
                        }
                        else {
                            options_1 += '<option value="'+cut_1+'">'+cut_1+'</option>';
                            options_1 += '<option value="/">/</option>';
                        }

                        var options_2 = '';
                        if (cut_2=='/') {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="-">-</option>';
                        }
                        else {
                            options_2 += '<option value="'+cut_2+'">'+cut_2+'</option>';
                            options_2 += '<option value="/">/</option>';
                        }

                        var options_3 = '';
                        if (cut_3=='/') {
                            options_3 += '<option value="'+cut_3+'">'+cut_3+'</option>';
                            options_3 += '<option value="-">-</option>';
                        }
                        else {
                            options_3 += '<option value="'+cut_3+'">'+cut_3+'</option>';
                            options_3 += '<option value="/">/</option>';
                        }

                        $('#cut_1').append(options_1);
                        $('#cut_2').append(options_2);
                        $('#cut_3').append(options_3);
                    })
                }
            })
        }
    });
}

function update(id_module_get, module_cd_get, module_name_get, file_name_get, id_module_category_get, module_category_name_get){
    $('#id_module').val(id_module_get);
    $('#module_cd').val(module_cd_get);
    $('#module_name').val(module_name_get);
    $('#file_name').val(file_name_get);

    list_module_category(id_module_category_get, module_category_name_get)
}

function reset_form(){
    $('#id_module').val('');
    $('#module_cd').val('');
    $('#module_name').val('');
    $('#file_name').val('');

    list_module_category(0, 0);
}

function disable_enable(id_module_get, module_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_module_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_module_disen').val(id_module_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+module_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+module_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+module_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_module(){
    var id_module = $('#id_module_disen').val();
    var deleted = $('#value_disen').val();

    //console.log(id_module+' '+deleted);

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'finance/update-module/'+key_session,
        type: 'post',
        data: 'id_module='+id_module+'&deleted='+deleted,
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
                        list_module(0);
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
}*/

function modal_loading_open(backgroundcolor, values_header, values_body){
    document.getElementById('modal_header').setAttribute('class', 'modal-header '+backgroundcolor);
    $('#modal_title').html('');
    $('#modal_body').html('');
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