$(document).ready(function(){
    list_common_stock();
})

function list_common_stock(){
    $('#list_common_stock').dataTable().fnDestroy();

    $('#list_common_stock').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-inventory-stock-datatable/'+key_session+'/common_stock/0',
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

function modal_unit_price(id_inventory_get, inventory_name_get, no_get){
    $('#header_unit_price').html('');
    $('#id_inventory').val('');
    $('#inventory_name').val('');
    $('#no').val('');
    $('#annual_price').val('');

    $('#header_unit_price').append('Annual Price of '+inventory_name_get);
    $('#id_inventory').val(id_inventory_get);
    $('#inventory_name').val(inventory_name_get);
    $('#no').val(no_get);

    year(0);
    list_annual_price(id_inventory_get);

    $('#modal_unit_price').modal('show');
}

function list_unit_price_close(){
    $('#modal_unit_price').modal('hide');
    list_common_stock();
}

function list_annual_price(id_inventory_get){
    //console.log(id_inventory_get);
    $.ajax({
        url: base_url+'inventory/list-annual-price/'+key_session+'/cs/'+id_inventory_get,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_annual_price').dataTable().fnDestroy();
            $('#list_annual_price tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_annual_price').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var year = responseList.year;
                        var annual_price = responseList.annual_price;
                        var annual_price_format = responseList.annual_price_format;
                        var deleted = responseList.deleted;
                        var status_price = '';
                        if (deleted==0) {
                            status_price = 'Active';
                        }
                        else {
                            status_price = 'Not Active';
                        }

                        trList += '<tr>';
                            trList += '<td>'+(i+1)+'</td>';
                            trList += '<td>'+year+'</td>';
                            trList += '<td>'+annual_price_format+'</td>';
                            trList += '<td>'+status_price+'</td>';
                            trList += '<td><button class="btn btn-info" onclick="update_annual_price(\''+year+'\', \''+annual_price+'\');"><i class="mdi mdi-lead-pencil"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_annual_price tbody').append(trList);
                    $('#list_annual_price').dataTable();
                }
            })
        }
    })
}

function add_annual_price(){
    var year = $('#year').val();
    var annual_price = $('#annual_price').val();
    var id_inventory = $('#id_inventory').val();
    var inventory_name = $('#inventory_name').val();
    var no = $('#no').val();

    if (year == '' || annual_price == '') {
        alert ('Year or Annual Price Cannot Empty.');
    }
    else {
        list_unit_price_close();
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');
        $.ajax({
            url: base_url+'inventory/add-annual-price/'+key_session,
            type: 'post',
            data: 'year='+year+'&annual_price='+annual_price+'&id_inventory='+id_inventory+'&category=cs',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function() {
                            modal_loading_hide();
                            modal_unit_price(id_inventory, inventory_name, no);
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Error : '+response);
                        setTimeout(function () {
                            modal_loading_hide();
                            modal_unit_price(id_inventory, inventory_name, no);
                        }, 5000);
                    }
                })
            }
        })
    }
}

function update_annual_price(year_get, annual_price_get){
    year(year_get);
    $('#annual_price').val('');
    $('#annual_price').val(annual_price_get);
}

function year(year_get){
    $('#year').html('');
    
    var trList = '';
    if (year_get == '0') {
        trList += '<option value="">Select Year</option>';   
    }
    else {
        trList += '<option value="'+year_get+'">'+year_get+'</option>';
    }

    for (var i=((this_year*1)-2); i<= ((this_year*1)+3); i++){
        trList += '<option value="'+i+'">'+i+'</option>';
    }
    $('#year').append(trList);
}

