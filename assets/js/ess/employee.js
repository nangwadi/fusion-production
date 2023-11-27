$(document).ready(function(){
    if (status=='active') {
        list_employee_active(1, 0);
    }
    else {
        list_employee_resign(0, 0);
    }

    $("#button_photo_personal_data").click(function(){
        photo_personal_data('photo_personal_data', '1');
    })

    $("#button_photo_education").click(function(){
        photo_personal_data('photo_education', '8');
    })

    $("#button_photo_personal_ktp").click(function(){
        photo_personal_data('photo_personal_ktp', '2');
    })

    $("#button_photo_personal_npwp").click(function(){
        photo_personal_data('photo_personal_npwp', '3');
    })

    $("#button_photo_personal_bpjs").click(function(){
        photo_personal_data('photo_personal_bpjs', '6');
    })

    $("#button_photo_personal_jst").click(function(){
        photo_personal_data('photo_personal_jst', '7');
    })

    $("#button_photo_personal_family").click(function(){
        photo_personal_data('photo_personal_family', '4');
    })

    $("#button_photo_bank_account").click(function(){
        photo_personal_data('photo_bank_account', '5');
    })

    $("#button_photo_covid19_1").click(function(){
        photo_personal_data('photo_covid19_1', '9');
    })

    $("#button_photo_covid19_2").click(function(){
        photo_personal_data('photo_covid19_2', '10');
    })

    $("#button_photo_covid19_3").click(function(){
        photo_personal_data('photo_covid19_3', '11');
    })
})

function list_employee_active(status_get, cNIK_get){
    $('#list_employee').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_employee tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_employee').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cNmDept = responseList.cNmDept;
                        var cNmBag = responseList.cNmBag;
                        var cNmJbtn = responseList.cNmJbtn;
                        var cGroupNm = responseList.cGroupNm;

                        var action = '<button class="btn btn-success" onclick="detail_employee(\''+status+'\', \''+cNIK+'\');"><i class="mdi mdi-lead-pencil"></i>&nbsp;&nbsp;Detail</button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+cNmBag+'</td>';
                            trList += '<td style="color:white;">'+cNmJbtn+'</td>';
                            trList += '<td style="color:white;">'+cGroupNm+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>';
                    });
                    $('#list_employee tbody').append(trList);
                    $('#list_employee').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function list_employee_resign(status_get, cNIK){
    $('#list_employee').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_employee tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_employee').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var dTglResign = responseList.dTglResign;
                        var cIDJnsBerhenti = responseList.cIDJnsBerhenti;
                        var cNmJnsBerhenti = responseList.cNmJnsBerhenti;
                        var cAlasan = responseList.cAlasan;
                        var cNote = responseList.cNote;
                        var dTglPengajuan = responseList.dTglPengajuan;

                        var action = '<button class="btn btn-success" onclick="update_resign(\''+cNIK+'\', \''+cNmPegawai+'\', \''+cIDJnsBerhenti+'\', \''+cNmJnsBerhenti+'\', \''+dTglPengajuan+'\', \''+cNote+'\');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        action += '<button class="btn btn-danger" onclick="delete_resign(\''+cNIK+'\', \''+cNmPegawai+'\');"><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNIK+'</td>';
                            trList += '<td style="color:white;">'+cNmPegawai+'</td>';
                            trList += '<td style="color:white;">'+dTglResign+'</td>';
                            trList += '<td style="color:white;">'+cNmJnsBerhenti+'</td>';
                            trList += '<td style="color:white;">'+cAlasan+'</td>';
                            //trList += '<td style="color:white;">'+cNote+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>';
                    });
                    $('#list_employee tbody').append(trList);
                    $('#list_employee').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    });
                }
            })
        }
    });
}

function add_employee(category){
    //console.log(category);
    if (category=='active') {
        document.getElementById('add_employee').removeAttribute('style');
        document.getElementById('add_employee').setAttribute('style', 'display:block');
        document.getElementById('photo_personal_data').removeAttribute('src');
        document.getElementById('photo_personal_data').setAttribute('src', base_url+'assets/images/photo/default/default.png');

        $('#new_employee').val('');
        $('#new_employee').val('1');

        // Tab Personal Data
        $('#cNIK').val('');
        $('#cNmPegawai').val('');
        $('#cNmPanggilan').val('');
        $('#cTempatLahir').val('');
        $('#dTglLhr').val('');
        $('#cAlamat').val('');
        $('#cKota').val('');
        $('#cKdPos').val('');
        $('#cTelp1').val('');
        $('#cTelp2').val('');
    }
    else {
        document.getElementById('add_employee_resign').removeAttribute('style');
        document.getElementById('add_employee_resign').setAttribute('style', 'display:block');

        list_employee_active_to_resign('1', '0', '');
        list_reasons_for_resigning('', '');
    }
}

// Active

function select_button(button_name){
    var last_button = $('#last_button').val();
    var last_tab_name = last_button+'_tab';

    document.getElementById(last_button).removeAttribute('class');
    document.getElementById(last_tab_name).removeAttribute('style');

    document.getElementById(last_button).setAttribute('class', 'nav-link');
    document.getElementById(button_name).setAttribute('class', 'btn btn-primary');

    document.getElementById(last_tab_name).setAttribute('style', 'display:none');
    document.getElementById(button_name+'_tab').setAttribute('style', 'display:block');

    $('#last_button').val('');
    $('#last_button').val(button_name);

    var cNIK = $('#cNIK').val();

    if (button_name=='education') {
        education('1', cNIK);
    }
    else if (button_name=='personal_data') {
        detail_employee('1', cNIK);
    }
    else if (button_name=='account') {
        account('1', cNIK);
    }
    else if (button_name=='potition') {
        list_department(0, '');
        list_potition_header(0)
        list_employee_status(0);
        list_potition('1', cNIK);
    }
    else if (button_name=='join_date') {
        join_date(1, cNIK);
    }
    else if (button_name=='plant') {
        plant(1, cNIK);
    }
    else if (button_name=='id_card') {
        id_card(1, cNIK);
    }
    else if (button_name=='tax_card') {
        tax_card(1, cNIK);
    }
    else if (button_name=='bpjs') {
        bpjs(1, cNIK);
    }
    else if (button_name=='family') {
        family(1, cNIK);
    }
    else if (button_name=='tax') {
        tax(1, cNIK);
    }
    else if (button_name=='insurance') {
        insurance(1, cNIK);
    }
    else if (button_name=='bank_account') {
        bank_account(1, cNIK);
    }
    else if (button_name=='salary') {
        salary(1, cNIK);
    }
    else if (button_name=='covid19') {
        covid19(1, cNIK);
    }
}

function close_button(button_name){
    var last_button = $('#last_button').val();
    var last_tab_name = last_button+'_tab';

    $('#last_button').val('');
    $('#last_button').val(button_name);

    document.getElementById('add_employee').removeAttribute('style');
    document.getElementById('add_employee').setAttribute('style', 'display:none');
}

