$(document).ready(function(){
    list_daily_attendance();
    list_attendance_periode();
})

function list_daily_attendance(){
    var cIdPeriod = $('#cIdPeriod').val();
    $('#list_daily_attendance').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-attendance-check/'+key_session+'/'+category+'/'+cIdPeriod,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_daily_attendance tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_daily_attendance').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var dTglHdr = responseList.dTglHdr;
                        var dTglHdr_format = responseList.dTglHdr_format;
                        var dJamMsk = responseList.dJamMsk;
                        var dJamPlg = responseList.dJamPlg;
                        var cShiftID_plan = responseList.cShiftID_plan;
                        var cNmShift_plan = responseList.cNmShift_plan;
                        var cShiftID_act = responseList.cShiftID_act;
                        var cNmShift_act = responseList.cNmShift_act;
                        var dt = responseList.dt;
                        var pc = responseList.pc;
                        var ot_awal_start = responseList.ot_awal_start;
                        var ot_awal_end = responseList.ot_awal_end;
                        var ot_awal = responseList.ot_awal;
                        var ot_akhir_start = responseList.ot_akhir_start;
                        var ot_akhir_end = responseList.ot_akhir_end;
                        var ot_akhir = responseList.ot_akhir;
                        var ot_libur_start = responseList.ot_libur_start;
                        var ot_libur_end = responseList.ot_libur_end;
                        var ot_libur = responseList.ot_libur;
                        var ot_1 = responseList.ot_1;
                        var ot_2 = responseList.ot_2;
                        var ot_3 = responseList.ot_3;
                        var ot_4 = responseList.ot_4;
                        var ot_real = responseList.ot_real;
                        var ot_konv = responseList.ot_konv;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var keterangan = responseList.keterangan;
                        var type_absen = responseList.type_absen;
                        var basik = responseList.basik;
                        var imp = responseList.imp;
                        var ipu = responseList.ipu;

                        var shift_show = '';
                        if (cShiftID_act=='') {
                            shift_show = cNmShift_plan;
                        }
                        else {
                            shift_show = cNmShift_act;
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+' / '+cNIK+'</td>';
                            trList += '<td style="color:white;">'+dTglHdr_format+'</td>';
                            trList += '<td style="color:white;"><div id="cShiftID_'+(i+1)+'">'+shift_show+'</div></td>';
                            trList += '<td style="color:white;"><div id="cIDAbsen_'+(i+1)+'">'+cNmAbsen+'</div></td>';
                            trList += '<td style="color:white;"><div id="dJamMsk_'+(i+1)+'">'+dJamMsk+'</div></td>';
                            trList += '<td style="color:white;"><div id="dJamPlg_'+(i+1)+'">'+dJamPlg+'</div></td>';
                            trList += '<td style="color:white;"><div id="ot_real_'+(i+1)+'">'+ot_real+'</div></td>';
                            trList += '<td style="color:white;"><div id="ot_konv_'+(i+1)+'">'+ot_konv+'</div></td>';
                            trList += '<td style="color:white;"><button class="btn btn-info" onclick="modal_daily_attendance(\''+(i+1)+'\', \''+cNIK+'\', \''+dTglHdr+'\');"><i class="mdi mdi-lead-pencil"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_daily_attendance tbody').append(trList);
                    $('#list_daily_attendance').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_attendance_periode(){
    $.ajax({
        url: base_url+'ess/list-attendance-periode/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#cIdPeriod').html('');
            var trList = '';
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
                        var cIdPeriod = responseList.cIdPeriod;
                        var cNmPeriod = responseList.cNmPeriod;

                        trList += '<option value="'+cIdPeriod+'">'+cNmPeriod+'</option>';
                    })
                }
            })
            $('#cIdPeriod').append(trList);
        }
    });
}

