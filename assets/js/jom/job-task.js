$(document).ready(function(){
    list_job_task(0);

    list_department(0, 0);
})

function list_department(cIDDept_get, cNmDept_get){
    $('#cIDDept').html('');
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDDept_get!=0) {
                trList += '<option value="'+cIDDept_get+'">'+cNmDept_get+'</option>';
            }

            trList += '<option value="">Select Department</option>';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var deleted = responseList.deleted;

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

function getDivision(cIDBag_get, cNmBag_get){
    var cIDDept = $('#cIDDept').val();
    $('#cIDBag').html('');  

    $.ajax({
        url: base_url+'ess/list-division-by-department/'+key_session+'/'+cIDDept,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDBag_get!='') {
                trList += '<option value="'+cIDBag_get+'">'+cNmBag_get+'</option>';
            }
            else {
                trList += '<option value="">Select Division</option>';
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<option value="">Data Not Found</option>';
                    }
                    else {
                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var company_id = responseList.company_id;
                            var company_name = responseList.company_name;
                            var cIDDept = responseList.cIDDept;
                            var cNmDept = responseList.cNmDept;
                            var cIDBag = responseList.cIDBag;
                            var cNmBag = responseList.cNmBag;
                            var deleted = responseList.deleted;

                            trList += '<option value="'+cIDBag+'">'+cNmBag+'</option>';

                        })
                    }
                })
            }         
            trList += '<option value="ALL">All</option>';   
            $('#cIDBag').append(trList);
        }
    });
}

function list_job_task(id_job_task){
    $('#list_job_task').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-job-task/'+key_session+'/'+id_job_task,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_job_task tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_job_task').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
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
                            action += '<button class="btn btn-info" id="btn_update_'+(i+1)+'" onclick="update(\''+id_job_task+'\', \''+job_task_cd+'\', \''+job_task_name+'\', \''+cIDDept+'\', \''+cNmDept+'\', \''+cIDBag+'\', \''+cNmBag+'\', \''+machine+'\', \''+(i+1)+'\');" title="Update Company - '+job_task_name+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" id="btn_disable_'+(i+1)+'" onclick="disable_enable(\''+id_job_task+'\', \''+job_task_name+'\', \''+1+'\');" title="Disable Company - '+job_task_name+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_job_task+'\', \''+job_task_name+'\', \''+0+'\');" title="Enable Company - '+job_task_name+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><div id="job_task_cd_'+(i+1)+'">'+job_task_cd+'</div></td>';
                            trList += '<td style="color:white;"><div id="job_task_name_'+(i+1)+'">'+job_task_name+'</div></td>';
                            trList += '<td style="color:white;"><div id="machine_'+(i+1)+'">'+machine_icon+'</div></td>';
                            trList += '<td style="color:white;"><div id="cNmDept_'+(i+1)+'">'+cNmDept+'</div></td>';
                            trList += '<td style="color:white;"><div id="cNmBag_'+(i+1)+'">'+cNmBag+'</div></td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_job_task tbody').append(trList);
                    $('#list_job_task').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_job_task(){
    var id_job_task = $('#id_job_task').val();
    var job_task_cd = $('#job_task_cd').val();
    var job_task_name = $('#job_task_name').val();
    var cIDDept = $('#cIDDept').val();
    var cIDBag = $('#cIDBag').val();
    var no = $('#no').val();
    var machine_prop = $('#machine').prop('checked');
    
    var machine = '';
    if (machine_prop==true) {
        machine = 1;
    }
    else {
        machine = 0;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-job-task/'+key_session,
        type: 'post',
        data: 'id_job_task='+id_job_task+'&job_task_cd='+job_task_cd+'&job_task_name='+job_task_name+'&cIDDept='+cIDDept+'&cIDBag='+cIDBag+'&machine='+machine,
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
                        if (id_job_task=='') {
                            list_job_task(0);
                        }
                        else {
                            $('#job_task_cd_'+no).html('');
                            $('#job_task_name_'+no).html('');
                            $('#cNmDept_'+no).html('');
                            $('#cNmBag_'+no).html('');
                            $('#machine_'+no).html('');
                            document.getElementById('btn_update_'+no).removeAttribute('onclick')
                            var response = responseGetList.response;
                            response.map(function(responseList, i){
                                var company_id_db = responseList.company_id;
                                var company_name_db = responseList.company_name;
                                var id_job_task_db = responseList.id_job_task;
                                var job_task_cd_db = responseList.job_task_cd;
                                var job_task_name_db = responseList.job_task_name;
                                var cIDDept_db = responseList.cIDDept;
                                var cNmDept_db = responseList.cNmDept;
                                var cIDBag_db = responseList.cIDBag;
                                var cNmBag_db = responseList.cNmBag;
                                var machine_db = responseList.machine;
                                var deleted = responseList.deleted;

                                var machine_icon = '';
                                if ((machine_db)*1==1) {
                                    machine_icon = '✔';
                                }
                                else if ((machine_db)*1==0) {
                                    machine_icon = '✖';
                                }

                                $('#job_task_cd_'+no).append(job_task_cd_db);
                                $('#job_task_name_'+no).append(job_task_name_db);
                                $('#cNmDept_'+no).append(cNmDept_db);
                                $('#cNmBag_'+no).append(cNmBag_db);
                                $('#machine_'+no).append(machine_icon);

                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_job_task_db+'\', \''+job_task_cd_db+'\', \''+job_task_name_db+'\', \''+cIDDept_db+'\', \''+cNmDept_db+'\', \''+cIDBag_db+'\', \''+cNmBag_db+'\', \''+machine_db+'\', \''+no+'\')');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_job_task_db+'\', \''+id_job_task_db+'\')');
                            })
                        }
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function update(id_job_task_get, job_task_cd_get, job_task_name_get, cIDDept_get, cNmDept_get, cIDBag_get, cNmBag_get, machine_get, no_get){
    $('#id_job_task').val(id_job_task_get);
    $('#job_task_cd').val(job_task_cd_get);
    $('#job_task_name').val(job_task_name_get);
    $('#no').val(no_get);

    if (machine_get==1) {
        $('#machine').prop('checked', true);
    }
    else if (machine_get==0) {
        $('#machine').prop('checked', false);
    }

    list_department(cIDDept_get, cNmDept_get);
    getDivision(cIDBag_get, cNmBag_get);
}

function reset_form(){
    $('#id_job_task').val('');
    $('#job_task_cd').val('');
    $('#job_task_name').val('');
    $('#no').val('');
    list_department(0, 0);
    $('#cIDBag').html('');
    $('#machine').prop('checked', false);
}

function disable_enable(id_job_task_get, job_task_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_job_task_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_job_task_disen').val(id_job_task_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+job_task_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+job_task_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+job_task_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+job_task_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_job_task(){
    var id_job_task = $('#id_job_task_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-job-task/'+key_session,
        type: 'post',
        data: 'id_job_task='+id_job_task+'&deleted='+deleted,
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
                        list_job_task(0);
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