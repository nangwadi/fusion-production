$(document).ready(function(){
    list_account(0);
    list_country(0, 0);
})

// employee

function list_employee(){
    $('#list_employee').dataTable().fnDestroy();
    $('#modal_employee').modal('show');

    $('#list_employee').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-employee-datatable/'+key_session+'/0',
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],
    });
}

function select_change_employee(no_get){
    $('.id_employee').prop('checked', false);
    $('#id_employee_'+no_get).prop('checked', true);
}

function list_employee_add(){
    $('#sales_person').val('');
    var id_employee
    for (var i = 0; i < 11; i++) {
        var id_employee_cb = $('#id_employee_'+i).prop('checked');
        if (id_employee_cb == true) {
            var id_employee_value = $('#id_employee_'+i).val();
            id_employee = id_employee_value;
        }
    }
    $('#sales_person').val(id_employee);
    list_employee_close();
}

function list_employee_close(){
    $('#modal_employee').modal('hide');
}

// coa

function list_coa(input_id_get){
    //console.log(input_id_get);
    $('#list_coa_'+input_id_get).dataTable().fnDestroy();
    $('#modal_coa_'+input_id_get).modal('show');

    $('#list_coa_'+input_id_get).DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'inventory/list-coa-datatable/'+key_session+'/0',
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],
    });
    $('.coa_cd').prop('checked', false);
}

function select_change_coa(no_get){
    //$('.coa_cd').prop('checked', false);
    for (var i = 0; i < 11; i++) {
        $('#coa_cd_'+i).prop('checked', false);
    }
    $('#coa_cd_'+no_get).prop('checked', true);
}

function list_coa_add(input_id_get){
    $('#id_coa_'+input_id_get).val('');
    var coa_cd
    for (var i = 0; i < 11; i++) {
        var coa_cd_cb = $('#coa_cd_'+i).prop('checked');
        if (coa_cd_cb == true) {
            var coa_cd_value = $('#coa_cd_'+i).val();
            coa_cd = coa_cd_value;
        }
    }
    $('#id_coa_'+input_id_get).val(coa_cd);
    list_coa_close(input_id_get);
}

function list_coa_close(input_id_get){
    $('#modal_coa_'+input_id_get).modal('hide');
}

// =====================

function list_country(id_country_get, country_name_get){
    $('#id_country').html('');
    $.ajax({
        url: base_url+'jom/list-country/'+key_session+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (id_country_get=='') {
                trList += '<option value="">Select Country</option>';
            }
            else {
                trList += '<option value="'+id_country_get+'">'+country_name_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var id_country = responseList.id_country;
                        var company_id = responseList.company_id;
                        var company_name = responseList.company_name;
                        var country_cd = responseList.country_cd;
                        var country_name = responseList.country_name;
                        var country_phone_code = (responseList.country_phone_code)*1;
                        var deleted = responseList.deleted;

                        var action = '';
                        if (deleted==0) {
                            trList += '<option value="'+id_country+'">'+country_name+'</option>';
                        }
                    })
                    $('#id_country').append(trList);
                }
            })
        }
    });
}

function list_employee_active(status_get, cNIK_get, cNmPegawai_get){
    $('#sales_person').html('');
    $.ajax({
        url: base_url+'ess/list-employee/'+key_session+'/'+status_get+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            var trList = '';
            if (cNIK_get=='') {
                trList += '<option value="">Select Employee.</option>';
            }
            else {
                trList += '<option value="'+cNIK_get+'">'+cNmPegawai_get+'</option>';
            }
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    trList += '<option value="">Data Not Found.</option>';
                }
                else {
                    var response = responseGetList.response;
                    response.map(function(responseList, i){
                        var cNIK = responseList.cNIK;
                        var cNmPegawai = responseList.cNmPegawai;

                        trList += '<option value="'+cNIK+'">'+cNmPegawai+'</option>';
                    });
                }
            })
            $('#sales_person').append(trList);
        }
    });
}

