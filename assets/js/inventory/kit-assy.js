$(document).ready(function(){
     $('#list_purchase_receipt_line').DataTable();
     $('#list_kit_assy_line').DataTable();
})

// =======================================================================================================================

function list_job_order(){

    $('#modal_job_order').modal('show');

    $('#list_job_order').dataTable().fnDestroy();
    $('#list_job_order').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-job-order-datatable/'+key_session,
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

function select_change_job_order(no_get){
    $('#no_select_job_order').val('');
    $('.id_job_order').prop('checked', false);
    
    $('#no_select_job_order').val(no_get);
    $('#id_job_order_'+no_get).prop('checked', true);
}

function list_job_order_add(){
    var no_select_job_order = $('#no_select_job_order').val();
    var id_job_order = $('#id_job_order_'+no_select_job_order).val();

    $('#JobNo').val('');
    $('#JobNo').val(id_job_order);

    list_job_order_close();
    list_purchase_receipt_by_jobno(id_job_order);
    list_kit_assy_by_jobno(id_job_order);
    kit_assy_by_jobno(id_job_order);
    list_kit_assy_summary(id_job_order)
}

function list_job_order_close(){
    $('#modal_job_order').modal('hide');
}

// =======================================================================================================================
    
function list_purchase_receipt_by_jobno(JobNo_get){
    $('#list_purchase_receipt_line').dataTable().fnDestroy();
    $('#list_purchase_receipt_line').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'distribution/list-purchase-receipt-line-by-jobno-datatable/'+key_session+'/'+JobNo_get,
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

function list_kit_assy_by_jobno(JobNo_get){
    $('#list_kit_assy_line').dataTable().fnDestroy();
    $('#list_kit_assy_line').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-kit-assy-line-by-jobno-datatable/'+key_session+'/'+JobNo_get,
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

function kit_assy_by_jobno(JobNo_get){
    $.ajax({
        url: base_url+'inventory/list-kit-assy-by-jobno/'+key_session+'/'+JobNo_get,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                $('#total_amount').html('');
                $('#kit_assy_number').val('');
                var status = responseGetList.status;
                if (status==0) {
                    $('#total_amount').append('0');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var kit_assy_number = responseList.kit_assy_number;
                        var total_amount = responseList.total_amount;

                        $('#kit_assy_number').val(kit_assy_number);
                        $('#total_amount').append(total_amount);
                    })
                }
            })
        }
    })
}

function list_kit_assy_summary(JobNo_get){
    $.ajax({
        url: base_url+'inventory/list-kit-assy-by-job-amount-summary/'+key_session+'/'+JobNo_get,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                $('#list_kit_assy_summary tbody').html('');
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<tr><td colspan="3" align="center">Data not found.</td></tr>'
                }
                else {
                    var response = responseGetList.response;
                    var trList = '';
                    response.map(function(responseList, i){
                        var item_class_name = responseList.item_class_name;
                        var total_amount = responseList.total_amount;

                        trList += '<tr>';
                            trList += '<td>'+(i+1)+'</td>';
                            trList += '<td>'+item_class_name+'</td>';
                            trList += '<td align="right">'+total_amount+'</td>';
                        trList += '</tr>';
                    })
                }
                $('#list_kit_assy_summary tbody').append(trList);
            })
        }
    })
}

function kit_assy(){
    var count = document.getElementsByName("count")[0].value;
    var JobNo = $('#JobNo').val();
    
    const id_purchase_receipt_line_array = [];
    const qty_used_array = [];

    let count_after = 0;

    for (var i = 1; i <= count; i++) {
        var id_purchase_receipt_line_check = $('#id_purchase_receipt_line_'+i).prop('checked');
        if (id_purchase_receipt_line_check == true) {
            var id_purchase_receipt_line = $('#id_purchase_receipt_line_'+i).val();
            id_purchase_receipt_line_array.push(id_purchase_receipt_line);

            let qty_used = $('#qty_used_'+i).val();
            qty_used_array.push(qty_used);

            count_after += 1;
        }
    }

    if (count_after==0) {
        alert ('Please select inventroy first to process this action.');
    }
    else {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'inventory/add-kit-assy/'+key_session,
            type: 'POST',
            data: 'id_purchase_receipt_line_array='+id_purchase_receipt_line_array+'&qty_used_array='+qty_used_array+'&count_after='+count_after+'&JobNo='+JobNo,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status[0]==1) {
                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function() {
                            list_purchase_receipt_by_jobno(JobNo);
                            list_kit_assy_by_jobno(JobNo);
                            kit_assy_by_jobno(JobNo);
                            list_kit_assy_summary(JobNo)
                            modal_loading_hide();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Error : '+response);
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 15000);
                    }
                })
            }
        })
    }

}

function list_kit_assy(){
    window.open(base_url+'inventory/list-kit-assy');
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