function detail_employee(status_get, cNIK_get){
    document.getElementById('add_employee').removeAttribute('style');
    document.getElementById('photo_personal_data').removeAttribute('src');

    document.getElementById('add_employee').setAttribute('style', 'display:block');
    
    $('#new_employee').val('');
    $('#new_employee').val('0');

    $('#cNIK').val('');
    $('#cNmPegawai').val('');
    $('#cNmPanggilan').val('');
    $('#cTempatLahir').val('');
    $('#dTglLhr').val('');
    $('#cAlamat').val('');
    $('#cKota').val('');
    $('#cKdPos').val('');
    $('#cTelp1').val('');
    $('#cTelp2').val('');
    $.ajax({
        url: base_url+'ess/personal-data/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var company_id = responseList.company_id;
                    var cNIK = responseList.cNIK;
                    var cNmPegawai = responseList.cNmPegawai;
                    var cNmPanggilan = responseList.cNmPanggilan;
                    var cTempatLahir = responseList.cTempatLahir;
                    var dTglLhr = responseList.dTglLhr;
                    var cAlamat = responseList.cAlamat;
                    var cKota = responseList.cKota;
                    var cKdPos = responseList.cKdPos;
                    var cTelp1 = responseList.cTelp1;
                    var cTelp2 = responseList.cTelp2;
                    var photo = responseList.photo;

                    $('#cNIK').val(cNIK);
                    $('#cNmPegawai').val(cNmPegawai);
                    $('#cNmPanggilan').val(cNmPanggilan);
                    $('#cTempatLahir').val(cTempatLahir);
                    $('#dTglLhr').val(dTglLhr);
                    $('#cAlamat').val(cAlamat);
                    $('#cKota').val(cKota);
                    $('#cKdPos').val(cKdPos);
                    $('#cTelp1').val(cTelp1);
                    $('#cTelp2').val(cTelp2);

                    document.getElementById('photo_personal_data').setAttribute('src', base_url+'assets/images/photo/'+photo);
                })                 
            })
        }
    });
}

function education(status_get, cNIK_get){
    document.getElementById('photo_education').removeAttribute('src');
    $.ajax({
        url: base_url+'ess/education/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    list_education('', '');
                    list_year('education', '');
                    document.getElementById('photo_education').setAttribute('src', base_url+'assets/images/photo/default/default.png');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cNmPanggilan = responseList.cNmPanggilan;
                        var id_pendidikan = responseList.id_pendidikan;
                        var nama_pendidikan = responseList.nama_pendidikan;
                        var bidang_study = responseList.bidang_study;
                        var keterangan = responseList.keterangan;
                        var tahun_lulus = responseList.tahun_lulus;
                        var photo = responseList.photo;

                        $('#bidang_study').val(bidang_study);
                        $('#keterangan').val(keterangan);
                        $('#tahun_lulus').val(tahun_lulus);

                        list_education(id_pendidikan, nama_pendidikan);
                        list_year('education', tahun_lulus);

                        document.getElementById('photo_education').setAttribute('src', base_url+'assets/images/photo/'+photo);
                    })
                }            
            })
        }
    });
}

function list_education(id_pendidikan_get, nama_pendidikan_get){

    $.ajax({
        url: base_url+'ess/list-education/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_education tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;

                    var trList = '';
                    if (id_pendidikan_get!='') {
                        trList += '<option value="'+id_pendidikan_get+'">'+nama_pendidikan_get+'</option>';
                    }
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_pendidikan = responseList.id_pendidikan;
                        var nama_pendidikan = responseList.nama_pendidikan;
                        var deleted = responseList.deleted;

                        if (deleted=='0') {
                            trList += '<option value="'+id_pendidikan+'">'+nama_pendidikan+'</option>';
                        }

                    });
                    $('#id_pendidikan').append(trList);
                
            })
        }
    });
}

function list_year (category, year_get){
    var trList='';
    if (year_get!='') {
        trList += '<option value="'+year_get+'">'+year_get+'</option>';
    }
    for (var i = tahun_lulus_awal; i <= tahun_lulus_akhir; i++) {
        trList += '<option value="'+i+'">'+i+'</option>';
    }

    if (category=='education') {
        $('#tahun_lulus').html('');
        $('#tahun_lulus').append(trList);
    }
}

function account(status_get, cNIK_get){
    //$('#cNIK_account').val('');
    $('#cNoAbsen').val('');
    $('#email').val('');
    $('#Pwd').val('');
    $('#cNoAbsen_old').val('');
    $('#email_old').val('');
    $('#Pwd_old').val('');

    $.ajax({
        url: base_url+'ess/account/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var company_id = responseList.company_id;
                    var cNIK_account = responseList.cNIK;
                    var cNoAbsen = responseList.cNoAbsen;
                    var email = responseList.email;
                    var Pwd = responseList.Pwd;

                    //$('#cNIK_account').val(cNIK_account);
                    $('#cNoAbsen').val(cNoAbsen);
                    $('#email').val(email);
                    $('#Pwd').val(Pwd);
                    $('#cNoAbsen_old').val(cNoAbsen);
                    $('#email_old').val(email);
                    $('#Pwd_old').val(Pwd);

                })                 
            })
        }
    });
}

function list_potition(status_get, cNIK_get){
    $('#list_potition').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/potition/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            $('#list_potition tbody').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#list_potition').dataTable();
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDJbtn = responseList.cIDJbtn;
                        var cNmJbtn = responseList.cNmJbtn;
                        var cIDStsKrj = responseList.cIDStsKrj;
                        var cNmStsKrj = responseList.cNmStsKrj;
                        var cNoSK = responseList.cNoSK;
                        var dTglSK = responseList.dTglSK;
                        var lPromosi = responseList.lPromosi;
                        var cNote = responseList.cNote;
                        var dBerlaku_Dari = responseList.dBerlaku_Dari;
                        var dBerlaku_Sdgn = responseList.dBerlaku_Sdgn;

                        var action = '<button class="btn btn-success" onclick="update_potition(\''+cIDDept+'\', \''+cNmDept+'\', \''+cIDBag+'\', \''+cNmBag+'\', \''+cIDJbtn+'\', \''+cNmJbtn+'\', \''+cIDStsKrj+'\', \''+cNmStsKrj+'\', \''+dBerlaku_Dari+'\');"><i class="mdi mdi-lead-pencil"></i></button>';

                        trList += '<tr>';
                            trList += '<td align="center" style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmDept+'</td>';
                            trList += '<td style="color:white;">'+cNmBag+'</td>';
                            trList += '<td style="color:white;">'+cNmJbtn+'</td>';
                            trList += '<td style="color:white;">'+cNmStsKrj+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_Dari+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_Sdgn+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>';
                    });
                    $('#list_potition tbody').append(trList);
                    $('#list_potition').dataTable();
                }               
            })
        }
    });
}

function list_department(cIDDept_get, cNmDept_get){
    $('#cIDDept').html('');
    $.ajax({
        url: base_url+'ess/list-department/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDDept_get!='0') {
                trList += '<option value="'+cIDDept_get+'">'+cNmDept_get+'</option>';
            }

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDDept+'">'+cNmDept+'</option>';
                        }
                    })
                }
            })
            $('#cIDDept').append(trList);
        }
    });
}

function getDivision(cIDBag_get, cNmBag_get){
    var cIDDept = $('#cIDDept').val();
    $('#cIDBag').html('');

    $.ajax({
        url: base_url+'ess/list-division-by-department/'+key_session+'/'+cIDDept,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDBag_get!='') {
                trList += '<option value="'+cIDBag_get+'">'+cNmBag_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDDept = responseList.cIDDept;
                        var cNmDept = responseList.cNmDept;
                        var cIDBag = responseList.cIDBag;
                        var cNmBag = responseList.cNmBag;
                        var deleted = responseList.deleted;

                        trList += '<option value="'+cIDBag+'">'+cNmBag+'</option>';

                    })
                }
            })
            $('#cIDBag').append(trList);
        }
    });
}

