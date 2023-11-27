$(document).ready(function(){
    list_maker_approval(3, 0);
    //list_department(0, 0);
    getEmployee(0, 0, 0);
})

function list_maker_approval(category, id_ot_maker){
    $('#list_maker_approval').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'overtime/list-maker-approval/'+key_session+'/'+category+'/'+id_ot_maker,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_maker_approval tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_maker_approval').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_ot_maker = responseList.id_ot_maker;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var category = responseList.category;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var cNIK = responseList.cNIK;
                        var maker_approval = responseList.maker_approval;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        //action = '<button class="btn btn-info" onclick="update(\''+id_ot_maker+'\', \''+cIDDept+'\', \''+cNmDept+'\', \''+cIDBag+'\', \''+cNmBag+'\',  \''+cNIK+'\', \''+maker_approval+'\');" title="Update overtime maker - '+cNmDept+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        var action = '<button class="btn btn-danger" onclick="deleted(\''+id_ot_maker+'\', \''+cNmDept+'\', \''+cNmBag+'\', \''+maker_approval+'\');" title="Delete overtime maker - '+cNmDept+'."><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+maker_approval+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_maker_approval tbody').append(trList);
                    $('#list_maker_approval').dataTable();
                }
            })
        }
    });
}

function list_department(cIDDept_get, cNmDept_get){
    $('#cIDDept').html('');
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){

                var trList = '';

                if (cIDDept_get=='0') {
                    trList += '<option value="" style="color:white;">Select Department</option>';
                }
                else {
                    trList += '<option value="'+cIDDept_get+'" style="color:white;">'+cNmDept_get+'</option>';
                }

                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var cIDDept = responseList.cIDDept;
                    var cNmDept = responseList.cNmDept;
                    var deleted = responseList.deleted;

                    if (deleted==0) {
                        trList += '<option value="'+cIDDept+'">'+cNmDept+'</option>';
                    }
                })
                $('#cIDDept').append(trList);
            })

        }
    });
}

function getDivision(cIDBag_get, cNmBag_get, cIDDept_get){
    var cIDDept = '';
    if (cIDDept_get==0){
        cIDDept = $('#cIDDept').val();
    }
    else {
        cIDDept = cIDDept_get;
    }
    $('#cIDBag').html('');

    $.ajax({
        url: base_url+'ess/list-division-by-department/'+key_session+'/'+cIDDept,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDBag_get!='') {
                trList += '<option value="'+cIDBag_get+'">'+cNmBag_get+'</option>';
            }
            trList += '<option value="">Select Division</option>';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var deleted = responseList.deleted;

                        trList += '<option value="'+cIDBag+'">'+cNmBag+'</option>';

                    })
                }
            })
            $('#cIDBag').append(trList);
        }
    });
}

function getEmployee(cNIK_get, cNmPegawai_get, cIDDept_get){
    
    var cIDDept = '0';
    var cIDBag = '0';

    $.ajax({
        url: base_url+'overtime/list-employee-by-dept-div/'+key_session+'/1/'+cIDDept+'/'+cIDBag,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#cNIK').html('');
            var trList = '';
            if (cNIK_get!=0) {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
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

function add_maker_approval(){
    var id_ot_maker = $('#id_ot_maker').val();
    var cIDDept = '';
    var cIDBag = '';
    var cNIK = $('#cNIK').val();
    var category = $('#category').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'overtime/add-maker-approval/'+key_session,
        type: 'post',
        data: 'id_ot_maker='+id_ot_maker+'&cIDDept='+cIDDept+'&cIDBag='+cIDBag+'&cNIK='+cNIK+'&category='+category,
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
                        list_maker_approval(3, 0);
                        getEmployee(0, 0, 0);
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

function update(id_ot_maker_get, cIDDept_get, cNmDept_get, cIDBag_get, cNmBag_get, cNIK_get, maker_approval_get){
    $('#id_ot_maker').val('');
    $('#id_ot_maker').val(id_ot_maker_get);
    list_department(cIDDept_get, cNmDept_get);
    getDivision(cIDBag_get, cNmBag_get, cIDDept_get);
    getEmployee(cNIK_get, maker_approval_get, cIDDept_get, cIDBag_get);
}

function deleted(id_ot_maker_get, cNmDept_get, cNmBag_get, maker_approval){
    if (confirm('Are you sure you want to delete special overtime approval '+maker_approval)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'overtime/delete-maker-approval/'+key_session,
            type: 'post',
            data: 'id_ot_maker='+id_ot_maker_get,
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
                            list_maker_approval(3, 0);
                            getEmployee(0, 0, 0);
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