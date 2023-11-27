$(document).ready(function(){
    list_part_list();

    var file_name = $('#file_name');
    file_name.on('change', function() {
        const size = (this.files[0].size / 1024 / 1024).toFixed(2);
        if (size <= 10.0) {
            var file_ext = getExtension(file_name.val());
            if (file_ext == "PDF" || file_ext == "pdf") {
                console.log(file_ext);
            }
            else {
                alert("File must PDF, please try again with PDF file.");
                file_name.val('');
            }
        } 
        else {
            alert("File must less then 10 Mb, click compress PDF to reduce your PDF file.");
            file_name.val('');
        }
    });
})

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function part_list(){
    $('#div_add_part_list').show();
    $('#div_add_material_order').hide();

    $('#div_list_part_list').show();
    $('#div_list_material_order').hide();
}

function material_order(){
    list_account_imo();
    list_imo(0);

    $('#div_add_part_list').hide();
    $('#div_add_material_order').show();

    $('#div_list_part_list').hide();
    $('#div_list_material_order').show();
}

function set_single_multi(){
    var single_multi = $('#single_multi').prop('checked');
    if (single_multi==true) {
        $('#single').hide();
        $('#multi').show();
    }
    else if (single_multi==false) {
        $('#single').show();
        $('#multi').hide();
    }
}

// inventory ================================================================

function list_inventory(){
    $('#list_inventory').dataTable().fnDestroy();
    $('#modal_inventory').modal('show');

    $('#list_inventory').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-inventory-datatable/'+key_session,
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

function select_change_inventory(no_get){
    $('.id_inventory').prop('checked', false);
    $('#id_inventory_'+no_get).prop('checked', true);
    $('#no_select_inventory').val('');
    $('#no_select_inventory').val(no_get);
}

function list_inventory_add(){
    $('#id_inventory').val('');
    $('#part_no').val('');
    $('#part_name').val('');
    var no_select = $('#no_select_inventory').val();

    var id_inventory_value = $('#id_inventory_'+no_select).val();
    id_inventory = id_inventory_value;

    var part_no_hide = $('#part_no_hide').val();

    $.ajax({
        url: base_url+'jom/list-inventory/'+key_session+'/'+id_inventory,
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
                        var inventory_name = responseList.inventory_name;
                        var inventory_cd = responseList.inventory_cd;
                        //var id_inventory = responseList.id_inventory;

                        //console.log(part_no_hide);

                        if ($('#part_no_hide').val() != '') {
                            $('#id_inventory').val(id_inventory);
                            $('#part_no').val(part_no_hide);
                            $('#part_name').val(inventory_name);
                        }
                        else {
                            $('#id_inventory').val(id_inventory);
                            $('#part_no').val(inventory_cd);
                            $('#part_name').val(inventory_name);
                        }

                        list_inventory_close();
                    })
                }
            })
        }
    })
}

function list_inventory_close(){
    $('#modal_inventory').modal('hide');
}

// material ================================================================

function list_material(){
    $('#list_material').dataTable().fnDestroy();
    $('#modal_material').modal('show');

    $('#list_material').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-material-datatable/'+key_session,
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

function select_change_material(no_get){
    $('.id_material').prop('checked', false);
    $('#id_material_'+no_get).prop('checked', true);
}

function list_material_add(){
    $('#id_material').val('');
    $('#id_account_vendor').val('');
    for (var i = 0; i < 11; i++) {
        var id_material_cb = $('#id_material_'+i).prop('checked');
        if (id_material_cb == true) {
            var id_material_value = $('#id_material_'+i).val();
            id_material = id_material_value;

            $.ajax({
                url: base_url+'jom/list-material/'+key_session+'/'+id_material,
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
                                var material_name = responseList.material_name;
                                var account_name = responseList.account_name;

                                $('#id_material').val(material_name);
                                $('#id_account_vendor').val(account_name);
                                list_material_close();
                            })
                        }
                    })
                }
            })
        }
    }
}

