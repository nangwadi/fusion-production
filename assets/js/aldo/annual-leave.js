$(document).ready(function(){
    list_annual_leave(0, this_year);
    list_year(0);
    list_employee_active(1, 0, 0);
})

function list_year(year_get){
    $('#year').html('');
    var trList = '';
    if (year_get!=0) {
        trList += '<option value="'+year_get+'">'+year_get+'</option>';
    }
    trList += '<option value="'+this_year+'">'+this_year+'</option>';
    for (var i=prev_year; i<next_year; i++){
        trList += '<option value="'+i+'">'+i+'</option>';
    }
    $('#year').append(trList);
}

function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
    $('#cNIK').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#cNIK tbody').html('');
            var trList = '';
            if (cNIK_get!=0) {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
            }
            else {
                trList += '<option value="">Select Employee</option>';
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<option value="">Data not found.</option>';
                    }
                    else {
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
            }
            $('#cNIK').append(trList);
        }
    });
}

function list_annual_leave(id_cuti_master, year_get){
    var year = '';
    if (year_get!=0) {
        year = year_get;
    }
    else {
        year = $('#year').val();
    }

    $('#list_annual_leave').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-annual-leave/'+key_session+'/'+id_cuti_master+'/'+year,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_annual_leave tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_annual_leave').dataTable();
                }
                else {
                    var trList = '';
                    $('#list_annual_leave tbody').html('');
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_cuti_master = responseList.id_cuti_master;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cNmBag = responseList.cNmBag;
                        var cNmDept = responseList.cNmDept;
                        var total = (responseList.total)*1;
                        var cuti_bsm = (responseList.cuti_bsm)*1;
                        var annual_leave_used = (responseList.annual_leave_used)*1;
                        var annual_leave_diff = (responseList.annual_leave_diff)*1;
                        var year = responseList.year;
                        var dTglBerlaku_Dari = responseList.dTglBerlaku_Dari;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+year+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+' / '+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+dTglBerlaku_Dari+'</td>';
                            trList += '<td style="color:white;" align="center"><div id="total_'+(i+1)+'">'+total+'</td>';
                            trList += '<td style="color:white;" align="center"><div id="cuti_bsm_'+(i+1)+'">'+cuti_bsm+'</td>';
                            trList += '<td style="color:white;" align="center"><div id="annual_leave_used_'+(i+1)+'">'+annual_leave_used+'</td>';
                            trList += '<td style="color:white;" align="center"><div id="annual_leave_diff_'+(i+1)+'">'+annual_leave_diff+'</td>';
                            trList += '<td style="color:white;" align="center"><button class="btn btn-info" onclick="update(\''+(i+1)+'\', \''+year+'\', \''+cNIK+'\', \''+cNmPegawai+'\', \''+total+'\', \''+cuti_bsm+'\', \''+annual_leave_used+'\', \''+dTglBerlaku_Dari+'\', \''+id_cuti_master+'\');"><i class="mdi mdi-lead-pencil"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_annual_leave tbody').append(trList);
                    $('#list_annual_leave').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function update(no_get, year_get, cNIK_get, cNmPegawai_get, total_get, cuti_bsm_get, annual_leave_used_get, dTglBerlaku_Dari_get, id_cuti_master_get){
    $('#total').val('');
    $('#cuti_bsm').val('');
    $('#id_cuti_master').val('');
    $('#dTglBerlaku_Dari').val('');
    $('#no').val('');
    $('#annual_leave_used').val('');

    //console.log(annual_leave_used_get);

    list_year(year_get);
    list_employee_active(1, cNIK_get, cNmPegawai_get);
    $('#total').val(total_get);
    $('#cuti_bsm').val(cuti_bsm_get);
    $('#id_cuti_master').val(id_cuti_master_get);
    $('#dTglBerlaku_Dari').val(dTglBerlaku_Dari_get);
    $('#no').val(no_get);
    $('#annual_leave_used').val(annual_leave_used_get);
}

