<?php
    //Declaration of month and days of the week tables
    $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
    $weekdays = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

    $month = date('m');
    $year = date('Y');

    $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    $date = date("Y-m-d");
    //day of the week as an int (1=monday / 7=sunday)
    //$timestamp = strtotime($date);
    //$dotw = date("w", $timestamp);

    function lastDayOfMonth() {
        $yearPicked = $_GET['year'];
        $monthPicked = $_GET['month'];
        $newDate = new DateTime();
        $newDate->setDate($yearPicked, $monthPicked, 10);
        $newDate->modify('last day of this month');
        $timestamp = strtotime($newDate->format('l'));
        $ldom = date('w',$timestamp);
        return $ldom;
    }

    function firstDayOfMonth() {
        $yearPicked = $_GET['year'];
        $monthPicked = $_GET['month'];
        $newDate = new DateTime();
        $newDate->setDate($yearPicked, $monthPicked, 10);   //set the date to the year and month i got from browser (3rd part can be any day since i bring this date back to the first of the month anyway)
        $newDate->modify('first day of this month');        //change $newDate to be the first day of the month
        $timestamp = strtotime($newDate->format('l'));      //makes it so that date is only a string of the day of the week. Changes a given string (date format) into a unix timestamp.
        $fdom = date('w',$timestamp);                       //gets the the day of the week of that timestamp as a number (1-7)
        return $fdom;
    }

    $k = 1;
    $show = 0;

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
        <!-- echo 'The first day is : ' . $weekdays[firstDayOfMonth()] . ' the last day is : ' . lastDayOfMonth(); -->
        <div class="current-date text-center d-block"><?php echo $months[$_GET['month']-1],' ',$_GET['year']; ?></div>
        <!-- echo 'Month chosen : ' . $_GET['month'] . 'Year chosen : ' . $_GET['year']; -->
        <div class="calendar-box text-center border border-white border-5 d-block mx-auto p-3">
        <div class="row p-4">
            <?php for($w=0;$w<7;$w++) { ?>
                <div class="col boldify"><?= $weekdays[$w] ?></div>
            <?php } ?>
        </div>
        <?php for($i=0;$i<5;$i++) { ?>
            <div class="row">
                <?php for($j=1;$j<8;$j++) { ?>
                    <div class="col cal py-3 days">
                        <?php
                            if($k < firstDayOfMonth()+1) {
                                $show = '';
                            }
                            else {
                                $show++;
                            }
                            $k++;
                            if($k>$numDays+firstDayOfMonth()+1) { $show='';};
                            echo $show;
                        ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        </div>
        <form class="row g-3" action="" method="get">
            <div class="col-4"></div>
            <div class="col-2">
                <select class="form-select" aria-label="Select a month" name="month">
                    <!-- <option selected><?= $_GET['month'] ?></option> -->
                    <?php for($monthSelect=0;$monthSelect<12;$monthSelect++) { ?>
                        <option value="<?= $monthSelect+1 ?>"><?= $months[$monthSelect] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-1">
                <select class="form-select" aria-label="Select a year" name="year">
                    <!-- <option selected><?= $_GET['year'] ?></option> -->
                    <?php for($yearSelect=1950;$yearSelect<2051;$yearSelect++) { ?>
                        <option value="<?= ($yearSelect) ?>"><?= $yearSelect ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-1">
                <button class="btn btn-primary" type="submit" value="Send">Confirm</button>
            </div>
            <div class="col-4"></div>
        </form>
    </div>
    <footer>
        <span class="fixed-bottom text-center credits">Developped by <a href="https://github.com/AugustinPro">Augustin Petre</a> | Photo by <a href="https://unsplash.com/@claybanks?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Clay Banks</a> on <a href="https://unsplash.com/s/photos/dark?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">Unsplash</a></span>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</html>