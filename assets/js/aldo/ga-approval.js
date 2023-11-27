$(document).ready(function(){
    list_ga_approval(0);
})

function list_ga_approval(id_approve_get){
    $('#list_ga_approval').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-ga-approval/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){

                var status = responseGetList.status;
                if (status==0) {
                    $('#list_ga_approval').dataTable();
                }
                else {
                    var trList = '';
                    $('#list_ga_approval tbody').html('');
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_approve = responseList.id_approve;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var ga1 = responseList.ga1;
                        var cNmPegawai_ga1 = responseList.cNmPegawai_ga1;
                        var ga2 = responseList.ga2;
                        var cNmPegawai_ga2 = responseList.cNmPegawai_ga2;
                        var ga3 = responseList.ga3;
                        var cNmPegawai_ga3 = responseList.cNmPegawai_ga3;
                        var ga4 = responseList.ga4;
                        var cNmPegawai_ga4 = responseList.cNmPegawai_ga4;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        trList += '<tr>';
                            trList += '<td><select class="form-control" id="ga1" style="color:white;" onchange="update_ga(\''+1+'\', \''+id_approve+'\');"></select></td>';
                            trList += '<td><select class="form-control" id="ga2" style="color:white;" onchange="update_ga(\''+2+'\', \''+id_approve+'\');"></select></td>';
                            trList += '<td><select class="form-control" id="ga3" style="color:white;" onchange="update_ga(\''+3+'\', \''+id_approve+'\');"></select></td>';
                            trList += '<td><select class="form-control" id="ga4" style="color:white;" onchange="update_ga(\''+4+'\', \''+id_approve+'\');"></select></td>';
                        trList += '</tr>';

                        list_employee(ga1, cNmPegawai_ga1, 0, 1);
                        list_employee(ga2, cNmPegawai_ga2, 0, 2);
                        list_employee(ga3, cNmPegawai_ga3, 0, 3);
                        list_employee(ga4, cNmPegawai_ga4, 0, 4);
                    })
                    $('#list_ga_approval tbody').append(trList);
                    $('#list_ga_approval').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_employee(cNIK_get, cNmPegawai_get, cIDDept_get, no_get){
    $('#ga'+no_get).html('');
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
            $('#ga'+no_get).append(trList);
        }
    });
}

function update_ga(no_get, id_approve_get){
    var ga = $('#ga'+no_get).val();
    var column = 'ga'+no_get;
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'aldo/add-ga-approval/'+key_session,
        type: 'post',
        data: 'id_approve='+id_approve_get+'&ga='+ga+'&column='+column,
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
                        //list_ga_approval(0);
                        //reset_form();
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