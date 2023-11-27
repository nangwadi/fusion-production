$(document).ready(function(){
    list_account(0, 0);
    list_job_type(0, 0);
    list_employee('marketing', 0, 0);
    list_employee('design', 0, 0);

    if (JobNo!='0') {
        detail_job(JobNo);
    }
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
                            trList += '<option value="'+id_account+'">'+account_cd+' / '+account_name+'</option>';
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

function get_job_number(){
    var id_account = $('#id_account').val();
    var id_job_type = $('#id_job_type').val();

    $('#JobNo').val('');

    if (id_account=='') {
        alert ('Customer name cannot empty.')
    }
    else {
        if (id_job_type=='') {
            alert ('Select Job Type.')
        }
        else {
            $.ajax({
                url: base_url+'jom/list-job-number/'+key_session+'/'+id_account+'/'+id_job_type,
                type: 'get',
                crossDomain: true,
                dataType: 'JSON',
                success: function(responseGet){
                    responseGet.map(function(responseGetList, i){
                        var status = responseGet.status;
                        if (status==0) {
                            alert ('Data not found, please refresh this page.');
                        }
                        else {
                            var response = responseGetList.response;
                            response.map(function(responseList){
                                var JobNo = responseList.JobNo;
                                var number = responseList.number;
                                
                                $('#JobNo').val(JobNo);
                                $('#number').val(number);
                            })
                        }
                    })
                }
            })
        }
    }
}

function list_employee(department_get, cNIK_get, cNmPegawai_get){
    $('#cNIK_'+department_get).html('');
    $.ajax({
        url: base_url+'jom/list-employee/'+key_session+'/'+department_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cNIK_get!=0) {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
            }
            else {
                trList += '<option value="">Select Employee</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    })
                }
            })
            $('#cNIK_'+department_get).append(trList);
        }
    });
}

function getJobName(){
    $('#JobName').val('');

    var MoldName = $('#MoldName').val();
    var MoldNomor = $('#MoldNomor').val();

    if (MoldName=='' && MoldNomor=='') {
        $('#JobName').val('');
    }
    else {
        $('#JobName').val((MoldName+' #'+MoldNomor).toUpperCase());
    }
}

function add_job_order(){
    var id_job_order = $('#id_job_order').val();
    var id_account = $('#id_account').val();
    var id_job_type = $('#id_job_type').val();
    var number = $('#number').val();
    var JobNo = $('#JobNo').val();
    var MoldName = $('#MoldName').val();
    var MoldNomor = $('#MoldNomor').val();
    var JobName = $('#JobName').val();
    var POCustomerNumber = $('#POCustomerNumber').val();
    var PODate = $('#PODate').val();
    var Qty = $('#Qty').val();
    var Amount = $('#Amount').val();
    var GrossProfit = $('#GrossProfit').val();
    var cNIK_marketing = $('#cNIK_marketing').val();
    var cNIK_design = $('#cNIK_design').val();
    var StartDatePlan = $('#StartDatePlan').val();
    var DeliveryDatePlan = $('#DeliveryDatePlan').val();
    var Keterangan = $('#Keterangan').val();

    if (id_account == '' || id_job_type == '' || JobNo == '' || MoldName == '' || MoldNomor == '' || JobName == '' || POCustomerNumber == '' || PODate == '' || Qty == '' || Amount == '' || GrossProfit == '' || cNIK_marketing == '' || cNIK_design == '' || StartDatePlan == '' || DeliveryDatePlan == '' || Keterangan == ''){
        alert('Data input cannot empty, please review again.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');

        $.ajax({
            url: base_url+'jom/add-job-order/'+key_session,
            type: 'post',
            data: 'id_job_order='+id_job_order+'&id_account='+id_account+'&id_job_type='+id_job_type+'&number='+number+'&JobNo='+JobNo+'&MoldName='+MoldName+'&MoldNomor='+MoldNomor+'&JobName='+JobName+'&POCustomerNumber='+POCustomerNumber+'&PODate='+PODate+'&Qty='+Qty+'&Amount='+Amount+'&GrossProfit='+GrossProfit+'&cNIK_marketing='+cNIK_marketing+'&cNIK_design='+cNIK_design+'&StartDatePlan='+StartDatePlan+'&DeliveryDatePlan='+DeliveryDatePlan+'&Keterangan='+Keterangan,
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
                        if (id_job_order==0) {
                            reset_form();
                        }
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
}

function reset_form(){
    $('#id_job_order').val('');
    //$('#id_account').val('');
    //$('#id_job_type').val('');
    $('#number').val('');
    $('#JobNo').val('');
    $('#MoldName').val('');
    $('#MoldNomor').val('');
    $('#JobName').val('');
    $('#POCustomerNumber').val('');
    $('#PODate').val('');
    $('#Qty').val('1');
    $('#Amount').val('0');
    $('#GrossProfit').val('0');
    //$('#cNIK_marketing').val('');
    //$('#cNIK_design').val('');
    $('#StartDatePlan').val('');
    $('#DeliveryDatePlan').val('');
    $('#Keterangan').val('');

    list_account(0, 0);
    list_job_type(0, 0);
    list_employee('marketing', 0, 0);
    list_employee('design', 0, 0);
}

function detail_job(JobNo_get){
    $.ajax({
        url: base_url+'jom/list-job-order-by-jobno/'+key_session+'/'+JobNo,
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
                        $('#JobNo').val(JobNo);
                        $('#MoldName').val(MoldName);
                        $('#MoldNomor').val(MoldNomor);
                        $('#JobName').val(JobName);
                        $('#POCustomerNumber').val(POCustomerNumber);
                        $('#PODate').val(PODate);
                        $('#Qty').val(Qty);
                        $('#Amount').val(Amount);
                        $('#GrossProfit').val(GrossProfit);
                        $('#StartDatePlan').val(StartDatePlan);
                        $('#DeliveryDatePlan').val(DeliveryDatePlan);
                        $('#Keterangan').val(Keterangan);

                        list_account(id_account, account_name);
                        list_job_type(id_job_type, job_type_name);
                        list_employee('marketing', cNIK_marketing, cNmPegawai_marketing);
                        list_employee('design', cNIK_design, cNmPegawai_design);
                    })
                }
            })
        }
    })
}