function modal_take(){
    $.ajax({
        url: base_url+'inventory/list-inventory-stock/'+key_session+'/cs/0',
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#list_take').dataTable().fnDestroy();
            $('#list_take tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_take').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_inventory = responseList.id_inventory;
                        var inventory_cd = responseList.inventory_cd;
                        var inventory_name = responseList.inventory_name;
                        var total_count = responseList.total_count;
                        var annual_price = responseList.annual_price;

                        var optionsList = '';
                        for (var ii=0; ii<=total_count; ii++){
                            optionsList += '<option value="'+ii+'">'+ii+'</option>';
                        }

                        trList += '<tr>';
                            trList += '<td>'+(i+1)+'</td>';
                            trList += '<td>'+inventory_cd+'</td>';
                            trList += '<td><div class="wordwrap">'+inventory_name+'</div></td>';
                            trList += '<td>'+total_count+'</td>';
                            trList += '<td><select class="form-control" id="qty_take_'+(i+1)+'" style="color:white;">'+optionsList+'</select></td>';
                            trList += '<td><button class="btn btn-info" onclick="take(\''+(i+1)+'\', \''+id_inventory+'\', \''+inventory_name+'\', \''+annual_price+'\', \''+(total_count)+'\');"><i class="mdi mdi-cart-plus"></i></button></td>';
                        trList += '</tr>';
                        
                    })
                    $('#list_take tbody').append(trList);
                    $('#list_take').dataTable();
                }
            })
            list_job_order();
            list_employee();
            $('#modal_take').modal('show')
        }
    })
}

function modal_take_close(){
    $('#modal_take').modal('hide');
    list_common_stock();
}

function take(no_get, id_inventory_get, inventory_name_get, annual_price_get, total_count_get){
    var qty_take = $('#qty_take_'+no_get).val();
    var JobNo = $('#JobNo').val();
    var date_out = $('#date_out').val();

    if (qty_take==0) {
        alert('Qty take must more than 1.');
    }
    else {
        if (JobNo == '' || JobNo == null || date_out == '' || date_out == null) {
            alert('Job or Date Cannot Empty.');
        }
        else {
            take_list.push({
              id_inventory: id_inventory_get,
              inventory_name: inventory_name_get,
              qty_take: qty_take,
              annual_price : annual_price_get
            });
            //console.log(take_list.length);
            let length_resume = take_list.length;
            $('#list_take_resume tbody').html('');
            var trList = '';
            for (var i = 0; i < length_resume; i++) {
                var id_inventory = take_list[i].id_inventory;
                var inventory_name = take_list[i].inventory_name;
                var qty_take = take_list[i].qty_take;

                trList += '<tr>';
                    trList += '<td>'+(i+1)+'</td>';
                    trList += '<td><div class="wordwrap">'+inventory_name+'</div></td>';
                    trList += '<td>'+qty_take+'</td>';
                    trList += '<td><button class="btn btn-danger" onclick="remove_stock_resume(\''+i+'\', \''+length_resume+'\', \''+inventory_name+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
                trList += '</tr>';
            }
            $('#list_take_resume tbody').append(trList);
        }
    }    
}

function remove_stock_resume(no_get, length_resume_get, inventory_name_get){
    if (confirm('Are you sure you want to delete '+inventory_name_get+'?')) {
        var take_list_new = [];
        for (var i = 0; i < length_resume_get; i++) {
            var id_inventory = take_list[i].id_inventory;
            var inventory_name = take_list[i].inventory_name;
            var qty_take = take_list[i].qty_take;
            var annual_price = take_list[i].annual_price;

            if (i != no_get) {
                take_list_new.push({
                    id_inventory: id_inventory,
                    inventory_name: inventory_name,
                    qty_take: qty_take,
                    annual_price : annual_price
                });            
            }
        }
        take_list = take_list_new;
        let length_resume = take_list_new.length;
        console.log(take_list_new);
        $('#list_take_resume tbody').html('');
        var trList = '';
        for (var i = 0; i < length_resume; i++) {
            var id_inventory = take_list_new[i].id_inventory;
            var inventory_name = take_list_new[i].inventory_name;
            var qty_take = take_list_new[i].qty_take;

            trList += '<tr>';
                trList += '<td>'+(i+1)+'</td>';
                trList += '<td>'+inventory_name+'</td>';
                trList += '<td>'+qty_take+'</td>';
                trList += '<td><button class="btn btn-danger" onclick="remove_stock_resume(\''+i+'\', \''+length_resume+'\', \''+inventory_name+'\');"><i class="mdi mdi-delete-forever"></i></button></td>';
            trList += '</tr>';
        }
        $('#list_take_resume tbody').append(trList);
    }
}

