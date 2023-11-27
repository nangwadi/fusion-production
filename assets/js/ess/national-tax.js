$(document).ready(function(){
    list_pkp_ptkp();
    list_pkp_ptkp_formula(1, 0);
    list_pkp_ptkp_formula(2, 0);
})

function list_pkp_ptkp(){
    $('#istri_company').val('');
    $('#istri_personal').val('');
    $('#anak_company').val('');
    $('#anak_personal').val('');
    $('#nominal_default').val('');
    $('#jumlah_bulan').val('');
    $.ajax({
        url: base_url+'ess/list-pkp-ptkp/'+key_session,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#id_pkp_ptkp').val('0');
                    $('#istri_company').val('0');
                    $('#istri_personal').val('0');
                    $('#anak_company').val('0');
                    $('#anak_personal').val('0');
                    $('#nominal_default').val('0');
                    $('#jumlah_bulan').val('0');
                }
                else {
                    var response = responseGetList.response;

                    var id_pkp_ptkp = response[0].id_pkp_ptkp;
                    var istri_company = response[0].istri_company;
                    var istri_personal = response[0].istri_personal;
                    var anak_company = response[0].anak_company;
                    var anak_personal = response[0].anak_personal;
                    var nominal_default = response[0].nominal_default;
                    var jumlah_bulan = response[0].jumlah_bulan;

                    $('#id_pkp_ptkp').val(istri_company);
                    $('#istri_company').val(istri_company);
                    $('#istri_personal').val(istri_personal);
                    $('#anak_company').val(anak_company);
                    $('#anak_personal').val(anak_personal);
                    $('#nominal_default').val(nominal_default);
                    $('#jumlah_bulan').val(jumlah_bulan);
                }
            })
        } 
    })
}

function add_pkp_ptkp(){
    var id_pkp_ptkp = $('#id_pkp_ptkp').val();
    var istri_company = $('#istri_company').val();
    var istri_personal = $('#istri_personal').val();
    var anak_company = $('#anak_company').val();
    var anak_personal = $('#anak_personal').val();
    var nominal_default = $('#nominal_default').val();
    var jumlah_bulan = $('#jumlah_bulan').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-pkp-ptkp/'+key_session,
        type: 'post',
        data: 'id_pkp_ptkp='+id_pkp_ptkp+'&istri_company='+istri_company+'&istri_personal='+istri_personal+'&anak_company='+anak_company+'&anak_personal='+anak_personal+'&nominal_default='+nominal_default+'&jumlah_bulan='+jumlah_bulan,
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
                        list_pkp_ptkp()
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

function list_pkp_ptkp_formula(category_get, id_pkp_ptkp_formula){
    if (category_get==1) {
        $('#list_pkp_ptkp_formula_company').dataTable().fnDestroy();
    }
    else if (category_get==2) {
        $('#list_pkp_ptkp_formula_personal').dataTable().fnDestroy();
    }

    $.ajax({
        url: base_url+'ess/list-pkp-ptkp-formula/'+key_session+'/'+id_pkp_ptkp_formula+'/'+category_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            if (category_get==1) {
                $('#list_pkp_ptkp_formula_company tbody').html('');
            }
            else if (category_get==2) {
                $('#list_pkp_ptkp_formula_personal tbody').html('');
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    if (category_get==1) {
                        $('#list_pkp_ptkp_formula_company').dataTable();
                    }
                    else if (category_get==2) {
                        $('#list_pkp_ptkp_formula_personal').dataTable();
                    }
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_pkp_ptkp_formula = responseList.id_pkp_ptkp_formula;
                        var range_start = responseList.range_start;
                        var range_end = responseList.range_end;
                        var range_start_format = responseList.range_start_format;
                        var range_end_format = responseList.range_end_format;
                        var npwp_percent = responseList.npwp_percent;
                        var non_npwp_percent = responseList.non_npwp_percent;
                        var minus_npwp = responseList.minus_npwp;
                        var minus_non_npwp = responseList.minus_non_npwp;
                        var minus_npwp_format = responseList.minus_npwp_format;
                        var minus_non_npwp_format = responseList.minus_non_npwp_format;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+id_pkp_ptkp_formula+'\', \''+range_start+'\', \''+range_end+'\', \''+npwp_percent+'\', \''+non_npwp_percent+'\', \''+minus_npwp+'\', \''+minus_non_npwp+'\', \''+category_get+'\');" title="Update pkp_ptkp_formula - '+range_start+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+id_pkp_ptkp_formula+'\', \''+range_start+'\', \''+range_end+'\', \''+1+'\');" title="Disable pkp_ptkp_formula - '+range_start+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+id_pkp_ptkp_formula+'\', \''+range_start+'\', \''+range_end+'\', \''+0+'\');" title="Enable pkp_ptkp_formula - '+range_start+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+range_start_format+'</td>';
                            trList += '<td style="color:white;">'+range_end_format+'</td>';
                            trList += '<td style="color:white;">'+npwp_percent+'</td>';
                            trList += '<td style="color:white;">'+non_npwp_percent+'</td>';
                            trList += '<td style="color:white;">'+minus_npwp_format+'</td>';
                            trList += '<td style="color:white;">'+minus_non_npwp_format+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    if (category_get==1) {
                        $('#list_pkp_ptkp_formula_company tbody').append(trList);
                        $('#list_pkp_ptkp_formula_company').dataTable({
                            "paging" : false,
                            "scrollY" : '400px',
                            "scrollCollapse" : true,
                        });
                    }
                    else if (category_get==2) {
                        $('#list_pkp_ptkp_formula_personal tbody').append(trList);
                        $('#list_pkp_ptkp_formula_personal').dataTable({
                            "paging" : false,
                            "scrollY" : '400px',
                            "scrollCollapse" : true,
                        });
                    }
                    
                }
            })
        }
    });
}

