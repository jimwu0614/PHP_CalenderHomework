<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <?php
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = date('n');
        $year = date("Y");
    }

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


    // echo "要顯示的月份為" . $year . '年' . $month . '月';



    $firstDay = date("Y-") . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay = $year . -$month . "-" . $monthDays;
    $today = date("Y-m-d");
    // echo "月份" . $month;
    // echo "<br>";
    // echo "第一天是" . $firstDay;
    // echo "<br>"; 
    // echo "第一天是星期" . $firstWeekday;
    // echo "<br>";
    // echo "最後一天是" . $lastDay;
    // echo "<br>";
    // echo "當月天數共" . $monthDays;
    // echo "<br>";
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
    <div class='nav'>
            <span>
                <a href='calender.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>'>上一個月</a>
            </span>
            <span>
                <?= $year . '年' . $month . '月'; ?>
            </span>
            <span>
                <a href='calender.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>'>下一個月</a>
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
</body>

</html>