$(document).ready(function(){
    list_medical_limit(0);
})

function list_medical_limit(cNIK){
    $('#list_medical_limit').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-medical-limit/'+key_session+'/'+this_year+'/'+cNIK,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_medical_limit tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_medical_limit').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cNmJbtn = responseList.cNmJbtn;
                        var tahun = responseList.tahun;
                        var tax_bpjs = responseList.tax_bpjs;
                        var limit_medical = responseList.limit_medical;
                        var limit_medical_format = responseList.limit_medical_format;
                        var total_history_medical = responseList.total_history_medical;
                        var total_history_medical_format = responseList.total_history_medical_format;
                        var diff = responseList.diff;
                        var diff_format = responseList.diff_format;

                        var action = '';
                        action += '<button class="btn btn-info" onclick="modal_medical(\''+cNIK+'\', \''+cNmPegawai+'\');" title="Add Reimbursment - '+cNmPegawai+'."><i class="mdi mdi-heart-pulse"></i></button>&nbsp;&nbsp;';
                        //action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_trans_manual+'\', \''+cNmKomponen+'\', \''+cNmPegawai+'\', \''+1+'\');" title="Disable Manual Transaction - '+cNmKomponen+'."><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+cNmJbtn+'</td>';
                            trList += '<td style="color:white;">'+tax_bpjs+'</td>';
                            trList += '<td style="color:white;">'+limit_medical_format+'</td>';
                            trList += '<td style="color:white;">'+total_history_medical_format+'</td>';
                            trList += '<td style="color:white;">'+diff_format+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_medical_limit tbody').append(trList);
                    $('#list_medical_limit').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function modal_medical(cNIK_get, cNmPegawai_get){
    list_history_medical(cNIK_get, cIDPeriod_default);
    $('#label_header').html('');
    $('#label_header').append('Add Medical Reimbursment - '+cNmPegawai_get);
    $('#modal_medical').modal('show');
}

function modal_medical_hide(){
    $('#modal_medical').modal('hide');
    list_medical_limit(0);
}

function family(status_get, cNIK_get){
    $('#cNama').html('');
    $.ajax({
        url: base_url+'ess/family/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var cNIK = responseList.cNIK;
                        var cNama = responseList.cNama;
                        //console.log(cNama);
                        trList += '<option value="'+cNama+'">'+cNama+'</option>';
                    })
                } 
                $('#cNama').append(trList);               
            })
        }
    });
}

function list_history_medical(cNIK_get, cIDPeriod_get){
    $('#list_medical_reimbursment tbody').html('');
    $.ajax({
        url: base_url+'ess/list-history-medical/'+key_session+'/'+cNIK_get+'/'+cIDPeriod_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            family(1, cNIK_get);
            trList += '<tr>';
                trList += '<td><select class="form-control" id="cNama" style="color:white;"></select></td>';
                trList += '<td><input type="date" class="form-control" id="dTgl_Berobat"></td>';
                trList += '<td><input type="number" class="form-control" id="nBiaya_Pengajuan"></td>';
                trList += '<td><input type="text" class="form-control" id="cNmRS"></td>';
                trList += '<td><input type="text" class="form-control" id="cNmDokter"></td>';
                trList += '<td><input type="text" class="form-control" id="diagnosa"></td>';
                trList += '<td><button class="btn btn-md btn-primary" onclick="add_history_medical(\''+cNIK_get+'\', \''+cIDPeriod_get+'\');">Save</button></td>';
            trList += '</tr>';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="7" align="center">Data not found.</td>';
                    trList += '</tr>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_medical= responseList.id_medical;
                        var cNama = responseList.cNama;
                        var dTgl_Berobat = responseList.dTgl_Berobat;
                        var nBiaya_Pengajuan = responseList.nBiaya_Pengajuan;
                        var cNmRS = responseList.cNmRS;
                        var cNmDokter = responseList.cNmDokter;
                        var diagnosa = responseList.diagnosa;

                        var button = '<button class="btn btn-md btn-info" onclick="update_history_medical(\''+(i+1)+'\', \''+id_medical+'\', \''+cNIK_get+'\', \''+cIDPeriod_get+'\');">Update</button>'

                        trList += '<tr>';
                            trList += '<td>'+cNama+'</td>';
                            trList += '<td><input type="date" class="form-control" id="dTgl_Berobat_'+(i+1)+'" value="'+dTgl_Berobat+'"></td>';
                            trList += '<td><input type="number" class="form-control" id="nBiaya_Pengajuan_'+(i+1)+'" value="'+nBiaya_Pengajuan+'"></td>';
                            trList += '<td><input type="text" class="form-control" id="cNmRS_'+(i+1)+'" value="'+cNmRS+'"></td>';
                            trList += '<td><input type="text" class="form-control" id="cNmDokter_'+(i+1)+'" value="'+cNmDokter+'"></td>';
                            trList += '<td><input type="text" class="form-control" id="diagnosa_'+(i+1)+'" value="'+diagnosa+'"></td>';
                            trList += '<td>'+button+'</td>';
                        trList += '</tr>';
                    })
                }
            })
            $('#list_medical_reimbursment tbody').append(trList);
        }
    })
}

