<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆</title>
    <link rel="stylesheet" href="./css/styleArray.css">
</head>

<body>
    <div class="wrapper">

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
        <!-- 取得月份的參數 -->
        <?php
        if (isset($_GET['month'])) {//isset判斷這個東西裡面有沒有設 0也是有設定
            $month = $_GET['month'];
            $year = $_GET['year'];
            // 判斷1月跟12月 避免跳到0月跟13月
            /* 這個switch...case如果放到if...else外的話
               會造成找不到陣列而出錯*/
            } else {
                $month = date('n'); //取得當前月
            $year = date("Y");//取得當前年
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

        
        echo "要顯示的月份為：" . $year . "年" . $month . "月";
        ?>

       
        <div class="nav">
            <span>
                <a href="index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">上一個月</a>
            </span>
            <span><?= $year . '年' . $month . '月'; ?></span>
            <span>
                <a href="index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">下一個月</a>
            </span>
        </div>

        <!-- 萬年曆內容 -->

        <?php
        // 設定各項參數
        $firstDay = $year . "-" . $month . "-1";//第一天日期
        $firstWeekday = date("w", strtotime($firstDay));//一號是星期幾
        $monthDays = date("t", strtotime($firstDay));//算這個月的總天數
        $lastDay = $year . "-" . $month . "-" . $monthDays;//算這個月的最後一天日期
        $today = date("Y-m-d");//得到今天日期
        $lastWeekday = date("w", strtotime($lastDay));//最後一天是星期幾
        $dateHouse = [];
        $sday = date("md" , strtotime($today));
        $sday == date("md" , strtotime($today));

        for ($i = 0; $i < $firstWeekday; $i++) {
            $dateHouse[] = "";//一號以前印空白
        }

        for ($i = 0; $i < $monthDays; $i++) {
            $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
            //日期函數的年月日 換算成字串 字串印出來以後要+1
            $dateHouse[] = $date;
        }

        for ($i = 0; $i < (6 - $lastWeekday); $i++) {
            $dateHouse[] = "";//最後一天以後印空白
        }

        ?>

        <div class="table">
            <div class='header'>日</div>
            <div class='header'>一</div>
            <div class='header'>二</div>
            <div class='header'>三</div>
            <div class='header'>四</div>
            <div class='header'>五</div>
            <div class='header'>六</div>
            <?php
            foreach ($dateHouse as $k => $day) {

                if ($day == $today) {
                    $hol = 'today';
                } else if ($k % 7 == 0 || $k % 7 == 6) {
                    $hol = 'weekend';
                } else if ($sday = date("md" , strtotime($day))){
                  $hol = 'sday';
                }else{
                    $hol = '';
                }

                // $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : ""; //判定是否為假日
                if (!empty($day)) {
                    $sday = date("md" , strtotime($day)); //每一天都產生一個$sday變數
                    $dayFormat = date("j", strtotime($day));
                    echo "<div class='{$hol}'><div class='festday{$sday}'>{$dayFormat}<br></div></div>";
                } else {
                    echo "<div class='{$hol}'></div>";
                }
            }
            ?>
        </div>
    </div>
  
</body>

</html>