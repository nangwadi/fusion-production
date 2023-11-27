$(document).ready(function(){
    list_work_calendar();
})

function list_work_calendar(){
    $('#calendar').html('');
    $.ajax({
        url: base_url+'ess/list-master-calendar/'+key_session+'/'+cGroupID+'/'+year_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var trList = '';
                var response = responseGetList.response;   
                //console.log(response);             
                response.map(function(responseList){
                    var month_name_header = responseList.month_name_header;
                    var data_array = responseList.data_array;
  
                        trList += '<div class="col-md-4">';
                            trList += '<div class="card-body">';
                                trList += '<label>'+month_name_header+'</label>';
                                trList += '<table class="table">';
                                    trList += '<thead>';
                                        trList += '<tr>';
                                            trList += '<th><div style="color:yellow;">Mon</div></th>';
                                            trList += '<th><div style="color:yellow;">Tue</div></th>';
                                            trList += '<th><div style="color:yellow;">Wed</div></th>';
                                            trList += '<th><div style="color:yellow;">Thu</div></th>';
                                            trList += '<th><div style="color:yellow;">Fri</div></th>';
                                            trList += '<th><div style="color:yellow;">Sat</div></th>';
                                            trList += '<th><div style="color:yellow;">Sun</div></th>';
                                        trList += '</tr>';
                                    trList += '</thead>';
                                    trList += '<tbody>';
                                    
                                    //console.log(data_array);

                                    for (var a=0; a<=6; a++){

                                        var val_1 = '';
                                        var val_2 = '';
                                        var val_3 = '';
                                        var val_4 = '';
                                        var val_5 = '';
                                        var val_6 = '';
                                        var val_7 = '';

                                        data_array.map(function(data_array_list){
                                            var week_number = data_array_list.week_number;
                                            var day_number = data_array_list.day_number;
                                            var dTglHdr = data_array_list.dTglHdr;
                                            var dTgl = data_array_list.dTgl;
                                            var PotongGaji = data_array_list.PotongGaji;
                                            var DayOff = data_array_list.DayOff;
                                            var cGroupID = data_array_list.cGroupID;
                                            var cGroupNm = data_array_list.cGroupNm;
                                            var cShiftID_Plan = data_array_list.cShiftID_Plan;
                                            var cNmShift = data_array_list.cNmShift;
                                            var cIDAbsen = data_array_list.cIDAbsen;
                                            var cNmAbsen = data_array_list.cNmAbsen;
                                            var color_marking_sift = data_array_list.color_marking_sift;

                                            if ((week_number)-1==a) {
                                                //console.log(color_marking_sift);
                                                if (day_number==1) {
                                                    val_1 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                }
                                                else if (day_number==2) {
                                                    val_2 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                }
                                                else if (day_number==3) {
                                                    val_3 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                }
                                                else if (day_number==4) {
                                                    val_4 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                    
                                                }
                                                else if (day_number==5) {
                                                    val_5 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                    
                                                }
                                                else if (day_number==6) {
                                                    val_6 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                    
                                                }
                                                else if (day_number==7) {
                                                    val_7 = '<div style="color:'+color_marking_sift+';" onclick="change_sift(\''+dTglHdr+'\', \''+cGroupID+'\', \''+cGroupNm+'\', \''+cShiftID_Plan+'\', \''+cNmShift+'\', \''+cIDAbsen+'\', \''+cNmAbsen+'\');">'+dTgl+'</div>';
                                                    
                                                }
                                            }

                                        })

                                        //console.log(day_number);
                                        trList += '<tr>';
                                            trList += '<td align="center">'+val_1+'</td>';
                                            trList += '<td align="center">'+val_2+'</td>';
                                            trList += '<td align="center">'+val_3+'</td>';
                                            trList += '<td align="center">'+val_4+'</td>';
                                            trList += '<td align="center">'+val_5+'</td>';
                                            trList += '<td align="center">'+val_6+'</td>';
                                            trList += '<td align="center">'+val_7+'</td>';
                                        trList += '</tr>';

                                       // }                                                                                  
                                    }
                                    trList += '</tbody>';
                                trList += '</table>';
                            trList += '</div>';
                        trList += '</div>';

                })
                $('#calendar').append(trList);
            })
        }
    });
}

