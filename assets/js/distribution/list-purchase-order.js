$(document).ready(function(){
    list_purchase_order();
})

// Purchase Order

function list_purchase_order(){
    $('#list_purchase_order').dataTable().fnDestroy();
    $('#modal_purchase_order').modal('show');

    $('#list_purchase_order').DataTable({
        "scrollY":        "500px",
        "scrollX":        true,
        "scrollCollapse": true,
        "processing" : true,
        "serverSide" : true,
        "bPaginate" : false,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-purchase-order-datatable/'+key_session+'/'+id_module,
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

function approve(no_get, id_puchase_order_get, id_transaction_role_new_get, purchase_order_number_get, transaction_name_new_get){
    //alert (no_get+' '+id_puchase_order_get+' '+id_transaction_role_new_get+' '+' '+purchase_order_number_get);
    if (confirm('Are you sure you want to approve purchase order nomor '+purchase_order_number_get+' ?')) {
        $.ajax({
            url: base_url+'distribution/update-purchase-order-approve/'+key_session+'/0',
            type: 'POST',
            data: 'id_puchase_order='+id_puchase_order_get+'&id_transaction_role='+id_transaction_role_new_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        //detail_header(transaction_number);
                        $('#transaction_name_'+no_get).html('');
                        $('#transaction_name_'+no_get).prop('style', 'height:45px; padding:5px; color:white;');
                        $('#transaction_name_'+no_get).html(transaction_name_new_get);
                        $('#transaction_name_'+no_get).prop('onclick', false);
                    }
                    else {
                        alert('Data not updated');
                    }
                })
            }
        })
    }
}

function detail_receipt(purchase_order_number_format_get){
    window.open(base_url+'distribution/purchase/purchase-order/'+purchase_order_number_format_get);
}

function search_transaction(){
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();

    if (date_start == '' || date_end == '') {
        alert('Date Cannot Empty, Please Try Again.');
    }
    else {
        $('#list_purchase_order').dataTable().fnDestroy();
        $('#list_purchase_order').DataTable({
            "scrollY":        "500px",
            "scrollX":        true,
            "scrollCollapse": true,
            "processing" : true,
            "serverSide" : true,
            "bPaginate" : false,
            "order": [],
            "ajax" : {
                'url' : base_url+'distribution/list-purchase-order-by-date-datatable/'+key_session+'/'+id_module+'/'+date_start+'/'+date_end,
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