function list_account(id_account_get){
    $('#list_account').dataTable().fnDestroy();

    $('#list_account').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order": [],
        "ajax" : {
            'url' : base_url+'jom/list-account-datatable/'+key_session+'/'+category+'/0',
            'type' : 'post'
        },
        "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
        ],
    });
}

function add_account(){
    var id_account = $('#id_account').val();
    var account_cd = $('#account_cd').val();
    var account_name = $('#account_name').val();
    var main_address = $('#main_address').val();
    var city = $('#city').val();
    var postal_code = $('#postal_code').val();
    var id_country = $('#id_country').val();
    var phone_1 = $('#phone_1').val();
    var phone_2 = $('#phone_2').val();
    var fax = $('#fax').val();
    var attn = $('#attn').val();
    var email = $('#email').val();

    var apr_account = $('#id_coa_apr_account').val();
    var aapr_account = $('#id_coa_aapr_account').val();
    var payment_account = $('#id_coa_payment_account').val();
    var sales_account = $('#id_coa_sales_account').val();
    var sales_person = $('#sales_person').val();
    var taxable_prop = $('#taxable').prop('checked');

    //console.log(payment_account);

    var taxable = '';
    if (taxable_prop==true) {
        taxable = 1;
    }
    else {
        taxable = 0;
    }

    var no = $('#no').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/add-account/'+key_session+'/'+category,
        type: 'post',
        data: 'id_account='+id_account+'&account_cd='+account_cd+'&account_name='+account_name+'&main_address='+main_address+'&city='+city+'&postal_code='+postal_code+'&id_country='+id_country+'&phone_1='+phone_1+'&phone_2='+phone_2+'&fax='+fax+'&attn='+attn+'&email='+email+'&apr_account='+apr_account+'&aapr_account='+aapr_account+'&payment_account='+payment_account+'&sales_account='+sales_account+'&sales_person='+sales_person+'&taxable='+taxable,
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
                        reset_form();
                        modal_loading_hide();
                        div_account();
                        if (id_account=='') {
                            list_account(0);
                        }
                        else {
                            $('#account_cd_'+no).html('');
                            $('#account_name_'+no).html('');
                            $('#main_address_'+no).html('');
                            $('#phone_1_'+no).html('');
                            $('#attn_'+no).html('');
                            $('#email_'+no).html('');

                            var response = responseGetList.response;
                                var id_account_db = response[0].id_account;
                                var account_cd_db = response[0].account_cd;
                                var account_name_db = response[0].account_name;
                                var main_address_db = response[0].main_address;
                                var city_db = response[0].city;
                                var postal_code_db = response[0].postal_code;
                                var id_country_db = response[0].id_country;
                                var country_name_db = response[0].country_name;
                                var phone_1_db = response[0].phone_1;
                                var phone_2_db = response[0].phone_2;
                                var fax_db = response[0].fax;
                                var attn_db = response[0].attn;
                                var email_db = response[0].email;

                                $('#account_cd_'+no).append(account_cd_db);
                                $('#account_name_'+no).append(account_name_db);
                                $('#main_address_'+no).append(main_address_db);
                                $('#phone_1_'+no).append(phone_1_db);
                                $('#attn_'+no).append(attn_db);
                                $('#email_'+no).append(email_db);

                                document.getElementById('btn_update_'+no).removeAttribute('onclick');
                                document.getElementById('btn_update_'+no).setAttribute('onclick', 'update(\''+id_account_db+'\', \''+no+'\')');

                                document.getElementById('btn_disable_'+no).removeAttribute('onclick');
                                document.getElementById('btn_disable_'+no).setAttribute('onclick', 'disable_enable(\''+id_account_db+'\', \''+account_name_db+'\', \''+1+'\')');
                        }
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    modal_loading_open('bg-danger', 'Saving data unsuccessfully. Error : '+response, 'Please wait for hide this view...');
                    setTimeout(function () {
                        modal_loading_hide();
                    }, 5000);
                }
            })
        }
    })
}