function list_material_close(){
    $('#modal_material').modal('hide');
}

// Account vendor and maker

function list_account(category){
    $('#list_account_'+category).dataTable().fnDestroy();
    $('#modal_account_'+category).modal('show');

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
    console.log(no_get);
    $('.id_account').prop('checked', false);
    $('#id_account_material_'+no_get).prop('checked', true);
    $('#no_select_maker').val('');
    $('#no_select_maker').val(no_get);
    $('#no_select_vendor').val('');
    $('#no_select_vendor').val(no_get);
}

function list_account_add(category){
    $('#id_account').val('');
    var no_select_account = $('#no_select_'+category).val();

    var id_account_value = $('#id_account_material_'+no_select_account).val();
    console.log(no_select_account);
        
    $('#id_account_'+category).val(id_account_value);
    list_account_close(category);
}

function list_account_close(category){
    $('#modal_account_'+category).modal('hide');
}

// ==========================================================================

function list_part_list(){
    $('#list_part_list').dataTable().fnDestroy();
    $('#list_part_list').dataTable({
        "scrollY":        "500px",
        "scrollX":        true,
        "scrollCollapse": true,
        "processing" : true,
        "serverSide" : true,
        "bPaginate" : false,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-part-list-datatable/'+key_session+'/'+JobNo,
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

function add_part_list(){
    var id_part_list = $('#id_part_list').val();
    var id_inventory = $('#id_inventory').val();
    var no = $('#no').val();
    var part_no = $('#part_no').val();
    var part_name = $('#part_name').val();
    var id_material = $('#id_material').val();
    var qty = $('#qty').val();
    var qty_spare = $('#qty_spare').val();
    var drawing_no = $('#drawing_no').val();
    var single_multi = $('#single_multi').val();
    var sp_1_single = $('#sp_1_single').val();
    var sp_1_multi = $('#sp_1').val();
    var sp_2 = $('#sp_2').val();
    var sp_3 = $('#sp_3').val();
    var sp_4 = $('#sp_4').val();
    var sp_5 = $('#sp_5').val();
    var note = $('#note').val();
    var id_account_vendor = $('#id_account_vendor').val();
    var id_account_maker = $('#id_account_maker').val();

    var sp_1 = '';
    if (sp_1_single=='') {
        sp_1 = sp_1_multi;
    }
    else {
        sp_1 = sp_1_single;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');
    $.ajax({
        url: base_url+'jom/add-part-list/'+key_session,
        type: 'post',
        data: 'id_part_list='+id_part_list+'&id_inventory='+id_inventory+'&part_no='+part_no+'&part_name='+part_name+'&id_material='+id_material+'&qty='+qty+'&qty_spare='+qty_spare+'&drawing_no='+drawing_no+'&single_multi='+single_multi+'&sp_1='+sp_1+'&sp_2='+sp_2+'&sp_3='+sp_3+'&sp_4='+sp_4+'&sp_5='+sp_5+'&note='+note+'&id_account_vendor='+id_account_vendor+'&id_account_maker='+id_account_maker+'&JobNo='+JobNo,
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
                        list_part_list();
                        reset_form();
                    }, 5000);
                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 10000);
                }
            })
        }
    })
}