function add_pkp_ptkp_formula(category_get){
    var id_pkp_ptkp_formula = '';
    var range_start = '';
    var range_end = '';
    var npwp_percent = '';
    var non_npwp_percent = '';
    var minus_npwp = '';
    var minus_non_npwp = '';

    if (category_get==1) {
        id_pkp_ptkp_formula = $('#id_pkp_ptkp_formula_company').val();
        range_start = $('#range_start').val();
        range_end = $('#range_end').val();
        npwp_percent = $('#npwp_percent').val();
        non_npwp_percent = $('#non_npwp_percent').val();
        minus_npwp = $('#minus_npwp').val();
        minus_non_npwp = $('#minus_non_npwp').val();
    }
    else if (category_get==2) {
        id_pkp_ptkp_formula = $('#id_pkp_ptkp_formula_personal').val();
        range_start = $('#range_start_personal').val();
        range_end = $('#range_end_personal').val();
        npwp_percent = $('#npwp_percent_personal').val();
        non_npwp_percent = $('#non_npwp_percent_personal').val();
        minus_npwp = $('#minus_npwp_personal').val();
        minus_non_npwp = $('#minus_non_npwp_personal').val();
    }

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    //console.log(range_start+' '+range_end+' '+npwp_percent+' '+non_npwp_percent);

    $.ajax({
        url: base_url+'ess/add-pkp-ptkp-formula/'+key_session+'/'+category_get,
        type: 'post',
        data: 'id_pkp_ptkp_formula='+id_pkp_ptkp_formula+'&range_start='+range_start+'&range_end='+range_end+'&npwp_percent='+npwp_percent+'&non_npwp_percent='+non_npwp_percent+'&minus_npwp='+minus_npwp+'&minus_non_npwp='+minus_non_npwp,
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
                        list_pkp_ptkp_formula(category_get, 0);
                        reset_form(category_get);
                        modal_loading_hide();
                    }, 5000);
                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully, Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function update(id_pkp_ptkp_formula_get, range_start_get, range_end_get, npwp_percent_get, non_npwp_percent_get, minus_npwp_get, minus_non_npwp_get, category_get){
    if (category_get==1) {
        $('#id_pkp_ptkp_formula_company').val('');
        $('#range_start').val('');
        $('#range_end').val('');
        $('#npwp_percent').val('');
        $('#non_npwp_percent').val('');
        $('#minus_npwp').val('');
        $('#minus_non_npwp').val('');

        $('#id_pkp_ptkp_formula_company').val(id_pkp_ptkp_formula_get);
        $('#range_start').val(range_start_get);
        $('#range_end').val(range_end_get);
        $('#npwp_percent').val(npwp_percent_get);
        $('#non_npwp_percent').val(non_npwp_percent_get);
        $('#minus_npwp').val(minus_npwp_get);
        $('#minus_non_npwp').val(minus_non_npwp_get);
    }
    else if (category_get==2) {
        $('#id_pkp_ptkp_formula_personal').val('');
        $('#range_start_personal').val('');
        $('#range_end_personal').val('');
        $('#npwp_percent_personal').val('');
        $('#non_npwp_percent_personal').val('');
        $('#minus_npwp_personal').val('');
        $('#minus_non_npwp_personal').val('');

        $('#id_pkp_ptkp_formula_personal').val(id_pkp_ptkp_formula_get);
        $('#range_start_personal').val(range_start_get);
        $('#range_end_personal').val(range_end_get);
        $('#npwp_percent_personal').val(npwp_percent_get);
        $('#non_npwp_percent_personal').val(non_npwp_percent_get);
        $('#minus_npwp_personal').val(minus_npwp_get);
        $('#minus_non_npwp_personal').val(minus_non_npwp_get);
    }
}

function reset_form(category_get){
    if (category_get==1) {
        $('#id_pkp_ptkp_formula_company').val('');
        $('#range_start').val('');
        $('#range_end').val('');
        $('#npwp_percent').val('');
        $('#non_npwp_percent').val('');
        $('#minus_npwp').val('');
        $('#minus_non_npwp').val('');
    }
    else if (category_get==2) {
        $('#id_pkp_ptkp_formula_personal').val('');
        $('#range_start_personal').val('');
        $('#range_end_personal').val('');
        $('#npwp_percent_personal').val('');
        $('#non_npwp_percent_personal').val('');
        $('#minus_npwp_personal').val('');
        $('#minus_non_npwp_personal').val('');
    }
}

function disable_enable(id_bpjs_get, nama_bpjs_get, alias_get, company_get, personal_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_bpjs_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_bpjs_disen').val(id_bpjs_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable bpjs - "+nama_bpjs_get+".");
        $('#modal_body_disen').append("Are you sure will disable bpjs "+nama_bpjs_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable bpjs - "+nama_bpjs_get+".");
        $('#modal_body_disen').append("Are you sure will enable bpjs "+nama_bpjs_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_bpjs(){
    var id_bpjs = $('#id_bpjs_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-bpjs/'+key_session,
        type: 'post',
        data: 'id_bpjs='+id_bpjs+'&deleted='+deleted,
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
                        list_bpjs(0);
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