function change_sift(dTglHdr_get, cGroupID_get, cGroupNm_get, cShiftID_Plan_get, cNmShift_get, cIDAbsen_get, cNmAbsen_get){
    //alert(dTglHdr_get+' '+cGroupID_get+' '+cShiftID_Plan_get);
    $('#dTglHdr_old').val('');
    $('#cGroupID_old').val('');
    $('#cShiftID_Plan_old').val('');
    $('#dTglHdr_start').val('');
    $('#dTglHdr_end').val('');
    $('#cIDAbsen_old').val('');

    $('#cGroupNm_old').val(cGroupNm_get);
    $('#cNmShift_Plan_old').val(cNmShift_get);
    $('#cNmAbsen_old').val(cNmAbsen_get);

    $('#dTglHdr_old').val(dTglHdr_get);
    $('#cGroupID_old').val(cGroupID_get);
    $('#cShiftID_Plan_old').val(cShiftID_Plan_get);
    $('#dTglHdr_start').val(dTglHdr_get);
    $('#dTglHdr_end').val(dTglHdr_get);

    list_sift_create(cShiftID_Plan_get, cNmShift_get)
    list_precense_type_create(cIDAbsen_get, cNmAbsen_get)

    $('#modal_update_calendar').modal('show');
}

function modal_update_calendar_hide(){
    $('#modal_update_calendar').modal('hide');
}

function list_sift_create(cShiftID_get, cNmShift_get){
    $('#cShiftID_update').html('');
    $.ajax({
        url: base_url+'ess/list-sift/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cShiftID_get!='') {
                trList += '<option value="'+cShiftID_get+'">'+cNmShift_get+'</option>';
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
                $('#cShiftID_update').append(trList);
            })
        }
    });
}

function list_precense_type_create(cIDAbsen_get, cNmAbsen_get){
    $('#cIDAbsen_update').html('');
    $.ajax({
        url: base_url+'ess/list-precense-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cIDAbsen_get!='') {
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
                        var Note = responseList.Note;
                        var DayOff = responseList.DayOff;
                        var PotongGaji = responseList.PotongGaji;
                        
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDAbsen+'">'+cNmAbsen+'</option>';
                        }
                    })
                }
                $('#cIDAbsen_update').append(trList);
            })
        }
    });
}

function sift_type(){
    var sift_type = $('#sift_type').val();
    $('#dTglHdr_end').val('');
    if (sift_type==1) {
        document.getElementById('date_start').removeAttribute('style');
        document.getElementById('date_start').setAttribute('style', 'display:block');
        document.getElementById('date_end').removeAttribute('style');
        document.getElementById('date_end').setAttribute('style', 'display:block');
    }
    else {
        document.getElementById('date_start').removeAttribute('style');
        document.getElementById('date_start').setAttribute('style', 'display:none');
        document.getElementById('date_end').removeAttribute('style');
        document.getElementById('date_end').setAttribute('style', 'display:none');
    }
}

function check_day(category){
    if (category==1) {
        document.getElementById('div_change_day').setAttribute('style', 'display:none');
        document.getElementById('div_note').removeAttribute('style');
        document.getElementById('div_note').setAttribute('style', 'display:block');
    }
    else if (category==3) {
        document.getElementById('div_note').setAttribute('style', 'display:none');
        document.getElementById('div_change_day').removeAttribute('style');
        document.getElementById('div_change_day').setAttribute('style', 'display:block');
    }
    else if (category==4 || category==2) {
        document.getElementById('div_note').removeAttribute('style');
        document.getElementById('div_change_day').removeAttribute('style');
        document.getElementById('div_note').setAttribute('style', 'display:none');
        document.getElementById('div_change_day').setAttribute('style', 'display:none');
    }
}