function add_history_medical(cNIK_get, cIDPeriod_get){
    var cNama = $('#cNama').val();
    var dTgl_Berobat = $('#dTgl_Berobat').val();
    var nBiaya_Pengajuan = $('#nBiaya_Pengajuan').val();
    var cNmRS = $('#cNmRS').val();
    var cNmDokter = $('#cNmDokter').val();
    var diagnosa = $('#diagnosa').val();

    if (dTgl_Berobat=='' || nBiaya_Pengajuan=='' || cNmRS=='' || cNmDokter=='' || diagnosa=='') {
        alert ('Data cannot empty.')
    }
    else {
        //console.log(cNama+' '+dTgl_Berobat+' '+nBiaya_Pengajuan+' '+cNmRS+' '+cNmDokter+' '+diagnosa+' '+cNIK_get+' '+cIDPeriod_get);
        document.getElementById('loading').removeAttribute('style');
        document.getElementById('loading').setAttribute('style', 'display:block');
        $('#loading').html('');
        $('#loading').append('Saving data...');
        $.ajax({
            url: base_url+'ess/add-history-medical/'+key_session,
            type: 'post',
            data: 'cNama='+cNama+'&dTgl_Berobat='+dTgl_Berobat+'&nBiaya_Pengajuan='+nBiaya_Pengajuan+'&cNmRS='+cNmRS+'&cNmDokter='+cNmDokter+'&diagnosa='+diagnosa+'&cNIK='+cNIK_get+'&cIDPeriod='+cIDPeriod_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                $('#loading').html('');
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        $('#loading').append('Saving data successfully.');
                        setTimeout(function () {
                            document.getElementById('loading').removeAttribute('style');
                            document.getElementById('loading').setAttribute('style', 'display:none');
                            list_history_medical(cNIK_get, cIDPeriod_get);
                        }, 3000);
                    }
                    else {
                        var response = responseGetList.response;
                        $('#loading').append('Saving data unsuccessfully. error : '+response);
                        setTimeout(function () {
                            document.getElementById('loading').removeAttribute('style');
                            document.getElementById('loading').setAttribute('style', 'display:none');
                        }, 3000);
                    }
                })
            }
        })
    }
}

function update_history_medical(no_get, id_medical_get, cNIK_get, cIDPeriod_get){
    var cNama = $('#cNama_'+no_get).val();
    var dTgl_Berobat = $('#dTgl_Berobat_'+no_get).val();
    var nBiaya_Pengajuan = $('#nBiaya_Pengajuan_'+no_get).val();
    var cNmRS = $('#cNmRS_'+no_get).val();
    var cNmDokter = $('#cNmDokter_'+no_get).val();
    var diagnosa = $('#diagnosa_'+no_get).val();

    if (dTgl_Berobat=='' || nBiaya_Pengajuan=='' || cNmRS=='' || cNmDokter=='' || diagnosa=='') {
        alert ('Data cannot empty.')
    }
    else {
        //console.log(cNama+' '+dTgl_Berobat+' '+nBiaya_Pengajuan+' '+cNmRS+' '+cNmDokter+' '+diagnosa+' '+cNIK_get+' '+cIDPeriod_get);
        document.getElementById('loading').removeAttribute('style');
        document.getElementById('loading').setAttribute('style', 'display:block');
        $('#loading').html('');
        $('#loading').append('Saving data...');
        $.ajax({
            url: base_url+'ess/update-history-medical/'+key_session,
            type: 'post',
            data: 'id_medical='+id_medical_get+'&cNama='+cNama+'&dTgl_Berobat='+dTgl_Berobat+'&nBiaya_Pengajuan='+nBiaya_Pengajuan+'&cNmRS='+cNmRS+'&cNmDokter='+cNmDokter+'&diagnosa='+diagnosa+'&cNIK='+cNIK_get+'&cIDPeriod='+cIDPeriod_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                $('#loading').html('');
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        $('#loading').append('Saving data successfully.');
                        setTimeout(function () {
                            document.getElementById('loading').removeAttribute('style');
                            document.getElementById('loading').setAttribute('style', 'display:none');
                            list_history_medical(cNIK_get, cIDPeriod_get);
                        }, 3000);
                    }
                    else {
                        var response = responseGetList.response;
                        $('#loading').append('Saving data unsuccessfully. error : '+response);
                        setTimeout(function () {
                            document.getElementById('loading').removeAttribute('style');
                            document.getElementById('loading').setAttribute('style', 'display:none');
                        }, 5000);
                    }
                })
            }
        })
    }

}

