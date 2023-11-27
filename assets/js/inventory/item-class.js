$(document).ready(function(){
    list_item_class(0);
    list_department(0, 0);
    list_class_category(0, 0);
    list_warehouse(0, 0);
})

function list_item_class(id_item_class){
    $('#list_item_class').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'inventory/list-item-class/'+key_session+'/'+id_item_class,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_item_class tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_item_class').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_item_class   = responseList.id_item_class;
                        var company_id  = responseList.company_id;
                        var company_name    = responseList.company_name;
                        var id_class_category   = responseList.id_class_category;
                        var class_category_cd   = responseList.class_category_cd;
                        var class_category_name = responseList.class_category_name;
                        var item_class_cd   = responseList.item_class_cd;
                        var item_class_name = responseList.item_class_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var kit_assy    = responseList.kit_assy;
                        var atk_stock   = responseList.atk_stock;
                        var common_stock    = responseList.common_stock;
                        var id_warehouse    = responseList.id_warehouse;
                        var warehouse_cd    = responseList.warehouse_cd;
                        var warehouse_name  = responseList.warehouse_name;
                        var deleted = responseList.deleted;

                        var kit_assy_icon = '';
                        if (kit_assy==1) {
                            kit_assy_icon = '✔';
                        }
                        else if (kit_assy==0) {
                            kit_assy_icon = '✖';
                        }

                        var atk_stock_icon = '';
                        if (atk_stock==1) {
                            atk_stock_icon = '✔';
                        }
                        else if (atk_stock==0) {
                            atk_stock_icon = '✖';
                        }

                        var common_stock_icon = '';
                        if (common_stock==1) {
                            common_stock_icon = '✔';
                        }
                        else if (common_stock==0) {
                            common_stock_icon = '✖';
                        }

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="update_'+(i+1)+'" onclick="update(\''+id_item_class+'\', \''+(i+1)+'\');" title="Update Company - '+item_class_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="disable_enable_'+(i+1)+'" onclick="disable_enable(\''+id_item_class+'\', \''+item_class_name+'\', \''+1+'\');" title="Disable Company - '+item_class_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_item_class+'\', \''+item_class_name+'\', \''+0+'\');" title="Enable Company - '+item_class_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="item_class_cd_'+(i+1)+'">'+item_class_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="item_class_name_'+(i+1)+'">'+item_class_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="class_category_name_'+(i+1)+'">'+class_category_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="cNmDept_'+(i+1)+'">'+cNmDept+'</div></td>';
                            trList += '<td style="color:white;"><div id="warehouse_name_'+(i+1)+'">'+warehouse_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="kit_assy_'+(i+1)+'">'+kit_assy_icon+'</div></td>';
                            trList += '<td style="color:white;"><div id="atk_stock_'+(i+1)+'">'+atk_stock_icon+'</div></td>';
                            trList += '<td style="color:white;"><div id="common_stock_'+(i+1)+'">'+common_stock_icon+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_item_class tbody').append(trList);
                    $('#list_item_class').dataTable({
                        scrollY:        "400px",
                        scrollX:        false,
                        scrollCollapse: true,
                        paging:         false
                    });
                }
            })
        }
    });
}

function list_department(cIDDept_get, cNmDept_get){
    $('#cIDDept').html('');
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cIDDept_get != 0) {
                trList += '<option value="'+cIDDept_get+'">'+cNmDept_get+'</option>';
            }
            else {
                trList += '<option value="">Select Department</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cIDDept+'">'+cNmDept+'</option>';
                        }
                    })
                }
            })
            $('#cIDDept').append(trList);
        }
    });
}

function list_class_category(id_class_category_get, class_category_name_get){
    $('#id_class_category').html('');
    $.ajax({
        url: base_url+'inventory/list-class-category/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_class_category_get != 0) {
                trList += '<option value="'+id_class_category_get+'">'+class_category_name_get+'</option>';
            }
            else {
                trList += '<option value="">Select Class Category</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_class_category = responseList.id_class_category;
                        var class_category_cd = responseList.class_category_cd;
                        var class_category_name = responseList.class_category_name;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+id_class_category+'">'+class_category_name+'</option>';
                        }
                    })
                }
            })
            $('#id_class_category').append(trList);
        }
    });
}

