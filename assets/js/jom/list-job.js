$(document).ready(function(){
    list_account(0, 0);
    list_job_type(0, 0);

    $('#list_job_order').dataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            left: 2,
            right: 1
        }
    });
})

function list_account(id_account_get, account_name_get){
    $('#id_account').html('');
    $.ajax({
        url: base_url+'jom/list-account/'+key_session+'/customer/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_account_get!=0) {
                trList += '<option value="'+id_account_get+'">'+account_name_get+'</option>';
            }

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    trList += '<option value="">Select Customer</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_account+'">'+account_cd+' - '+account_name+'</option>';
                        }

                    })
                }
            })
            $('#id_account').append(trList);
        }
    });
}

function list_job_type(id_job_type_get, job_type_name_get){
    $('#id_job_type').html('');
    $.ajax({
        url: base_url+'jom/list-job-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_job_type_get!=0) {
                trList += '<option value="'+id_job_type_get+'">'+job_type_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    trList += '<option value="">Select Job Type</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_job_type = responseList.id_job_type;
                        var job_type_cd = responseList.job_type_cd;
                        var job_type_name = responseList.job_type_name;
                        var job_type_format = responseList.job_type_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_job_type+'">'+job_type_name+'</option>';
                        }
                    })
                }
            })
            $('#id_job_type').append(trList);
        }
    });
}

function search_job(){
    var id_account = $('#id_account').val();
    var id_job_type = $('#id_job_type').val();
    if (id_account == '' || id_job_type == '') {
        alert('Customer or Job Type Cannot Empty, Please Try Again.')
    }
    else {
        $('#list_job_order').dataTable().fnDestroy();
        $.ajax({
            url: base_url+'jom/list-job-order/'+key_session+'/'+id_account+'/'+id_job_type,
            type: 'get',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                $('#list_job_order tbody').html('');
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    var trList = '';
                    if (status==0) {
                        alert('Data not found.');

                        $('#list_job_order').dataTable({
                            scrollY:        "400px",
                            scrollX:        true,
                            scrollCollapse: true,
                            paging:         false,
                            fixedColumns:   {
                                left: 2,
                                right: 1
                            }
                        });
                    }
                    else {
                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var id_job_order = responseList.id_job_order;
                            var company_id = responseList.company_id;
                            var company_name = responseList.company_name;
                            var id_account = responseList.id_account;
                            var account_cd = responseList.account_cd;
                            var account_name = responseList.account_name;
                            var id_job_type = responseList.id_job_type;
                            var job_type_cd = responseList.job_type_cd;
                            var job_type_name = responseList.job_type_name;
                            var JobNo = responseList.JobNo;
                            var MoldName = responseList.MoldName;
                            var MoldNomor = responseList.MoldNomor;
                            var JobName = responseList.JobName;
                            var POCustomerNumber = responseList.POCustomerNumber;
                            var PODate = responseList.PODate;
                            var PODate_format = responseList.PODate_format;
                            var Qty = responseList.Qty;
                            var Amount = responseList.Amount;
                            var GrossProfit = responseList.GrossProfit;
                            var Amount_format = responseList.Amount_format;
                            var GrossProfit = responseList.GrossProfit;
                            var cNIK_marketing = responseList.cNIK_marketing;
                            var cNmPegawai_marketing = responseList.cNmPegawai_marketing;
                            var cNIK_design = responseList.cNIK_design;
                            var cNmPegawai_design = responseList.cNmPegawai_design;
                            var StartDatePlan = responseList.StartDatePlan;
                            var StartDatePlan_format = responseList.StartDatePlan_format;
                            var StartDateAct_format = responseList.StartDateAct_format;
                            var DeliveryDatePlan = responseList.DeliveryDatePlan;
                            var DeliveryDatePlan_format = responseList.DeliveryDatePlan_format;
                            var DeliveryDateAct_format = responseList.DeliveryDateAct_format;
                            var Keterangan = responseList.Keterangan;
                            var create_by = responseList.create_by;
                            var cNmPegawai_create = responseList.cNmPegawai_create;
                            var create_date = responseList.create_date;
                            var last_by = responseList.last_by;
                            var cNmPegawai_last = responseList.cNmPegawai_last;
                            var last_update = responseList.last_update;

                            /*var button = '<button class="btn btn-sm btn-success" title="Create Sales Document of '+JobNo+'"><i class="mdi mdi-file"></i></button>&nbsp;';
                                button += '<button class="btn btn-sm btn-info" title="Create Part List of '+JobNo+'"><i class="mdi mdi-file-tree"></i></button>&nbsp;';
                                button += '<button class="btn btn-sm btn-primary" title="Delivery of '+JobNo+'"><i class="mdi mdi-truck-delivery"></i></button>&nbsp;';*/

                            var button = '<button class="btn btn-md btn-primary" title="Job Detail of '+JobNo+'" onclick="modal_detail(\''+id_job_order+'\', \''+JobNo+'\');"><i class="mdi mdi-layers"></i></button>';

                            trList +='<tr>';
                                trList +='<td style="background-color:black;border:1px solid grey; min-height: 60px;" align="center">'+(i+1)+'</td>';
                                trList +='<td style="background-color:black;border:1px solid grey;" align="center">'+JobNo+'</td>';
                                trList +='<td class="tdclass">'+JobName+'</td>';
                                trList +='<td class="tdclass">'+POCustomerNumber+'</td>';
                                trList +='<td class="tdclass" align="center">'+PODate_format+'</td>';
                                trList +='<td class="tdclass_right" align="right">'+Qty+'</td>';
                                trList +='<td class="tdclass_right" align="right">'+Amount_format+'</td>';
                                trList +='<td class="tdclass" align="center">'+StartDatePlan_format+'</td>';
                                trList +='<td class="tdclass" align="center">'+StartDateAct_format+'</td>';
                                trList +='<td class="tdclass" align="center">'+DeliveryDatePlan_format+'</td>';
                                trList +='<td class="tdclass" align="center">'+DeliveryDateAct_format+'</td>';
                                trList +='<td class="tdclass">'+Keterangan+'</td>';
                                trList +='<td align="center">'+button+'</td>';
                            trList +='</tr>';
                        })
                        $('#list_job_order tbody').append(trList);
                        $('#list_job_order').dataTable({
                            scrollY:        "400px",
                            scrollX:        true,
                            scrollCollapse: true,
                            paging:         false,
                            fixedColumns:   {
                                left: 2,
                                right: 1
                            }
                        });
                    }
                    
                })
            }
        })
    }
}