function update_calendar(){
    var dTglHdr = $('#dTglHdr_old').val();
    var cGroupID = $('#cGroupID_old').val();
    var cShiftID_Plan = $('#cShiftID_Plan_old').val();
    var cIDAbsen = $('#cIDAbsen_old').val();

    var cGroupNm = $('#cGroupNm_old').val();
    var cNmShift = $('#cNmShift_Plan_old').val();
    var cNmAbsen = $('#cNmAbsen_old').val();

    var sift_type = $('#sift_type').val();
    var dTglHdr_start = $('#dTglHdr_start').val();
    var dTglHdr_end = $('#dTglHdr_end').val();
    var cShiftID_update = $('#cShiftID_update').val();
    var cIDAbsen_update = $('#cIDAbsen_update').val();

    var note = $('#note').val();

    var radios = document.getElementsByName('check_day');

    var category = '';
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            category = radios[i].value;
        }
    }

    modal_update_calendar_hide();
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    if (sift_type==0) { // Non Sift
        $.ajax({
            url: base_url+'ess/update-master-calendar/'+key_session,
            type: 'post',
            data: 'dTglHdr='+dTglHdr+'&cGroupID='+cGroupID+'&cShiftID_Plan='+cShiftID_Plan+'&cShiftID_update='+cShiftID_update+'&cIDAbsen_update='+cIDAbsen_update+'&note='+note+'&category='+category,
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
                            modal_loading_hide();
                            list_work_calendar();
                        }, 5000);

                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            change_sift(dTglHdr, cGroupID, cGroupNm, cShiftID_Plan, cNmShift, cIDAbsen, cNmAbsen)
                        }, 5000);
                    }
                })
            }
        })
    }
    else if (sift_type==1) { // Sift
        $.ajax({
            url: base_url+'ess/update-master-calendar-sift/'+key_session,
            type: 'post',
            data: 'dTglHdr_start='+dTglHdr_start+'&dTglHdr_end='+dTglHdr_end+'&cGroupID='+cGroupID+'&cShiftID_Plan='+cShiftID_Plan+'&cShiftID_update='+cShiftID_update+'&cIDAbsen_update='+cIDAbsen_update+'&note='+note+'&category='+category,
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
                            modal_loading_hide();
                            list_work_calendar();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            change_sift(dTglHdr, cGroupID, cGroupNm, cShiftID_Plan, cNmShift, cIDAbsen, cNmAbsen)
                        }, 5000);
                    }
                })
            }
        })
    }
}

/*function list_sift_group(cGroupID_get, cGroupNm_get){
    $('#cGroupID').html('');
    $.ajax({
        url: base_url+'ess/list-sift-group/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cGroupID_get!='') {
                if (cGroupID_get=="ALL") {
                    trList += '<option value="ALL">ALL</option>';
                }
                else {
                    trList += '<option value="'+cGroupID_get+'">'+cGroupNm_get+'</option>';
                }
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_sift_group').dataTable();
                }
                else {
                    trList += '<option value="ALL">ALL</option>';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cGroupID = responseList.cGroupID;
                        var deleted = responseList.deleted;

                        var cGroupNm = responseList.cGroupNm;


                        if (deleted==0) {
                            trList += '<option value="'+cGroupID+'">'+cGroupNm+'</option>';
                        }
                    })
                }
            })
            $('#cGroupID').append(trList);
        }
    });
}

function update(id_lembur_wajib_get, tanggal_lembur_wajib_get, cGroupID, cGroupNm){
    $('#id_lembur_wajib_get').val(id_lembur_wajib_get);
    $('#tanggal_lembur_wajib_get').val(tanggal_lembur_wajib_get);
    list_sift_group(cGroupID_get, cGroupNm_get);
}

function add_mandatory_overtime(){
    var id_lembur_wajib = $('#id_lembur_wajib').val();
    var tanggal_lembur_wajib = $('#tanggal_lembur_wajib').val();
    var cGroupID = $('#cGroupID').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-mandatory-overtime/'+key_session,
        type: 'post',
        data: 'id_lembur_wajib='+id_lembur_wajib+'&tanggal_lembur_wajib='+tanggal_lembur_wajib+'&cGroupID='+cGroupID,
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
                        list_mandatory_overtime(0);
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
    $('#id_lembur_wajib').val('');
    $('#tanggal_lembur_wajib').val('');
    $('#nama_hari_libur').val('');
    document.getElementById('id_lembur_wajib').removeAttribute('readonly');
    document.getElementById('id_lembur_wajib').removeAttribute('style');
    document.getElementById('id_lembur_wajib').setAttribute('style', 'color:black');
}

function disable_enable(id_lembur_wajib_get, tanggal_lembur_wajib_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_lembur_wajib_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_lembur_wajib_disen').val(id_lembur_wajib_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable mandatory overtime - "+tanggal_lembur_wajib_get+".");
        $('#modal_body_disen').append("Are you sure will disable mandatory overtime "+tanggal_lembur_wajib_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable mandatory overtime - "+tanggal_lembur_wajib_get+".");
        $('#modal_body_disen').append("Are you sure will enable mandatory overtime "+tanggal_lembur_wajib_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_mandatory_overtime(){
    var id_lembur_wajib = $('#id_lembur_wajib_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-mandatory-overtime/'+key_session,
        type: 'post',
        data: 'id_lembur_wajib='+id_lembur_wajib+'&deleted='+deleted,
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
                        list_mandatory_overtime(0);
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
}*/

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