//  =======================================================================================================================================

function list_job_task(id_job_task_get, job_task_name_get){
    $('#id_job_task').html('');
    $.ajax({
        url: base_url+'jom/list-job-task/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_job_task_get!=0) {
                trList += '<option value="'+id_job_task_get+'">'+job_task_name_get+'</option>';
            }
            trList += '<option value="">Select Task</option>';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var id_job_task = responseList.id_job_task;
                        var job_task_cd = responseList.job_task_cd;
                        var job_task_name = responseList.job_task_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_job_task+'">'+job_task_name+'</option>';
                        }

                    })
                }
            })
            trList += '<option value="ALL">All</option>';
            $('#id_job_task').append(trList);
        }
    });
}

function list_job_task_sub(id_job_task_sub){
    $('#list_job_task_sub').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-job-task-sub/'+key_session+'/'+id_job_task_sub,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_job_task_sub tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_job_task_sub').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_job_task_sub = responseList.id_job_task_sub;
                        var job_task_sub_cd = responseList.job_task_sub_cd;
                        var job_task_sub_name = responseList.job_task_sub_name;
                        var id_job_task = responseList.id_job_task;
                        var job_task_cd = responseList.job_task_cd;
                        var job_task_name = responseList.job_task_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var machine = responseList.machine;
                        var deleted = responseList.deleted;

                        var machine_icon = '';
                        if ((machine)*1==1) {
                            machine_icon = '✔';
                        }
                        else if ((machine)*1==0) {
                            machine_icon = '✖';
                        }

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_job_task_sub+'\', \''+job_task_sub_cd+'\', \''+job_task_sub_name+'\', \''+id_job_task+'\', \''+job_task_name+'\', \''+(i+1)+'\');" title="Update Company - '+job_task_sub_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_job_task_sub+'\', \''+job_task_sub_name+'\', \''+1+'\');" title="Disable Company - '+job_task_sub_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_job_task_sub+'\', \''+job_task_sub_name+'\', \''+0+'\');" title="Enable Company - '+job_task_sub_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="job_task_name_'+(i+1)+'">'+job_task_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="job_task_sub_cd_'+(i+1)+'">'+job_task_sub_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="job_task_sub_name_'+(i+1)+'">'+job_task_sub_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="machine_'+(i+1)+'">'+machine_icon+'</div></td>';
                            trList += '<td style="color:white;"><div id="cNmDept_'+(i+1)+'">'+cNmDept+'</div></td>';
                            trList += '<td style="color:white;"><div id="cNmBag_'+(i+1)+'">'+cNmBag+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_job_task_sub tbody').append(trList);
                    $('#list_job_task_sub').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_job_task_sub(){
    var id_job_task_sub = $('#id_job_task_sub').val();
    var job_task_sub_cd = $('#job_task_sub_cd').val();
    var job_task_sub_name = $('#job_task_sub_name').val();
    var id_job_task = $('#id_job_task').val();

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-job-task-sub/'+key_session,
        type: 'post',
        data: 'id_job_task_sub='+id_job_task_sub+'&job_task_sub_cd='+job_task_sub_cd+'&job_task_sub_name='+job_task_sub_name+'&id_job_task='+id_job_task,
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
                        reset_form();
                        modal_loading_hide();
                        if (id_job_task_sub=='') {
                            list_job_task_sub(0);
                        }
                        else {
                            $('#job_task_sub_cd_'+no).html('');
                            $('#job_task_sub_name_'+no).html('');
                            $('#job_task_name_'+no).html('');
                            $('#cNmDept_'+no).html('');
                            $('#cNmBag_'+no).html('');
                            $('#machine_'+no).html('');
                            document.getElementById('btn_update_'+no).removeAttribute('onclick')
                            var response = responseGetList.response;
                            response.map(function(responseList, i){
                                var company_id_db = responseList.company_id;
                                var company_name_db = responseList.company_name;
                                var id_job_task_sub_db = responseList.id_job_task_sub;
                                var job_task_sub_cd_db = responseList.job_task_sub_cd;
                                var job_task_sub_name_db = responseList.job_task_sub_name;
                                var id_job_task_db = responseList.id_job_task;
                                var job_task_cd_db = responseList.job_task_cd;
                                var job_task_name_db = responseList.job_task_name;
                                var cIDDept_db = responseList.cIDDept;
                                var cNmDept_db = responseList.cNmDept;
                                var cIDBag_db = responseList.cIDBag;
                                var cNmBag_db = responseList.cNmBag;
                                var machine_db = responseList.machine;
                                var deleted_db = responseList.deleted;

                                var machine_icon = '';
                                if ((machine_db)*1==1) {
                                    machine_icon = '✔';
                                }
                                else if ((machine_db)*1==0) {
                                    machine_icon = '✖';
                                }

                                $('#job_task_sub_cd_'+no).append(job_task_sub_cd_db);
                                $('#job_task_sub_name_'+no).append(job_task_sub_name_db);
                                $('#job_task_name_'+no).append(job_task_name_db);
                                $('#cNmDept_'+no).append(cNmDept_db);
                                $('#cNmBag_'+no).append(cNmBag_db);
                                $('#machine_'+no).append(machine_icon);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_job_task_sub_db+'\', \''+job_task_sub_cd_db+'\', \''+job_task_sub_name_db+'\', \''+id_job_task_db+'\', \''+job_task_name_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_job_task_sub_db+'\', \''+id_job_task_sub_db+'\')');
                            })
                        }
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 10000);
                }
            })
        }
    })
}

function update(id_job_task_sub_get, job_task_sub_cd_get, job_task_sub_name_get, id_job_task_get, job_task_name_get, no_get){
    $('#id_job_task_sub').val(id_job_task_sub_get);
    $('#job_task_sub_cd').val(job_task_sub_cd_get);
    $('#job_task_sub_name').val(job_task_sub_name_get);
    $('#no').val(no_get);

    list_job_task(id_job_task_get, job_task_name_get);
}

function disable_enable(id_job_task_sub_get, job_task_sub_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_job_task_sub_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_job_task_sub_disen').val(id_job_task_sub_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+job_task_sub_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+job_task_sub_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+job_task_sub_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+job_task_sub_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_job_task_sub(){
    var id_job_task_sub = $('#id_job_task_sub_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-job-task-sub/'+key_session,
        type: 'post',
        data: 'id_job_task_sub='+id_job_task_sub+'&deleted='+deleted,
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
                        list_job_task_sub(0);
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