<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Javascripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- Project Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/calendar/jquery.bootstrap.year.calendar.css">
    <script src="<?php echo base_url(); ?>style/calendar/jquery.bootstrap.year.calendar.js"></script>
    <!--Title-->
    <title>Jquery Bootstrap Year Calendar - Changing Start Year</title>
</head>
<body>
<div class="container">
    <div class="calendar"></div>
</div>
<script>
    $('.calendar').calendar({
        mode: 'rangepicker'
    });

    $('.calendar').on('jqyc.changeYearToPrevious', function (event) {
        var currentYear = $(this).find('.jqyc-change-year').data('year');
        console.log(currentYear);
    });

    $('.calendar').on('jqyc.changeYearToNext', function (event) {
        var currentYear = $(this).find('.jqyc-next-year').data('year');
        console.log(currentYear);
    });

    $('.calendar').on('jqyc.dayChoose', function (event) {
        var choosenYear = $(this).data('year');
        var choosenMonth = $(this).data('month');
        var choosenDay = $(this).data('day-of-month');
        var date = new Date(choosenYear, choosenMonth, choosenDay);
        console.log(date);
        alert('add');
    });
</script>
</body>
</html>