function list_potition_header(cIDJbtn){
    $('#cIDJbtn').html('');
    $.ajax({
        url: base_url+'ess/list-potition/'+key_session+'/'+cIDJbtn,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDJbtn = responseList.cIDJbtn;
                        var cNmJbtn = responseList.cNmJbtn;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDJbtn+'">'+cNmJbtn+'</option>';
                        }

                    })
                    $('#cIDJbtn').append(trList);
                }
            })
            
        }
    });
}

function list_employee_status(cIDStsKrj_get, cNmStsKrj_get){
    $('#cIDStsKrj').html('');
    $.ajax({
        url: base_url+'ess/list-employee-status/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found</option>';
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDStsKrj = responseList.cIDStsKrj;
                        var cNmStsKrj = responseList.cNmStsKrj;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDStsKrj+'">'+cNmStsKrj+'</option>';
                        }
                    })
                    $('#cIDStsKrj').append(trList);
                }
            })
        }
    });
}

function join_date(status_get, cNIK_get){
    $('#dTglGabung').val('');
    $('#dTglGabung2').val('');

    $.ajax({
        url: base_url+'ess/personal-data/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#dTglGabung').val('');
                    $('#dTglGabung2').val('');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var dTglGabung = responseList.dTglGabung;
                        var dTglGabung2 = responseList.dTglGabung2;

                        $('#dTglGabung').val(dTglGabung);
                        $('#dTglGabung2').val(dTglGabung2);
                    })
                }                 
            })
        }
    });
}

function plant(status_get, cNIK_get){
    $.ajax({
        url: base_url+'ess/plant/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    list_plant('', '');
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var plant = responseList.plant;
                        var plant_name = responseList.plant_name;
                        list_plant(plant, plant_name);
                    })
                }
            })
            
        }
    });
}

function list_plant(id_plant_get, plant_get){
    $('#plant_select').html('');
    var trList = '';
    trList += '<option value="'+id_plant_get+'">'+plant_get+'</option>';
    $.ajax({
        url: base_url+'ess/list-plant/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data not found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_plant = responseList.id_plant;
                        var plant = responseList.plant;
                        var note = responseList.note;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            if (id_plant!=id_plant_get) {
                                trList += '<option value="'+id_plant+'">'+plant+'</option>';
                            }
                        }
                    })
                }
            })
            $('#plant_select').append(trList);
        }
    });
}

function id_card(status_get, cNIK_get){
    document.getElementById('photo_personal_ktp').removeAttribute('src');
    $('#cNoKTP').val('');
    $('#cAlamatKTP').val('');
    $('#cKotaKTP').val('');
    $.ajax({
        url: base_url+'ess/id-card/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var company_id = responseList.company_id;
                    var cNoKTP = responseList.cNoKTP;
                    var cAlamatKTP = responseList.cAlamatKTP;
                    var cKotaKTP = responseList.cKotaKTP;
                    var photo = responseList.photo;

                    $('#cNoKTP').val(cNoKTP);
                    $('#cAlamatKTP').val(cAlamatKTP);
                    $('#cKotaKTP').val(cKotaKTP);

                    document.getElementById('photo_personal_ktp').setAttribute('src', base_url+'assets/images/photo/'+photo);
                })                 
            })
        }
    });
}

function tax_card(status_get, cNIK_get){
    document.getElementById('photo_personal_npwp').removeAttribute('src');
    $('#cNPWP').val('');
    $('#cAlamatNPWP').val('');
    $('#cKotaNPWP').val('');
    $.ajax({
        url: base_url+'ess/tax-card/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var company_id = responseList.company_id;
                    var cNPWP = responseList.cNPWP;
                    var cAlamatNPWP = responseList.cAlamatNPWP;
                    var cKotaNPWP = responseList.cKotaNPWP;
                    var photo = responseList.photo;

                    $('#cNPWP').val(cNPWP);
                    $('#cAlamatNPWP').val(cAlamatNPWP);
                    $('#cKotaNPWP').val(cKotaNPWP);

                    document.getElementById('photo_personal_npwp').setAttribute('src', base_url+'assets/images/photo/'+photo);
                })                 
            })
        }
    });
}

function bpjs(status_get, cNIK_get){
    document.getElementById('photo_personal_bpjs').removeAttribute('src');
    document.getElementById('photo_personal_jst').removeAttribute('src');
    $('#cNoBPJS').val('');
    $('#dTglBPJS').val('');
    $('#cNoJST').val('');
    $('#dTglJST').val('');
    $.ajax({
        url: base_url+'ess/bpjs/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var company_id = responseList.company_id;
                    var cNoBPJS = responseList.cNoBPJS;
                    var dTglBPJS = responseList.dTglBPJS;
                    var cNoJST = responseList.cNoJST;
                    var dTglJST = responseList.dTglJST;
                    var kategori = responseList.kategori;
                    var photo = responseList.photo;

                    $('#cNoBPJS').val(cNoBPJS);
                    $('#dTglBPJS').val(dTglBPJS);

                    $('#cNoJST').val(cNoJST);
                    $('#dTglJST').val(dTglJST);

                    if (kategori==6) {
                        document.getElementById('photo_personal_bpjs').setAttribute('src', base_url+'assets/images/photo/'+photo);
                    }
                    else if (kategori==7) {
                        document.getElementById('photo_personal_jst').setAttribute('src', base_url+'assets/images/photo/'+photo);
                    }
                })                 
            })
        }
    });
}

function family(status_get, cNIK_get){
    document.getElementById('photo_personal_family').removeAttribute('src');
    getSex('', '');
    getFamilyStatus('', '');
    getReligion('', '');
    getBloodGroup('', '');
    getMerried('', '');

    $.ajax({
        url: base_url+'ess/family/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_family tbody').html('');
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="6" align="center">Data Not Found.</td>';
                    trList += '</tr>';
                }
                else {
                    var photo = responseGetList.photo;
                    document.getElementById('photo_personal_family').setAttribute('src', base_url+'assets/images/photo/'+photo);

                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var cNIK = responseList.cNIK;
                        var cNama = responseList.cNama;
                        var dTglLhr = responseList.dTglLhr;
                        var cTempat_Lhr = responseList.cTempat_Lhr;
                        var cJnsKel = responseList.cJnsKel;
                        var cIDHubKel = responseList.cIDHubKel;
                        var cNmHubKel = responseList.cNmHubKel;
                        var cIDAgama = responseList.cIDAgama;
                        var cNmAgama = responseList.cNmAgama;
                        var cGolDrh = responseList.cGolDrh;
                        var nama_golongan_darah = responseList.nama_golongan_darah;
                        var lNikah = responseList.lNikah;
                        var dTglNikah = responseList.dTglNikah;
                        var cPekerjaan = responseList.cPekerjaan;
                        var cAlamat = responseList.cAlamat;
                        var cTelp = responseList.cTelp;
                        var cNote = responseList.cNote;

                        var button = '<button class="btn btn-success" onclick="update_family(\''+cNama+'\', \''+dTglLhr+'\', \''+cTempat_Lhr+'\', \''+cJnsKel+'\', \''+cIDHubKel+'\', \''+cNmHubKel+'\', \''+cIDAgama+'\', \''+cNmAgama+'\', \''+cGolDrh+'\', \''+nama_golongan_darah+'\', \''+lNikah+'\', \''+dTglNikah+'\');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                        button += '<button class="btn btn-danger" onclick="delete_family(\''+cNama+'\', \''+dTglLhr+'\', \''+cTempat_Lhr+'\', \''+cJnsKel+'\', \''+cIDHubKel+'\');"><i class="mdi mdi-delete"></i></button>';

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNama+'</td>';
                            trList += '<td style="color:white;">'+cTempat_Lhr+'</td>';
                            trList += '<td style="color:white;">'+dTglLhr+'</td>';
                            trList += '<td style="color:white;">'+cNmHubKel+'</td>';
                            trList += '<td style="color:white;">'+button+'</td>';
                        trList += '</tr>';
                    })

                } 
                $('#list_family tbody').append(trList);               
            })
        }
    });
}