function add_annual_leave(){
    var year = $('#year').val();
    var cNIK = $('#cNIK').val();
    var total = $('#total').val();
    var cuti_bsm = $('#cuti_bsm').val();
    var id_cuti_master = $('#id_cuti_master').val();
    var dTglBerlaku_Dari = $('#dTglBerlaku_Dari').val();
    var no = $('#no').val();
    var annual_leave_used = $('#annual_leave_used').val();


    let annual_leave_diff = (total)-((cuti_bsm*1)+(annual_leave_used*1));

    if (cNIK == '' || total == '' || cuti_bsm == '' || dTglBerlaku_Dari == '') {
        alert ("Data cannot empty. Please try again.");
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');

        $.ajax({
            url: base_url+'aldo/add-annual-leave/'+key_session,
            type: 'post',
            data: 'year='+year+'&cNIK='+cNIK+'&total='+total+'&cuti_bsm='+cuti_bsm+'&id_cuti_master='+id_cuti_master+'&dTglBerlaku_Dari='+dTglBerlaku_Dari,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        $('#total_'+no).html('');
                        $('#cuti_bsm_'+no).html('');
                        $('#annual_leave_diff_'+no).html('');   

                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            if (no=='') {
                                list_annual_leave(0, this_year);
                            }
                            else {
                                $('#total_'+no).append(total);
                                $('#cuti_bsm_'+no).append(cuti_bsm);
                                $('#annual_leave_diff_'+no).append(annual_leave_diff);                            
                            }
                            modal_loading_hide();
                            reset_form();
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

function reset_form(){
    $('#total').val('');
    $('#cuti_bsm').val('');
    $('#id_cuti_master').val('');
    $('#dTglBerlaku_Dari').val('');

    list_year(0);
    list_employee_active(1, 0, 0);
}

/*function modal_add_aldo(){

    var cIDDept = '';
    if (category==1) {
        cIDDept_get = cIDDept;
    }
    else if (category==2) {
        cIDDept_get = cIDDept;
    }
    else if (category==3) {
        cIDDept_get = '0';
    }

    var cIDBag_get = '';
    if (category==1) {
        cIDBag_get = cIDBag;
    }
    else if (category==2) {
        cIDBag_get = '0';
    }
    else if (category==3) {
        cIDBag_get = '0';
    }

    $.ajax({
        url: base_url+'aldo/list-employee-by-dept-div/'+key_session+'/1/'+cIDDept_get+'/'+cIDBag_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            $('#total_line_add').val('');
            $('#list_maker tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<tr><td colspan="6" align="center">Employee Not Found.</td></tr>';
                }
                else {
                    var response = responseGetList.response;
                    $('#total_line_add').val(response.length);
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cNmDept = responseList.cNmDept;
                        var cNmBag = responseList.cNmBag;

                        trList += '<tr>';
                            trList += '<td align="center">'+(i+1)+'</td>';
                            trList += '<td>'+cNmPegawai+' / '+cNIK+'</td>';
                            trList += '<td>'+cNmDept+'</td>';
                            trList += '<td><input type="hidden" class="form-control" id="cNIK_'+(i+1)+'" value="'+cNIK+'"><input type="text" class="form-control" id="job_'+(i+1)+'" style="background-color:white; color:black;"></td>';
                            trList += '<td align="center"><input type="checkbox" id="aldo_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                            trList += '<td align="center"><input type="checkbox" id="catering_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                        trList += '</tr>';
                    });
                }
            })
            $('#list_maker tbody').append(trList);
            $('#modal_add_aldo').modal('show');
        }
    });
}

function modal_add_aldo_close(){
    $('#modal_add_aldo').modal('hide');
}

function add_daily_aldo(){
    var total_line_add = $('#total_line_add').val();
    var cNIK_obj = [];
    var aldo_obj = [];
    var catering_obj = [];
    var job_obj = [];
    let total_aldo = 0;

    for (var i=1; i<=total_line_add*1; i++){
        var cNIK = $('#cNIK_'+i).val();

        var aldo = $("#aldo_"+i).prop("checked");
        var catering = $("#catering_"+i).prop("checked");

        var catering_value = '';

        if (aldo == true) {
            var job = $("#job_"+i).val();
            if (catering == true) {
                catering_value = 1;
            }
            else {
                catering_value = 0;
            }
            cNIK_obj.push(cNIK);
            job_obj.push(job);
            aldo_obj.push(1);
            catering_obj.push(catering_value);

            total_aldo +=1;
        }
    }

    modal_add_aldo_close();
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'aldo/add-daily-aldo/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK_obj+'&aldo='+aldo_obj+'&catering='+catering_obj+'&job='+job_obj+'&category='+category+'&total_aldo='+total_aldo,
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
                        list_daily_aldo(1, 0, 0);
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

function modal_approve_aldo(){

    var cIDDept_get = '';
    if (category==1) {
        cIDDept_get = cIDDept;
    }
    else if (category==2) {
        cIDDept_get = cIDDept;
    }
    else if (category==3) {
        cIDDept_get = '0';
    }

    var cIDBag_get = '';
    if (category==1) {
        cIDBag_get = cIDBag;
    }
    else if (category==2) {
        cIDBag_get = '0';
    }
    else if (category==3) {
        cIDBag_get = '0';
    }

    $.ajax({
        url: base_url+'aldo/list-approve-aldo/'+key_session+'/1/'+cIDDept_get+'/'+cIDBag_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            $('#total_line_approve').val('');
            $('#list_approval tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<tr><td colspan="6" align="center">No Employee to aldo.</td></tr>';
                }
                else {
                    var response = responseGetList.response;
                    $('#total_line_approve').val(response.length);
                    response.map(function(responseList, i){
                        var id_cuti_master = responseList.id_cuti_master;
                        var company_id = responseList.company_id;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai_lembur = responseList.cNmPegawai;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var cShiftID = responseList.cShiftID;
                        var dTglHdr = responseList.dTglHdr;
                        var job = responseList.job;
                        var kategori = responseList.kategori;
                        var plan_start = responseList.plan_start;
                        var plan_end = responseList.plan_end;
                        var catering = responseList.catering;
                        var approve = responseList.approve;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var catering_icon = '';
                        if (catering==1) {
                            catering_icon = '✔';
                        }
                        else if (catering==0) {
                            catering_icon = '✖';
                        }

                        var approve_icon = '';
                        if (approve==1) {
                            approve_icon = '✔';
                        }
                        else if (approve==0) {
                            approve_icon = '✖';
                        }

                        trList += '<tr>';
                            trList += '<td align="center">'+(i+1)+'</td>';
                            trList += '<td>'+cNmPegawai_lembur+'</td>';
                            trList += '<td>'+cNmDept+'</td>';
                            trList += '<td>'+job+'</td>';
                            trList += '<td align="center">'+approve_icon+'</td>';
                            trList += '<td align="center"><input type="hidden" id="id_cuti_master_'+(i+1)+'" value="'+id_cuti_master+'"><input type="checkbox" id="approve_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                        trList += '</tr>';
                    });
                }
            })
            $('#list_approval tbody').append(trList);
            $('#modal_approve_aldo').modal('show');
        }
    });
}

function modal_approve_aldo_close(){
    $('#modal_approve_aldo').modal('hide');
}

function approve_aldo(){
    var total_line_approve = $('#total_line_approve').val();
    var id_cuti_master_obj = [];
    let total_line_approve_act = 0;
    for (var i = 1 - 1; i <= total_line_approve*1; i++) {
        var approve = $('#approve_'+i).prop('checked');
        if (approve==true) {
            var id_cuti_master = $('#id_cuti_master_'+i).val();
            id_cuti_master_obj.push(id_cuti_master);
            total_line_approve_act +=1;
        }
    }
    //console.log(id_cuti_master_obj);
    modal_approve_aldo_close();
    modal_loading_open('bg-info', 'Approving data', 'Please wait...');

    $.ajax({
        url: base_url+'aldo/update-approve-aldo/'+key_session,
        type: 'post',
        data: 'id_cuti_master='+id_cuti_master_obj+'&total_line_approve='+total_line_approve_act+'&approve=1',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Approving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        list_daily_aldo(1, 0, 0);
                        modal_loading_hide();
                    }, 5000);
                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Approving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function modal_approve_aldo_close(){
    $('#modal_approve_aldo').modal('hide');
}

function approve_all(){
    var approve_all = $('#approve_all').prop('checked');

    var total_line_approve = $('#total_line_approve').val();
    for (var i = 1; i <= total_line_approve*1; i++) {
        if (approve_all==true) {
            document.getElementById('approve_'+i).setAttribute('checked', 'checked');
        }
        else {
            document.getElementById('approve_'+i).removeAttribute('checked');
        }
    }
}

function update(id_cuti_master_get, cNmPegawai_lembur_get, catering){
    var notify = '';
    if (catering==1) {
        notify = 'Are you sure you want cancel order catering for '+cNmPegawai_lembur_get+'?';
    }
    else {
        notify = 'Are you sure you want order catering for '+cNmPegawai_lembur_get+'?';
    }

    if (confirm(notify)) {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/update-catering-daily-aldo/'+key_session,
            type: 'post',
            data: 'id_cuti_master='+id_cuti_master_get+'&catering='+catering,
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
                            list_daily_aldo(1, 0, 0);
                            if (category==3) {
                                list_catering_aldo(1, 0, 0);
                            }
                            modal_loading_hide();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function deleted(id_cuti_master_get, cNmPegawai_lembur_get){
    if (confirm('Are you sure you want to delete daily aldo - '+cNmPegawai_lembur_get)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/delete-daily-aldo/'+key_session,
            type: 'post',
            data: 'id_cuti_master='+id_cuti_master_get,
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
                            list_daily_aldo(1, 0, 0);
                            modal_loading_hide();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function cancel_aldo(id_cuti_master_get, cNmPegawai_lembur_get){
    var notify = '';
    notify = 'Are you sure you want cancel aldo for '+cNmPegawai_lembur_get+'?';
    

    if (confirm(notify)) {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/update-approve-aldo/'+key_session,
            type: 'post',
            data: 'id_cuti_master='+id_cuti_master_get+'&approve=0&total_line_approve=1',
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
                            list_daily_aldo(1, 0, 0);
                            modal_loading_hide();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Updating data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function add_catering(){
    var plant_1 = $('#plant_1').val();
    var plant_2 = $('#plant_2').val();
    var driver = $('#driver').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'aldo/add-catering-aldo/'+key_session,
        type: 'post',
        data: 'plant_1='+plant_1+'&plant_2='+plant_2+'&driver='+driver,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        list_daily_aldo(1, 0, 0);
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

function reset_form(){
    list_department(0, 0);
    $('#cIDBag').html('');
    $('#cNIK').html('');
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
}*/