function search_attendance(){
    var dTglHdr_start = $('#dTglHdr_start').val();
    var dTglHdr_end = $('#dTglHdr_end').val();
    var cShiftID = $('#cShiftID').val();
    var cIDAbsen = $('#cIDAbsen').val();
    var cNIK = $('#cNIK').val();

    $('#list_daily_attendance').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-daily-attendance/'+key_session,
        type: 'post',
        data: 'dTglHdr_start='+dTglHdr_start+'&dTglHdr_end='+dTglHdr_end+'&cShiftID='+cShiftID+'&cIDAbsen='+cIDAbsen+'&cNIK='+cNIK,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_daily_attendance tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_daily_attendance').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var dTglHdr = responseList.dTglHdr;
                        var dTglHdr_format = responseList.dTglHdr_format;
                        var dJamMsk = responseList.dJamMsk;
                        var dJamPlg = responseList.dJamPlg;
                        var cShiftID_plan = responseList.cShiftID_plan;
                        var cNmShift_plan = responseList.cNmShift_plan;
                        var cShiftID_act = responseList.cShiftID_act;
                        var cNmShift_act = responseList.cNmShift_act;
                        var dt = responseList.dt;
                        var pc = responseList.pc;
                        var ot_awal_start = responseList.ot_awal_start;
                        var ot_awal_end = responseList.ot_awal_end;
                        var ot_awal = responseList.ot_awal;
                        var ot_akhir_start = responseList.ot_akhir_start;
                        var ot_akhir_end = responseList.ot_akhir_end;
                        var ot_akhir = responseList.ot_akhir;
                        var ot_libur_start = responseList.ot_libur_start;
                        var ot_libur_end = responseList.ot_libur_end;
                        var ot_libur = responseList.ot_libur;
                        var ot_1 = responseList.ot_1;
                        var ot_2 = responseList.ot_2;
                        var ot_3 = responseList.ot_3;
                        var ot_4 = responseList.ot_4;
                        var ot_real = responseList.ot_real;
                        var ot_konv = responseList.ot_konv;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var keterangan = responseList.keterangan;
                        var type_absen = responseList.type_absen;
                        var basik = responseList.basik;
                        var imp = responseList.imp;
                        var ipu = responseList.ipu;

                        var shift_show = '';
                        if (cShiftID_act=='') {
                            shift_show = cNmShift_plan;
                        }
                        else {
                            shift_show = cNmShift_act;
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+' / '+cNIK+'</td>';
                            trList += '<td style="color:white;">'+dTglHdr_format+'</td>';
                            trList += '<td style="color:white;"><div id="cShiftID_'+(i+1)+'">'+shift_show+'</div></td>';
                            trList += '<td style="color:white;"><div id="cIDAbsen_'+(i+1)+'">'+cNmAbsen+'</div></td>';
                            trList += '<td style="color:white;"><div id="dJamMsk_'+(i+1)+'">'+dJamMsk+'</div></td>';
                            trList += '<td style="color:white;"><div id="dJamPlg_'+(i+1)+'">'+dJamPlg+'</div></td>';
                            trList += '<td style="color:white;"><div id="ot_real_'+(i+1)+'">'+ot_real+'</div></td>';
                            trList += '<td style="color:white;"><div id="ot_konv_'+(i+1)+'">'+ot_konv+'</div></td>';
                            trList += '<td style="color:white;"><button class="btn btn-info" onclick="modal_daily_attendance(\''+(i+1)+'\', \''+cNIK+'\', \''+dTglHdr+'\');"><i class="mdi mdi-lead-pencil"></i></button></td>';
                        trList += '</tr>';
                    })
                    $('#list_daily_attendance tbody').append(trList);
                    $('#list_daily_attendance').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_employee_active(status_get, cNIK_get, cNmPegawai_get, category_get){
    if (category_get==1) {
        $('#cNIK_update').html('');
        var trList = '';
        trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
        $('#cNIK_update').append(trList);
    }
    else {
        $('#cNIK').html('');    
        $.ajax({
            url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
            type: 'get',
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                var trList = '';
                trList += '<option value="">Select Employee</option>';
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<option value="">Data not found.</option>';
                    }
                    else {
                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var cNIK = responseList.cNIK;
                            var cNmPegawai = responseList.cNmPegawai;

                            trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                        });
                    }
                })
                $('#cNIK').append(trList);
            }
        });
    }
}

function list_sift(cShiftID_get, cNmShift_get, category_get){
    //$('#cShiftID').html('');
    if (category_get==0) {
        $('#cShiftID').html('');
    }
    else {
        $('#cShiftID_update').html('');    
    }
    $.ajax({
        url: base_url+'ess/list-sift/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cShiftID_get!=0) {
                trList += '<option value="'+cShiftID_get+'">'+cNmShift_get+'</option>';
            }
            else {
                trList += '<option value="">Select Shift</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cShiftID = responseList.cShiftID;
                        var cNmShift = responseList.cNmShift;
                        var deleted = responseList.deleted;
                        if (deleted==0) {
                            trList += '<option value="'+cShiftID+'">'+cNmShift+'</option>';
                        }
                    })
                }
            })
            //$('#cShiftID').append(trList);
            if (category_get==0) {
                $('#cShiftID').append(trList);
            }
            else {
                $('#cShiftID_update').append(trList);
            }
        }
    });
}