function update_part_list(id_part_list_get, no_get){
    $.ajax({
        url: base_url+'jom/list-part-list/'+key_session+'/'+id_part_list_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    reset_form();
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_part_list = responseList.id_part_list;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_job_order = responseList.id_job_order;
                        var JobNo = responseList.JobNo;
                        var MoldName = responseList.MoldName;
                        var MoldNomor = responseList.MoldNomor;
                        var JobName = responseList.JobName;
                        var id_inventory = responseList.id_inventory;
                        var inventory_cd = responseList.inventory_cd;
                        var inventory_name = responseList.inventory_name;
                        var part_no = responseList.part_no;
                        var part_name = responseList.part_name;
                        var id_material = responseList.id_material;
                        var material_cd = responseList.material_cd;
                        var material_name = responseList.material_name;
                        var qty = responseList.qty;
                        var qty_spare = responseList.qty_spare;
                        var single_multi = responseList.single_multi;
                        var sp_1 = responseList.sp_1;
                        var sp_2 = responseList.sp_2;
                        var sp_3 = responseList.sp_3;
                        var sp_4 = responseList.sp_4;
                        var sp_5 = responseList.sp_5;
                        var note = responseList.note;
                        var drawing_no = responseList.drawing_no;
                        var id_account_vendor = responseList.id_account_vendor;
                        var account_cd_vendor = responseList.account_cd_vendor;
                        var account_name_vendor = responseList.account_name_vendor;
                        var id_account_maker = responseList.id_account_maker;
                        var account_cd_maker = responseList.account_cd_maker;
                        var account_name_maker = responseList.account_name_maker;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var deleted = responseList.deleted;

                        $('#id_part_list').val(id_part_list);
                        $('#id_inventory').val(id_inventory);
                        $('#no').val(no_get);
                        $('#part_no').val(part_no);
                        $('#part_no_hide').val(part_no);
                        $('#part_name').val(part_name);
                        $('#id_material').val(material_name);
                        $('#qty').val(qty);
                        $('#qty_spare').val(qty_spare);
                        $('#drawing_no').val(drawing_no);
                        
                        if (single_multi=='single') {
                            $('#sp_1').val(sp_1);
                            $('#single').show();
                            $('#multi').hide();
                        }
                        else if (single_multi=='multi') {
                            $('#single_multi').prop('checked', true);
                            $('#sp_1').val(sp_1);
                            $('#sp_2').val(sp_2);
                            $('#sp_3').val(sp_3);
                            $('#sp_4').val(sp_4);
                            $('#sp_5').val(sp_5);

                            $('#single').hide();
                            $('#multi').show();
                        }

                        $('#note').val(note);
                        $('#id_account_vendor').val(account_name_vendor);
                        $('#id_account_maker').val(account_name_maker);
                    })
                }
                else {
                    var response = responseGetList.response;
                    alert ('Data not found. Error : '+response);
                }
            })
        }
    })
}

function reset_form(){
    $('#id_part_list').val('');
    $('#id_inventory').val('');
    $('#no').val('');
    $('#part_no').val('');
    $('#part_no_hide').val('');
    $('#part_name').val('');
    $('#id_material').val('');
    $('#qty').val('');
    $('#qty_spare').val('');
    $('#drawing_no').val('');
    $('#single_multi').prop('checked', false);
    $('#sp_1').val('');
    $('#sp_1_single').val('');
    $('#sp_2').val('');
    $('#sp_3').val('');
    $('#sp_4').val('');
    $('#sp_5').val('');
    $('#single').show();
    $('#multi').hide();
    $('#note').val('');
    $('#id_account_vendor').val('');
    $('#id_account_maker').val('');
}

function delete_part_list(id_part_list_get, part_name_get){
    if (confirm('Are you sure you want to delete '+part_name_get+' ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'jom/delete-part-list/'+key_session,
            type: 'post',
            data: 'id_part_list='+id_part_list_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            list_part_list();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 10000);
                    }
                })
            }
        })
    }
}

function add_sub_part_list(part_no_get){
     $.ajax({
        url: base_url+'jom/list-part-list-by-part-no/'+key_session+'/'+part_no_get+'/'+JobNo,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            $('#part_no').val('');
            responseGet.map(function(responseGetList){
                var response = responseGetList.response;
                $('#part_no').val(response);
                //document.getElementById('part_no').setAttribute('readonly', 'readonly');
            })
        }
    })
}

