$(document).ready(function(){
    list_part_list(0);
})

function list_job(){
    $('#modal_job_order').modal('show');
    $('#list_job').dataTable().fnDestroy();
    $('#list_job').dataTable({
        "scrollY":        "500px",
        "scrollX":        true,
        "scrollCollapse": true,
        "processing" : true,
        "serverSide" : true,
        "bPaginate" : false,
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
        "fixedColumns":   {
            'leftColumns': 3
        }
    });
}

function select_change_job_order(no_get){
    $('.id_job_order').prop('checked', false);
    $('#id_job_order_'+no_get).prop('checked', true);
    $('#no_select_job_order').val('');
    $('#no_select_job_order').val(no_get);
}

function list_job_order_add(){
    var no_select = $('#no_select_job_order').val();

    list_job_order_close();

    var id_job_order_value = $('#id_job_order_'+no_select).val();
    id_job_order = id_job_order_value;

    //console.log(id_job_order);

    $('#JobNo').val('');
    $('#JobNo').val(id_job_order);

    list_part_list(id_job_order);
}

function list_job_order_close(){
    $('#modal_job_order').modal('hide');
}

// ==========================================================================

function list_part_list(JobNo_get){
    $('#list_part_list').dataTable().fnDestroy();
    var total_line = $('#total_line').val();
    var total_line_value = '';
    var table = $('#list_part_list').dataTable({
        "scrollY": "500px",
        "scrollX": true,
        "scrollCollapse": true,
        "processing" : true,
        "serverSide" : true,
        "bPaginate" : false,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-part-list-bom-datatable/'+key_session+'/'+JobNo_get,
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],
        "fixedColumns":   {
            'leftColumns': 3
        }
    });
}

function select_bom(){
    let no_line = 0;
    for (var a=1; a<1000; a++){
        var id_part_list = $('#id_part_list_'+a).val();
        if (id_part_list != undefined) {
            no_line += 1;
        }
    }
    $('#total_line').val(no_line);
}

function create_po(){
    let total_line = $('#total_line').val();
    //console.log(total_line);
    for (var a=1; a<=total_line; a++){
        var id_part_list_check = $('#id_part_list_'+a).prop('checked');
        if (id_part_list_check==true) {
            var id_part_list = $('#id_part_list_'+a).val();
            console.log(id_part_list);
        }
    }
}

// Account vendor and maker

function list_account(category, id_part_list_get, no_get){
    $('#list_account_'+category).dataTable().fnDestroy();
    $('#modal_account_'+category).modal('show');

    $('#id_part_list_'+category).val('');
    $('#id_part_list_'+category).val(id_part_list_get);

    $('#no_line_'+category).val('');
    $('#no_line_'+category).val(no_get);

    $('#list_account_'+category).DataTable({
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
    $('#no_select_maker').val('');
    $('#no_select_maker').val(no_get);
    $('#no_select_vendor').val('');
    $('#no_select_vendor').val(no_get);
}

function list_account_add(category){

    var no_select_account = $('#no_select_'+category).val();
    var id_part_list = $('#id_part_list_'+category).val();
    var account_name = $('#id_account_material_'+no_select_account).val();
    var no_line = $('#no_line_'+category).val();

    //console.log(no_select_account+' '+id_part_list+' '+account_name);
    $.ajax({
        url: base_url+'jom/update-part-list-account/'+key_session,
        type: 'post',
        data: 'id_part_list='+id_part_list+'&category='+category+'&account_name='+account_name,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    $('#account_'+category+'_'+no_line).html('');
                    $('#account_'+category+'_'+no_line).append(account_name);
                    list_account_close(category);
                }
                else {
                    alert ('Data cannot updated, please try again.');
                }
            })
            //list_account_close(category);
        }
    })

}

function list_account_close(category){
    $('#modal_account_'+category).modal('hide');
}

// ============== Add PO Temp ===============================

