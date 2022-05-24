<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="./css/styleLoop.css">
    <style>

    </style>
</head>

<body>
    <script src="https://kit.fontawesome.com/448aedbc21.js" crossorigin="anonymous"></script>   
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
    $lastWeekday = date("w", strtotime($lastDay));
    $dateHouse = [];
    $sday = date("md", strtotime($today));

    ?>




    <section>
        <div class="box">

            <div class="topic">
                <span style="--i:1">用</span>
                <span style="--i:2">迴</span>
                <span style="--i:3">圈</span>
                <span style="--i:4">方</span>
                <span style="--i:5">法</span>
                <span style="--i:6">製</span>
                <span style="--i:7">作</span>
                <span style="--i:8">萬</span>
                <span style="--i:9">年</span>
                <span style="--i:10">曆</span>
            </div>
 
            <p class="clock">
                <div>
                    <h2 id="location">
                        Taipei, Taiwan
                    </h2>
                    <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=large&timezone=Asia%2FTaipei" width="100%" height="140" frameborder="0" seamless>
                    </iframe>
                </div>
            </p>


            <div class="container">
                <div class="calender">
                    <div class='nav'>
                        <span>
                            <a href='calenderLoop.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>'><i class="fa-solid fa-chevron-left"></i></a>
                        </span>
                        <span>
                        <a href="calenderLoop.php" style="text-decoration:none;"><?= $year . '年' . $month . '月'; ?></a>
                        </span>
                        <span>
                            <a href='calenderLoop.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>'><i class="fa-solid fa-chevron-right"></i></a>
                        </span>
                    </div>


                    <div class="header">
                        <div class='headerItem'>日</div>
                        <div class='headerItem'>一</div>
                        <div class='headerItem'>二</div>
                        <div class='headerItem'>三</div>
                        <div class='headerItem'>四</div>
                        <div class='headerItem'>五</div>
                        <div class='headerItem'>六</div>
                    </div>


                    <table>
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
                    <footer>
                        <a href="./index.php">回上一頁</a>
                    </footer>
                </div>
            </div>
        </div>
    </section>
</body>

</html>