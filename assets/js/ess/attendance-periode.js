$(document).ready(function(){
    list_attendance_periode(0);
})

function list_attendance_periode(cIdPeriod){
    $('#list_attendance_periode').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-attendance-periode/'+key_session+'/'+cIdPeriod,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_attendance_periode tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_attendance_periode').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIdPeriod = responseList.cIdPeriod;
                        var cNmPeriod = responseList.cNmPeriod;
                        var dTglPeriod_Start = responseList.dTglPeriod_Start;
                        var dTglPeriod_End = responseList.dTglPeriod_End;
                        var status = responseList.status;

                        var calendar ='<button class="btn btn-success" onclick="modal_schedule(\''+cIdPeriod+'\', \''+cNmPeriod+'\', \''+dTglPeriod_Start+'\', \''+dTglPeriod_End+'\');" title="Schedule - '+cNmPeriod+'."><i class="mdi mdi-calendar"></i></button>';

                        var action = '';
                        if (status==0 || status==null) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIdPeriod+'\', \''+cNmPeriod+'\', \''+dTglPeriod_Start+'\', \''+dTglPeriod_End+'\');" title="Update attendance-periode - '+cNmPeriod+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIdPeriod+'\', \''+cNmPeriod+'\', \''+dTglPeriod_Start+'\', \''+dTglPeriod_End+'\', \''+1+'\');" title="Disable attendance-periode - '+cNmPeriod+'."><i class="mdi mdi-bookmark-check"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIdPeriod+'\', \''+cNmPeriod+'\', \''+dTglPeriod_Start+'\', \''+dTglPeriod_End+'\', \''+0+'\');" title="Enable attendance-periode - '+cNmPeriod+'."><i class="mdi mdi-bookmark-check"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIdPeriod+'</td>';
                            trList += '<td style="color:white;">'+cNmPeriod+'</td>';
                            trList += '<td style="color:white;">'+dTglPeriod_Start+'</td>';
                            trList += '<td style="color:white;">'+dTglPeriod_End+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_attendance_periode tbody').append(trList);
                    $('#list_attendance_periode').dataTable();
                }
            })
        }
    });
}

function update(cIdPeriod, cNmPeriod, dTglPeriod_Start, dTglPeriod_End){
    $('#cIdPeriod').val(cIdPeriod);
    $('#cNmPeriod').val(cNmPeriod);
    $('#dTglPeriod_Start').val(dTglPeriod_Start);
    $('#dTglPeriod_End').val(dTglPeriod_End);
    document.getElementById('cIdPeriod').setAttribute('readonly', 'readonly');
    document.getElementById('cIdPeriod').setAttribute('style', 'color:black');
}

function add_attendance_periode(){
    var cIdPeriod = $('#cIdPeriod').val();
    var cNmPeriod = $('#cNmPeriod').val();
    var dTglPeriod_Start = $('#dTglPeriod_Start').val();
    var dTglPeriod_End = $('#dTglPeriod_End').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-attendance-periode/'+key_session,
        type: 'post',
        data: 'cIdPeriod='+cIdPeriod+'&cNmPeriod='+cNmPeriod+'&dTglPeriod_Start='+dTglPeriod_Start+'&dTglPeriod_End='+dTglPeriod_End,
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
                        list_attendance_periode(0);
                        reset_form();
                        modal_loading_hide();
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

function reset_form(){
    $('#cIdPeriod').val('');
    $('#cNmPeriod').val('');
    $('#dTglPeriod_Start').val('');
    $('#dTglPeriod_End').val('');
    document.getElementById('cIdPeriod').removeAttribute('readonly');
    document.getElementById('cIdPeriod').removeAttribute('style');
    document.getElementById('cIdPeriod').setAttribute('style', 'color:black');
}

function disable_enable(cIdPeriod_get, cNmPeriod_get, dTglPeriod_Start_get, dTglPeriod_End_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIdPeriod_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIdPeriod_disen').val(cIdPeriod_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Close attendance periode - "+cNmPeriod_get+".");
        $('#modal_body_disen').append("Are you sure will Close attendance periode "+cNmPeriod_get+" ?");
        $('#btn_disen').append('Close');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Open attendance periode - "+cNmPeriod_get+".");
        $('#modal_body_disen').append("Are you sure will Open attendance periode "+cNmPeriod_get+" ?");
        $('#btn_disen').append('Open');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_attendance_periode(){
    var cIdPeriod = $('#cIdPeriod_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-attendance-periode/'+key_session,
        type: 'post',
        data: 'cIdPeriod='+cIdPeriod+'&deleted='+deleted,
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
                        list_attendance_periode(0);
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