$(document).ready(function(){
    //console.log(cIdPeriod_default);
    list_manual_transaction(cIDPeriod_default);
    $('#cIDPeriod').val('');
    $('#cIDPeriod').val(cIDPeriod_default);
    $('#cNmPeriod').val('');
    $('#cNmPeriod').val(cNmPeriod_default);
    list_employee_active(1, 0, 0);
    list_salary_component(0, 0);
})

function list_manual_transaction(cIDPeriod){
    $('#list_manual_transaction').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-manual-transaction/'+key_session+'/'+cIDPeriod,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_manual_transaction tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_manual_transaction').dataTable();
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

                        var action = '';
                        action += '<button class="btn btn-info" onclick="update(\''+id_trans_manual+'\');" title="Update Manual Transaction - '+cNmKomponen+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_trans_manual+'\', \''+cNmKomponen+'\', \''+cNmPegawai+'\', \''+1+'\');" title="Disable Manual Transaction - '+cNmKomponen+'."><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmPeriod+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+cNmKomponen+'</td>';
                            trList += '<td style="color:white;">'+nNilai_format+'</td>';
                            trList += '<td style="color:white;">'+cNote+'</td>';
                            trList += '<td style="color:white;">'+dTglTrans+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_manual_transaction tbody').append(trList);
                    $('#list_manual_transaction').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
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