function list_precense_type(cIDAbsen_get, cNmAbsen_get, category_get){
    //$('#cIDAbsen').html('');
    if (category_get==0) {
        $('#cIDAbsen').html('');
    }
    else {
        $('#cIDAbsen_update').html('');    
    }
    $.ajax({
        url: base_url+'ess/list-precense-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cIDAbsen_get!=0) {
                trList += '<option value="'+cIDAbsen_get+'">'+cNmAbsen_get+'</option>';
            }
            else {
                trList += '<option value="">Select Absen Type</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var deleted = responseList.deleted;
                        if (deleted==0) {
                            trList += '<option value="'+cIDAbsen+'">'+cNmAbsen+'</option>';
                        }                        
                    })
                }
            })
            //$('#cIDAbsen').append(trList);
            if (category_get==0) {
                $('#cIDAbsen').append(trList);
            }
            else {
                $('#cIDAbsen_update').append(trList);
            }
        }
    });
}

function modal_daily_attendance(no_get, cNIK_get, dTglHdr_get){
    $('#modal_title_absen').html('');
    $('#modal_title_absen').html('');
    $('#dTglHdr_update').val('');
    $('#dJamMsk_update').val('');
    $('#dJamPlg_update').val('');
    $('#nomor').val('');
    $.ajax({
        url: base_url+'ess/list-daily-attendance/'+key_session,
        type: 'post',
        data: 'dTglHdr_start='+dTglHdr_get+'&dTglHdr_end='+dTglHdr_get+'&cNIK='+cNIK_get,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;

                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var cNIK = responseList.cNIK;
                    var cNmPegawai = responseList.cNmPegawai;
                    var dTglHdr = responseList.dTglHdr;
                    var dJamMsk = responseList.dJamMsk;
                    var dJamPlg = responseList.dJamPlg;
                    var cShiftID_plan = responseList.cShiftID_plan;
                    var cNmShift_plan = responseList.cNmShift_plan;
                    var cShiftID_act = responseList.cShiftID_act;
                    var cNmShift_act = responseList.cNmShift_act;
                    var dt = responseList.dt;
                    var pc = responseList.pc;
                    var ot_awal_start = responseList.ot_awal_start;
                    var ot_awal_end = responseList.ot_awal_end;
                    var ot_awal = responseList.ot_awal;
                    var ot_akhir_start = responseList.ot_akhir_start;
                    var ot_akhir_end = responseList.ot_akhir_end;
                    var ot_akhir = responseList.ot_akhir;
                    var ot_libur_start = responseList.ot_libur_start;
                    var ot_libur_end = responseList.ot_libur_end;
                    var ot_libur = responseList.ot_libur;
                    var ot_1 = responseList.ot_1;
                    var ot_2 = responseList.ot_2;
                    var ot_3 = responseList.ot_3;
                    var ot_4 = responseList.ot_4;
                    var ot_real = responseList.ot_real;
                    var ot_konv = responseList.ot_konv;
                    var cIDAbsen = responseList.cIDAbsen;
                    var cNmAbsen = responseList.cNmAbsen;
                    var keterangan = responseList.keterangan;
                    var type_absen = responseList.type_absen;
                    var basik = responseList.basik;
                    var imp = responseList.imp;
                    var ipu = responseList.ipu;

                    $('#modal_title_absen').append('Update Attendance - '+cNmPegawai+' / '+dTglHdr);

                    $('#dTglHdr_update').val(dTglHdr);
                    list_employee_active(1, cNIK, cNmPegawai, 1);
                    list_sift(cShiftID_act, cNmShift_act, 1);
                    list_precense_type(cIDAbsen, cNmAbsen, 1);
                    $('#dJamMsk_update').val(dJamMsk);
                    $('#dJamPlg_update').val(dJamPlg);
                    $('#nomor').val(no_get);
                })
                $('#modal_daily_attendance').modal('show');
            })
        }
    });
}

function modal_daily_attendance_hide(){
    $('#modal_daily_attendance').modal('hide');
    document.getElementById('loading_update').removeAttribute('class');
    $('#loading_update').html('');
}

