$(document).ready(function(){
    list_salary_deduction();
})

function list_salary_deduction(){
    $('#id_salary_deduction').val('');
    $('#month').val('');
    $('#week').val('');
    $('#day').val('');
    $.ajax({
        url: base_url+'ess/list-salary-deduction/'+key_session,
        type: 'get',
        crossDomain: true,
        dataType: 'JSON',
        success: function(responseGet){
            //console.log(responseGet);
            responseGet.map(function(responseGetList){
                var status = responseGetList.status;
                if (status==0) {
                    $('#id_salary_deduction').val('0');
                    $('#month').val('0');
                    $('#week').val('0');
                    $('#day').val('0');
                }
                else {
                    var response = responseGetList.response;

                    var id_salary_deduction = response[0].id_salary_deduction;
                    var month = response[0].month;
                    var week = response[0].week;
                    var day = response[0].day;

                    $('#id_salary_deduction').val(month);
                    $('#month').val(month);
                    $('#week').val(week);
                    $('#day').val(day);
                }
            })
        } 
    })
}

function add_salary_deduction(){
    var id_salary_deduction = $('#id_salary_deduction').val();
    var month = $('#month').val();
    var week = $('#week').val();
    var day = $('#day').val();

    modal_loading_open('bg-info', 'Saving data', 'Please wait...');

    $.ajax({
        url: base_url+'ess/add-salary-deduction/'+key_session,
        type: 'post',
        data: 'id_salary_deduction='+id_salary_deduction+'&month='+month+'&week='+week+'&day='+day,
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
                        list_salary_deduction()
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