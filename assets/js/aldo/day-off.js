$(document).ready(function(){
    list_day_off();
    list_precense_type(0, 0);
})

function list_day_off(){
    $('#list_day_off').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-day-off/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_day_off tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_day_off').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_cuti_day_off = responseList.id_cuti_day_off;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var annual_leave = responseList.annual_leave;
                        var cuti_khusus = responseList.cuti_khusus;
                        var images = responseList.images;
                        var cuti_tahunan_min = responseList.cuti_tahunan_min;
                        var max = responseList.max;
                        var create_by = responseList.create_by;
                        var cNmAbsen_create = responseList.cNmAbsen_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmAbsen_last = responseList.cNmAbsen_last;
                        var last_update = responseList.last_update;

                        var annual_leave_desc = '';
                        if (annual_leave==1) {
                            annual_leave_desc = 'Yes';
                        }
                        else {
                            annual_leave_desc = 'No';
                        }

                        var cuti_khusus_desc = '';
                        if (cuti_khusus==1) {
                            cuti_khusus_desc = 'Yes';
                        }
                        else {
                            cuti_khusus_desc = 'No';
                        }

                        var images_desc = '';
                        if (images==1) {
                            images_desc = 'Yes';
                        }
                        else {
                            images_desc = 'No';
                        }

                        var action = '<button class="btn btn-info" onclick="updated(\''+id_cuti_day_off+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\', \''+annual_leave+'\', \''+cuti_khusus+'\', \''+images+'\', \''+cuti_tahunan_min+'\', \''+max+'\');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        action += '<button class="btn btn-danger" onclick="deleted(\''+id_cuti_day_off+'\', \''+cNmAbsen+'\');"><i class="mdi mdi-delete"></i></button>'

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmAbsen+'</td>';
                            trList += '<td style="color:white;">'+annual_leave_desc+'</td>';
                            trList += '<td style="color:white;">'+images_desc+'</td>';
                            trList += '<td style="color:white;">'+images_desc+'</td>';
                            trList += '<td style="color:white;">'+cuti_tahunan_min+'</td>';
                            trList += '<td style="color:white;">'+max+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_day_off tbody').append(trList);
                    $('#list_day_off').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_precense_type(cIDAbsen_get, cNmAbsen_get){
    $('#cIDAbsen').html('');
    $.ajax({
        url: base_url+'ess/list-precense-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDAbsen_get==0) {
                trList += '<option value="">Select Precense Type</option>';
            }
            else {
                trList += '<option value="'+cIDAbsen_get+'">'+cNmAbsen_get+'</option>';
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
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;                        
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cIDAbsen+'">'+cNmAbsen+'</option>';
                        }
                    })
                }
            })
            $('#cIDAbsen').append(trList);
        }
    });
}

function list_employee(){
    $('#cIDAbsen').html('');
    //var cIDDept = $('#cIDDept').val();
    $.ajax({
        url: base_url+'aldo/list-employee-by-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(cIDAbsen_get);
            var trList = '';

            trList += '<option value="">Select Employee.</option>';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;

                        trList += '<option value="'+cIDAbsen+'">'+cNmAbsen+'</option>';
                    });
                }
            })
            $('#cIDAbsen').append(trList);
        }
    });
}

function add_day_off(){
    var id_cuti_day_off = $('#id_cuti_day_off').val();
    var cIDAbsen = $('#cIDAbsen').val();
    let annual_leave = '';
    let cuti_khusus = '';
    let images = '';
    var max = $('#max').val();
    var cuti_tahunan_min = $('#cuti_tahunan_min').val();

    if ($('#annual_leave').prop('checked')==true) {
        annual_leave = 1;
    }
    else {
        annual_leave = 0;
    }

    if ($('#cuti_khusus').prop('checked')==true) {
        cuti_khusus = 1;
    }
    else {
        cuti_khusus = 0;
    }

    if ($('#images').prop('checked')==true) {
        images = 1;
    }
    else {
        images = 0;
    }

    if (cIDAbsen =='' || max == '') {
        alert ('Data cannot empty, please try again.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');

        $.ajax({
            url: base_url+'aldo/add-day-off/'+key_session,
            type: 'post',
            data: 'id_cuti_day_off='+id_cuti_day_off+'&cIDAbsen='+cIDAbsen+'&annual_leave='+annual_leave+'&cuti_khusus='+cuti_khusus+'&images='+images+'&max='+max+'&cuti_tahunan_min='+cuti_tahunan_min,
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
                            list_day_off();
                            list_precense_type(0, 0);
                            $('#annual_leave').prop('checked', false);
                            $('#cuti_khusus').prop('checked', false);
                            $('#images').prop('checked', false);
                            $('#max').val('0');
                            $('#cuti_tahunan_min').val('0');
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

function updated(id_cuti_day_off_get, cIDAbsen_get, cNmAbsen_get, annual_leave_get, cuti_khusus_get, images_get, cuti_tahunan_min_get, max_get){
    $('#id_cuti_day_off').val('');
    $('#max').val('');
    $('#cuti_tahunan_min').val('');

    $('#id_cuti_day_off').val(id_cuti_day_off_get);
    $('#max').val(max_get);
    $('#cuti_tahunan_min').val(cuti_tahunan_min_get);

    list_precense_type(cIDAbsen_get, cNmAbsen_get);

    if (annual_leave_get==0) {
        $("#annual_leave").prop("checked", false);
    }
    else {
        $("#annual_leave").prop("checked", true);
    }

    if (cuti_khusus_get==0) {
        $("#cuti_khusus").prop("checked", false);
    }
    else {
        $("#cuti_khusus").prop("checked", true);
    }

    if (images_get==1) {
        $("#images").prop("checked", true);
    }
    else {
        $("#images").prop("checked", false);
    }
}

function deleted(id_cuti_day_off_get, cNmAbsen_get){
    if (confirm('Are you sure you want to delete Day Off - '+cNmAbsen_get)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/delete-day-off/'+key_session,
            type: 'post',
            data: 'id_cuti_day_off='+id_cuti_day_off_get,
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
                            list_day_off();
                            list_precense_type(0, 0);
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