function list_warehouse(id_warehouse_get, warehouse_name_get){
    $('#id_warehouse').html('');
    $.ajax({
        url: base_url+'inventory/list-warehouse/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_warehouse_get != 0) {
                trList += '<option value="'+id_warehouse_get+'">'+warehouse_name_get+'</option>';
            }
            else {
                trList += '<option value="">Select Warehouse</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_warehouse = responseList.id_warehouse;
                        var warehouse_cd = responseList.warehouse_cd;
                        var warehouse_name = responseList.warehouse_name;
                        var full_address = responseList.full_address;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_warehouse+'">'+warehouse_name+'</option>';
                        }
                    })
                }
            })
            $('#id_warehouse').append(trList);
        }
    });
}

function add_item_class(){
    var id_item_class = $('#id_item_class').val();
    var item_class_cd = $('#item_class_cd').val();
    var item_class_name = $('#item_class_name').val();
    var cIDDept = $('#cIDDept').val();
    var id_class_category = $('#id_class_category').val();
    var id_warehouse = $('#id_warehouse').val();
    var kit_assy_checkbox = $('#kit_assy').prop('checked');
    var atk_stock_checkbox = $('#atk_stock').prop('checked');
    var common_stock_checkbox = $('#common_stock').prop('checked');
    var no = $('#no').val();

    var kit_assy = '';
    if (kit_assy_checkbox==true) {
        kit_assy = 1;
    }
    else {
        kit_assy = 0;
    }

    var atk_stock = '';
    if (atk_stock_checkbox==true) {
        atk_stock = 1;
    }
    else {
        atk_stock = 0;
    }

    var common_stock = '';
    if (common_stock_checkbox==true) {
        common_stock = 1;
    }
    else {
        common_stock = 0;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/add-item-class/'+key_session,
        type: 'post',
        data: 'id_item_class='+id_item_class+'&item_class_cd='+item_class_cd+'&item_class_name='+item_class_name+'&kit_assy='+kit_assy+'&cIDDept='+cIDDept+'&id_class_category='+id_class_category+'&id_warehouse='+id_warehouse+'&atk_stock='+atk_stock+'&common_stock='+common_stock,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        if (id_item_class=='') {
                            list_item_class(0);
                        }
                        else {
                            var response = responseGetList.response;

                            //var id_item_class   = response[0].id_item_class;
                            var company_id  = response[0].company_id;
                            var company_name    = response[0].company_name;
                            var id_class_category   = response[0].id_class_category;
                            var class_category_cd   = response[0].class_category_cd;
                            var class_category_name = response[0].class_category_name;
                            var item_class_cd   = response[0].item_class_cd;
                            var item_class_name = response[0].item_class_name;
                            var cIDDept = response[0].cIDDept;
                            var cNmDept = response[0].cNmDept;
                            var kit_assy    = response[0].kit_assy;
                            var atk_stock   = response[0].atk_stock;
                            var common_stock    = response[0].common_stock;
                            var id_warehouse    = response[0].id_warehouse;
                            var warehouse_cd    = response[0].warehouse_cd;
                            var warehouse_name  = response[0].warehouse_name;
                            var deleted = response[0].deleted;

                            var kit_assy_icon = '';
                            if (kit_assy==1) {
                                kit_assy_icon = '✔';
                            }
                            else if (kit_assy==0) {
                                kit_assy_icon = '✖';
                            }

                            var atk_stock_icon = '';
                            if (atk_stock==1) {
                                atk_stock_icon = '✔';
                            }
                            else if (atk_stock==0) {
                                atk_stock_icon = '✖';
                            }

                            var common_stock_icon = '';
                            if (common_stock==1) {
                                common_stock_icon = '✔';
                            }
                            else if (common_stock==0) {
                                common_stock_icon = '✖';
                            }

                            $('#item_class_cd_'+no).html('');
                            $('#item_class_name_'+no).html('');
                            $('#class_category_name_'+no).html('');
                            $('#cNmDept_'+no).html('');
                            $('#warehouse_name_'+no).html('');
                            $('#kit_assy_'+no).html('');
                            $('#atk_stock_'+no).html('');
                            $('#common_stock_'+no).html('');

                            $('#item_class_cd_'+no).append(item_class_cd);
                            $('#item_class_name_'+no).append(item_class_name);
                            $('#class_category_name_'+no).append(class_category_name);
                            $('#cNmDept_'+no).append(cNmDept);
                            $('#warehouse_name_'+no).append(warehouse_name);
                            $('#kit_assy_'+no).append(kit_assy_icon);
                            $('#atk_stock_'+no).append(atk_stock_icon);
                            $('#common_stock_'+no).append(common_stock_icon);
                        }
                        reset_form();
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

function update(id_item_class_get, no_get){
    $.ajax({
        url: base_url+'inventory/list-item-class/'+key_session+'/'+id_item_class_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;

                var trList = '';
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var id_item_class   = responseList.id_item_class;
                    var company_id  = responseList.company_id;
                    var company_name    = responseList.company_name;
                    var id_class_category   = responseList.id_class_category;
                    var class_category_cd   = responseList.class_category_cd;
                    var class_category_name = responseList.class_category_name;
                    var item_class_cd   = responseList.item_class_cd;
                    var item_class_name = responseList.item_class_name;
                    var cIDDept = responseList.cIDDept;
                    var cNmDept = responseList.cNmDept;
                    var kit_assy    = responseList.kit_assy;
                    var atk_stock   = responseList.atk_stock;
                    var common_stock    = responseList.common_stock;
                    var id_warehouse    = responseList.id_warehouse;
                    var warehouse_cd    = responseList.warehouse_cd;
                    var warehouse_name  = responseList.warehouse_name;
                    var deleted = responseList.deleted;

                    $('#kit_assy').prop('checked', false);
                    $('#atk_stock').prop('checked', false);
                    $('#common_stock').prop('checked', false);

                    if (kit_assy*1==1) {
                        $('#kit_assy').prop('checked', true);
                    }
                    else if (kit_assy==0) {
                        $('#kit_assy').prop('checked', false);
                    }

                    if (atk_stock*1==1) {
                        $('#atk_stock').prop('checked', true);
                    }
                    else if (atk_stock==0) {
                        $('#atk_stock').prop('checked', false);
                    }

                    if (common_stock*1==1) {
                        $('#common_stock').prop('checked', true);
                    }
                    else if (common_stock==0) {
                        $('#common_stock').prop('checked', false);
                    }

                    $('#id_item_class').val(id_item_class);
                    $('#item_class_cd').val(item_class_cd);
                    $('#item_class_name').val(item_class_name);

                    if (cIDDept=='') {
                        list_department(0, 0);
                    }
                    else {
                        list_department(cIDDept, cNmDept);
                    }
                    
                    list_class_category(id_class_category, class_category_name);
                    list_warehouse(id_warehouse, warehouse_name);

                    $('#no').val(no_get);
                })
                
            })
        }
    });
}

function reset_form(){
    $('#id_item_class').val('');
    $('#item_class_cd').val('');
    $('#item_class_name').val('');
    $('#cIDDept').val('');
    $('#id_class_category').val('');
    $('#id_warehouse').val('');
    $('#no').val('');

    $('#kit_assy').prop('checked', false);
    $('#atk_stock').prop('checked', false);
    $('#common_stock').prop('checked', false);

    list_department(0, 0);
    list_class_category(0, 0);
    list_warehouse(0, 0);
}

function disable_enable(id_item_class_get, item_class_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_item_class_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_item_class_disen').val(id_item_class_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+item_class_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+item_class_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+item_class_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+item_class_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_item_class(){
    var id_item_class = $('#id_item_class_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'inventory/update-item-class/'+key_session,
        type: 'post',
        data: 'id_item_class='+id_item_class+'&deleted='+deleted,
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
                        list_item_class(0);
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