$(document).ready(function(){
    list_approval(category);
})

function list_approval(category_get){
    //$('#list_day_off').dataTable().fnDestroy();
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
                    trList += '<button class="btn btn-md btn-inverse-primary">Approval not found.</button>';
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

                                var images = '';
                                if (img1 != '' || img2 !='' || img3 != '') {
                                    images = '<button class="btn btn-info" onclick="view_image(\''+img1+'\', \''+img2+'\', \''+img3+'\', \''+cNmPegawai+'\');"><i class="mdi mdi-image-filter"></i></button>';
                                }
                                else {
                                    images = '';
                                }

                                trList += '<tr>';
                                    trList += '<td style="color:white;">'+(i+1)+'</td>';
                                    trList += '<td style="color:white;">'+cNmPegawai+' / '+cNIK+'</td>';
                                    trList += '<td style="color:white;">'+date_start_format+'</td>';
                                    trList += '<td style="color:white;">'+cNmAbsen+'</td>';
                                    trList += '<td style="color:white;">'+note+'</td>';
                                    trList += '<td style="color:white;">'+images+'</td>';
                                    trList += '<td style="color:white;">'+diff+'</td>';
                                    trList += '<td><input type="hidden" class="form-control" id="cNIK_'+(i+1)+'" value="'+cNIK+'"><input type="hidden" class="form-control" id="column_'+(i+1)+'" value="'+approve+'"><input type="hidden" class="form-control" id="id_cuti_'+(i+1)+'" value="'+id_cuti+'"><input type="text" class="form-control" id="reject_'+(i+1)+'" placeholder="If reject only"></td>';
                                    trList += '<td><input type="checkbox" id="approve_'+(i+1)+'" style="width:25px; height:25px;"></td>';
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

function approve(){
    var total_line = $('#total_line').val();
    var cIDAbsen = $('#cIDAbsen').val();
    var Pwd = $('#Pwd').val();

    if (cIDAbsen=='') {
        alert ('Please choose day off approval.');
    }
    else {
        if (Pwd =='') {
            alert ('Password cannot empty, please try again.');
        }
        else {
             var id_cuti_obj = [];
             var cNIK_obj = [];
             var approve_obj = [];
             var reject_obj = [];
             var column_obj = [];
             let total_approve = 0;

             for (var i=1; i<=total_line*1; i++){
                var approve = $("#approve_"+i).prop("checked");
                var id_cuti = $('#id_cuti_'+i).val();
                var cNIK = $('#cNIK_'+i).val();
                var reject = $("#reject_"+i).val();
                var column = $("#column_"+i).val();
                if (approve == true) {
                    id_cuti_obj.push(id_cuti);
                    cNIK_obj.push(cNIK);
                    column_obj.push(column);
                    approve_obj.push(1);
                    reject_obj.push('');
                    total_approve +=1;
                }
                else {
                    if (reject!='') {
                        id_cuti_obj.push(id_cuti);
                        cNIK_obj.push(cNIK);
                        column_obj.push(column);
                        approve_obj.push(2);
                        reject_obj.push(reject);
                        total_approve +=1;
                    }
                    else {
                        total_approve +=0;
                    }
                }
            }

            if (total_approve==0) {
                alert ('You not choose anything.');
            }
            else {
                modal_loading_open('bg-info', 'Saving data', 'Please wait...');
                $.ajax({
                    url: base_url+'aldo/update-day-off-input/'+key_session,
                    type: 'post',
                    data: 'id_cuti='+id_cuti_obj+'&cNIK='+cNIK_obj+'&approve='+approve_obj+'&reject='+reject_obj+'&column='+column_obj+'&total_approve='+total_approve+'&Pwd='+Pwd,
                    crossDomain: true,
                    dataType: 'JSON',
                    success: function(responseGet){
                        //console.log(responseGet);
                        modal_loading_hide();
                        responseGet.map(function(responseGetList){
                            var status = responseGetList.status;
                            if (status==1) {
                                modal_loading_open('bg-primary', 'Approve successfully', 'Please wait for hide this view...');
                                setTimeout(function () {
                                    list_approval(category);
                                    list_day_off_input(cIDAbsen);
                                    modal_loading_hide();
                                }, 5000);

                            }
                            else {
                                var response = responseGetList.response;
                                modal_loading_open('bg-danger', 'Approve unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                                setTimeout(function () {
                                    modal_loading_hide();
                                }, 5000);
                            }
                        })
                    }
                })
            }
        }
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