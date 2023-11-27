$(document).ready(function(){
    list_face(0, 0);
})

function list_face(cNIK, date_record){
    $('#list_face').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-face/'+key_session+'/'+cNIK+'/'+date_record,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_face tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_face').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var date_record = responseList.date_record;
                        var time_record = responseList.time_record;
                        var kategori = responseList.kategori;
                        var kategori_eng = '';
                        if (kategori=='Masuk') {
                            kategori_eng = '<div class="btn btn-outline-success" style="width:75px;">IN</div>';
                        }
                        else {
                            kategori_eng = '<div class="btn btn-outline-danger" style="width:75px;">OUT</div>';
                        }
                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+date_record+'</td>';
                            trList += '<td style="color:white;">'+time_record+'</td>';
                            trList += '<td style="color:white;">'+kategori_eng+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_face tbody').append(trList);
                    $('#list_face').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_face_search(){
    var cNIK = 0;
    var date_record = $('#date_record').val();

    $('#list_face').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-face/'+key_session+'/'+cNIK+'/'+date_record,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_face tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_face').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var date_record = responseList.date_record;
                        var time_record = responseList.time_record;
                        var kategori = responseList.kategori;
                        var kategori_eng = '';
                        if (kategori=='Masuk') {
                            kategori_eng = '<div class="btn btn-outline-success" style="width:75px;">IN</div>';
                        }
                        else {
                            kategori_eng = '<div class="btn btn-outline-danger" style="width:75px;">OUT</div>';
                        }
                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+date_record+'</td>';
                            trList += '<td style="color:white;">'+time_record+'</td>';
                            trList += '<td style="color:white;">'+kategori_eng+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_face tbody').append(trList);
                    $('#list_face').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}