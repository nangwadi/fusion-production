$(document).ready(function(){
    list_time_deadline();
})

function list_time_deadline(){
    $('#list_time_deadline').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'overtime/list-time-deadline/'+key_session,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_time_deadline tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_time_deadline').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_ot_timeline = responseList.id_ot_timeline;
                        var company_id = responseList.company_id;
                        var daily_maker = responseList.daily_maker;
                        var daily_approval = responseList.daily_approval;
                        var holiday_maker = responseList.holiday_maker;
                        var holiday_approval = responseList.holiday_approval;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;
                        var company_code = responseList.company_code;
                        var company_name = responseList.company_name;

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;"><input type="text" class="form-control" id="daily_maker" value="'+daily_maker+'" maxlength="5" onchange="update(\''+id_ot_timeline+'\');"></td>';
                            trList += '<td style="color:white;"><input type="text" class="form-control" id="daily_approval" value="'+daily_approval+'" maxlength="5" onchange="update(\''+id_ot_timeline+'\');"></td>';
                            trList += '<td style="color:white;"><input type="text" class="form-control" id="holiday_maker" value="'+holiday_maker+'" maxlength="5" onchange="update(\''+id_ot_timeline+'\');"></td>';
                            trList += '<td style="color:white;"><input type="text" class="form-control" id="holiday_approval" value="'+holiday_approval+'" maxlength="5" onchange="update(\''+id_ot_timeline+'\');"></td>';
                            trList += '<td style="color:white;">'+cNmPegawai_last+'</td>';
                            trList += '<td style="color:white;">'+last_update+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_time_deadline tbody').append(trList);
                    $('#list_time_deadline').dataTable();
                }
            })
        }
    });
}

function update(id_ot_timeline_get){
    var daily_maker = $('#daily_maker').val();
    var daily_approval = $('#daily_approval').val();
    var holiday_maker = $('#holiday_maker').val();
    var holiday_approval = $('#holiday_approval').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'overtime/update-time-deadline/'+key_session,
        type: 'post',
        data: 'daily_maker='+daily_maker+'&daily_approval='+daily_approval+'&holiday_maker='+holiday_maker+'&holiday_approval='+holiday_approval+'&id_ot_timeline='+id_ot_timeline_get,
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
                        list_time_deadline();
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