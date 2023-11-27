$(document).ready(function(){
    list_day_off_input(cIDAbsen, 0);

    $('.file-upload-browse').on('click', function() {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });

    img1.onchange = evt => {
        const [file] = img1.files
        if (file) {
            document.getElementById('div_view_img1').setAttribute('style', 'display:block; position: relative;');
            document.getElementById('div_img2').setAttribute('style', 'display:block');
            img_view1.src = URL.createObjectURL(file)
        }
    }

    img2.onchange = evt => {
        const [file] = img2.files
        if (file) {
            document.getElementById('div_view_img2').setAttribute('style', 'display:block; position: relative;');
            document.getElementById('div_img3').setAttribute('style', 'display:block');
            img_view2.src = URL.createObjectURL(file)
        }
    }

    img3.onchange = evt => {
        const [file] = img3.files
        if (file) {
            document.getElementById('div_view_img3').setAttribute('style', 'display:block; position: relative;');
            img_view3.src = URL.createObjectURL(file)
        }
    }
})

function list_day_off_input(type_get, id_cuti_get){
    $('#list_day_off_input').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-day-off-input/'+key_session+'/'+type_get+'/'+id_cuti_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_day_off_input tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_day_off_input').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_cuti = responseList.id_cuti;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var year = responseList.year;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var date_start = responseList.date_start;
                        var date_start_format = responseList.date_start_format;
                        var date_end = responseList.date_end;
                        var total = responseList.total;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var sub_type = responseList.sub_type;
                        var note = responseList.note;
                        var img1 = responseList.img1;
                        var img2 = responseList.img2;
                        var img3 = responseList.img3;
                        var img4 = responseList.img4;
                        var img5 = responseList.img5;
                        var approve1 = responseList.approve1;
                        var date_approve1 = responseList.date_approve1;
                        var approve1_by = responseList.approve1_by;
                        var cNmPegawai_approve1 = responseList.cNmPegawai_approve1;
                        var approve1_reject = responseList.approve1_reject;
                        var approve2 = responseList.approve2;
                        var date_approve2 = responseList.date_approve2;
                        var approve2_by = responseList.approve2_by;
                        var cNmPegawai_approve2 = responseList.cNmPegawai_approve2;
                        var approve2_reject = responseList.approve2_reject;
                        var ga1 = responseList.ga1;
                        var date_ga1 = responseList.date_ga1;
                        var ga1_by = responseList.ga1_by;
                        var cNmPegawai_ga1 = responseList.cNmPegawai_ga1;
                        var ga1_reject = responseList.ga1_reject;
                        var ga2 = responseList.ga2;
                        var date_ga2 = responseList.date_ga2;
                        var ga2_by = responseList.ga2_by;
                        var cNmPegawai_ga2 = responseList.cNmPegawai_ga2;
                        var ga2_reject = responseList.ga2_reject;
                        var ga3 = responseList.ga3;
                        var date_ga3 = responseList.date_ga3;
                        var ga3_by = responseList.ga3_by;
                        var cNmPegawai_ga3 = responseList.cNmPegawai_ga3;
                        var ga3_reject = responseList.ga3_reject;
                        var ga4 = responseList.ga4;
                        var date_ga4 = responseList.date_ga4;
                        var ga4_by = responseList.ga4_by;
                        var cNmPegawai_ga4 = responseList.cNmPegawai_ga4;
                        var ga4_reject = responseList.ga4_reject;
                        var create_by = responseList.create_by;
                        var cNmPegawai_create = responseList.cNmPegawai_create;
                        var create_date = responseList.create_date;
                        var last_by = responseList.last_by;
                        var cNmPegawai_last = responseList.cNmPegawai_last;
                        var last_update = responseList.last_update;

                        var approve1_icon = '';
                        if (approve1==1) {
                            approve1_icon = '✔';
                        }
                        else if (approve1==0) {
                            approve1_icon = '✖';
                        }

                        var approve2_icon = '';
                        if (approve2==1) {
                            approve2_icon = '✔';
                        }
                        else if (approve2==0) {
                            approve2_icon = '✖';
                        }

                        var ga1_icon = '';
                        if (ga1==1) {
                            ga1_icon = '✔';
                        }
                        else if (ga1==0) {
                            ga1_icon = '✖';
                        }

                        var ga2_icon = '';
                        if (ga2==1) {
                            ga2_icon = '✔';
                        }
                        else if (ga2==0) {
                            ga2_icon = '✖';
                        }

                        var ga3_icon = '';
                        if (ga3==1) {
                            ga3_icon = '✔';
                        }
                        else if (ga3==0) {
                            ga3_icon = '✖';
                        }

                        var ga4_icon = '';
                        if (ga4==1) {
                            ga4_icon = '✔';
                        }
                        else if (ga4==0) {
                            ga4_icon = '✖';
                        }

                        var action = '';
                        if (ga4==0) {
                            action = '<button class="btn btn-danger" onclick="deleted(\''+id_cuti+'\', \''+date_start_format+'\');" title="Enable Company - '+cNmPegawai+'."><i class="mdi mdi-delete-forever"></i></button>';
                        }
                        else {
                            action = '';
                        }

                        
                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+date_start_format+'</td>';
                            trList += '<td style="color:white;">'+cNmAbsen+'</td>';
                            trList += '<td style="color:white;">'+note+'</td>';
                            trList += '<td style="color:white;">'+approve1_icon+'</td>';
                            trList += '<td style="color:white;">'+approve2_icon+'</td>';
                            trList += '<td style="color:white;">'+ga1_icon+'</td>';
                            trList += '<td style="color:white;">'+ga2_icon+'</td>';
                            trList += '<td style="color:white;">'+ga3_icon+'</td>';
                            trList += '<td style="color:white;">'+ga4_icon+'</td>';
                            trList += '<td>'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_day_off_input tbody').append(trList);
                    $('#list_day_off_input').dataTable();
                }
            })
        }
    });
}

