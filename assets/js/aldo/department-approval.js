$(document).ready(function(){
    list_department_approval(0);
    list_department(0, 0);
    list_potition(0, 0);
})

function list_department_approval(id_approve_get){
    $('#list_department_approval').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-department-approval/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){

                var status = responseGetList.status;
                if (status==0) {
                    $('#list_department_approval').dataTable();
                }
                else {
                    var trList = '';
                    $('#list_department_approval tbody').html('');
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_approve = responseList.id_approve;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cIDBag = responseList.cIDBag;
                        var cIDJbtn = responseList.cIDJbtn;
                        var cNmDept = responseList.cNmDept;
                        var cNmBag = responseList.cNmBag;
                        var cNmJbtn = responseList.cNmJbtn;
                        var approve1 = responseList.approve1;
                        var cNmPegawai_approve1 = responseList.cNmPegawai_approve1;
                        var approve2 = responseList.approve2;
                        var cNmPegawai_approve2 = responseList.cNmPegawai_approve2;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var action = '<button class="btn btn-info" onclick="update(\''+id_approve+'\');" title="Update Department Approval - '+cNmDept+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        action += '<button class="btn btn-danger" onclick="deleted(\''+id_approve+'\', \''+cNmDept+'\');" title="Disable Company - '+cNmDept+'."><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+cNmBag+'</td>';
                            trList += '<td style="color:white;">'+cNmJbtn+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai_approve1+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai_approve2+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_department_approval tbody').append(trList);
                    $('#list_department_approval').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
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
            var trList = '';
            if (cIDDept_get!='0') {
                trList += '<option value="'+cIDDept_get+'">'+cNmDept_get+'</option>';
            }
            else {
                trList += '<option value="">Select Department</option>';
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
                            var deleted = responseList.deleted;

                            if (deleted==0) {
                                trList += '<option value="'+cIDDept+'">'+cNmDept+'</option>';
                            }
                        })
                    }
                })
            }            
            $('#cIDDept').append(trList);
        }
    });
}

function getDivision(cIDBag_get, cNmBag_get){
    var cIDDept = $('#cIDDept').val();
    $('#cIDBag').html('');

    if (cIDBag_get=='0') {
        list_employee1(0, 0, cIDDept);
        list_employee2(0, 0, cIDDept);    
    }    

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
            else {
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
            }            
            $('#cIDBag').append(trList);
        }
    });
}

function list_potition(cIDJbtn_get, cNmJbtn_get){
    $('#cIDJbtn').html('');
    $.ajax({
        url: base_url+'ess/list-potition/'+key_session+'/'+cIDJbtn_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = ''
            if (cIDJbtn_get!='0') {
                trList += '<option value="'+cIDJbtn_get+'">'+cNmJbtn_get+'</option>';
            }
            else {
                trList += '<option value="">Select Potition</option>';
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
                            var cIDJbtn = responseList.cIDJbtn;
                            var cNmJbtn = responseList.cNmJbtn;
                            var deleted = responseList.deleted;

                            if (deleted==0) {
                                trList += '<option value="'+cIDJbtn+'">'+cNmJbtn+'</option>';
                            }

                        })
                    }
                })
            }
            
            $('#cIDJbtn').append(trList);
        }
    });
}

function list_employee1(cNIK_get, cNmPegawai_get, cIDDept_get){
    $('#approve1').html('');
    //var cIDDept = $('#cIDDept').val();
    $.ajax({
        url: base_url+'aldo/list-employee-by-department/'+key_session+'/'+cIDDept_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(cNIK_get);
            var trList = '';
            if (cNIK_get=='0') {
                trList += '<option value="">Select Employee.</option>';
            }
            else {
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
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;

                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    });
                }
            })
            $('#approve1').append(trList);
        }
    });
}

function list_employee2(cNIK_get, cNmPegawai_get, cIDDept_get){
    $('#approve2').html('');
    //var cIDDept = $('#cIDDept').val();
    $.ajax({
        url: base_url+'aldo/list-employee-by-department/'+key_session+'/'+cIDDept_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(cNIK_get);
            var trList = '';
            if (cNIK_get=='0') {
                trList += '<option value="">Select Employee.</option>';
            }
            else {
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
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;

                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    });
                }
            })
            $('#approve2').append(trList);
        }
    });
}

function update(id_approve_get){
    $.ajax({
        url: base_url+'aldo/list-department-approval/'+key_session+'/'+id_approve_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var id_approve = responseList.id_approve;
                    var company_id = responseList.company_id;
                    var company_name = responseList.company_name;
                    var cIDDept = responseList.cIDDept;
                    var cIDBag = responseList.cIDBag;
                    var cIDJbtn = responseList.cIDJbtn;
                    var cNmDept = responseList.cNmDept;
                    var cNmBag = responseList.cNmBag;
                    var cNmJbtn = responseList.cNmJbtn;
                    var approve1 = responseList.approve1;
                    var cNmPegawai_approve1 = responseList.cNmPegawai_approve1;
                    var approve2 = responseList.approve2;
                    var cNmPegawai_approve2 = responseList.cNmPegawai_approve2;
                    var create_by = responseList.create_by;
                    var cNmPegawai_create = responseList.cNmPegawai_create;
                    var create_date = responseList.create_date;
                    var last_by = responseList.last_by;
                    var cNmPegawai_last = responseList.cNmPegawai_last;
                    var last_update = responseList.last_update;

                    $('#id_approve').val('');
                    $('#id_approve').val(id_approve);

                    list_department(cIDDept, cNmDept);
                    getDivision(cIDBag, cNmBag);
                    list_potition(cIDJbtn, cNmJbtn);
                    list_employee1(approve1, cNmPegawai_approve1, cIDDept);
                    list_employee2(approve2, cNmPegawai_approve2, cIDDept);
                })
            })
        }
    });
}

function add_department_approval(){

    var id_approve = $('#id_approve').val();
    var cIDDept = $('#cIDDept').val();
    var cIDBag = $('#cIDBag').val();
    var cIDJbtn = $('#cIDJbtn').val();
    var approve1 = $('#approve1').val();
    var approve2 = $('#approve2').val();

    if (cIDDept == '' || cIDBag == '' || cIDJbtn == '' || approve2 == '') {
        alert ('Data cannot empty, please try again.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');

        $.ajax({
            url: base_url+'aldo/add-department-approval/'+key_session,
            type: 'post',
            data: 'id_approve='+id_approve+'&cIDDept='+cIDDept+'&cIDBag='+cIDBag+'&cIDJbtn='+cIDJbtn+'&approve1='+approve1+'&approve2='+approve2,
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
                            list_department_approval(0);
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
}

function add_approval_show(){
    document.getElementById('add_approval').removeAttribute('style');
    document.getElementById('add_approval').setAttribute('style', 'display:block');
}

function add_approval_hide(){
    document.getElementById('add_approval').removeAttribute('style');
    document.getElementById('add_approval').setAttribute('style', 'display:none');
}

function reset_form(){
    $('#cIDBag').val('');

    list_department(0, 0);
    list_potition(0, 0);
    $('#cIDBag').html('');
    $('#approve1').html('');
    $('#approve2').html('');

    document.getElementById('add_approval').setAttribute('style', 'display:none');
}

function deleted(id_approve_get, cNmDept_get){
    if (confirm('Are you sure you want to delete Approval Department of - '+cNmDept_get)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/delete-department-approval/'+key_session,
            type: 'post',
            data: 'id_approve='+id_approve_get,
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
                            list_department_approval(0);
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