function update(id_account_get, no_get){

    div_account();
    $('#id_account').val('');
    $('#account_cd').val('');
    $('#account_name').val('');
    $('#main_address').val('');
    $('#city').val('');
    $('#postal_code').val('');
    $('#phone_1').val('');
    $('#phone_2').val('');
    $('#fax').val('');
    $('#attn').val('');
    $('#email').val('');
    $('#no').val('');

    $.ajax({
        url: base_url+'jom/list-account/'+key_session+'/'+category+'/'+id_account_get,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList, i){
                    var id_account = responseList.id_account;
                    var company_id = responseList.company_id;
                    var company_name = responseList.company_name;
                    var cv = responseList.cv;
                    var account_cd = responseList.account_cd;
                    var account_name = responseList.account_name;
                    var main_address = responseList.main_address;
                    var city = responseList.city;
                    var postal_code = responseList.postal_code;
                    var id_country = responseList.id_country;
                    var country_name = responseList.country_name;
                    var phone_1 = responseList.phone_1;
                    var phone_2 = responseList.phone_2;
                    var fax = responseList.fax;
                    var attn = responseList.attn;
                    var email = responseList.email;
                    var apr_account = responseList.apr_account;
                    var coa_cd_apr = responseList.coa_cd_apr;
                    var coa_name_apr = responseList.coa_name_apr;
                    var aapr_account = responseList.aapr_account;
                    var coa_cd_aapr = responseList.coa_cd_aapr;
                    var coa_name_aapr = responseList.coa_name_aapr;
                    var payment_account = responseList.payment_account;
                    var coa_cd_payment_account = responseList.coa_cd_payment_account;
                    var coa_name_payment_account = responseList.coa_name_payment_account;
                    var sales_account = responseList.sales_account;
                    var coa_cd_sales_account = responseList.coa_cd_sales_account;
                    var coa_name_sales_account = responseList.coa_name_sales_account;
                    var sales_person = responseList.sales_person;
                    var cNmPegawai_sales_person = responseList.cNmPegawai_sales_person;
                    var taxable = responseList.taxable;
                    var deleted = responseList.deleted;

                    $('#id_account').val(id_account);
                    $('#account_cd').val(account_cd);
                    $('#account_name').val(account_name);
                    $('#main_address').val(main_address);
                    $('#city').val(city);
                    $('#postal_code').val(postal_code);
                    $('#phone_1').val(phone_1);
                    $('#phone_2').val(phone_2);
                    $('#fax').val(fax);
                    $('#attn').val(attn);
                    $('#email').val(email);
                    $('#no').val(no_get);

                    list_country(id_country, country_name);
                    /*list_coa(apr_account, coa_cd_apr, coa_name_apr, 'apr_account');
                    list_coa(aapr_account, coa_cd_aapr, coa_name_aapr, 'aapr_account');
                    list_coa(payment_account, coa_cd_payment_account, coa_name_payment_account, 'payment_account');
                    list_coa(sales_account, coa_cd_sales_account, coa_name_sales_account, 'sales_account');
                    list_employee_active(1, sales_person, cNmPegawai_sales_person);*/
                    $('#id_coa_apr_account').val(coa_cd_apr+' // '+coa_name_apr);
                    if (coa_cd_aapr!='') {
                        $('#id_coa_aapr_account').val(coa_cd_aapr+' // '+coa_name_aapr);
                    }
                    else {
                        $('#id_coa_aapr_account').val('');
                    }
                    
                    if (coa_cd_payment_account!='') {
                        $('#id_coa_payment_account').val(coa_cd_payment_account+' // '+coa_name_payment_account);
                    }
                    else {
                        $('#id_coa_payment_account').val('');
                    }

                    if (coa_cd_sales_account!='') {
                        $('#id_coa_sales_account').val(coa_cd_sales_account+' // '+coa_name_sales_account);
                    }
                    else {
                        $('#id_coa_sales_account').val('');
                    }

                    if (sales_person!='') {
                        $('#sales_person').val(cNmPegawai_sales_person);
                    }
                    else {
                        $('#sales_person').val('');
                    }
                    //$('#id_coa_payment_account').val(coa_cd_payment_account+' // '+coa_name_payment_account);
                    //$('#id_coa_sales_account').val(coa_cd_sales_account+' // '+coa_name_sales_account);

                    if ((taxable)*1==1) {
                        $('#taxable').prop('checked', true);
                    }
                    else {
                        $('#taxable').prop('checked', false);
                    }

                })
            })
        }
    });
}

