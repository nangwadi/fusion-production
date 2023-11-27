$(document).ready(function(){
    list_finger(0, 0);
})

function list_finger(cNIK, tgl){
    $('#list_finger').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-finger/'+key_session+'/'+cNIK+'/'+tgl,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_finger tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_finger').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var tgl = responseList.tgl;
                        var jam = responseList.jam;
                        var nTNAEvent = responseList.nTNAEvent;
                        var nTNAEvent_eng = '';
                        if (nTNAEvent=='0') {
                            nTNAEvent_eng = '<div class="btn btn-outline-success" style="width:75px;">IN</div>';
                        }
                        else if (nTNAEvent=='1') {
                            nTNAEvent_eng = '<div class="btn btn-outline-warning" style="width:75px;">OUT</div>';
                        }
                        else {
                            nTNAEvent_eng = '<div class="btn btn-outline-danger" style="width:75px;">OTHER</div>';
                        }
                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+tgl+'</td>';
                            trList += '<td style="color:white;">'+jam+'</td>';
                            trList += '<td style="color:white;">'+nTNAEvent_eng+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_finger tbody').append(trList);
                    $('#list_finger').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_finger_search(){
    var cNIK = 0;
    var tgl = $('#tgl').val();

    $('#list_finger').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-finger/'+key_session+'/'+cNIK+'/'+tgl,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            $('#list_finger tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_finger').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var tgl = responseList.tgl;
                        var jam = responseList.jam;
                        var nTNAEvent = responseList.nTNAEvent;
                        var nTNAEvent_eng = '';
                        if (nTNAEvent=='0') {
                            nTNAEvent_eng = '<div class="btn btn-outline-success" style="width:75px;">IN</div>';
                        }
                        else if (nTNAEvent=='1') {
                            nTNAEvent_eng = '<div class="btn btn-outline-warning" style="width:75px;">OUT</div>';
                        }
                        else {
                            nTNAEvent_eng = '<div class="btn btn-outline-danger" style="width:75px;">OTHER</div>';
                        }
                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+tgl+'</td>';
                            trList += '<td style="color:white;">'+jam+'</td>';
                            trList += '<td style="color:white;">'+nTNAEvent_eng+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_finger tbody').append(trList);
                    $('#list_finger').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}