function rto(id_part_list_get, part_name_get, value_get, no_get){ // Ready To Order
    if (value_get==1) { // Add
        if (confirm('Are you sure you want ready to order part '+part_name_get+' ?')) {
            $.ajax({
                url: base_url+'jom/add-rto/'+key_session,
                type: 'post',
                data: 'id_part_list='+id_part_list_get,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            alert ('Updating data successfully.');
                            //modal_detail_imo_close();
                            //update_imo(id_material_order_get);
                            document.getElementById('part_name_'+no_get).removeAttribute('style');
                            document.getElementById('part_name_'+no_get).setAttribute('style', 'padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white; font-style:italic;');
                            document.getElementById('part_name_'+no_get).removeAttribute('onclick');
                            document.getElementById('part_name_'+no_get).setAttribute('onclick', '\''+id_part_list_get+'\'');
                        }
                        else {
                            alert ('Updating data unsuccessfully.');
                        }
                    })
                }
            })
        }
    }
    else { // Delete
        if (confirm('Are you sure you want delete ready to order part '+part_name_get+' ?')) {
            $.ajax({
                url: base_url+'jom/delete-rto/'+key_session,
                type: 'post',
                data: 'id_part_list='+id_part_list_get,
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    console.log(responseGet);
                    responseGet.map(function(responseGetList){
                        var status = responseGetList.status;
                        if (status==1) {
                            alert ('Deleting data successfully.');
                            document.getElementById('part_name_'+no_get).removeAttribute('style');
                            document.getElementById('part_name_'+no_get).setAttribute('style', 'padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white;');
                            document.getElementById('part_name_'+no_get).removeAttribute('onclick');
                            document.getElementById('part_name_'+no_get).setAttribute('onclick', '"'+id_part_list_get+', '+part_name_get+', '+1+', '+no_get+'"');
                        }
                        else {
                            alert ('Deleting data unsuccessfully.');
                        }
                    })
                }
            })
        }
    }
}

// Material Order

function list_imo(id_material_order){
    $('#list_imo').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-imo/'+key_session+'/'+JobNo+'/'+id_material_order,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_imo tbody').html('');
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<tr><td colspan="8" align="center"></td></tr>'
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_material_order = responseList.id_material_order;
                        var material_order_number = responseList.material_order_number;
                        var account_name = responseList.account_name;
                        var date_order = responseList.date_order;
                        var cNmPegawai_issued = responseList.cNmPegawai_issued;
                        var cNmPegawai_checked_1 = responseList.cNmPegawai_checked_1;
                        var cNmPegawai_checked_2 = responseList.cNmPegawai_checked_2;

                        var approve_checked_1 = responseList.approve_checked_1;
                        var approve_checked_2 = responseList.approve_checked_2;

                        var checked_1 = responseList.checked_1;
                        var checked_2 = responseList.checked_2;

                        var string_checked_1 = '';
                        if (approve_checked_1==0) {
                            if (cNIK_session==checked_1 || cNIK_session == '16L10294') {
                                string_checked_1 = '<div style="color:red;" onclick="approve_imo(\''+id_material_order+'\', \''+material_order_number+'\', \''+(1)+'\', \''+(1)+'\');">'+cNmPegawai_checked_1+'</div>';
                            }
                            else {
                                string_checked_1 = '<div style="color:red;">'+cNmPegawai_checked_1+'</div>';
                            }
                        }
                        else {
                            if (cNIK_session==checked_1 || cNIK_session == '16L10294') {
                                string_checked_1 = '<div style="color:white;" onclick="approve_imo(\''+id_material_order+'\', \''+material_order_number+'\', \''+(0)+'\', \''+(1)+'\');">'+cNmPegawai_checked_1+'</div>';
                            }
                            else {
                                string_checked_1 = '<div style="color:white;">'+cNmPegawai_checked_1+'</div>';
                            }
                        }

                        var string_checked_2 = '';
                        if (approve_checked_2==0) {
                            if (cNIK_session==checked_2 || cNIK_session == '16L10294') {
                                string_checked_2 = '<div style="color:red;" onclick="approve_imo(\''+id_material_order+'\', \''+material_order_number+'\', \''+(1)+'\', \''+(2)+'\');">'+cNmPegawai_checked_2+'</div>';
                            }
                            else {
                                string_checked_2 = '<div style="color:red;">'+cNmPegawai_checked_2+'</div>';
                            }
                        }
                        else {
                            if (cNIK_session==checked_2 || cNIK_session == '16L10294') {
                                string_checked_2 = '<div style="color:white;" onclick="approve_imo(\''+id_material_order+'\', \''+material_order_number+'\', \''+(0)+'\', \''+(2)+'\');">'+cNmPegawai_checked_2+'</div>';
                            }
                            else {
                                string_checked_2 = '<div style="color:white;">'+cNmPegawai_checked_2+'</div>';
                            }
                        }

                        var material_order_line = responseList.material_order_line;

                        var action = '<button class="btn btn-info" onclick="update_imo(\''+id_material_order+'\');" title="Detail '+material_order_number+'"><i class="mdi mdi-playlist-check"></i></button>';

                        if (material_order_line.length==0) {
                            action += '<button class="btn btn-danger" onclick="delete(\''+id_material_order+'\', \''+material_order_number+'\');" title="Delete '+material_order_number+'"><i class="mdi mdi-delete-forever"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;" align="center">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+material_order_number+'</td>';
                            trList += '<td style="color:white;">'+account_name+'</td>';
                            trList += '<td style="color:white;">'+date_order+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai_issued+'</td>';
                            trList += '<td style="color:white;">'+string_checked_1+'</td>';
                            trList += '<td style="color:white;">'+string_checked_2+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>'
                    })
                }
            })
            $('#list_imo tbody').append(trList);
            $('#list_imo').dataTable();
        }
    })
}