function time_val(category){
    if (category==1) {
        var dJamMsk = $('#dJamMsk_update').val();
        let length = dJamMsk.length;
        
        if (length<2) {
            $('#dJamMsk_update').val(dJamMsk);
        }
        else if (length==2) {
            if (dJamMsk<=23) {
                $('#dJamMsk_update').val(dJamMsk+':');
            }
            else {
                $('#dJamMsk_update').val('00:');
            }
        }
        else {
            const dJamMskArray = dJamMsk.split(":");
            let dJamMsk_0 = dJamMskArray[0];
            let dJamMsk_1 = dJamMskArray[1];
            var dJamMsk_fix = '';
            if (dJamMsk_1<=59) {
                dJamMsk_fix = dJamMsk;
            }
            else {
                dJamMsk_fix = dJamMsk_0+':00';
            }
            $('#dJamMsk_update').val(dJamMsk_fix);
        }
    }
    else {
        var dJamPlg = $('#dJamPlg_update').val();
        let length = dJamPlg.length;
        
        if (length<2) {
            $('#dJamPlg_update').val(dJamPlg);
        }
        else if (length==2) {
            if (dJamPlg<=23) {
                $('#dJamPlg_update').val(dJamPlg+':');
            }
            else {
                $('#dJamPlg_update').val('00:');
            }
        }
        else {
            const dJamPlgArray = dJamPlg.split(":");
            let dJamPlg_0 = dJamPlgArray[0];
            let dJamPlg_1 = dJamPlgArray[1];
            var dJamPlg_fix = '';
            if (dJamPlg_1<=59) {
                dJamPlg_fix = dJamPlg;
            }
            else {
                dJamPlg_fix = dJamPlg_0+':00';
            }
            $('#dJamPlg_update').val(dJamPlg_fix);
        }
    }
}

function update_daily_attendance(){
    var cNIK = $('#cNIK_update').val();
    var dTglHdr = $('#dTglHdr_update').val();
    var cShiftID = $('#cShiftID_update').val();
    var cIDAbsen = $('#cIDAbsen_update').val();
    var dJamMsk = $('#dJamMsk_update').val();
    var dJamPlg = $('#dJamPlg_update').val();
    var nomor = $('#nomor').val();

    $('#cShiftID_'+nomor).html('');
    $('#cIDAbsen_'+nomor).html('');
    $('#dJamMsk_'+nomor).html('');
    $('#dJamPlg_'+nomor).html('');
    $('#ot_real_'+nomor).html('');
    $('#ot_konv_'+nomor).html('');

    document.getElementById('loading_update').setAttribute('class', 'btn btn-success');
    $('#loading_update').append('Updating attendance...');

    $.ajax({
        url: base_url+'ess/update-daily-attendance/'+key_session,
        type: 'post',
        data: 'dTglHdr='+dTglHdr+'&cNIK='+cNIK+'&cShiftID='+cShiftID+'&cIDAbsen='+cIDAbsen+'&dJamMsk='+dJamMsk+'&dJamPlg='+dJamPlg,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            document.getElementById('loading_update').removeAttribute('class');
            $('#loading_update').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    document.getElementById('loading_update').setAttribute('class', 'btn btn-primary');
                    $('#loading_update').append('Updating attendance successfully.');
                    var response = responseGetList.response;
                    var cNmShift = response.cNmShift;
                    var cNmShift = response.cNmShift;
                    var cNmAbsen = response.cNmAbsen;
                    var dJamMsk = response.dJamMsk;
                    var dJamPlg = response.dJamPlg;
                    var ot_real = response.ot_real;
                    var ot_konv = response.ot_konv;

                    setTimeout(function () {
                        modal_daily_attendance_hide();
                        $('#cShiftID_'+nomor).append(cNmShift);
                        $('#cIDAbsen_'+nomor).append(cNmAbsen);
                        $('#dJamMsk_'+nomor).append(dJamMsk);
                        $('#dJamPlg_'+nomor).append(dJamPlg);
                        $('#ot_real_'+nomor).append(ot_real);
                        $('#ot_konv_'+nomor).append(ot_konv);
                    }, 3000);
                }
                else {
                    document.getElementById('loading_update').setAttribute('class', 'btn btn-danger');
                    $('#loading_update').append('Updating attendance unsuccessfully.');
                    setTimeout(function () {
                        document.getElementById('loading_update').removeAttribute('class');
                        $('#loading_update').html('');
                    }, 3000);
                }
            })
        }
    })
}