$(document).ready(function(){
    list_daily_overtime(1, 0, 0);
    list_catering_overtime(1, 0, 0);
    //console.log(category);
})

function list_catering_overtime(category, id_lembur, dTglHdr){
    $('#plant_1').val('');
    $('#plant_2').val('');
    $('#driver').val('');
    $('#total').val('');

    $.ajax({
        url: base_url+'overtime/list-catering-overtime/'+key_session+'/'+category,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#plant_1').val(0);
                    $('#plant_2').val(0);
                    $('#driver').val(0);
                    $('#total').val(0);
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    let total = 0;
                    response.map(function(responseList, i){
                        var plant = responseList.plant;
                        var sum = responseList.sum;
                        total += sum;

                        if (plant==1) {
                            $('#plant_1').val(sum);
                        }
                        else if (plant==2) {
                            $('#plant_2').val(sum);
                        }
                        else if (plant==3) {
                            $('#driver').val(sum);
                        }
                    })
                    $('#total').val(total);
                }
            })
        }
    });
}

function list_daily_overtime(category_get, id_lembur, dTglHdr){
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
    //console.log(cIDDept_get+' '+cIDBag_get);
    $('#list_daily_overtime').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'overtime/list-daily-overtime/'+key_session+'/'+category_get+'/'+id_lembur+'/'+dTglHdr+'/'+cIDDept_get+'/'+cIDBag_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_daily_overtime tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_daily_overtime').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_lembur = responseList.id_lembur;
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

                        var cancel_overtime = '';
                        if (approve==1) {
                            cancel_overtime = '<a onclick="cancel_overtime(\''+id_lembur+'\', \''+cNmPegawai_lembur+'\');" title="Cancel overtime - '+cNmPegawai_lembur+'.">'+approve_icon+'</button>';
                        }
                        else {
                            cancel_overtime = approve_icon;
                        }

                        //action = '<button class="btn btn-info" onclick="update(\''+id_lembur+'\', \''+cIDDept+'\', \''+cNmDept+'\', \''+cIDBag+'\', \''+cNmBag+'\',  \''+cNIK+'\', \''+daily_overtime+'\');" title="Update overtime maker - '+cNmDept+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        var action = '<button class="btn btn-danger" onclick="deleted(\''+id_lembur+'\', \''+cNmPegawai_lembur+'\');" title="Delete overtime maker - '+cNmDept+'."><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+dTglHdr+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai_lembur+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+cNmBag+'</td>';
                            trList += '<td style="color:white;">'+job+'</td>';
                            trList += '<td style="color:white;" align="center"><a onclick="update(\''+id_lembur+'\', \''+cNmPegawai_lembur+'\', \''+catering+'\');">'+catering_icon+'</a></td>';
                            trList += '<td style="color:white;" align="center">'+cancel_overtime+'</td>';
                            trList += '<td align="center">'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_daily_overtime tbody').append(trList);
                    $('#list_daily_overtime').dataTable();
                }
            })
        }
    });
}

function modal_add_overtime(){

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
        url: base_url+'overtime/list-employee-by-dept-div/'+key_session+'/1/'+cIDDept_get+'/'+cIDBag_get,
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
                            trList += '<td align="center"><input type="checkbox" id="overtime_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                            trList += '<td align="center"><input type="checkbox" id="catering_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                        trList += '</tr>';
                    });
                }
            })
            $('#list_maker tbody').append(trList);
            $('#modal_add_overtime').modal('show');
        }
    });
}

function modal_add_overtime_close(){
    $('#modal_add_overtime').modal('hide');
}