/*function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
    $('#cNIK').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cNIK_get!=0) {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
            }
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
            $('#cNIK').append(trList);
        }
    });
}

function list_salary_component(id_trans_manual_get, cNmKomponen_get){
    $('#cIDKomponen').html('');
    $.ajax({
        url: base_url+'ess/list-salary-component/'+key_session+'/'+id_trans_manual_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_trans_manual_get!=0) {
                trList += '<option value="'+id_trans_manual_get+'">'+cNmKomponen_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_salary_component').dataTable();
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDKomponen = responseList.cIDKomponen;
                        var cNmKomponen = responseList.cNmKomponen;
                        var kategori = responseList.kategori;
                        var kategori_descr = responseList.kategori_descr;
                        var trans_manual = responseList.trans_manual;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            if (trans_manual==1) {
                                trList += '<option value="'+cIDKomponen+'">'+cNmKomponen+'</option>';
                            }
                        }
                    })
                }
            })
            $('#cIDKomponen').append(trList);
        }
    });
}

function add_manual_transaction(){
    var id_trans_manual = $('#id_trans_manual').val();
    var cNIK = $('#cNIK').val();
    var cIDKomponen = $('#cIDKomponen').val();
    var nNilai = $('#nNilai').val();
    var cNote = $('#cNote').val();
    var dTglTrans = $('#dTglTrans').val();
    var cIDPeriod = $('#cIDPeriod').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-manual-transaction/'+key_session,
        type: 'post',
        data: 'id_trans_manual='+id_trans_manual+'&cNIK='+cNIK+'&cIDKomponen='+cIDKomponen+'&nNilai='+nNilai+'&cNote='+cNote+'&dTglTrans='+dTglTrans+'&cIDPeriod='+cIDPeriod,
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
                        list_manual_transaction(cIDPeriod_default);
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

function update(id_trans_manual_get){
    $('#id_trans_manual').val('');
    //$('#cNIK').html('');
    //$('#cIDKomponen').html();
    $('#nNilai').val('');
    $('#cNote').val('');
    $('#dTglTrans').val('');
    $('#cIDPeriod').val('');
    $('#cNmPeriod').val('');

    $.ajax({
        url: base_url+'ess/list-manual-transaction-by-id/'+key_session+'/'+id_trans_manual_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_trans_manual = responseList.id_trans_manual;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cIDKomponen = responseList.cIDKomponen;
                        var cNmKomponen = responseList.cNmKomponen;
                        var kategori = responseList.kategori;
                        var nNilai = responseList.nNilai;
                        var nNilai_format = responseList.nNilai_format;
                        var cNote = responseList.cNote;
                        var dTglTrans = responseList.dTglTrans;
                        var cIDPeriod = responseList.cIDPeriod;
                        var cNmPeriod = responseList.cNmPeriod;

                        $('#id_trans_manual').val(id_trans_manual);
                        list_employee_active(1, cNIK, cNmPegawai);
                        list_salary_component(cIDKomponen, cNmKomponen);
                        $('#nNilai').val(nNilai);
                        $('#cNote').val(cNote);
                        $('#dTglTrans').val(dTglTrans);
                        $('#cIDPeriod').val(cIDPeriod);
                        $('#cNmPeriod').val(cNmPeriod);                        
                    })
                }
            })
        }
    });
}

function reset_form(){
    $('#id_trans_manual').val('');
    $('#nNilai').val('');
    $('#cNote').val('');
    $('#dTglTrans').val('');

    list_employee_active(1, 0, 0);
    list_salary_component(0, 0);
}

function disable_enable(id_trans_manual_get, cNmKomponen, cNmPegawai, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_trans_manual_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_trans_manual_disen').val(id_trans_manual_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable manual transaction - "+cNmKomponen+" "+cNmPegawai+".");
        $('#modal_body_disen').append("Are you sure will delete manual transaction "+cNmKomponen+" "+cNmPegawai+" ?");
        $('#btn_disen').append('Delete');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function delete_manual_transaction(){
    var id_trans_manual = $('#id_trans_manual_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/delete-manual-transaction/'+key_session,
        type: 'post',
        data: 'id_trans_manual='+id_trans_manual,
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
                        list_manual_transaction(0);
                        reset_form();
                        modal_loading_hide();
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Deleting data unsuccessfully', 'Please wait for hide this view...');
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