function set_password(id_account_get, account_name_get){
    $('#modal_title_password').html('');
    $('#modal_title_password').append('Set Password for '+account_name_get);
    $('#id_account_password').val('');
    $('#id_account_password').val(id_account_get);
    $('#modal_password').modal('show');
}

function set_password_close(){
    $('#modal_password').modal('hide');
}

function password_generator(){
    $('#password_account').val('');

    var password_1 = password_gen_1(1)+''+password_gen_2(2)+''+password_gen_3(5);
    $('#password_account').val(password_1);
}

function password_gen_1(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}

function password_gen_2(length) {
    let result = '';
    const characters = 'abcdefghijklmnopqrstuvwxyz';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}

function password_gen_3(length) {
    let result = '';
    const characters = '0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
    }
    return result;
}

function save_password(){
    var id_account = $('#id_account_password').val();
    var password_account = $('#password_account').val();

    if (id_account == '' || password_account == '') {
        alert ('Password cannot empty.');
    }
    else {
        loading_account_password_show('Saving password...');
        $.ajax({
            url: base_url+'jom/add-account-password/'+key_session,
            type: 'POST',
            data: 'id_account='+id_account+'&password_account='+password_account,
            dataType: 'JSON',
            success: function(responseGet){
                //console.log(responseGet);
                loading_account_password_hide();
                responseGet.map(function(responseGetList){
                    var status = responseGetList.status;
                    if (status*1 == 1) {
                        loading_account_password_show('Saving password successfully.');
                        setTimeout(function () {
                            loading_account_password_hide();
                            set_password_close();
                        }, 5000);
                    }
                    else {
                        loading_account_password_show('Saving password unsuccessfully.');
                        setTimeout(function () {
                            loading_account_password_hide();
                            set_password_close();
                        }, 5000);
                    }
                })
            }
        })
    }
}

function loading_account_password_show(text_values){
    $('#loading_account_password').html('');
    $('#loading_account_password').append(text_values);
}

function loading_account_password_hide(){
    $('#loading_account_password').html('');
}

function reset_form(){
    $('#id_account').val('');
    $('#account_cd').val('');
    $('#account_name').val('');
    $('#main_address').val('');
    $('#city').val('');
    $('#postal_code').val('');
    $('#phone_1').val('');
    $('#phone_2').val('');
    $('#fax').val('');
    $('#attn').val('');
    $('#email').val('');
    $('#no').val('');

    $('#id_coa_apr_account').val('');
    $('#id_coa_aapr_account').val('');
    $('#id_coa_payment_account').val('');
    $('#id_coa_sales_account').val('');
    $('#sales_person').val('');

    $('#taxable').prop('checked', false);

    list_country(0, 0);
}