function add_day_off_input(){
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    var note = $('#note').val();

    var sub_type = '';
    var total = 1;
    var input_img1 = $('#input_img1').val();
    var input_img2 = $('#input_img2').val();
    var input_img3 = $('#input_img3').val();
    var img1 = $('#img1')[0].files;
    var img2 = $('#img2')[0].files;
    var img3 = $('#img3')[0].files;

    if (date_start == '' || note == '' || input_img1 == '') {
        alert ('Data cannot empty.');
    }
    else {
        modal_loading_open('bg-info', 'Saving data', 'Please wait...');

        var formData = new FormData();
        formData.append('date_start', date_start);
        formData.append('date_end', date_end);
        formData.append('note', note);
        formData.append('total', total);
        formData.append('input_img2', input_img2);
        formData.append('input_img3', input_img3);
        formData.append('img1', img1[0]);
        formData.append('img2', img2[0]);
        formData.append('img3', img3[0]);

        $.ajax({
            url: base_url+'aldo/add-day-off-non-special-leave/'+key_session+'/'+cIDAbsen,
            type: 'post',
            data: formData,
            crossDomain: true,
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            list_day_off_input(cIDAbsen, 0);
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

function deleted(id_cuti_get, date_start_format_get){
    if (confirm('Are you sure you want to delete this register - date : '+date_start_format_get+' ?')) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/delete-day-off-input/'+key_session,
            type: 'post',
            data: 'id_cuti='+id_cuti_get,
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
                            list_day_off_input(cIDAbsen, 0);
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

function reset_form(){
    $('#date_end').val('');
    $('#note').val('');

    $('#input_img1').val('');
    document.getElementById('div_view_img1').setAttribute('style', 'display:none;');
    document.getElementById('img_view1').setAttribute('src', '');

    $('#input_img2').val('');
    document.getElementById('div_img2').setAttribute('style', 'display:none;');
    document.getElementById('div_view_img2').setAttribute('style', 'display:none;');
    document.getElementById('img_view2').setAttribute('src', '');

    $('#input_img3').val('');
    document.getElementById('div_img3').setAttribute('style', 'display:none;');
    document.getElementById('div_view_img3').setAttribute('style', 'display:none;');
    document.getElementById('img_view3').setAttribute('src', '');
}

function remove_img(no_get){
    $('#input_img'+no_get).val('');
    document.getElementById('div_view_img'+no_get).setAttribute('style', 'display:none;');
    document.getElementById('img_view'+no_get).setAttribute('src', '');
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