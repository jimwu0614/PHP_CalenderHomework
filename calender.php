<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>

    </style>
</head>

<body>
    <?php

    //傳值

    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = date('n');
        $year = date("Y");
    }

    //計算上月次月按鈕

    switch ($month) {
        case 1:
            $prevMonth = 12;
            $prevYear = $year - 1;
            $nextMonth = $month + 1;
            $nextYear = $year;
            break;
        case 12:
            $prevMonth = $month - 1;
            $prevYear = $year;
            $nextMonth = 1;
            $nextYear = $year + 1;
            break;
        default:
            $prevMonth = $month - 1;
            $prevYear = $year;
            $nextMonth = $month + 1;
            $nextYear = $year;
    }

    //設定月份參數

    $firstDay = date("Y-") . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay = $year . -$month . "-" . $monthDays;
    $today = date("Y-m-d");

    ?>
    <p>
    <div class="clock">
        <h2 id="location">
            Taipei, Taiwan
        </h2>
        <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone=Asia%2FTaipei" width="100%" height="140" frameborder="0" seamless>
        </iframe>
    </div>
    </p>
    <section>
        <div class='nav'>
            <span>
                <a href='calender.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>'><button class="change"> 上一個月</button></a>
            </span>
            <span>
                <?= $year . '年' . $month . '月'; ?>
            </span>
            <span>
                <a href='calender.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>'><button class="change">下一個月</button></a>
            </span>
        </div>
        <table>
            <tr>
                <td class="header">日</td>
                <td class="header">一</td>
                <td class="header">二</td>
                <td class="header">三</td>
                <td class="header">四</td>
                <td class="header">五</td>
                <td class="header">六</td>
            </tr>
            <?php
            for ($i = 0; $i < 6; $i++) {
                echo "<tr>";

                for ($j = 0; $j < 7; $j++) {
                    $d = $i * 7 + ($j + 1) - $firstWeekday - 1;

                    if ($d >= 0 && $d < $monthDays) {
                        $fs = strtotime($firstDay);
                        $shiftd = strtotime("+$d days", $fs);
                        $date = date("d", $shiftd);
                        $w = date("w", $shiftd);
                        $chktoday = "";
                        if (date("Y-m-d", $shiftd) == $today) {
                            $chktoday = 'today';
                        }
                        // $date=date("Y-m-d",strtotime("+$d days",strtotime($firstDay)));
                        if ($w == 0 || $w == 6) {
                            echo "<td class='weekend $chktoday' >";
                        } else {
                            echo "<td class='workday $chktoday'>";
                        }
                        echo $date;
                        echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }

            ?>
        </table>
    </section>
    <footer>
    123123
    </footer>
</body>

</html>