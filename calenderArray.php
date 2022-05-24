<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="./css/styleArray.css">
</head>

<body>
    <script src="https://kit.fontawesome.com/448aedbc21.js" crossorigin="anonymous"></script>
    <div class="wrapper">


        <!-- 取得月份的參數 -->
        <?php
        if (isset($_GET['month'])) { //isset判斷這個東西裡面有沒有設 0也是有設定
            $month = $_GET['month'];
            $year = $_GET['year'];
            // 判斷1月跟12月 避免跳到0月跟13月
            /* 這個switch...case如果放到if...else外的話
               會造成找不到陣列而出錯*/
        } else {
            $month = date('n'); //取得當前月
            $year = date("Y"); //取得當前年
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


        // echo "要顯示的月份為：" . $year . "年" . $month . "月";




        // 設定各項參數
        $firstDay = $year . "-" . $month . "-1"; //第一天日期
        $firstWeekday = date("w", strtotime($firstDay)); //一號是星期幾
        $monthDays = date("t", strtotime($firstDay)); //算這個月的總天數
        $lastDay = $year . "-" . $month . "-" . $monthDays; //算這個月的最後一天日期
        $today = date("Y-m-d"); //得到今天日期
        $lastWeekday = date("w", strtotime($lastDay)); //最後一天是星期幾
        $dateHouse = [];
        $sday = date("md", strtotime($today));
        $sday == date("md", strtotime($today));

        for ($i = 0; $i < $firstWeekday; $i++) {
            $dateHouse[] = ""; //一號以前印空白
        }

        for ($i = 0; $i < $monthDays; $i++) {
            $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
            //日期函數的年月日 換算成字串 字串印出來以後要+1
            $dateHouse[] = $date;
        }

        for ($i = 0; $i < (6 - $lastWeekday); $i++) {
            $dateHouse[] = ""; //最後一天以後印空白
        }

        ?>


        <!-- 標題動畫 -->

        <div class="topic">
            <span style="--i:1">用</span>
            <span style="--i:2">陣</span>
            <span style="--i:3">列</span>
            <span style="--i:4">方</span>
            <span style="--i:5">法</span>
            <span style="--i:6">製</span>
            <span style="--i:7">作</span>
            <span style="--i:8">萬</span>
            <span style="--i:9">年</span>
            <span style="--i:10">曆</span>
        </div>


        <!-- 查詢 -->
        <aside class="input">
        <form action="./calenderArray.php" method="get">
        <h1 class="typein">輸入年份和月分</h1>

        <div class="text">
          年份: <input type="text" name="year" style="font-size: 30px;width:200px;" value="" placeholder="輸入年分">
          月分: <select name="month" id="" style="font-size: 30px;" aria-placeholder="0">
            <option value="0">請選擇</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
        </div>
        <div class="button">
          <p style="margin: 30px;"><input type="submit" value="查詢" ></p>

          <p style="margin: 30px;"><input type="reset" value="清空" ></p>
        </div>
      </form>
        </aside>

        <!-- 萬年曆開始 -->

        <div class="blackboard">


            <div class='nav'>
                <span>
                    <a href='calenderArray.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>' style="color: red;"><i class="fa-solid fa-chevron-left"></i></a>
                </span>
                <span>
                    <a href="calenderArray.php" style="text-decoration:none;"><?= $year . '年' . $month . '月'; ?></a>
                </span>
                <span>
                    <a href='calenderArray.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>' style="color: red;"><i class="fa-solid fa-chevron-right"></i></a>
                </span>
            </div>

            <div class="calender">
                <div class='header'>SUN</div>
                <div class='header'>MON</div>
                <div class='header'>TUE</div>
                <div class='header'>WED</div>
                <div class='header'>THU</div>
                <div class='header'>FRI</div>
                <div class='header'>SAT</div>
                <?php
                foreach ($dateHouse as $k => $day) {

                    if ($day == $today) {
                        $hol = 'today';
                    } else if ($k % 7 == 0 || $k % 7 == 6) {
                        $hol = 'weekend';
                    } else if ($sday = date("md", strtotime($day))) {
                        $hol = 'sday';
                    } else {
                        $hol = '';
                    }

                    // $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : ""; //判定是否為假日
                    if (!empty($day)) {
                        $sday = date("md", strtotime($day)); //每一天都產生一個$sday變數
                        $dayFormat = date("j", strtotime($day));
                        echo "<div class='{$hol}'><div class='festday{$sday}'>{$dayFormat}<br></div></div>";
                    } else {
                        echo "<div class='{$hol}'></div>";
                    }
                }
                ?>
            </div>
            <p><a href="./index.php" style="color: #fff; font-size:20px">回上一頁</a></p>
        </div>
        <!-- 圖片 -->
        <aside class="img">
            <img src="./img/month<?= rand(01, 24) ?>.jpg" alt="">
        </aside>
    </div>

</body>

</html>