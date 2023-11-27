<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AAA</title>
    <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
    <script type="text/javascript">
      body {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
      }
    </script>
  </head>
  <body>
    <div id="calendar"></div>
    <script src="js-year-calendar.min.js"></script>
    <script type="text/javascript">
      new Calendar('#calendar', 
        {
            style: 'border',
            minDate: new Date(),
            //getWeekStart: 1
        }
      );
    </script>
  </body>
</html>