function list_account_imo(){
    $('#id_account_imo').html('');
    $.ajax({
        url: base_url+'jom/list-account-imo/'+key_session+'/'+JobNo,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    trList += '<option value="">Select Vendor</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_account_vendor = responseList.id_account_vendor;
                        var account_name_vendor = responseList.account_name_vendor;

                        trList += '<option value="'+id_account_vendor+'">'+account_name_vendor+'</option>';
                    })
                }
            })
            $('#id_account_imo').append(trList);
        }
    })
}

function open_part_list(){
    $('#part_list_imo tbody').html('');
    $('#total_line').val('');

    var id_account_imo = $('#id_account_imo').val();
    var cut_dim = $('#cut_dim').val();
    if (id_account_imo=='') {
        alert ('Vendor cannot empty, please try again.');
    }
    else {
        $.ajax({
            url: base_url+'jom/list-part-list-by-account-imo/'+key_session+'/'+JobNo+'/'+id_account_imo+'/'+cut_dim,
            type: 'get',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                var trList = '';
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<tr><td align="center">Data Not Found.</td></tr>';
                    }
                    else {
                        var response = responseGetList.response;
                        var total_line = response.length;

                        $('#total_line').val(total_line);

                        response.map(function(responseList, i){
                            var id_part_list = responseList.id_part_list;
                            var part_no = responseList.part_no;
                            var part_name = responseList.part_name;
                            var material_cd = responseList.material_cd;
                            var qty = responseList.qty;

                            var sp_1 = responseList.sp_1;
                            var sp_1_cut = responseList.sp_1_cut;

                            var sp_3 = responseList.sp_3;
                            var sp_3_cut = responseList.sp_3_cut;

                            var sp_5 = responseList.sp_5;
                            var sp_5_cut = responseList.sp_5_cut;

                            trList += '<tr>';
                                trList += '<td style="color:white;"><input type="checkbox" style="width:20px; height:20px;" value="'+id_part_list+'" id="imo_select_'+(i+1)+'" checked="checked"></td>';
                                trList += '<td style="color:white;">'+part_name+'</td>';
                                trList += '<td style="color:white;">'+material_cd+'</td>';
                                trList += '<td style="color:white;">'+qty+'</td>';
                                trList += '<td style="color:white;">'+sp_1_cut+' ('+sp_1+')</td>';
                                trList += '<td style="color:white;">'+sp_3_cut+' ('+sp_3+')</td>';
                                trList += '<td style="color:white;">'+sp_5_cut+' ('+sp_5+')</td>';
                            trList += '</tr>';
                        })
                    }
                })
                $('#part_list_imo tbody').append(trList);
            }
        })
    }
}

