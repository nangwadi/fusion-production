$(document).ready(function(){
    list_sift(0);
})

function list_sift(cShiftID){
    $('#list_sift').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-sift/'+key_session+'/'+cShiftID,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_sift tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_sift').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cShiftID = responseList.cShiftID;
                        var cNmShift = responseList.cNmShift;
                        var holiday_overtime = responseList.holiday_overtime;
                        var holiday_overtime_desc = responseList.holiday_overtime_desc;
                        var x1 = responseList.x1;
                        var x2 = responseList.x2;
                        var x3 = responseList.x3;
                        var x4 = responseList.x4;
                        var color_marking = responseList.color_marking;
                        var deleted = responseList.deleted;

                        var schedule ='<button class="btn btn-success" onclick="modal_schedule(\''+cShiftID+'\', \''+cNmShift+'\');" title="Schedule - '+cNmShift+'."><i class="mdi mdi-calendar"></i></button>';

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-success" onclick="update(\''+cShiftID+'\', \''+cNmShift+'\', \''+x1+'\', \''+x2+'\', \''+x3+'\', \''+x4+'\', \''+color_marking+'\', \''+holiday_overtime+'\');" title="Update Company - '+cNmShift+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cShiftID+'\', \''+cNmShift+'\', \''+1+'\');" title="Disable Company - '+cNmShift+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cShiftID+'\', \''+cNmShift+'\', \''+0+'\');" title="Enable Company - '+cNmShift+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cShiftID+'</td>';
                            trList += '<td style="color:white;">'+cNmShift+'</td>';
                            trList += '<td style="color:white;">'+holiday_overtime_desc+'</td>';
                            trList += '<td style="color:white;">'+x1+'</td>';
                            trList += '<td style="color:white;">'+x2+'</td>';
                            trList += '<td style="color:white;">'+x3+'</td>';
                            trList += '<td style="color:white;">'+x4+'</td>';
                            trList += '<td style="color:white;">'+color_marking+'</td>';
                            trList += '<td style="color:white;">'+schedule+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_sift tbody').append(trList);
                    $('#list_sift').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function update(cShiftID, cNmShift, x1, x2, x3, x4, color_marking, holiday_overtime){
    $('#cShiftID').val('');
    $('#cNmShift').val('');
    $('#x1').val('');
    $('#x2').val('');
    $('#x3').val('');
    $('#x4').val('');
    $('#color_marking').val('');
    document.getElementById('holiday_overtime').removeAttribute('checked');

    $('#cShiftID').val(cShiftID);
    $('#cNmShift').val(cNmShift);
    $('#x1').val(x1);
    $('#x2').val(x2);
    $('#x3').val(x3);
    $('#x4').val(x4);
    $('#color_marking').val(color_marking);

    if (holiday_overtime==0) {
        //document.getElementById('holiday_overtime').setAttribute('checked', '');
    }
    else {
        document.getElementById('holiday_overtime').setAttribute('checked', 'checked');
    }

    document.getElementById('cShiftID').setAttribute('readonly', 'readonly');
    document.getElementById('cShiftID').setAttribute('style', 'color:black');
}

function add_sift(){
    var cShiftID = $('#cShiftID').val();
    var cNmShift = $('#cNmShift').val();
    var x1 = $('#x1').val();
    var x2 = $('#x2').val();
    var x3 = $('#x3').val();
    var x4 = $('#x4').val();
    var color_marking = $('#color_marking').val();
    
    var holiday_overtime = '';
    if (document.getElementById("holiday_overtime").checked == true){
        holiday_overtime = 1;
    }
    else {
        holiday_overtime = 0;
    }

    console.log(holiday_overtime);

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-sift/'+key_session,
        type: 'post',
        data: 'cShiftID='+cShiftID+'&cNmShift='+cNmShift+'&x1='+x1+'&x2='+x2+'&x3='+x3+'&x4='+x4+'&color_marking='+color_marking+'&holiday_overtime='+holiday_overtime,
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
                        list_sift(0);
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

function reset_form(){
    $('#cShiftID').val('');
    $('#cNmShift').val('');
    $('#x1').val('');
    $('#x2').val('');
    $('#x3').val('');
    $('#x4').val('');
    $('#color_marking').val('');
    document.getElementById('cShiftID').removeAttribute('readonly');
    document.getElementById('cShiftID').removeAttribute('style');
    document.getElementById('cShiftID').setAttribute('style', 'color:black');
}

function disable_enable(cShiftID_get, cNmShift_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cShiftID_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cShiftID_disen').val(cShiftID_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable sift - "+cNmShift_get+".");
        $('#modal_body_disen').append("Are you sure will disable sift "+cNmShift_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable sift - "+cNmShift_get+".");
        $('#modal_body_disen').append("Are you sure will enable sift "+cNmShift_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_sift(){
    var cShiftID = $('#cShiftID_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-sift/'+key_session,
        type: 'post',
        data: 'cShiftID='+cShiftID+'&deleted='+deleted,
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
                        list_sift(0);
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

function modal_schedule(cShiftID, cNmShift){
    $('#cShiftID_sift_time').val('');
    $('#modal_title_sift_time').html('');

    console.log('x');

    document.getElementById('modal_header_sift_time').setAttribute('class', 'modal-header bg-success');
     document.getElementById('modal_footer_sift_time').setAttribute('class', 'modal-footer bg-success');
    $('#modal_title_sift_time').append('Sift Schedule of '+cNmShift);

    $.ajax({
        url: base_url+'ess/list-sift-time/'+key_session+'/'+cShiftID,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';

                $('#cShiftID_sift_time').val(cShiftID);
                $('#list_sift_time tbody').html('');
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var cDayNm = responseList.cDayNm;
                    var dIN = responseList.dIN;
                    var dOUT = responseList.dOUT;
                    var dRest_Start1 = responseList.dRest_Start1;
                    var dRest_End1 = responseList.dRest_End1;
                    var dRest_Start2 = responseList.dRest_Start2;
                    var dRest_End2 = responseList.dRest_End2;
                    var dRest_Start3 = responseList.dRest_Start3;
                    var dRest_End3 = responseList.dRest_End3;

                    trList += '<tr>';
                        trList += '<td><input type="hidden" class="form-control" id="cDayNm_'+(i+1)+'" value="'+cDayNm+'">'+cDayNm+'</td>';
                        trList += '<td><input type="text" class="form-control" id="dIN_'+(i+1)+'" value="'+dIN+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dOUT_'+(i+1)+'" value="'+dOUT+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_Start1_'+(i+1)+'" value="'+dRest_Start1+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_End1_'+(i+1)+'" value="'+dRest_End1+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_Start2_'+(i+1)+'" value="'+dRest_Start2+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_End2_'+(i+1)+'" value="'+dRest_End2+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_Start3_'+(i+1)+'" value="'+dRest_Start3+'"></td>';
                        trList += '<td><input type="text" class="form-control" id="dRest_End3_'+(i+1)+'" value="'+dRest_End3+'"></td>';
                    trList += '</tr>';
                })
                
                $('#list_sift_time tbody').append(trList);
            });
            $('#modal_sift_time').modal('show');
        }
    })
}

function sift_time_hide(){
    $('#modal_sift_time').modal('hide');
}

function update_sift_time(){
    document.getElementById('loading_sift_time').removeAttribute('style');
    document.getElementById('loading_sift_time').removeAttribute('class');
    document.getElementById('loading_sift_time').setAttribute('style', 'display:block');
    $('#loading_sift_time_value').html('');
    document.getElementById('loading_sift_time').setAttribute('class', 'btn btn-secondary');
    $('#loading_sift_time_value').append('Saving data, please wait...');

    var cShiftID = $('#cShiftID_sift_time').val();
    var cDayNm_array = [];
    var dIN_array = [];
    var dOUT_array = [];
    var dRest_Start1_array = [];
    var dRest_End1_array = [];
    var dRest_Start2_array = [];
    var dRest_End2_array = [];
    var dRest_Start3_array = [];
    var dRest_End3_array = [];

    for (var i = 1; i <= 7; i++) {
        var cDayNm = $('#cDayNm_'+i).val();
        var dIN = $('#dIN_'+i).val();
        var dOUT = $('#dOUT_'+i).val();
        var dRest_Start1 = $('#dRest_Start1_'+i).val();
        var dRest_End1 = $('#dRest_End1_'+i).val();
        var dRest_Start2 = $('#dRest_Start2_'+i).val();
        var dRest_End2 = $('#dRest_End2_'+i).val();
        var dRest_Start3 = $('#dRest_Start3_'+i).val();
        var dRest_End3 = $('#dRest_End3_'+i).val();

        cDayNm_array.push(cDayNm);
        dIN_array.push(dIN);
        dOUT_array.push(dOUT);
        dRest_Start1_array.push(dRest_Start1);
        dRest_End1_array.push(dRest_End1);
        dRest_Start2_array.push(dRest_Start2);
        dRest_End2_array.push(dRest_End2);
        dRest_Start3_array.push(dRest_Start3);
        dRest_End3_array.push(dRest_End3);
    }

    $.ajax({
        url: base_url+'ess/add-sift-time/'+key_session+'/'+cShiftID,
        type: 'post',
        data: 'cDayNm='+cDayNm_array+'&dIN='+dIN_array+'&dOUT='+dOUT_array+'&dRest_Start1='+dRest_Start1_array+'&dRest_End1='+dRest_End1_array+'&dRest_Start2='+dRest_Start2_array+'&dRest_End2='+dRest_End2_array+'&dRest_Start3='+dRest_Start3_array+'&dRest_End3='+dRest_End3_array,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = (responseGetList.status)[0];
                //console.log(status);
                $('#loading_sift_time_value').html('');
                if (status==1) {
                    document.getElementById('loading_sift_time').setAttribute('class', 'btn btn-info');
                    $('#loading_sift_time_value').append('Saving data successfully, please wait...');
                    setTimeout(function () {
                        document.getElementById('loading_sift_time').setAttribute('style', 'display:none');
                        sift_time_hide();
                    }, 5000);
                }
                else {
                    document.getElementById('loading_sift_time').setAttribute('class', 'btn btn-danger');
                    $('#loading_sift_time_value').append('Saving data unsuccessfully, please wait...');
                    setTimeout(function () {
                        document.getElementById('loading_sift_time').setAttribute('style', 'display:none');
                        sift_time_hide();
                    }, 5000);
                }
            })
        }
    })
}