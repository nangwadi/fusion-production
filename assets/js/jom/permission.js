$(document).ready(function(){
    list_permission_employee(0);
    list_employee_active(1, '', '');
    //list_permission(0, 0);
})

function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
    $('#cNIK').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cNIK_get=='') {
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
            $('#cNIK').append(trList);
        }
    });
}

/*function list_permission(id_permission_get, permission_name_get){
    $('#id_permission').html('');
    $.ajax({
        url: base_url+'jom/list-permission-type/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_permission_get==0) {
                trList += '<option value="">Select Permission Name</option>';
            }
            else {
                trList += '<option value="'+id_permission_get+'">'+permission_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_permission = responseList.id_permission;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var permission_cd = responseList.permission_cd;
                        var permission_name = responseList.permission_name;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_permission+'">'+permission_name+'</option>';
                        }
                    })
                }
            })
            $('#id_permission').append(trList);
        }
    });
}*/

function list_permission_employee(id_permission_employee){
    $('#list_permission_employee').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'jom/list-permission-employee/'+key_session+'/'+id_permission+'/'+id_permission_employee,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_permission_employee tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_permission_employee').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_permission_employee = responseList.id_permission_employee;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_permission = responseList.id_permission;
                        var permission_cd = responseList.permission_cd;
                        var permission_name = responseList.permission_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai_permission = responseList.cNmPegawai_permission;
                        var r = responseList.r;
                        var c = responseList.c;
                        var u = responseList.u;
                        var d = responseList.d;

                        var r_icon = '';
                        if (r==1) {
                            r_icon = '✔';
                        }
                        else if (r==0) {
                            r_icon = '✖';
                        }

                        var c_icon = '';
                        if (c==1) {
                            c_icon = '✔';
                        }
                        else if (c==0) {
                            c_icon = '✖';
                        }

                        var u_icon = '';
                        if (u==1) {
                            u_icon = '✔';
                        }
                        else if (u==0) {
                            u_icon = '✖';
                        }

                        var d_icon = '';
                        if (d==1) {
                            d_icon = '✔';
                        }
                        else if (d==0) {
                            d_icon = '✖';
                        }

                        var action = '';
                        action += '<button class="btn btn-info" onclick="update(\''+id_permission_employee+'\', \''+id_permission+'\', \''+permission_name+'\', \''+cNIK+'\', \''+cNmPegawai_permission+'\', \''+r+'\', \''+c+'\', \''+u+'\', \''+d+'\');" title="Update Company - '+cNmPegawai_permission+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        action += '<button class="btn btn-danger" onclick="deleted(\''+id_permission_employee+'\', \''+cNmPegawai_permission+'\', \''+1+'\');" title="Delete - '+cNmPegawai_permission+'."><i class="mdi mdi-delete"></i></button>';
                        

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            //trList += '<td style="color:white;">'+permission_name+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai_permission+'</td>';
                            trList += '<td style="color:white;">'+r_icon+'</td>';
                            trList += '<td style="color:white;">'+c_icon+'</td>';
                            trList += '<td style="color:white;">'+u_icon+'</td>';
                            trList += '<td style="color:white;">'+d_icon+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_permission_employee tbody').append(trList);
                    $('#list_permission_employee').dataTable();
                }
            })
        }
    });
}

function add_permission_employee(){
    var id_permission_employee = $('#id_permission_employee').val();
    var id_permission = $('#id_permission').val();
    var cNIK = $('#cNIK').val();
    var r = $('#r').prop('checked');
    var c = $('#c').prop('checked');
    var u = $('#u').prop('checked');
    var d = $('#d').prop('checked');
    
    let r_value = '';
    if (r==true) {
        r_value = 1;
    }
    else if (r==false) {
        r_value = 0;
    }

    let c_value = '';
    if (c==true) {
        c_value = 1;
    }
    else if (c==false) {
        c_value = 0;
    }

    let u_value = '';
    if (u==true) {
        u_value = 1;
    }
    else if (u==false) {
        u_value = 0;
    }

    let d_value = '';
    if (d==true) {
        d_value = 1;
    }
    else if (d==false) {
        d_value = 0;
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-permission-employee/'+key_session,
        type: 'post',
        data: 'id_permission_employee='+id_permission_employee+'&id_permission='+id_permission+'&cNIK='+cNIK+'&r='+r_value+'&c='+c_value+'&u='+u_value+'&d='+d_value,
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
                        list_permission_employee(0);
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

function update(id_permission_employee_get, id_permission_get, permission_name_get, cNIK_get, cNmPegawai_permission_get, r_get, c_get, u_get, d_get){
    $('#id_permission_employee').val(id_permission_employee_get);

    list_employee_active(1, cNIK_get, cNmPegawai_permission_get);
    //list_permission(id_permission_get, permission_name_get);

    if (r_get==1) {
        $('#r').prop('checked', true);
    }
    else if(r_get==0) {
        $('#r').prop('checked', false);    
    }

    if (c_get==1) {
        $('#c').prop('checked', true);
    }
    else if(c_get==0) {
        $('#c').prop('checked', false);    
    }

    if (u_get==1) {
        $('#u').prop('checked', true);
    }
    else if(u_get==0) {
        $('#u').prop('checked', false); 
    }

    if (d_get==1) {
        $('#d').prop('checked', true);
    }
    else if(d_get==0) {
        $('#d').prop('checked', false);    
    }
}

function reset_form(){
    list_employee_active(1, '', '');
    //list_permission(0, 0);

    $('#r').prop('checked', false);
    $('#c').prop('checked', false);
    $('#u').prop('checked', false);
    $('#d').prop('checked', false);
}

function deleted(id_permission_employee_get, cNmPegawai_permission_get){
    if (confirm('Are you sure you want to delete permission for '+cNmPegawai_permission_get+' ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'jom/delete-permission-employee/'+key_session,
            type: 'post',
            data: 'id_permission_employee='+id_permission_employee_get,
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
                            list_permission_employee(0);
                            reset_form();
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