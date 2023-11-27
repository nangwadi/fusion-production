$(document).ready(function(){
    list_after_trial();
})

function list_after_trial(){
    $('#list_job_order').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-after-trial/'+key_session+'/'+JobNo,
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
                        var id_job_order_after_trial = responseList.id_job_order_after_trial;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_job_order = responseList.id_job_order;
                        var JobNo = responseList.JobNo;
                        var JobName = responseList.JobName;
                        var trial = responseList.trial;
                        var DeliveryDatePlan = responseList.DeliveryDatePlan;
                        var DeliveryDateAct = responseList.DeliveryDateAct;
                        var DeliveryDatePlan_format = responseList.DeliveryDatePlan_format;
                        var DeliveryDateAct_format = responseList.DeliveryDateAct_format;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var button = '';
                        var input_deli = '';
                        if (DeliveryDateAct_format=='') {
                            button += '<button class="btn btn-md btn-primary" title="Delivery Job '+JobNo+'" onclick="update_after_trial(\''+(i+1)+'\', \''+id_job_order_after_trial+'\');"><i class="mdi mdi-truck-delivery"></i></button>';
                            button += '<button class="btn btn-md btn-danger" title="Delete Job '+JobNo+'" onclick="delete_after_trial(\''+(i+1)+'\', \''+id_job_order_after_trial+'\', \''+trial+'\');"><i class="mdi mdi-delete-forever"></i></button>';
                            input_deli += '<input type="date" class="form-control" value="'+DeliveryDateAct+'" id="DeliveryDateAct_'+(i+1)+'">';
                        }
                        else {
                            if (response.length==(i+1)) {
                                button += '<button class="btn btn-md btn-primary" title="Delivery Job '+JobNo+'" onclick="update_after_trial(\''+(i+1)+'\', \''+id_job_order_after_trial+'\');"><i class="mdi mdi-truck-delivery"></i></button>';
                                button += '<button class="btn btn-md btn-danger" title="Delete Job '+JobNo+'" onclick="delete_after_trial(\''+(i+1)+'\', \''+id_job_order_after_trial+'\', \''+trial+'\');"><i class="mdi mdi-delete-forever"></i></button>';
                                input_deli += '<input type="date" class="form-control" value="'+DeliveryDateAct+'" id="DeliveryDateAct_'+(i+1)+'">';
                            }
                            else {
                                input_deli += DeliveryDateAct_format;
                            }
                        }

                        trList +='<tr>';
                            trList +='<td style="background-color:black;border:1px solid grey; min-height: 60px;" align="center">'+(i+1)+'</td>';
                            trList +='<td style="background-color:black;border:1px solid grey;">'+JobNo+'</td>';
                            trList +='<td class="tdclass">'+JobName+'</td>';
                            trList +='<td class="tdclass" align="center">'+trial+'</td>';
                            trList +='<td class="tdclass" align="center">'+DeliveryDatePlan_format+'</td>';
                            trList +='<td class="tdclass" align="center">'+input_deli+'</td>';
                            trList +='<td style="background-color:black;border:1px solid grey;" align="center">'+button+'</td>';
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

function add_after_trial(){
    var DeliveryDatePlan = $('#DeliveryDatePlan').val();
    if (DeliveryDatePlan == '') {
        alert('Delivery Plan Cannot Empty.')
    }
    else {
        if (confirm('Are you sure you want to after trial ?')) {
            modal_loading_open('bg-info', 'Saving data', 'Please wait...');
            $.ajax({
                url: base_url+'jom/add-after-trial/'+key_session,
                type: 'post',
                data: 'JobNo='+JobNo+'&DeliveryDatePlan='+DeliveryDatePlan,
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
                                list_after_trial();
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
}

function update_after_trial(no_get, id_job_order_after_trial_get){
    var DeliveryDateAct = $('#DeliveryDateAct_'+no_get).val();
    if (DeliveryDateAct=='') {
        alert ('Delivery Date Cannot Empty.');
    }
    else {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'jom/update-after-trial/'+key_session,
            type: 'post',
            data: 'id_job_order_after_trial='+id_job_order_after_trial_get+'&DeliveryDateAct='+DeliveryDateAct,
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
                            list_after_trial();
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
}

function delete_after_trial(no_get, id_job_order_after_trial_get, trial_get){
    if (confirm('Are you sure you want to delete after trial job '+JobNo+' - '+trial_get+' ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'jom/delete-after-trial/'+key_session,
            type: 'post',
            data: 'id_job_order_after_trial='+id_job_order_after_trial_get,
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
                            list_after_trial();
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