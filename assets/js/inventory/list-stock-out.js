$(document).ready(function(){
    list_stock_out();
})

function list_stock_out(){
    $('#list_stock_out').dataTable().fnDestroy();

    $('#list_stock_out').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-stock-out-datatable/'+key_session+'/'+category,
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

function remove_stock_out(no_get, id_stock_out_get, id_inventory_get, inventory_name_get, qty_get){
    if (confirm('Are you sure you want to delete '+inventory_name_get+'?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'inventory/delete-stock-out/'+key_session,
            type: 'POST',
            data: 'id_stock_out='+id_stock_out_get+'&id_inventory='+id_inventory_get+'&qty='+qty_get+'&category=cs',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                modal_loading_hide();
                console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            list_stock_out();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully', response);
                        /*setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);*/
                    }
                })
            }
        })
    }
}

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