function modal_detail(id_job_order_get, JobNo_get){
    $('#modal_title_detail').html('');
    $('#JobNo').val('');

    $('#modal_title_detail').append('<i class="mdi mdi-image-filter-none"></i>&nbsp;&nbsp;Detail Job '+JobNo_get);

    $.ajax({
        url: base_url+'jom/list-job-order-by-jobno/'+key_session+'/'+JobNo_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status!=0) {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var id_job_order = responseList.id_job_order;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_account = responseList.id_account;
                        var account_cd = responseList.account_cd;
                        var account_name = responseList.account_name;
                        var id_job_type = responseList.id_job_type;
                        var job_type_cd = responseList.job_type_cd;
                        var job_type_name = responseList.job_type_name;
                        var JobNo = responseList.JobNo;
                        var MoldName = responseList.MoldName;
                        var MoldNomor = responseList.MoldNomor;
                        var JobName = responseList.JobName;
                        var POCustomerNumber = responseList.POCustomerNumber;
                        var PODate = responseList.PODate;
                        var Qty = responseList.Qty;
                        var Amount = responseList.Amount;
                        var GrossProfit = responseList.GrossProfit;
                        var cNIK_marketing = responseList.cNIK_marketing;
                        var cNmPegawai_marketing = responseList.cNmPegawai_marketing;
                        var cNIK_design = responseList.cNIK_design;
                        var cNmPegawai_design = responseList.cNmPegawai_design;
                        var StartDatePlan = responseList.StartDatePlan;
                        var StartDateAct = responseList.StartDateAct;
                        var DeliveryDatePlan = responseList.DeliveryDatePlan;
                        var DeliveryDateAct = responseList.DeliveryDateAct;
                        var Keterangan = responseList.Keterangan;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        $('#id_job_order').val(id_job_order);
                        $('#id_account_get').val(account_name);
                        $('#id_job_type_get').val(job_type_name);
                        $('#JobNo').val(JobNo);
                        $('#MoldName').val(MoldName);
                        $('#MoldNomor').val(MoldNomor);
                        $('#JobName').val(JobName);
                        $('#POCustomerNumber').val(POCustomerNumber);
                        $('#PODate').val(PODate);
                        $('#Qty').val(Qty);
                        $('#Amount').val(Amount);
                        $('#GrossProfit').val(GrossProfit);

                        $('#cNIK_marketing').val(cNmPegawai_marketing);
                        $('#cNIK_design').val(cNmPegawai_design);
                        $('#StartDatePlan').val(StartDatePlan);
                        $('#DeliveryDatePlan').val(DeliveryDatePlan);
                        $('#StartDateAct').val(StartDateAct);
                        $('#DeliveryDateAct').val(DeliveryDateAct);
                        $('#Keterangan').val(Keterangan);
                    })
                }
                $('#modal_detail').modal('show');
            })
        }
    })
}

function modal_detail_close(){
    $('#modal_detail').modal('hide');
}

function delete_job(){
    var id_job_order = $('#id_job_order').val();
    var JobNo = $('#JobNo').val();
    if (confirm('Are you sure you want to delete job '+JobNo+' ?')) {
        $.ajax({
            url: base_url+'jom/delete-job-order/'+key_session,
            type: 'post',
            data: 'id_job_order='+id_job_order,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        alert ('Deleting job successfully.');
                        location.reload(true);
                    }
                    else {
                        var response = responseGetList.response;
                        alert ('Deleting job unsuccessfully. Error : '+response);
                    }
                })
            }
        })
    }
}

function update_job(){
    var JobNo = $('#JobNo').val();
    window.open(base_url+'jom/input-job/'+JobNo);
}

function after_trial(){
    var JobNo = $('#JobNo').val();
    window.open(base_url+'jom/after-trial/'+JobNo);
}

function part_list(){
    var JobNo = $('#JobNo').val();
    window.open(base_url+'jom/part-list/'+JobNo);
}