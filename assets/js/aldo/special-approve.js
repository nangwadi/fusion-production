$(document).ready(function(){
    list_approval(category);
})

function list_approval(category_get){
    $('#list_day_off').dataTable();
    $.ajax({
        url: base_url+'aldo/list-cuti-approval-input/'+key_session+'/'+category_get+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#div_btn_approval').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (status==0) {
                    trList += 'No Approval';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList){
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        var count = responseList.count;
                        if ((count)*1 >= 0.5) {
                            const months = ["primary", "secondary", "success", "danger", "warning", "info", "light"];
                            const random = Math.floor(Math.random() * months.length);

                            trList += '<button class="btn btn-md btn-inverse-'+months[random]+'" onclick="list_day_off_input(\''+cIDAbsen+'\');">'+cNmAbsen+' ('+count+')</button>&nbsp;&nbsp;&nbsp;';
                        }
                    })
                }
                $('#div_btn_approval').append(trList);
            })
        }
    })
}

function list_day_off_input(cIDAbsen_get){
    $('#list_day_off').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'aldo/list-cuti-approval-input/'+key_session+'/'+category+'/'+cIDAbsen_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_day_off tbody').html('');
            $('#total_line').val('');
            $('#cIDAbsen').val('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_day_off').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    
                    response.map(function(responseList, i){
                        var result_cuti_approval_1 = responseList.result_cuti_approval_1;
                        var cIDAbsen = responseList.cIDAbsen;
                        var cNmAbsen = responseList.cNmAbsen;
                        if (result_cuti_approval_1.length>=0.5) {
                            result_cuti_approval_1.map(function(result_cuti_approval_1_list, i){
                                var id_cuti = result_cuti_approval_1_list.id_cuti;
                                var cNIK = result_cuti_approval_1_list.cNIK;
                                var cNmPegawai = result_cuti_approval_1_list.cNmPegawai;
                                var date_start = result_cuti_approval_1_list.date_start;
                                var date_start_format = result_cuti_approval_1_list.date_start_format;
                                var total = result_cuti_approval_1_list.total;
                                var sub_type = result_cuti_approval_1_list.sub_type;
                                var sub_type_desc = sub_type_desc;
                                var note = result_cuti_approval_1_list.note;
                                var cIDDept = result_cuti_approval_1_list.cIDDept;
                                var cNmDept = result_cuti_approval_1_list.cNmDept;
                                var cIDBag = result_cuti_approval_1_list.cIDBag;
                                var cNmBag = result_cuti_approval_1_list.cNmBag;
                                var cIDJbtn = result_cuti_approval_1_list.cIDJbtn;
                                var cNmJbtn = result_cuti_approval_1_list.cNmJbtn;
                                var img1 = result_cuti_approval_1_list.img1;
                                var img2 = result_cuti_approval_1_list.img2;
                                var img3 = result_cuti_approval_1_list.img3;
                                var diff = result_cuti_approval_1_list.diff;
                                var approve = result_cuti_approval_1_list.approve;
                                var approve1 = result_cuti_approval_1_list.approve1;
                                var approve2 = result_cuti_approval_1_list.approve2;
                                var ga1 = result_cuti_approval_1_list.ga1;
                                var ga2 = result_cuti_approval_1_list.ga2;
                                var ga3 = result_cuti_approval_1_list.ga3;
                                var ga4 = result_cuti_approval_1_list.ga4;

                                var images = '';
                                if (img1 != '' || img2 !='' || img3 != '') {
                                    images = '<button class="btn btn-info" onclick="view_image(\''+img1+'\', \''+img2+'\', \''+img3+'\', \''+cNmPegawai+'\');"><i class="mdi mdi-image-filter"></i></button>';
                                }
                                else {
                                    images = '';
                                }

                                var action = '<button class="btn btn-danger" onclick="deleted(\''+id_cuti+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');" title="Enable Company - '+cNmPegawai+'."><i class="mdi mdi-delete-forever"></i></button>';

                                trList += '<tr>';
                                    trList += '<td style="color:white;">'+(i+1)+'</td>';
                                    trList += '<td style="color:white;">'+cNmPegawai+' / '+cNIK+'</td>';
                                    trList += '<td style="color:white;">'+date_start_format+'</td>';
                                    trList += '<td style="color:white;">'+cNmAbsen+'</td>';
                                    trList += '<td style="color:white;">'+note+'</td>';
                                    trList += '<td style="color:white;">'+images+'</td>';
                                    trList += '<td style="color:white;">'+diff+'</td>';
                                    trList += '<td style="color:white;">';
                                        if (approve1==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="approve1_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'approve1\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="approve1_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'approve1\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    trList += '<td style="color:white;">';
                                        if (approve2==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="approve2_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'approve2\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="approve2_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'approve2\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    trList += '<td style="color:white;">';
                                        if (ga1==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="ga1_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga1\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="ga1_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga1\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    trList += '<td style="color:white;">';
                                        if (ga2==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="ga2_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga2\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="ga2_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga2\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    trList += '<td style="color:white;">';
                                        if (ga3==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="ga3_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga3\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="ga3_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga3\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    trList += '<td style="color:white;">';
                                        if (ga4==1) {
                                            trList += '<input type="checkbox" checked="checked" style="width:25px; height:25px;" id="ga4_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga4\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                        else {
                                            trList += '<input type="checkbox" style="width:25px; height:25px;" id="ga4_'+(i+1)+'" onchange="approve(\''+(i+1)+'\', \''+id_cuti+'\', \'ga4\', \''+cNmPegawai+'\', \''+date_start_format+'\', \''+cIDAbsen+'\');">';
                                        }
                                    trList += '</td>';
                                    
                                    trList += '<td style="color:white;">'+action+'</td>';
                                trList += '</tr>';
                            })
                        }

                        let total_line = result_cuti_approval_1.length;
                        $('#total_line').val(total_line*1);
                        $('#cIDAbsen').val(cIDAbsen);
                    })  
                    
                    $('#list_day_off tbody').append(trList);
                    $('#list_day_off').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function approve(no_get, id_cuti_get, column_get, cNmPegawai_get, date_start_format_get, cIDAbsen_get){
    //alert(id_cuti_get+' '+column_get);
    var approve_input = $('#'+column_get+'_'+no_get).prop('checked');
    
    var notify = '';
    var notify_2 = '';
    let approve = '';
    if (approve_input==true) {
        notify = 'Are you sure want approve '+cNmPegawai_get+'?';
        notify_2 = 'Approve';
        approve = 1;
    }
    else if (approve_input==false) {
        notify = 'Are you sure want cancel approve '+cNmPegawai_get+'?';
        notify_2 = 'Cancel approve';
        approve = 0;
    }

    if (confirm(notify)) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');
        $.ajax({
            url: base_url+'aldo/update-day-off-special-approve/'+key_session,
            type: 'post',
            data: 'id_cuti='+id_cuti_get+'&column='+column_get+'&approve='+approve,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1) {
                        modal_loading_open('bg-primary', notify_2+' successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                    else {
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', notify_2+' unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function deleted(id_cuti_get, date_start_format_get, cIDAbsen_get){
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
                            list_day_off_input(cIDAbsen_get);
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

function view_image(img1_get, img2_get, img3_get, cNmPegawai_get){
    $('#modal_title_image').html('');
    $('#modal_title_image').append('<i class="mdi mdi-image-filter"></i>&nbsp;&nbsp;&nbsp;Image(s) from '+cNmPegawai_get);
    if (img1_get!='') {
        document.getElementById('div_img1').removeAttribute('style');
        document.getElementById('div_img1').setAttribute('style', 'display:block; position: relative;');
        document.getElementById('img1').removeAttribute('src', '');
        document.getElementById('img1').setAttribute('src', base_url+'assets/images/aldo/'+img1_get);
        $('#img1_value').val('');
        $('#img1_value').val(base_url+'assets/images/aldo/'+img1_get);
    }

    if (img2_get!='') {
        document.getElementById('div_img2').removeAttribute('style');
        document.getElementById('div_img2').setAttribute('style', 'display:block; position: relative;');
        document.getElementById('img2').removeAttribute('src', '');
        document.getElementById('img2').setAttribute('src', base_url+'assets/images/aldo/'+img2_get);
        $('#img2_value').val('');
        $('#img2_value').val(base_url+'assets/images/aldo/'+img2_get);
    }

    if (img3_get!='') {
        document.getElementById('div_img3').removeAttribute('style');
        document.getElementById('div_img3').setAttribute('style', 'display:block; position: relative;');
        document.getElementById('img3').removeAttribute('src', '');
        document.getElementById('img3').setAttribute('src', base_url+'assets/images/aldo/'+img3_get);
        $('#img3_value').val('');
        $('#img3_value').val(base_url+'assets/images/aldo/'+img3_get);
    }
    $('#modal_image').modal('show');
}

function view_image_hide(){
    $('#modal_image').modal('hide');   
}

function download_img(no_get){
    var img_url = $('#img'+no_get+'_value').val();
    fetch(img_url)
        .then(resp => resp.blob())
        .then(blob => {
            const img_url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = img_url;
            // the filename you want
            a.download = name;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(img_url);
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