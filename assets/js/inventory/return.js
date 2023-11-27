$(document).ready(function(){
    list_inventory_datatable();
})

function list_inventory_datatable(){
    $('#list_inventory').dataTable().fnDestroy();

    $('#list_inventory').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-inventory-return-datatable/'+key_session+'/0',
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

function returns(no_get, id_purchase_receipt_line_get, id_total_count_in_line_get, description_get){
    let qty = $('#qty_'+no_get).val();
    let qty_used = $('#qty_used_'+no_get).val();

    if ((qty_used)*1 > (qty)*1) {
        alert ('Qty return cannot more than qty receipt.');
    }
    else {
        if (confirm('Are you sure you want to return '+description_get+' ?')) {
            modal_loading_open('bg-info', 'Returning data', 'Please wait...');
            $.ajax({
                url: base_url+'inventory/add-return/'+key_session,
                type: 'post',
                data: 'id_purchase_receipt_line='+id_purchase_receipt_line_get+'&id_total_count_in_line='+id_total_count_in_line_get+'&qty_used='+qty_used,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    //console.log(responseGet);
                    modal_loading_hide();
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            modal_loading_open('bg-primary', 'Returning data successfully', 'Please wait for hide this view...');
                            setTimeout(function () {
                                modal_loading_hide();
                                list_inventory_datatable();
                            }, 5000);
                        }
                        else {
                            var response = responseGetList.response;
                            modal_loading_open('bg-danger', 'Returning data unsuccessfully', response);
                            /*setTimeout(function () {
                                modal_loading_hide();
                            }, 5000);*/
                        }
                    })
                }
            })
        } 
    }
}

function list_return(){
    window.open(base_url+'inventory/list-return');
}

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