function add_daily_overtime(){
    var total_line_add = $('#total_line_add').val();
    var cNIK_obj = [];
    var overtime_obj = [];
    var catering_obj = [];
    var job_obj = [];
    let total_overtime = 0;

    for (var i=1; i<=total_line_add*1; i++){
        var cNIK = $('#cNIK_'+i).val();

        var overtime = $("#overtime_"+i).prop("checked");
        var catering = $("#catering_"+i).prop("checked");

        var catering_value = '';

        if (overtime == true) {
            var job = $("#job_"+i).val();
            if (catering == true) {
                catering_value = 1;
            }
            else {
                catering_value = 0;
            }
            cNIK_obj.push(cNIK);
            job_obj.push(job);
            overtime_obj.push(1);
            catering_obj.push(catering_value);

            total_overtime +=1;
        }
    }

    modal_add_overtime_close();
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'overtime/add-daily-overtime/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK_obj+'&overtime='+overtime_obj+'&catering='+catering_obj+'&job='+job_obj+'&category='+category+'&total_overtime='+total_overtime,
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
                        list_daily_overtime(1, 0, 0);
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

function modal_approve_overtime(){

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
        url: base_url+'overtime/list-approve-overtime/'+key_session+'/1/'+cIDDept_get+'/'+cIDBag_get,
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
                    trList += '<tr><td colspan="6" align="center">No Employee to Overtime.</td></tr>';
                }
                else {
                    var response = responseGetList.response;
                    $('#total_line_approve').val(response.length);
                    response.map(function(responseList, i){
                        var id_lembur = responseList.id_lembur;
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
                            trList += '<td align="center"><input type="hidden" id="id_lembur_'+(i+1)+'" value="'+id_lembur+'"><input type="checkbox" id="approve_'+(i+1)+'" style="width:25px; height:25px;"></td>';
                        trList += '</tr>';
                    });
                }
            })
            $('#list_approval tbody').append(trList);
            $('#modal_approve_overtime').modal('show');
        }
    });
}

function modal_approve_overtime_close(){
    $('#modal_approve_overtime').modal('hide');
}

function approve_overtime(){
    var total_line_approve = $('#total_line_approve').val();
    var id_lembur_obj = [];
    let total_line_approve_act = 0;
    for (var i = 1 - 1; i <= total_line_approve*1; i++) {
        var approve = $('#approve_'+i).prop('checked');
        if (approve==true) {
            var id_lembur = $('#id_lembur_'+i).val();
            id_lembur_obj.push(id_lembur);
            total_line_approve_act +=1;
        }
    }
    //console.log(id_lembur_obj);
    modal_approve_overtime_close();
    modal_loading_open('bg-info', 'Approving data', 'Please wait...');

    $.ajax({
        url: base_url+'overtime/update-approve-overtime/'+key_session,
        type: 'post',
        data: 'id_lembur='+id_lembur_obj+'&total_line_approve='+total_line_approve_act+'&approve=1',
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
                        list_daily_overtime(1, 0, 0);
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

function modal_approve_overtime_close(){
    $('#modal_approve_overtime').modal('hide');
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

function update(id_lembur_get, cNmPegawai_lembur_get, catering){
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
            url: base_url+'overtime/update-catering-daily-overtime/'+key_session,
            type: 'post',
            data: 'id_lembur='+id_lembur_get+'&catering='+catering,
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
                            list_daily_overtime(1, 0, 0);
                            if (category==3) {
                                list_catering_overtime(1, 0, 0);
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

function deleted(id_lembur_get, cNmPegawai_lembur_get){
    if (confirm('Are you sure you want to delete daily overtime - '+cNmPegawai_lembur_get)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'overtime/delete-daily-overtime/'+key_session,
            type: 'post',
            data: 'id_lembur='+id_lembur_get,
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
                            list_daily_overtime(1, 0, 0);
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

function cancel_overtime(id_lembur_get, cNmPegawai_lembur_get){
    var notify = '';
    notify = 'Are you sure you want cancel overtime for '+cNmPegawai_lembur_get+'?';
    

    if (confirm(notify)) {
        modal_loading_open('bg-info', 'Updating data', 'Please wait...');
        $.ajax({
            url: base_url+'overtime/update-approve-overtime/'+key_session,
            type: 'post',
            data: 'id_lembur='+id_lembur_get+'&approve=0&total_line_approve=1',
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
                            list_daily_overtime(1, 0, 0);
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
        url: base_url+'overtime/add-catering-overtime/'+key_session,
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
                        list_daily_overtime(1, 0, 0);
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
}