function list_job_order(){
    $.ajax({
        url: base_url+'inventory/list-job-order-open/'+key_session,
        type: 'GET',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                $('#JobNo').html('');
                var trList = '';
                var status = responseGetList.status;
                if (status == 0) {
                    trList += '<option value="">Job Not Found.</option>';
                }
                else {
                    trList += '<option value="">Select Job</option>';
                    trList += '<option value="Non Job">For Non Job</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var JobNo = responseList.JobNo;
                        trList += '<option value="'+JobNo+'">'+JobNo+'</option>';
                    })
                }
                $('#JobNo').append(trList);
            })
        }
    })
}

function add_stock_transaction(){
    var JobNo = $('#JobNo').val();
    var date_out = $('#date_out').val();
    var cNIK_take = $('#cNIK_take').val();

    if (JobNo == '' || JobNo == null) {
        alert ('Job Cannot Empty.');
    }
    else {
        if (date_out == '' || date_out == null) {
            alert ('Date Cannot Empty.');
        }
        else {
            if (cNIK_take == '' || cNIK_take == null) {
                alert ('Employee Cannot Empty.');
            }
            else {
                var take_list_array = JSON.stringify(take_list);
                let resume_length = take_list.length;
                if (resume_length==0) {
                    alert ('Not Stock Selected.');
                }
                else {
                    modal_take_close();
                    modal_loading_open('bg-info', 'Saving data', 'Please wait...');
                    $.ajax({
                        url: base_url+'inventory/add-stock-transaction/'+key_session,
                        type: 'post',
                        data: 'JobNo='+JobNo+'&date_out='+date_out+'&cNIK_take='+cNIK_take+'&take_list='+take_list_array+'&take_line='+resume_length+'&category=cs',
                        crossDomain: true,
                        dataType: 'JSON',
                        success: function(responseGet){
                            console.log(responseGet);
                            modal_loading_hide();
                            responseGet.map(function(responseGetList){
                                var status = responseGetList.status;
                                if (status[0]==1) {
                                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                                    setTimeout(function() {
                                        modal_loading_hide();
                                        modal_take();
                                        take_list = [];
                                        let length_resume = take_list.length;
                                        $('#list_take_resume tbody').html('');
                                        var trList = '';
                                        for (var i = 0; i < length_resume; i++) {
                                            var id_inventory = take_list[i].id_inventory;
                                            var inventory_name = take_list[i].inventory_name;
                                            var qty_take = take_list[i].qty_take;

                                            trList += '<tr>';
                                                trList += '<td>'+(i+1)+'</td>';
                                                trList += '<td>'+inventory_name+'</td>';
                                                trList += '<td>'+qty_take+'</td>';
                                                trList += '<td><input type="checkbox" id="deleted_'+(i+1)+'" onclick="remove_stock_resume(\''+i+'\', \''+length_resume+'\', \''+inventory_name+'\');" style="width:20px; height:20px;"></td>';
                                            trList += '</tr>';
                                        }
                                        $('#list_take_resume tbody').append(trList);
                                    }, 5000);
                                }
                                else {
                                    var response = responseGetList.response;
                                    modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Error : '+response);
                                    setTimeout(function () {
                                        modal_loading_hide();
                                        modal_take();
                                    }, 5000);
                                }
                            })
                        }
                    })
                }
            }
        }
    }
}

function list_employee(){
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/1/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#cNIK_take').html('');
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Employee Not Found</option>';
                }
                else {
                    trList += '<option value="">Select Employee</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;

                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    });
                }
            })
            $('#cNIK_take').append(trList);
        }
    });
}

function list_stock_out(category){
    window.open(base_url+'inventory/list-stock-out/'+category);
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