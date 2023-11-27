$(document).ready(function(){
    list_salary_component_group(0);
    kategori_list('');
    trans_manual('');
    list_salary_component('');
})

function list_salary_component_group(cIDKomponen_group){
    $('#list_salary_component_group').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-salary-component-group/'+key_session+'/'+cIDKomponen_group,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_salary_component_group tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_salary_component_group').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDKomponen_group = responseList.cIDKomponen_group;
                        var cNmKomponen_group = responseList.cNmKomponen_group;
                        var kategori = responseList.kategori;
                        var kategori_descr = responseList.kategori_descr;
                        var cIDKomponen_multi = responseList.cIDKomponen_multi;
                        var cNmKomponen_multi  = responseList.cNmKomponen_multi;
                        var operator  = responseList.operator;
                        var nilai  = responseList.nilai;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDKomponen_group+'\');" title="Update Company - '+cNmKomponen_group+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDKomponen_group+'\', \''+cNmKomponen_group+'\', \''+kategori+'\', \''+1+'\');" title="Disable Company - '+cNmKomponen_group+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDKomponen_group+'\', \''+cNmKomponen_group+'\', \''+kategori+'\', \''+0+'\');" title="Enable Company - '+cNmKomponen_group+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            //trList += '<td style="color:white;">'+cIDKomponen+'</td>';
                            trList += '<td style="color:white;">'+cNmKomponen_group+'</td>';
                            trList += '<td style="color:white;">'+kategori_descr+'</td>';
                            trList += '<td style="color:white;">'+cNmKomponen_multi+'</td>';
                            trList += '<td style="color:white;">'+operator+'</td>';
                            trList += '<td style="color:white;">'+nilai+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_salary_component_group tbody').append(trList);
                    $('#list_salary_component_group').DataTable( {
                        scrollY:        "600px",
                        scrollX:        true,
                        scrollCollapse: true,
                        paging:         false,
                        fixedColumns:   {
                            left: 1,
                            right: 1
                        }
                    });
                }
            })
        }
    });
}

function list_salary_component(cIDKomponen_get){
    var url_list_salary = '';
    if (cIDKomponen_get!='') {
        url_list_salary = '';
    }
    else {
        url_list_salary = base_url+'ess/list-salary-component/'+key_session+'/0';
    }

    $('#cIDKomponen_multi').html('');

    $.ajax({
        url: url_list_salary,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="WY">Data not found.</option>';
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
                        var trans_manual_descr = responseList.trans_manual_descr;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDKomponen+'">'+cNmKomponen+'</option>';
                        }
                    })
                }
            })
            $('#cIDKomponen_multi').append(trList);
            $('#cIDKomponen_multi').select2();
        }
    });
}

function kategori_list(values){
    var trList = '';
    if (values=='P') {
        trList += '<option value="P">Plus</option>';
        trList += '<option value="M">Minus</option>';
    }
    else if (values=='M') {
        trList += '<option value="M">Minus</option>';
        trList += '<option value="P">Plus</option>';
    }
    else if (values=='') {
        trList += '<option value="P">Plus</option>';
        trList += '<option value="M">Minus</option>';
    }
    $('#kategori').html('');
    $('#kategori').append(trList);
}

function trans_manual(trans_manual_get){
    $('#trans_manual').html('');
    var trList = '';
    if (trans_manual_get==1) {
        trList += '<option value="1">Yes</option>';
        trList += '<option value="0">No</option>';
    }
    else if (trans_manual_get==0) {
        trList += '<option value="0">No</option>';
        trList += '<option value="1">Yes</option>';
    }
    else {
        trList += '<option value="0">No</option>';
        trList += '<option value="1">Yes</option>';
    }
    $('#trans_manual').append(trList);
}

function update(cIDKomponen_group_get){
    $.ajax({
        url: base_url+'ess/list-salary-component-group/'+key_session+'/'+cIDKomponen_group_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#cIDKomponen_group').val('');
                    $('#cNmKomponen_group').val('');
                    kategori_list('');
                    $('#operator').val('');
                    $('#nilai').val('');
                }
                else {
                    var trList = '';
                    $('#cIDKomponen_multi').html('');
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDKomponen_group = responseList.cIDKomponen_group;
                        var cNmKomponen_group = responseList.cNmKomponen_group;
                        var kategori = responseList.kategori;
                        var kategori_descr = responseList.kategori_descr;
                        var cIDKomponen_multi = responseList.cIDKomponen_multi;
                        var cNmKomponen_multi  = responseList.cNmKomponen_multi;
                        var operator  = responseList.operator;
                        var nilai  = responseList.nilai;
                        var deleted = responseList.deleted;

                        var cIDKomponen_array = responseList.cIDKomponen_array;
                        cIDKomponen_array.map(function(cIDKomponen_list){
                            var cIDKomponen = cIDKomponen_list.cIDKomponen;
                            var cNmKomponen = cIDKomponen_list.cNmKomponen; 

                            trList += '<option value="'+cIDKomponen+'" selected="selected">'+cNmKomponen+'</option>';
                        })

                        var cIDKomponen_default_array = responseList.cIDKomponen_default_array;
                        cIDKomponen_default_array.map(function(cIDKomponen_default_list){
                            var cIDKomponen = cIDKomponen_default_list.cIDKomponen;
                            var cNmKomponen = cIDKomponen_default_list.cNmKomponen; 

                            trList += '<option value="'+cIDKomponen+'">'+cNmKomponen+'</option>';
                        })

                        $('#cIDKomponen_multi').append(trList);
                        $('#cIDKomponen_multi').select2();

                        $('#cIDKomponen_group').val(cIDKomponen_group);
                        $('#cNmKomponen_group').val(cNmKomponen_group);
                        kategori_list(kategori);

                        $('#operator').val(operator);
                        $('#nilai').val(nilai);

                    })
                }
            })
        }
    });
}

function add_salary_component(){
    var cIDKomponen_group = $('#cIDKomponen_group').val();
    var cNmKomponen_group = $('#cNmKomponen_group').val();
    var kategori = $('#kategori').val();
    var cIDKomponen_multi = $('#cIDKomponen_multi').val();
    var operator = $('#operator').val();
    var nilai = $('#nilai').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-salary-component-group/'+key_session,
        type: 'post',
        data: 'cIDKomponen_group='+cIDKomponen_group+'&cNmKomponen_group='+cNmKomponen_group+'&kategori='+kategori+'&cIDKomponen_multi='+cIDKomponen_multi+'&operator='+operator+'&nilai='+nilai,
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
                        list_salary_component_group(0);
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
    $('#cIDKomponen_group').val('');
    $('#cNmKomponen_group').val('');
    kategori_list('');
    list_salary_component('');
    $('#operator').val('');
    $('#nilai').val('');
    document.getElementById('cIDKomponen_group').removeAttribute('readonly');
    document.getElementById('cIDKomponen_group').removeAttribute('style');
    document.getElementById('cIDKomponen_group').setAttribute('style', 'color:black');
}

function disable_enable(cIDKomponen_get, cNmKomponen_get, kategori, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDKomponen_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDKomponen_disen').val(cIDKomponen_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable family status - "+cNmKomponen_get+".");
        $('#modal_body_disen').append("Are you sure will disable family status "+cNmKomponen_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable family status - "+cNmKomponen_get+".");
        $('#modal_body_disen').append("Are you sure will enable family status "+cNmKomponen_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_salary_component(){
    var cIDKomponen = $('#cIDKomponen_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-salary-component/'+key_session,
        type: 'post',
        data: 'cIDKomponen='+cIDKomponen+'&deleted='+deleted,
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
                        list_salary_component_group(0);
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