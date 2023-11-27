$(document).ready(function(){
    list_precense_type(0);
    yesno(0, 0);
})

function list_precense_type(cIDAbsen){
    $('#list_precense_type').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-precense-type/'+key_session+'/'+cIDAbsen,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#list_precense_type tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_precense_type').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var Note = responseList.Note;
                        var DayOff = responseList.DayOff;
                        var PotongGaji = responseList.PotongGaji;
                        var color_marking = responseList.color_marking;

                        var DayOff_note = '';
                        if (DayOff==0) {
                            DayOff_note = '<div class="btn-outline-danger">No</div>';
                        }
                        else {
                            DayOff_note = '<div class="btn-outline-primary">Yes</div>';
                        }

                        var PotongGaji_note = '';
                        if (PotongGaji==0) {
                            PotongGaji_note = '<div class="btn-outline-danger">No</div>';
                        }
                        else {
                            PotongGaji_note = '<div class="btn-outline-primary">Yes</div>';
                        }
                        
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-info" onclick="update(\''+cIDAbsen+'\', \''+cNmAbsen+'\', \''+Note+'\', \''+DayOff+'\', \''+PotongGaji+'\', \''+color_marking+'\');" title="Update Precense Type - '+cNmAbsen+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable(\''+cIDAbsen+'\', \''+cNmAbsen+'\', \''+1+'\');" title="Disable Precense Type - '+cNmAbsen+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable(\''+cIDAbsen+'\', \''+cNmAbsen+'\', \''+0+'\');" title="Enable Precense Type - '+cNmAbsen+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cIDAbsen+'</td>';
                            trList += '<td style="color:white;">'+cNmAbsen+'</td>';
                            trList += '<td style="color:white;">'+Note+'</td>';
                            trList += '<td style="color:white;">'+DayOff_note+'</td>';
                            trList += '<td style="color:white;">'+PotongGaji_note+'</td>';
                            trList += '<td style="color:white;">'+color_marking+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_precense_type tbody').append(trList);
                    $('#list_precense_type').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function yesno(category, value){
    var trList = '';
    if (value==1) {
        trList += '<option value="1">Yes</option>';
        trList += '<option value="0">No</option>';
    }
    else {
        trList += '<option value="0">No</option>';
        trList += '<option value="1">Yes</option>';
    }

    if (category==1) {
        $('#DayOff').html('');
        $('#DayOff').append(trList);
    }
    else if (category==2) {
        $('#PotongGaji').html('');
        $('#PotongGaji').append(trList);        
    }
    else {
        $('#DayOff').html('');
        $('#DayOff').append(trList);
        $('#PotongGaji').html('');
        $('#PotongGaji').append(trList);  
    }
}

function update(cIDAbsen, cNmAbsen, Note, DayOff, PotongGaji, color_marking){
    $('#cIDAbsen').val('');
    $('#cNmAbsen').val('');
    $('#Note').val('');
    $('#color_marking').val('');

    $('#cIDAbsen').val(cIDAbsen);
    $('#cNmAbsen').val(cNmAbsen);
    $('#Note').val(Note);
    $('#color_marking').val(color_marking);
    yesno(1, DayOff);
    yesno(2, PotongGaji);
    document.getElementById('cIDAbsen').setAttribute('readonly', 'readonly');
    document.getElementById('cIDAbsen').setAttribute('style', 'color:black');
}

function add_precense_type(){
    var cIDAbsen = $('#cIDAbsen').val();
    var cNmAbsen = $('#cNmAbsen').val();
    var Note = $('#Note').val();
    var DayOff = $('#DayOff').val();
    var PotongGaji = $('#PotongGaji').val();
    var color_marking = $('#color_marking').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-precense-type/'+key_session,
        type: 'post',
        data: 'cIDAbsen='+cIDAbsen+'&cNmAbsen='+cNmAbsen+'&Note='+Note+'&DayOff='+DayOff+'&PotongGaji='+PotongGaji+'&color_marking='+color_marking,
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
                        list_precense_type(0);
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
    $('#cIDAbsen').val('');
    $('#cNmAbsen').val('');
    $('#Note').val('');
    $('#color_marking').val('');
    yesno(0, 0);
    document.getElementById('cIDAbsen').removeAttribute('readonly');
    document.getElementById('cIDAbsen').removeAttribute('style');
    document.getElementById('cIDAbsen').setAttribute('style', 'color:black');
}

function disable_enable(cIDAbsen_get, cNmAbsen_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#cIDAbsen_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#cIDAbsen_disen').val(cIDAbsen_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable precense type - "+cNmAbsen_get+".");
        $('#modal_body_disen').append("Are you sure will disable precense type "+cNmAbsen_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable precense type - "+cNmAbsen_get+".");
        $('#modal_body_disen').append("Are you sure will enable precense type "+cNmAbsen_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_precense_type(){
    var cIDAbsen = $('#cIDAbsen_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/update-precense-type/'+key_session,
        type: 'post',
        data: 'cIDAbsen='+cIDAbsen+'&deleted='+deleted,
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
                        list_precense_type(0);
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