function add_po_line(id_part_list_get){

    if (id_part_list_array.length==0) {
        id_part_list_array.push(id_part_list_get);
    }   
    else {
        if(id_part_list_array.indexOf(id_part_list_get) !== -1){
            alert ('Part List has been added.')
        }
        else {
            id_part_list_array.push(id_part_list_get);
        }
    } 

    $('#total_line').val('');
    let total_line = id_part_list_array.length;
    $('#total_line').val(total_line);

    $('#total_line_info').html('');
    $('#total_line_info').append('<i class="mdi mdi-plus"></i>&nbsp;&nbsp;Review PO ('+total_line+')');
}

function review_po(){
    if (id_part_list_array.length==0) {
        alert ("you haven't selected the part list");
    }
    else {
        //console.log(id_part_list_array);
        $.ajax({
            url: base_url+'jom/list-part-list-review/'+key_session,
            type: 'post',
            data: 'id_part_list_array='+id_part_list_array,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                $('#list_review_po tbody').html('');
                var trList = '';
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    var response = responseGetList.response;
                    $('#total_line_review_po').val('');
                    $('#total_line_review_po').val(response.length);
                    response.map(function(responseList, i){
                        var id_part_list = responseList[0].id_part_list;

                        var JobNo = responseList[0].JobNo;
                        var part_no = responseList[0].part_no;
                        var part_name = responseList[0].part_name;
                        var material_cd = responseList[0].material_cd;
                        var material_name = responseList[0].material_name;
                        var qty = responseList[0].qty;
                        let qty_spare_db = responseList[0].qty_spare;
                        let qty_spare = '';
                        if (qty_spare_db==null) {
                            qty_spare = 0;
                        }
                        else {
                            qty_spare = qty_spare_db;
                        }

                        let qty_order = (qty*1)+(qty_spare*1);

                        var material_order_number = responseList[0].material_order_number;
                        var cut_dimension = responseList[0].cut_dimension;

                        var sp_1 = responseList[0].sp_1;
                        var sp_1_cut = sp_1+cut_dimension;
                        var sp_3 = responseList[0].sp_3;
                        var sp_3_cut = sp_3+cut_dimension;
                        var sp_5 = responseList[0].sp_5;
                        var sp_5_cut = sp_5+cut_dimension;

                        var description = '';
                        if (material_order_number==null) {
                            description = part_name;
                        }
                        else {
                            description = material_name+' ('+sp_1_cut+' X '+sp_3_cut+' X '+sp_5_cut+') '+part_name;
                        }

                        var select_po = '<input type="hidden" id="description_'+(i+1)+'" value="'+description+'"><input type="checkbox" style="width:25px; height:25px;" value="'+id_part_list+'" id="id_part_list_select_'+(i+1)+'" checked="checked">';

                        trList += '<tr>';
                            trList += '<td>'+JobNo+'</td>';
                            trList += '<td>'+part_no+'</td>';
                            trList += '<td>'+description+'</td>';
                            trList += '<td align="center">'+qty_order+'</td>';
                            trList += '<td align="center">'+select_po+'</td>';
                        trList += '</tr>';

                        //console.log(responseList[0].JobName);
                    })
                })
                $('#list_review_po tbody').append(trList);
                $('#modal_review_po').modal('show');
            }
        })
    }
}

function list_review_po_close(){
    $('#modal_review_po').modal('hide');
}

function list_review_po_add(){
    let total_line_review_po = $('#total_line_review_po').val();
    
    const id_part_list_po_array = [];
    const description_po_array = [];

    for (var i = 1; i <= total_line_review_po; i++) {
        var id_part_list_check = $('#id_part_list_select_'+i).prop('checked');

        if (id_part_list_check==true) {
            var id_part_list = $('#id_part_list_select_'+i).val();
            var description = $('#description_'+i).val();

            id_part_list_po_array.push(id_part_list);
            description_po_array.push(description);
        }

    }

    //console.log(description_po_array);
}

// Loading

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