function save_imo(){
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    var id_imo = $('#id_imo').val();
    var id_account_imo = $('#id_account_imo').val();
    var cut_dim = $('#cut_dim').val();
    var total_line = $('#total_line').val();

    var id_part_list_array = [];

    let line_select = 0;
    
    for (var i=1; i <= total_line*1; i++){
        var imo_select = $('#imo_select_'+i).prop('checked');
    
        if (imo_select==true) {
            var id_part_list = $('#imo_select_'+i).val();
            id_part_list_array.push(id_part_list);
            line_select += 1;
        }
    }

    if (line_select==0) {
        modal_loading_hide();
        alert ('No Part List Select, Please Try Again.');
    }
    else {
        $.ajax({
            url: base_url+'jom/add-imo/'+key_session,
            type: 'post',
            data: 'id_account_imo='+id_account_imo+'&id_imo='+id_imo+'&cut_dim='+cut_dim+'&id_part_list_array='+id_part_list_array+'&JobNo='+JobNo+'&line_select='+line_select,
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
                            list_imo(0);
                            $('#part_list_imo tbody').html('');
                            $('#total_line').val('');
                            list_account_imo();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 10000);
                    }
                })
            }
        })
    }
}

function update_imo(id_material_order_get){
    $('#modal_detail_imo').modal('show');
    $('#label_header_imo_detail').html('');
    $.ajax({
        url: base_url+'jom/list-imo/'+key_session+'/'+JobNo+'/'+id_material_order_get,
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
                        var id_material_order = responseList.id_material_order;
                        var material_order_number = responseList.material_order_number;
                        var account_name = responseList.account_name;
                        var cut_dimension = responseList.cut_dimension;

                        $('#id_material_order_detail').val(id_material_order);
                        $('#id_account_imo_detail').val(account_name);
                        cut_dim(cut_dimension);

                        $('#label_header_imo_detail').append('Material Order - '+material_order_number);

                        $('#list_imo_detail tbody').html('');

                        var trList = '';

                        var material_order_line = responseList.material_order_line;
                        material_order_line.map(function(responseListLine, i){
                            var id_material_order_line = responseListLine.id_material_order_line;
                            var id_part_list = responseListLine.id_part_list;
                            var part_name = responseListLine.part_name;
                            var material_cd = responseListLine.material_cd;
                            var qty = responseListLine.qty;
                            var sp_1 = responseListLine.sp_1;
                            var sp_1_cut = responseListLine.sp_1_cut;
                            var sp_3 = responseListLine.sp_3;
                            var sp_3_cut = responseListLine.sp_3_cut;
                            var sp_5 = responseListLine.sp_5;
                            var sp_5_cut = responseListLine.sp_5_cut;

                            var action = '<button class="btn btn-danger" onclick="delete_imo_line(\''+id_material_order_line+'\', \''+part_name+'\', \''+id_material_order_get+'\');"><i class="mdi mdi-delete-forever"></i></button>';

                            trList += '<tr>';
                                trList += '<td style="color:black;">'+action+'</td>';
                                trList += '<td style="color:black;">'+part_name+'</td>';
                                trList += '<td style="color:black;" align="center">'+material_cd+'</td>';
                                trList += '<td style="color:black;" align="center">'+qty+'</td>';
                                trList += '<td style="color:black;" align="center">'+sp_1_cut+' ('+sp_1+')</td>';
                                trList += '<td style="color:black;" align="center">'+sp_3_cut+' ('+sp_3+')</td>';
                                trList += '<td style="color:black;" align="center">'+sp_5_cut+' ('+sp_5+')</td>';
                            trList += '</tr>';
                        })

                        var data_line_uncheck_array = responseList.data_line_uncheck_array;
                        data_line_uncheck_array.map(function(responseList_uncheck, i){
                            var id_part_list = responseList_uncheck.id_part_list;
                            var part_no = responseList_uncheck.part_no;
                            var part_name = responseList_uncheck.part_name;
                            var material_cd = responseList_uncheck.material_cd;
                            var qty = responseList_uncheck.qty;

                            var sp_1 = responseList_uncheck.sp_1;
                            var sp_1_cut = responseList_uncheck.sp_1_cut;

                            var sp_3 = responseList_uncheck.sp_3;
                            var sp_3_cut = responseList_uncheck.sp_3_cut;

                            var sp_5 = responseList_uncheck.sp_5;
                            var sp_5_cut = responseList_uncheck.sp_5_cut;

                            trList += '<tr>';
                                trList += '<td style="color:black;" style="color:white;"><input type="checkbox" style="width:20px; height:20px;" value="'+id_part_list+'" id="imo_select_'+(i+1)+'" onclick="add_imo_line(\''+material_order_number+'\', \''+id_part_list+'\', \''+part_name+'\');"></td>';
                                trList += '<td style="color:black;" style="color:white;">'+part_name+'</td>';
                                trList += '<td style="color:black;" style="color:white;">'+material_cd+'</td>';
                                trList += '<td style="color:black;" style="color:white;">'+qty+'</td>';
                                trList += '<td style="color:black;" style="color:white;">'+sp_1_cut+' ('+sp_1+')</td>';
                                trList += '<td style="color:black;" style="color:white;">'+sp_3_cut+' ('+sp_3+')</td>';
                                trList += '<td style="color:black;" style="color:white;">'+sp_5_cut+' ('+sp_5+')</td>';
                            trList += '</tr>';
                        })

                        $('#list_imo_detail tbody').append(trList);
                    })
                }
                else {
                    alert ('Data not found.');
                }
            })
        }
    })
}