function job_number(id_account_get, account_name_get){
    $('#modal_title_number').html('');
    $.ajax({
        url: base_url+'jom/list-job-number/'+key_session+'/'+id_account_get+'/0',
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet)
            $('#id_account_number').val('');
            $('#id_account_number').val(id_account_get);
            $('#div_numbering').html('');
            var trList = '';
            trList += '<div class="row">';
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                var response = responseGetList.response;
                response.map(function(responseList){
                    var id_job_type = responseList.id_job_type;
                    var job_type_name = responseList.job_type_name;
                    var job_type_name_dash = responseList.job_type_name_dash;
                    var number = responseList.number;

                    trList += '<div class="col-sm-4"><label>'+job_type_name+'</label><input type="number" class="form-control" id="'+job_type_name_dash+'" value="'+number+'" onchange="update_account_number(\''+id_account_get+'\', \''+id_job_type+'\', \''+job_type_name_dash+'\');"></div>'
                    console.log(id_job_type+' '+job_type_name+' '+number);
                    
                })
            })
            trList += '</div>';
            $('#div_numbering').append(trList);
            $('#modal_title_number').append("Customer Job Number - "+account_name_get+".");
            document.getElementById('modal_header_number').setAttribute('class', 'modal-header bg-success');
            document.getElementById('modal_footer_number').setAttribute('class', 'modal-footer bg-success');
            $('#modal_number').modal('show');
        }
    })
}

function account_number_hide(){
    $('#modal_number').modal('hide');
}

function update_account_number(id_account, id_job_type, job_type_name){
    var number = $('#'+job_type_name).val();
    $('#loading_job_number').html('');
    $('#loading_job_number').append('Updating number');
    $.ajax({
        url: base_url+'jom/add-job-number/'+key_session,
        type: 'post',
        data: 'id_account='+id_account+'&id_job_type='+id_job_type+'&number='+number,
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            $('#loading_job_number').html('');
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==1) {
                    $('#loading_job_number').append('Update number successfully.');
                    setTimeout(function () {
                        $('#loading_job_number').html('');
                    }, 5000);

                }
                else {
                    var response = responseGetList.response;
                    $('#loading_job_number').append('Update number unsuccessfully. Error :'+response);
                    setTimeout(function () {
                        $('#loading_job_number').html('');
                    }, 5000);
                }
            })
        }
    })
}

function disable_enable(id_account_get, account_name_get, values){
    document.getElementById('modal_header_disen').removeAttribute('class');
    document.getElementById('modal_footer_disen').removeAttribute('class');
    $('#id_account_disen').val('');
    $('#value_disen').val('');
    $('#modal_title_disen').html('');
    $('#modal_body_disen').html('');
    $('#btn_disen').html('');

    $('#id_account_disen').val(id_account_get);
    $('#value_disen').val(values);
    if (values==1) {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-danger');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-danger');
        $('#modal_title_disen').append("Disable department - "+account_name_get+".");
        $('#modal_body_disen').append("Are you sure will disable department "+account_name_get+" ?");
        $('#btn_disen').append('Disable');
    }
    else {
        document.getElementById('modal_header_disen').setAttribute('class', 'modal-header bg-warning');
        document.getElementById('modal_footer_disen').setAttribute('class', 'modal-footer bg-warning');
        $('#modal_title_disen').append("Enable department - "+account_name_get+".");
        $('#modal_body_disen').append("Are you sure will enable department "+account_name_get+" ?");
        $('#btn_disen').append('Enable');
    }
    $('#modal_disen').modal('show');
}

function disable_enable_hide(){
    $('#modal_disen').modal('hide');
}

function update_account(){
    var id_account = $('#id_account_disen').val();
    var deleted = $('#value_disen').val();

    disable_enable_hide();
    modal_loading_open('bg-info', 'Updating data', 'Please wait...');

    $.ajax({
        url: base_url+'jom/update-account/'+key_session,
        type: 'post',
        data: 'id_account='+id_account+'&deleted='+deleted,
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
                        list_account(0);
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

function div_account(){
    var add_account_value = $('#add_account_value').val();
    if (add_account_value==1) {
        document.getElementById('div_account').setAttribute('style', 'display:block');
        document.getElementById('btn_add').removeAttribute('class');
        document.getElementById('btn_add').setAttribute('class', 'btn btn-warning btn-md');
        $('#add_account_value').val('0');
    }
    else {
        document.getElementById('div_account').setAttribute('style', 'display:none');
        document.getElementById('btn_add').removeAttribute('class');
        document.getElementById('btn_add').setAttribute('class', 'btn btn-primary btn-md');
        $('#add_account_value').val('1');
    }
}