function getSex(id_sex, note_sex){
    $('#cJnsKel_select').html('');
    var trList = '';
    if (id_sex=='') {
        trList += '<option value="1">Male</option>';
        trList += '<option value="2">Female</option>';
    }
    else if (id_sex==1) {
        trList += '<option value="1">Male</option>';
        trList += '<option value="2">Female</option>';
    }
    else if (id_sex==2) {
        trList += '<option value="2">Female</option>';
        trList += '<option value="1">Male</option>';
    }
    $('#cJnsKel_select').append(trList);
}

function getFamilyStatus(cIDHubKel_get, cNmHubKel_get){
    $('#cIDHubKel_select').html('');
    $.ajax({
        url: base_url+'ess/list-family-relation/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDHubKel_get!='') {
                trList += '<option value="'+cIDHubKel_get+'">'+cNmHubKel_get+'</option>';
            }

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDHubKel = responseList.cIDHubKel;
                        var cNmHubKel = responseList.cNmHubKel;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            if (cIDHubKel!=0) {
                                trList += '<option value="'+cIDHubKel+'">'+cNmHubKel+'</option>';
                            }
                        }
                    })
                }
            })
            $('#cIDHubKel_select').append(trList);
        }
    });
}

function getReligion(cIDAgama_get, cNmAgama_get){
    $('#cIDAgama_select').html('');
    $.ajax({
        url: base_url+'ess/list-religion/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDAgama_get!='') {
                trList += '<option value="'+cIDAgama_get+'">'+cNmAgama_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDAgama = responseList.cIDAgama;
                        var cNmAgama = responseList.cNmAgama;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDAgama+'">'+cNmAgama+'</option>';
                        }
                    })
                }
            })
            $('#cIDAgama_select').append(trList);
        }
    });
}

function getBloodGroup(id_golongan_darah_get, nama_golongan_darah_get){
    $('#cGolDrh_select').html('');
    $.ajax({
        url: base_url+'ess/list-blood-group/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            
            responseGet.map(function(responseGetList){
                var trList = '';
                if (id_golongan_darah_get!='') {
                    trList += '<option value="'+id_golongan_darah_get+'">'+nama_golongan_darah_get+'</option>';
                }
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var trList = '';
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var id_golongan_darah = responseList.id_golongan_darah;
                        var nama_golongan_darah = responseList.nama_golongan_darah;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+id_golongan_darah+'">'+nama_golongan_darah+'</option>';
                        }
                    })
                }
                $('#cGolDrh_select').append(trList);
            })
        }
    });
}

function getMerried(id_merried, note_merried){
    $('#lNikah_select').html('');
    var trList = '';
    if (id_merried=='') {
        trList += '<option value="0">No</option>';
        trList += '<option value="1">Yes</option>';
    }
    else if (id_merried==1) {
        trList += '<option value="1">Yes</option>';
        trList += '<option value="0">No</option>';
    }
    else if (id_merried==0) {
        trList += '<option value="0">No</option>';
        trList += '<option value="1">Yes</option>';
    }
    $('#lNikah_select').append(trList);
}

function getMerriedDate(){
    var lNikah_select = $('#lNikah_select').val();
    if (lNikah_select==0) {
        document.getElementById('dTglNikah').removeAttribute('readonly');
        document.getElementById('dTglNikah').setAttribute('readonly', 'readonly');
    }
    else {
        document.getElementById('dTglNikah').removeAttribute('readonly');
    }
}

function list_family_status_pph21(tax_pph21_get){
    $('#tax_pph21').html('');
    $.ajax({
        url: base_url+'ess/list-family-status/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (tax_pph21_get!='') {
                trList += '<option value="'+tax_pph21_get+'">'+tax_pph21_get+'</option>';   
            }

            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';   
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDSts_Keluarga = responseList.cIDSts_Keluarga;
                        var cNmSts_Keluarga = responseList.cNmSts_Keluarga;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cIDSts_Keluarga+'">'+cIDSts_Keluarga+'</option>';   
                        }
                    })
                    $('#tax_pph21').append(trList);
                }
            })
        }
    });
}

function list_family_status_bpjs(tax_bpjs_get){
    $('#tax_bpjs').html('');
    $.ajax({
        url: base_url+'ess/list-family-status/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (tax_bpjs_get!='') {
                trList += '<option value="'+tax_bpjs_get+'">'+tax_bpjs_get+'</option>';   
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';                    
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDSts_Keluarga = responseList.cIDSts_Keluarga;
                        var cNmSts_Keluarga = responseList.cNmSts_Keluarga;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+cIDSts_Keluarga+'">'+cIDSts_Keluarga+'</option>';   
                        }
                    })
                    $('#tax_bpjs').append(trList);
                }
            })
        }
    });
}

function tax(status_get, cNIK_get){
    list_family_status_pph21('');
    list_family_status_bpjs('');
    getYear('');
    $.ajax({
        url: base_url+'ess/tax/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_tax tbody').html('');
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="5" align="center">Data Not Found.</td>';
                    trList += '</tr>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var cNIK = responseList.cNIK;
                        var tax_bpjs = responseList.tax_bpjs;
                        var cNmSts_Keluarga_bpjs = responseList.cNmSts_Keluarga_bpjs;
                        var tax_pph21 = responseList.tax_pph21;
                        var cNmSts_Keluarga_pph21 = responseList.cNmSts_Keluarga_pph21;
                        var tahun = responseList.tahun;
                        var dBerlaku_Dari = responseList.dBerlaku_Dari;
                        var dBerlaku_Sdgn = responseList.dBerlaku_Sdgn;

                        var button = '';
                        if (dBerlaku_Sdgn == '' || dBerlaku_Sdgn == null) {
                            button += '<button class="btn btn-success" onclick="update_tax(\''+tahun+'\', \''+tax_pph21+'\', \''+tax_bpjs+'\', \''+dBerlaku_Dari+'\');"><i class="mdi mdi-lead-pencil"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+tahun+'</td>';
                            trList += '<td style="color:white;">'+tax_pph21+'</td>';
                            trList += '<td style="color:white;">'+tax_bpjs+'</td>';
                            trList += '<td style="color:white;">'+button+'</td>';
                        trList += '</tr>';
                    })

                } 
                $('#list_tax tbody').append(trList);               
            })
        }
    });
}

function getYear(year_get){
    $('#tahun_tax').html('');
    var trList = '';
    if (year_get!='') {
        trList += '<option value="'+year_get+'">'+year_get+'</option>';
    }
    else {
        for (var i = tahun_ini-3; i <= tahun_ini; i++) {
            trList += '<option value="'+i+'">'+i+'</option>';
        }    
    }
    
    $('#tahun_tax').append(trList);
}