function add_imo_line(material_order_number_get, id_part_list_get, part_name_get){
    if (confirm('Are you sure you want to add '+part_name_get+' to material order number '+material_order_number_get+' ?')) {
        $.ajax({
            url: base_url+'jom/add-imo-line/'+key_session,
            type: 'post',
            data: 'material_order_number='+material_order_number_get+'&id_part_list='+id_part_list_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        alert ('Saving data successfully.');
                    }
                    else {
                        alert ('Saving data unsuccessfully.');
                    }
                })
            }
        })
    }
}

function update_imo_line(){
    modal_detail_imo_close();
    var id_material_order = $('#id_material_order_detail').val();
    var cut_dimension = $('#cut_dim_detail').val();

    //console.log(id_material_order+' '+cut_dimension);

    $.ajax({
        url: base_url+'jom/update-imo-line/'+key_session,
        type: 'post',
        data: 'id_material_order='+id_material_order+'&cut_dimension='+cut_dimension,
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
                        modal_loading_hide();
                        list_imo(0);
                    }, 5000);
                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 10000);
                }
            })
        }
    })
}

function cut_dim(cut_dimension_get){
    $('#cut_dim_detail').html('');
    var trList = '<option value="'+cut_dimension_get+'">'+cut_dimension_get+'</option>';
    for (var i=0; i<=10; i++){
        trList += '<option value="'+i+'">'+i+'</option>';
    }
    $('#cut_dim_detail').append(trList);
}

function modal_detail_imo_close(){
    $('#modal_detail_imo').modal('hide');
}

