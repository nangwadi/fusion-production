$(document).ready(function(){
    list_sift_group(0);
})

function list_sift_group(cGroupID){
    $('#list_sift_group').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-sift-group/'+key_session+'/'+cGroupID,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_sift_group tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_sift_group').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cGroupID = responseList.cGroupID;
                        var cGroupNm = responseList.cGroupNm;
                        var deleted = responseList.deleted;

                        var calendar ='<a class="btn btn-success" onclick="modal_work_calendar(\''+cGroupID+'\', \''+cGroupNm+'\');" target="_blank" title="Schedule - '+cGroupNm+'."><i class="mdi mdi-calendar"></i></a>';

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cGroupID+'\', \''+cGroupNm+'\');" title="Update Company - '+cGroupNm+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cGroupID+'\', \''+cGroupNm+'\', \''+1+'\');" title="Disable Company - '+cGroupNm+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cGroupID+'\', \''+cGroupNm+'\', \''+0+'\');" title="Enable Company - '+cGroupNm+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cGroupID+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                            trList += '<td style="color:white;">'+calendar+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_sift_group tbody').append(trList);
                    $('#list_sift_group').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function update(cGroupID, cGroupNm){
    $('#cGroupID').val(cGroupID);
    $('#cGroupNm').val(cGroupNm);
    document.getElementById('cGroupID').setAttribute('readonly', 'readonly');
    document.getElementById('cGroupID').setAttribute('style', 'color:black');
}

function add_sift_group(){
    var cGroupID = $('#cGroupID').val();
    var cGroupNm = $('#cGroupNm').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-sift-group/'+key_session,
        type: 'post',
        data: 'cGroupID='+cGroupID+'&cGroupNm='+cGroupNm,
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
                        list_sift_group(0);
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
    $('#cGroupID').val('');
    $('#cGroupNm').val('');
    document.getElementById('cGroupID').removeAttribute('readonly');
    document.getElementById('cGroupID').removeAttribute('style');
    document.getElementById('cGroupID').setAttribute('style', 'color:black');
}

function disable_enable(cGroupID_get, cGroupNm_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cGroupID_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cGroupID_disen').val(cGroupID_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable sift group - "+cGroupNm_get+".");
        $('#modal_body_disen').append("Are you sure will disable sift group "+cGroupNm_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable sift group - "+cGroupNm_get+".");
        $('#modal_body_disen').append("Are you sure will enable sift group "+cGroupNm_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_sift_group(){
    var cGroupID = $('#cGroupID_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-sift-group/'+key_session,
        type: 'post',
        data: 'cGroupID='+cGroupID+'&deleted='+deleted,
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
                        list_sift_group(0);
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

function modal_work_calendar(cGroupID_get, cGroupNm_get){
    $('#modal_title_work_calendar').html('');
    $('#modal_title_work_calendar').append('Open Calendar '+cGroupNm_get);
    $('#cGroupID_work').val('');
    $('#cGroupID_work').val(cGroupID_get);

    $('#modal_work_calendar').modal('show');
}

function open_calendar(){
    var cGroupID = $('#cGroupID_work').val();
    var year_work = $('#year_work').val();

    window.open(base_url+'ess/work-calendar/'+cGroupID+'/'+year_work);
}

function modal_work_calendar_hide(){
    $('#modal_work_calendar').modal('hide');
}

function modal_create_calendar(){
    list_sift_group_create();
    list_sift_create();
    list_precense_type_create();
    $('#modal_create_calendar').modal('show');
}

function modal_create_calendar_hide(){
    $('#modal_create_calendar').modal('hide');
}

function list_sift_group_create(){
    $('#cGroupID_create').html('');
    $.ajax({
        url: base_url+'ess/list-sift-group/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    trList += '<option value="ALL">ALL</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cGroupID = responseList.cGroupID;
                        var cGroupNm = responseList.cGroupNm;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cGroupID+'">'+cGroupNm+'</option>';
                        }
                    })
                }
                $('#cGroupID_create').append(trList);
            })
        }
    });
}

function list_sift_create(){
    $('#cShiftID_create').html('');
    $('#cShiftID_create_absen').html('');
    $.ajax({
        url: base_url+'ess/list-sift/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
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
                        var cShiftID = responseList.cShiftID;
                        var cNmShift = responseList.cNmShift;
                        var x1 = responseList.x1;
                        var x2 = responseList.x2;
                        var x3 = responseList.x3;
                        var x4 = responseList.x4;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cShiftID+'">'+cNmShift+'</option>';
                        }
                    })
                }
                $('#cShiftID_create').append(trList);
                $('#cShiftID_create_absen').append(trList);
            })
        }
    });
}

function list_precense_type_create(){
    $('#cIDAbsen_create_absen').html('');
    $('#cIDAbsen_create_holiday').html('');
    $.ajax({
        url: base_url+'ess/list-precense-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
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
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var Note = responseList.Note;
                        var DayOff = responseList.DayOff;
                        var PotongGaji = responseList.PotongGaji;
                        
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDAbsen+'">'+cNmAbsen+'</option>';
                        }
                    })
                }
                $('#cIDAbsen_create_absen').append(trList);
                $('#cIDAbsen_create_holiday').append(trList);
            })
        }
    });
}

function create_calendar(){
    var year_create = $('#year_create').val();
    var cGroupID_create = $('#cGroupID_create').val();
    var cShiftID_create = $('#cShiftID_create').val();
    var cShiftID_create_absen = $('#cShiftID_create_absen').val();
    var cIDAbsen_create_absen = $('#cIDAbsen_create_absen').val();
    var cIDAbsen_create_holiday = $('#cIDAbsen_create_holiday').val();

    modal_create_calendar_hide();
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/create-calendar/'+year_create+'/'+cGroupID_create+'/'+cShiftID_create+'/'+cShiftID_create_absen+'/'+cIDAbsen_create_absen+'/'+cIDAbsen_create_holiday,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        modal_create_calendar();
                    }, 5000);
                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        modal_create_calendar();
                    }, 5000);
                }
            })
        }
    })

    //window.open(base_url+'ess/create-calendar/'+year_create+'/'+cGroupID_create+'/'+cShiftID_create+'/'+cShiftID_create_absen+'/'+cIDAbsen_create_absen+'/'+cIDAbsen_create_holiday);
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