function insurance(status_get, cNIK_get){
    $.ajax({
        url: base_url+'ess/insurance/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_insurance tbody').html('');
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="7" align="center">Data Not Found.</td>';
                    trList += '</tr>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var No_Peserta = responseList.No_Peserta;
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;
                        var Total = responseList.Total;
                        var Per_Bulan = responseList.Per_Bulan;
                        var Total_format = responseList.Total_format;
                        var Per_Bulan_format = responseList.Per_Bulan_format;
                        var Jml_Bln = responseList.Jml_Bln;
                        var status = responseList.status;
                        var dBerlaku_Dari = responseList.dBerlaku_Dari;
                        var dBerlaku_Sdgn = responseList.dBerlaku_Sdgn;

                        var button = '<button class="btn btn-info" onclick="update_family();"><i class="mdi mdi-lead-pencil"></i></button>';
                        button = '<button class="btn btn-info" onclick="update_family();"><i class="mdi mdi-lead-pencil"></i></button>';

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+No_Peserta+'</td>';
                            trList += '<td style="color:white;">'+Total_format+'</td>';
                            trList += '<td style="color:white;">'+Per_Bulan_format+'</td>';
                            trList += '<td style="color:white;">'+Jml_Bln+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_Dari+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_Sdgn+'</td>';
                        trList += '</tr>';
                    })

                } 
                $('#list_insurance tbody').append(trList);               
            })
        }
    });
}

function bank_account(status_get, cNIK_get){
    document.getElementById('photo_bank_account').removeAttribute('src');
    getBank('', '');
    $.ajax({
        url: base_url+'ess/bank-account/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_bank_account tbody').html('');
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="7" align="center">Data Not Found.</td>';
                    trList += '</tr>';

                    document.getElementById('photo_bank_account').setAttribute('src', base_url+'assets/images/photo/default/default.png');
                }
                else {
                    var photo = responseGetList.photo;
                    document.getElementById('photo_bank_account').setAttribute('src', base_url+'assets/images/photo/'+photo);

                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var No_Peserta = responseList.No_Peserta;
                        var cNIK = responseList.cNIK;
                        var cIDBank = responseList.cIDBank;
                        var cNmBank = responseList.cNmBank;
                        var cNoAccount = responseList.cNoAccount;
                        var cAlmBank = responseList.cAlmBank;
                        var cNmPemilik = responseList.cNmPemilik;
                        var dCity = responseList.dCity;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-success" onclick="update_bank(\''+cIDBank+'\', \''+cNmBank+'\', \''+cNmPemilik+'\', \''+cNoAccount+'\', \''+cAlmBank+'\', \''+dCity+'\');" title="Update Company - '+cNmBank+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable_bank(\''+cIDBank+'\', \''+cNmBank+'\', \''+cNmPemilik+'\', \''+cNoAccount+'\', \''+cAlmBank+'\', \''+dCity+'\', \''+1+'\');" title="Disable Company - '+cNmBank+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable_bank(\''+cIDBank+'\', \''+cNmBank+'\', \''+cNmPemilik+'\', \''+cNoAccount+'\', \''+cAlmBank+'\', \''+dCity+'\', \''+0+'\');" title="Enable Company - '+cNmBank+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmBank+'</td>';
                            trList += '<td style="color:white;">'+cNmPemilik+'</td>';
                            trList += '<td style="color:white;">'+cNoAccount+'</td>';
                            trList += '<td style="color:white;">'+cAlmBank+'</td>';
                            trList += '<td style="color:white;">'+dCity+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>';
                    })
                } 
                $('#list_bank_account tbody').append(trList);               
            })
        }
    });
}

function getBank(cIDBank_get, cNmBank_get){
    $('#cIDBank').html('');
    $.ajax({
        url: base_url+'ess/list-bank/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDBank_get!='') {
                trList += '<option value="'+cIDBank_get+'">'+cNmBank_get+'</option>';
                $('#cIDBank').append(trList);
            }
            else {
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<option value="">Data Not Found.</option>';
                    }
                    else {

                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var company_id = responseList.company_id;
                            var company_name = responseList.company_name;
                            var cIDBank = responseList.cIDBank;
                            var cNmBank = responseList.cNmBank;
                            var cSandiBank = responseList.cSandiBank;
                            var deleted = responseList.deleted;

                            if (deleted==0) {
                                trList += '<option value="'+cIDBank+'">'+cNmBank+'</option>';
                            }
                        })
                        $('#cIDBank').append(trList);
                    }
                })
            }
        }
    });
}

function salary(status_get, cNIK_get){
    $('#nNilai').val('');
    $('#dBerlaku_Dari_salary').val('');
    getComponentSalary('', '');
    $('#list_salary').dataTable().fnDestroy();
    $.ajax({
        url: base_url+'ess/component-salary/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_salary tbody').html('');
                if (status==0) {
                    $('#list_salary').dataTable();
                }
                else {
                    var photo = responseGetList.photo;
                    document.getElementById('photo_bank_account').setAttribute('src', base_url+'assets/images/photo/'+photo);

                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var No_Peserta = responseList.No_Peserta;
                        var cNIK = responseList.cNIK;
                        var cIDKomponen = responseList.cIDKomponen;
                        var cNmKomponen = responseList.cNmKomponen;
                        var kategori_descr = responseList.kategori_descr;
                        var nNilai = responseList.nNilai;
                        var nNilai_format = responseList.nNilai_format;
                        var dBerlaku_dari = responseList.dBerlaku_dari;
                        var dBerlaku_Sdgn = responseList.dBerlaku_Sdgn;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            action += '<button class="btn btn-success" onclick="update_salary(\''+cIDKomponen+'\', \''+cNmKomponen+'\', \''+nNilai+'\', \''+dBerlaku_dari+'\');" title="Update Company - '+cNmKomponen+'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;';
                            action += '<button class="btn btn-danger" onclick="disable_enable_salary(\''+cIDKomponen+'\', \''+cNmKomponen+'\', \''+nNilai+'\', \''+dBerlaku_dari+'\', \''+1+'\');" title="Disable Company - '+cNmKomponen+'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                            action = '<button class="btn btn-warning" onclick="disable_enable_salary(\''+cIDKomponen+'\', \''+cNmKomponen+'\', \''+nNilai+'\', \''+dBerlaku_dari+'\', \''+0+'\');" title="Enable Company - '+cNmKomponen+'."><i class="mdi mdi-backup-restore"></i></button>';
                        }

                        trList += '<tr>';
                            trList += '<td style="color:white;">'+(i+1)+'</td>';
                            trList += '<td style="color:white;">'+cNmKomponen+'</td>';
                            trList += '<td style="color:white;">'+nNilai_format+'</td>';
                            trList += '<td style="color:white;">'+kategori_descr+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_dari+'</td>';
                            trList += '<td style="color:white;">'+dBerlaku_Sdgn+'</td>';
                            trList += '<td style="color:white;">'+action+'</td>';
                        trList += '</tr>';
                    })
                    $('#list_salary tbody').append(trList);   
                    $('#list_salary').dataTable({
                        "paging" : false,
                        "scrollY" : '500px',
                        "scrollCollapse" : true,
                    }); 
                }           
            })
        }
    });
}