function delete_imo_line(id_material_order_line_get, part_name_get, id_material_order_get){
    if (confirm('Are you sure you want to delete '+part_name_get+' ?')) {
        $.ajax({
            url: base_url+'jom/delete-imo-line/'+key_session,
            type: 'post',
            data: 'id_material_order_line='+id_material_order_line_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        alert ('Deleting data successfully.');
                        modal_detail_imo_close();
                        update_imo(id_material_order_get);
                    }
                    else {
                        alert ('Deleting data unsuccessfully.');
                    }
                })
            }
        })
    }
}

function approve_imo(id_material_order_get, material_order_number_get, value_get, category_get){
    var note_string = '';
    if (value_get==1) {
        note_string = 'approve';
    }
    else {
        note_string = 'unapprove';
    }
    if (confirm('Are you sure you want to '+note_string+' '+material_order_number_get+' ?')) {
        $.ajax({
            url: base_url+'jom/approve-imo/'+key_session,
            type: 'post',
            data: 'id_material_order='+id_material_order_get+'&category='+category_get+'&value='+value_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        alert ('Approve data successfully.');
                        list_imo(0);
                    }
                    else {
                        alert ('Approve data unsuccessfully.');
                    }
                })
            }
        })
    }
}

// List File Dwg

function list_file_dwg(id_part_list_get){
    //console.log(base_url+'jom/list-file-dwg/'+key_session+'/'+id_part_list_get);
    $('#list_file_dwg').dataTable().fnDestroy();
    $('#list_file_dwg').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-file-dwg/'+key_session+'/'+id_part_list_get,
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

// Upload File Dwg

function upload_file_dwg(no_get, id_part_list_get, part_name_get, rev_get, JobNo_get){
    //console.log(id_part_list_get+' '+part_name_get);
    $('#id_part_list_upload').val('');
    $('#id_part_list_upload').val(id_part_list_get);

    $('#rev').val('');
    $('#rev').val(rev_get);

    $('#modal_title_upload').html('');
    $('#modal_title_upload').append('Upload Drawing File of '+JobNo_get+' - '+part_name_get);

    list_file_dwg(id_part_list_get);

    $('#modal_upload_file_dwg').modal('show');
}

function upload_file_dwg_hide(){
    $('#modal_upload_file_dwg').modal('hide');
}

function save_upload_file_dwg(){
    var id_part_list = $('#id_part_list_upload').val();
    var file_name = $('#file_name');
    var rev = $('#rev').val();
    var note = $('#note_upload').val();

    if (file_name.val() == '') {
        alert('File cannot empty, please try again.');
    }
    else {
        var formData = new FormData();
        formData.append('id_part_list', id_part_list);
        formData.append('rev', rev);
        formData.append('note', note);
        formData.append('category', 1);
        formData.append('file_name', $('#file_name')[0].files[0]);

        $('#loading_upload_file_dwg').html('');
        $('#loading_upload_file_dwg').append('Uploading file...');

        $.ajax({
            url: base_url+'jom/upload-file-dwg/'+key_session,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            crossDomain: true,
            headers: {
               'Content-Type': undefined
            },
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        $('#loading_upload_file_dwg').html('');
                        $('#loading_upload_file_dwg').append('Uploading file successfully.');
                        setTimeout(function () {
                            $('#loading_upload_file_dwg').html('');
                            $('#note_upload').val('');
                            $('#file_name').val('');
                            $('#rev').val('');
                            $('#rev').val((rev*1)+1);
                            list_file_dwg(id_part_list);
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        $('#loading_upload_file_dwg').html('');
                        $('#loading_upload_file_dwg').append('Uploading file unsuccessfully, error : '+response);
                        setTimeout(function () {
                            $('#loading_upload_file_dwg').html('');
                        }, 5000);
                    }
                })
            },
            error : function(error){
                console.log(error);
            }
        })
    }
}

function download_file_dwg(file_url_get){
    window.open(file_url_get, '_blank');
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