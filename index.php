<?php
    $test = new DateTime();
    print_r($test);

    //Declaration of month and days of the week tables
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
    $weekdays = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

    $month = date('m');
    $year = date('Y');

    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $date = date("Y-m-d");
    //day of the week as an int (1=monday / 7=sunday)
    //$timestamp = strtotime($date);
    //$dotw = date("w", $timestamp);
    $k = 1;

    function lastDayOfMonth($year, $month) {
        $newDate = new DateTime();
        $newDate->setDate($year, $month, 1);
        $newDate->modify('last day of this month');
        $timestamp = strtotime($newDate->format('l'));
        $ldom = date('w',$timestamp);
        return $ldom;
    }

    function firstDayOfMonth($year, $month) {
        $newDate = new DateTime();
        $newDate->setDate($year, $month, 1);
        $newDate->modify('first day of this month');        //change $newDate to be the first day of the month
        $timestamp = strtotime($newDate->format('l'));      //makes it so that date is only a string of the day of the week. Changes a given string (date format) into a unix timestamp.
        $fdom = date('w',$timestamp);                       //gets the the day of the week of that timestamp as a number (1-7)
        return $fdom;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
            $yearPicked = $_GET['year'];
            $monthPicked = $_GET['month'];
            echo 'The first day is : ' . $weekdays[firstDayOfMonth($yearPicked, $monthPicked)-1] . ' the last day is : ' . lastDayOfMonth($yearPicked, $monthPicked);
        ?>
        <form class="row g-3" action="" method="get">
            <select class="form-select" aria-label="Select a month" name="month">
                <?php for($monthSelect=0;$monthSelect<12;$monthSelect++) { ?>
                    <option value="<?= $monthSelect+1 ?>"><?= $months[$monthSelect] ?></option>
                <?php } ?>
            </select>
            <select class="form-select" aria-label="Select a year" name="year">
                <?php for($yearSelect=1950;$yearSelect<2051;$yearSelect++) { ?>
                    <option value="<?= ($yearSelect) ?>"><?= $yearSelect ?></option>
                <?php } ?>
            </select>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" value="Send">Confirm</button>
            </div>
        </form>
        <?php 
            echo 'Month chosen : ' . $_GET['month'] . 'Year chosen : ' . $_GET['year'];
        ?>
        <div class="row">
            <?php for($w=0;$w<7;$w++) { ?>
                <div class="col"><?= $weekdays[$w] ?></div>
            <?php } ?>
        </div>
        <?php for($i=0;$i<5;$i++) { ?>
            <div class="row">
                <?php for($j=1;$j<8;$j++) { ?>
                    <div class="col cal"><?= $k; $k++; if($k>$numDays) { $k=1; }?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</html>