function getComponentSalary(cIDKomponen_get, cNmKomponen_get){
    $('#cIDKomponen').html('');
    $.ajax({
        url: base_url+'ess/list-salary-component/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            var trList = '';
            if (cIDKomponen_get!='') {
                trList += '<option value="'+cIDKomponen_get+'">'+cNmKomponen_get+'</option>';
                $('#cIDKomponen').append(trList);
            }
            else {
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==0) {
                        trList += '<option value="">Data Not Found.</option>';
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
                            var deleted = responseList.deleted;

                            if (deleted==0) {
                                trList += '<option value="'+cIDKomponen+'">'+cNmKomponen+'</option>';
                            }
                        })
                        $('#cIDKomponen').append(trList);
                    }
                })
            }
            
        }
    });
}

function covid19(status_get, cNIK_get){
    document.getElementById('photo_covid19_1').removeAttribute('src');
    document.getElementById('photo_covid19_2').removeAttribute('src');
    document.getElementById('photo_covid19_3').removeAttribute('src');

    $.ajax({
        url: base_url+'ess/covid19/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                $('#list_salary tbody').html('');
                if (status==0) {
                    trList += '<tr>';
                        trList += '<td colspan="7" align="center">Data Not Found.</td>';
                    trList += '</tr>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var No_Peserta = responseList.No_Peserta;
                        var cNIK = responseList.cNIK;
                        var kategori = responseList.kategori;
                        var photo = responseList.photo;
                        if (kategori==9) {
                            document.getElementById('photo_covid19_1').setAttribute('src', base_url+'assets/images/photo/'+photo);
                        }
                        else if (kategori==10) {
                            document.getElementById('photo_covid19_2').setAttribute('src', base_url+'assets/images/photo/'+photo);
                        }
                        else if (kategori==11) {
                            document.getElementById('photo_covid19_3').setAttribute('src', base_url+'assets/images/photo/'+photo);
                        }
                    })
                }           
            })
        }
    });
}

// SAVE

