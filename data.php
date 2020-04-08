<?php

try{
    $rec = get_record();
    $subject_year = $_GET['course'];
    $subject_semester = $rec['semester'];
    $subject_name = $rec['name'];
    $subject_registers = $rec['registers'];
    $subject_a = $rec['a'];
    $subject_b = $rec['b'];
    $subject_c = $rec['c'];
    $subject_d = $rec['d'];
    $subject_f = $rec['f'];
    // floatvalで浮動小数点に変換
    $per_get_credit = floatval($subject_a) + floatval($subject_b) + floatval($subject_c) + floatval($subject_d);

    $pdo = null;
}
catch(PDOException $e){
    print 'ただいま通信障害により大変ご迷惑をおかけしております。';
    exit();
}

function get_record(){
    $course = $_GET['course'];
    $subject_code = $_GET['code'];
    
    $sql = "SELECT semester,name,registers,a,b,c,d,f FROM $course WHERE code=?";

    require_once('config/database.php');
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$username","$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare($sql);
    $data[] = $subject_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    return $rec;
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Do-Search</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <canvas id="myBarChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>

<body>

年度:<?php print h($subject_year) ?><br>
科目名:<?php print h($subject_name) ?><br>
<?php print h($subject_semester) ?>学期<br>
登録者数:<?php print h($subject_registers) ?><br>
単位取得率:<?php print h($per_get_credit) ?>%<br>
A:<?php print h($subject_a) ?>%,
B:<?php print h($subject_b) ?>%,
C:<?php print h($subject_c) ?>%,
D:<?php print h($subject_d) ?>%,
F:<?php print h($subject_f) ?>%<br>
<a href='result.php' id = 'backbutton_result'>検索結果一覧に戻る</a>
<a href='index.php' id = 'backbutton_index'>検索機能に戻る</a>

<script>
    var subject_name = '<?php echo h($subject_name); ?>';
    var subject_semester = '<?php echo h($subject_semester); ?>';
    var subject_registers = '<?php echo h($subject_registers); ?>';
    var subject_a = '<?php echo h($subject_a); ?>';
    var subject_b = '<?php echo h($subject_b); ?>';
    var subject_c = '<?php echo h($subject_c); ?>';
    var subject_d = '<?php echo h($subject_d); ?>';
    var subject_f = '<?php echo h($subject_f); ?>';

    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D', 'F'],
            datasets: [
                {
                    label: '',
                    data: [subject_a, subject_b, subject_c, subject_d, subject_f],
                    backgroundColor: ["rgba(242,53,19,0.5)","rgba(255,114,38,0.5)","rgba(149,255,20,0.5)","rgba(30,19,240,0.5)","rgba(159,5,242,0.5)"]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: subject_name+'の成績データ'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 100,
                        suggestedMin: 0,
                        stepSize: 10.0,
                        callback: function(value, index, values){
                            return value + '%'
                        }
                    }
                }]
            },
            legend: {
                // グラフ図の頭上にある凡例を非表示にする
                display: false
            }
        }
    });
</script>
</body>