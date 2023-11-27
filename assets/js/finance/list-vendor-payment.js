$(document).ready(function(){
    list_transaction();
})

// ======================================================================= HEADER =============================================================

// Purchase invoice

function list_transaction(){
    $('#list_transaction').dataTable().fnDestroy();
    var transaction_periode = $('#transaction_periode').val();
    console.log(base_url+'finance/list-transaction-by-transaction-periode/'+key_session+'/'+transaction_periode+'/VP');
    $.ajax({
        url: base_url+'finance/list-transaction-by-transaction-periode/'+key_session+'/'+transaction_periode+'/VP',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_transaction').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var account_name = responseList.account_name;
                        var transaction_number = responseList.transaction_number;
                        var total_transaction_distribution = responseList.total_transaction_distribution;
                        var cury_amount = responseList.cury_amount;
                        var ppn = responseList.ppn;
                        var pph = responseList.pph;

                        trList += '<tr>';
                            trList += '<td>'+(i+1)+'</td>';
                            trList += '<td>'+account_name+'</td>';
                            trList += '<td>'+transaction_number+'</td>';
                            trList += '<td align="center">'+total_transaction_distribution+'</td>';
                            trList += '<td align="right" style="padding-right:20px;">'+cury_amount+'</td>';
                            trList += '<td align="right" style="padding-right:20px;">'+ppn+'</td>';
                            trList += '<td align="right" style="padding-right:20px;">'+pph+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_transaction tbody').append(trList);
                    $('#list_transaction').dataTable();
                }
            })
        }
    })
}

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