function save_personal_data(){
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    var new_employee = $('#new_employee').val();

    var cNIK = $('#cNIK').val();
    var cNmPegawai = $('#cNmPegawai').val();
    var cNmPanggilan = $('#cNmPanggilan').val();
    var cTempatLahir = $('#cTempatLahir').val();
    var dTglLhr = $('#dTglLhr').val();
    var cAlamat = $('#cAlamat').val();
    var cKota = $('#cKota').val();
    var cKdPos = $('#cKdPos').val();
    var cTelp1 = $('#cTelp1').val();
    var cTelp2 = $('#cTelp2').val();

    $.ajax({
        url: base_url+'ess/add-personal-data/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNmPegawai='+cNmPegawai+'&cNmPanggilan='+cNmPanggilan+'&cTempatLahir='+cTempatLahir+'&dTglLhr='+dTglLhr+'&cAlamat='+cAlamat+'&cKota='+cKota+'&cKdPos='+cKdPos+'&cTelp1='+cTelp1+'&cTelp2='+cTelp2,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        if (new_employee==1) {
                            location.reload();
                        }
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_education(){
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    var cNIK = $('#cNIK').val();
    var id_pendidikan = $('#id_pendidikan').val();
    var keterangan = $('#keterangan').val();
    var bidang_study = $('#bidang_study').val();
    var tahun_lulus = $('#tahun_lulus').val();

    //alert (cNIK+', '+id_pendidikan+', '+keterangan+', '+bidang_study+', '+tahun_lulus);

    $.ajax({
        url: base_url+'ess/add-personal-education/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&id_pendidikan='+id_pendidikan+'&keterangan='+keterangan+'&bidang_study='+bidang_study+'&tahun_lulus='+tahun_lulus,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_account(){
    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    var cNIK = $('#cNIK').val();
    var cNoAbsen = $('#cNoAbsen').val();
    var email = $('#email').val();
    var Pwd = $('#Pwd').val();
    var cNoAbsen_old = $('#cNoAbsen_old').val();
    var email_old = $('#email_old').val();
    var Pwd_old = $('#Pwd_old').val();

    //alert (cNIK+', '+cNoAbsen+', '+email+', '+Pwd+', '+tahun_lulus);

    $.ajax({
        url: base_url+'ess/add-personal-account/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNoAbsen='+cNoAbsen+'&email='+email+'&Pwd='+Pwd+'&cNoAbsen_old='+cNoAbsen_old+'&email_old='+email_old+'&Pwd_old='+Pwd_old,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_potition(){
    var cNIK = $('#cNIK').val();
    var update_potition = $('#update_potition').val();
    var cIDDept = $('#cIDDept').val();
    var cIDBag = $('#cIDBag').val();
    var dBerlaku_Dari = $('#dBerlaku_Dari_potition').val();
    var cIDJbtn = $('#cIDJbtn').val();
    var cIDStsKrj = $('#cIDStsKrj').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-potition/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&update_potition='+update_potition+'&cIDDept='+cIDDept+'&cIDBag='+cIDBag+'&dBerlaku_Dari='+dBerlaku_Dari+'&cIDJbtn='+cIDJbtn+'&cIDStsKrj='+cIDStsKrj,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        list_potition('1', cNIK);
                        $('#update_potition').val('');
                        $('#update_potition').val('0');
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_join_date(){
    var cNIK = $('#cNIK').val();
    var dTglGabung = $('#dTglGabung').val();
    var dTglGabung2 = $('#dTglGabung2').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-join-date/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&dTglGabung='+dTglGabung+'&dTglGabung2='+dTglGabung2,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_plant(){
    var cNIK = $('#cNIK').val();
    var plant = $('#plant_select').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-plant/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&plant='+plant,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_id_card(){
    var cNIK = $('#cNIK').val();
    var cNoKTP = $('#cNoKTP').val();
    var cAlamatKTP = $('#cAlamatKTP').val();
    var cKotaKTP = $('#cKotaKTP').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-id-card/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNoKTP='+cNoKTP+'&cAlamatKTP='+cAlamatKTP+'&cKotaKTP='+cKotaKTP,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_tax_card(){
    var cNIK = $('#cNIK').val();
    var cNPWP = $('#cNPWP').val();
    var cAlamatNPWP = $('#cAlamatNPWP').val();
    var cKotaNPWP = $('#cKotaNPWP').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-tax-card/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNPWP='+cNPWP+'&cAlamatNPWP='+cAlamatNPWP+'&cKotaNPWP='+cKotaNPWP,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_bpjs(){
    var cNIK = $('#cNIK').val();
    var cNoBPJS = $('#cNoBPJS').val();
    var dTglBPJS = $('#dTglBPJS').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-bpjs/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNoBPJS='+cNoBPJS+'&dTglBPJS='+dTglBPJS,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_naker(){
    var cNIK = $('#cNIK').val();
    var cNoJST = $('#cNoJST').val();
    var dTglJST = $('#dTglJST').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-naker/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&cNoJST='+cNoJST+'&dTglJST='+dTglJST,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_family(){
    var cNIK = $('#cNIK').val();
    var update_family = $('#update_family').val();
    var cNama = $('#cNama').val();
    var dTglLhr = $('#dTglLhr_family').val();
    var cTempat_Lhr = $('#cTempat_Lhr').val();
    var cJnsKel_select = $('#cJnsKel_select').val();
    var cIDHubKel_select = $('#cIDHubKel_select').val();
    var cIDAgama_select = $('#cIDAgama_select').val();
    var cGolDrh_select = $('#cGolDrh_select').val();
    var lNikah_select = $('#lNikah_select').val();
    var dTglNikah = $('#dTglNikah').val();

    //alert (cNIK+', '+cNama+', '+dTglLhr+', '+cTempat_Lhr+', '+cJnsKel_select+', '+cIDHubKel_select+', '+cIDAgama_select+', '+cGolDrh_select+', '+lNikah_select+', '+dTglNikah);

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-family/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&update_family='+update_family+'&cNama='+cNama+'&dTglLhr='+dTglLhr+'&cTempat_Lhr='+cTempat_Lhr+'&cJnsKel_select='+cJnsKel_select+'&cIDHubKel_select='+cIDHubKel_select+'&cIDAgama_select='+cIDAgama_select+'&cGolDrh_select='+cGolDrh_select+'&lNikah_select='+lNikah_select+'&dTglNikah='+dTglNikah,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        family('1', cNIK);
                        $('#update_family').val('');
                        $('#update_family').val('0');
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_tax(){
    var cNIK = $('#cNIK').val();
    var tax_pph21 = $('#tax_pph21').val();
    var tax_bpjs = $('#tax_bpjs').val();
    var tahun_tax = $('#tahun_tax').val();
    var dBerlaku_Dari_tax = $('#dBerlaku_Dari_tax').val();

    //alert (cNIK+', '+tax_pph21+', '+tax_bpjs+', '+tahun_tax+', '+cJnsKel_select+', '+cIDHubKel_select+', '+cIDAgama_select+', '+cGolDrh_select+', '+lNikah_select+', '+dTglNikah);

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-tax/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&tax_pph21='+tax_pph21+'&tax_bpjs='+tax_bpjs+'&tahun='+tahun_tax+'&dBerlaku_Dari='+dBerlaku_Dari_tax,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        tax('1', cNIK)
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_insurance(){
    var cNIK = $('#cNIK').val();
    var no_pes = $('#no_pes').val();
    var bulan = $('#bulan').val();
    var Jml_Bln = $('#Jml_Bln').val();
    var dBerlaku_Dari_bni = $('#dBerlaku_Dari_bni').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-insurance/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&no_pes='+no_pes+'&bulan='+bulan+'&Jml_Bln='+Jml_Bln+'&dBerlaku_Dari='+dBerlaku_Dari_bni,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        insurance('1', cNIK)
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_bank_account(){
    var cNIK = $('#cNIK').val();
    var update_bank = $('#update_bank').val();
    var cIDBank = $('#cIDBank').val();
    var cNmPemilik = $('#cNmPemilik').val();
    var cNoAccount = $('#cNoAccount').val();
    var cAlmBank = $('#cAlmBank').val();
    var dCity = $('#dCity').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-bank-account/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&update_bank='+update_bank+'&cIDBank='+cIDBank+'&cNmPemilik='+cNmPemilik+'&cNoAccount='+cNoAccount+'&cAlmBank='+cAlmBank+'&dCity='+dCity,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        bank_account('1', cNIK);
                        $('#update_bank').val('');
                        $('#update_bank').val('0');
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function save_salary(){
    var cNIK = $('#cNIK').val();
    var update_salary = $('#update_salary').val();
    var cIDKomponen = $('#cIDKomponen').val();
    var nNilai = $('#nNilai').val();
    var dBerlaku_Dari_salary = $('#dBerlaku_Dari_salary').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-personal-salary/'+key_session,
        type: 'post',
        data: 'cNIK='+cNIK+'&update_salary='+update_salary+'&cIDKomponen='+cIDKomponen+'&nNilai='+nNilai+'&dBerlaku_Dari='+dBerlaku_Dari_salary,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        salary('1', cNIK);
                        $('#update_salary').val('');
                        $('#update_salary').val('0');
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

// UPDATE

function update_potition(cIDDept_get, cNmDept_get, cIDBag_get, cNmBag_get, cIDJbtn_get, cNmJbtn_get, cIDStsKrj_get, cNmStsKrj_get, dBerlaku_Dari_get){
    list_department(cIDDept_get, cNmDept_get);
    getDivision(cIDBag_get, cNmBag_get);
    list_potition_header(cIDJbtn_get, cNmJbtn_get);
    list_employee_status(cIDStsKrj_get, cNmStsKrj_get);
    $('#dBerlaku_Dari_potition').val('');
    $('#dBerlaku_Dari_potition').val(dBerlaku_Dari_get);
    $('#update_potition').val('');
    $('#update_potition').val('1');
    //alert(cIDDept_get);
}

function update_family(cNama_get, dTglLhr_get, cTempat_Lhr_get, cJnsKel_get, cIDHubKel_get, cNmHubKel_get, cIDAgama_get, cNmAgama_get, cGolDrh_get, nama_golongan_darah_get, lNikah_get, dTglNikah_get){
    $('#update_family').val('');
    $('#update_family').val('1');
    $('#cNama').val('');
    $('#cNama').val(cNama_get);
    $('#dTglLhr_family').val('');
    $('#dTglLhr_family').val(dTglLhr_get);
    $('#cTempat_Lhr').val('');
    $('#cTempat_Lhr').val(cTempat_Lhr_get);

    getSex(cJnsKel_get, '');
    getFamilyStatus(cIDHubKel_get, cNmHubKel_get);
    getReligion(cIDAgama_get, cNmAgama_get);
    getBloodGroup(cGolDrh_get, nama_golongan_darah_get);
    getMerried(lNikah_get, '');
    if (lNikah_get==1) {
        $('#dTglNikah').val('');
        $('#dTglNikah').val(dTglNikah_get);
    }
    else {
        $('#dTglNikah').val('');
    }
}

function update_tax(tahun_get, tax_pph21_get, tax_bpjs_get, dBerlaku_Dari_get){
    $('#tax_pph21').html('');
    $('#tax_bpjs').html('');
    $('#tahun_tax').html('');
    $('#dBerlaku_Dari_tax').val('');

    list_family_status_pph21(tax_pph21_get);
    list_family_status_bpjs(tax_bpjs_get);
    getYear(tahun_get);
    $('#dBerlaku_Dari_tax').val(dBerlaku_Dari_get);
}

function update_salary(cIDKomponen_get, cNmKomponen_get, nNilai_get, dBerlaku_dari_get){
    getComponentSalary(cIDKomponen_get, cNmKomponen_get);
    $('#update_salary').val('');
    $('#update_salary').val('1');
    $('#nNilai').val('');
    $('#nNilai').val(nNilai_get);
    $('#dBerlaku_Dari_salary').val('');
    $('#dBerlaku_Dari_salary').val(dBerlaku_dari_get);
}

function update_bank(cIDBank_get, cNmBank_get, cNmPemilik_get, cNoAccount_get, cAlmBank_get, dCity_get){
    $('#cIDBank').html('');
    getBank(cIDBank_get, cNmBank_get);
    $('#cNmPemilik').val('');
    $('#cNmPemilik').val(cNmPemilik_get);
    $('#cNoAccount').val('');
    $('#cNoAccount').val(cNoAccount_get);
    $('#cAlmBank').val('');
    $('#cAlmBank').val(cAlmBank_get);
    $('#dCity').val('');
    $('#dCity').val(dCity_get);
    $('#update_bank').val('');
    $('#update_bank').val('1');
}

// Disbale - Enable

function disable_enable_salary(cIDKomponen_get, cNmKomponen_get, nNilai_get, dBerlaku_dari_get, values_get){
    var cNIK = $('#cNIK').val();
    if(confirm("Are you sure will disable "+cNmKomponen_get+" ?")) {

        if (values_get==1) {
            modal_loading_open('bg-info', 'Disabling data', 'Please wait...');
        }
        else {
            modal_loading_open('bg-info', 'Enabling data', 'Please wait...');
        }

        $.ajax({
            url: base_url+'ess/update-personal-salary/'+key_session,
            type: 'post',
            data: 'cNIK='+cNIK+'&cIDKomponen='+cIDKomponen_get+'&deleted='+values_get+'&nNilai='+nNilai_get+'&dBerlaku_dari='+dBerlaku_dari_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        modal_loading_open('bg-primary', 'Updating data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            salary('1', cNIK);
                        }, 5000);
                    }
                    else if(status==0){
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function disable_enable_bank(cIDBank_get, cNmBank_get, cNmPemilik_get, cNoAccount_get, cAlmBank_get, dCity_get, values_get){
    var cNIK = $('#cNIK').val();
    var values_note = '';
    if (values_get==1) {
        values_note = 'Disable';
    }
    else {
        values_note = 'Enable';
    }

    if(confirm("Are you sure will "+values_note+" bank account "+cNmPemilik_get+" ?")) {

        modal_loading_open('bg-info', values_note+' data', 'Please wait...');

        $.ajax({
            url: base_url+'ess/update-personal-bank-account/'+key_session,
            type: 'post',
            data: 'cNIK='+cNIK+'&cIDBank='+cIDBank_get+'&cNmBank='+cNmBank_get+'&cNmPemilik='+cNmPemilik_get+'&cNoAccount='+cNoAccount_get+'&cAlmBank='+cAlmBank_get+'&dCity='+dCity_get+'&deleted='+values_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            bank_account('1', cNIK);
                        }, 5000);
                    }
                    else if(status==0){
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

// Delete 

function delete_family(cNama_get, dTglLhr_get, cTempat_Lhr_get, cJnsKel_get, cIDHubKel_get){
    var cNIK = $('#cNIK').val();
    if(confirm("Are you sure will permanent delete "+cNama_get+" ?")) {
        modal_loading_open('bg-info', 'Deleting data', 'Please wait...');

        $.ajax({
            url: base_url+'ess/delete-personal-family/'+key_session,
            type: 'post',
            data: 'cNIK='+cNIK+'&cNama='+cNama_get+'&dTglLhr='+dTglLhr_get+'&cTempat_Lhr='+cTempat_Lhr_get+'&cJnsKel='+cJnsKel_get+'&cIDHubKel='+cIDHubKel_get,
            crossDomain: true,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        modal_loading_open('bg-primary', 'Deleting data successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            family('1', cNIK);
                        }, 5000);
                    }
                    else if(status==0){
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Deleting data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            }
        })
    }
}

// UPLOAD PHOTO

function photo_personal_data(file_photo_id, id_data_photo){
    var file_photo_id_new = 'file_'+file_photo_id;
    var fd = new FormData();
    var files = $('#'+file_photo_id_new)[0].files;
    var cNIK = $('#cNIK').val();

    modal_loading_open('bg-info', 'Saving photo', 'Please wait...');

    if(files.length > 0 ){
        fd.append('file', files[0]);
        fd.append('cNIK', cNIK);
        $.ajax({
            url: base_url+'ess/upload-data-photo/'+key_session+'/'+id_data_photo,
            type: 'post',
            data: fd,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function(responseGet){
                //console.log(responseGet);
                modal_loading_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status==1){
                        var url_photo = responseGetList.url_photo;
                        modal_loading_open('bg-primary', 'Saving photo successfully', 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                            document.getElementById(file_photo_id).removeAttribute('src');
                            document.getElementById(file_photo_id).setAttribute('src', url_photo);
                            $('#'+file_photo_id_new).val('')
                        }, 5000);
                    }
                    else if(status==0){
                        var response = responseGetList.response;
                        modal_loading_open('bg-danger', 'Saving photo unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                        setTimeout(function () {
                            modal_loading_hide();
                        }, 5000);
                    }
                })
            },
        });
    }
    else {
        alert("Please select a file.");
    }
}

// Modal

function modal_loading_open(backgroundcolor, values_header, values_body){
    document.getElementById('modal_header').setAttribute('class', 'modal-header '+backgroundcolor);
    $('#modal_title').html('');
    $('#modal_body').html('');
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

// Resign

function list_employee_active_to_resign(status_get, cNIK_get, cNmPegawai_get){
    $('#cNIK_resign').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/'+cNIK_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var trList = '';
                if (cNIK_get!='0') {
                    trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
                }
                else {
                    if (status==0) {
                        trList += '<option value="">Data Not Found.</option>';
                    }
                    else {
                        var response = responseGetList.response;
                        response.map(function(responseList, i){
                            var company_id = responseList.company_id;
                            var company_name = responseList.company_name;
                            var cNIK = responseList.cNIK;
                            var cNmPegawai = responseList.cNmPegawai;

                            trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                        });
                    }
                }
                $('#cNIK_resign').append(trList);
            })
        }
    });
}

function list_reasons_for_resigning(cIDJnsBerhenti_get, cNmJnsBerhenti_get){
    $('#cIDJnsBerhenti').html('');
    $.ajax({
        url: base_url+'ess/list-reasons-for-resigning/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            var trList = '';
            if (cIDJnsBerhenti_get!='') {
                trList += '<option value="'+cIDJnsBerhenti_get+'">'+cNmJnsBerhenti_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var cIDJnsBerhenti = responseList.cIDJnsBerhenti;
                        var cNmJnsBerhenti = responseList.cNmJnsBerhenti;
                        var deleted = responseList.deleted;

                        if (deleted==0) {
                            trList += '<option value="'+cIDJnsBerhenti+'">'+cNmJnsBerhenti+'</option>';
                        }
                    })
                }
            })
            $('#cIDJnsBerhenti').append(trList);
        }
    });
}

function save_resign(){
    var cNIK_resign = $('#cNIK_resign').val();
    var cIDJnsBerhenti = $('#cIDJnsBerhenti').val();
    var dTglPengajuan = $('#dTglPengajuan').val();
    var cNote = $('#cNote').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    console.log(cNIK_resign+' '+cIDJnsBerhenti+' '+dTglPengajuan+' '+cNote);

    $.ajax({
        url: base_url+'ess/add-resign/'+key_session,
        type: 'post',
        data: 'cNIK_resign='+cNIK_resign+'&cIDJnsBerhenti='+cIDJnsBerhenti+'&dTglPengajuan='+dTglPengajuan+'&cNote='+cNote,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            modal_loading_hide();
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1){
                    modal_loading_open('bg-primary', 'Saving data successfully', 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                        list_employee_resign(0, 0);
                        $('#dTglPengajuan').val('');
                        $('#cNote').val('');
                        list_employee_active_to_resign('0', '0', '');
                        list_reasons_for_resigning('', '');
                    }, 5000);
                }
                else if(status==0){
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. value error = '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function update_resign(cNIK_get, cNmPegawai_get, cIDJnsBerhenti_get, cNmJnsBerhenti_get, dTglPengajuan_get, cNote_get){
    document.getElementById('add_employee_resign').removeAttribute('style');
    document.getElementById('add_employee_resign').setAttribute('style', 'display:block');

    list_employee_active_to_resign('0', cNIK_get, cNmPegawai_get);
    list_reasons_for_resigning(cIDJnsBerhenti_get, cNmJnsBerhenti_get);
    $('#dTglPengajuan').val('');
    $('#dTglPengajuan').val(dTglPengajuan_get);
    $('#cNote').val('');
    $('#cNote').val(cNote_get);
}

function delete_resign(cNIK_get, cNmPegawai_get){
}