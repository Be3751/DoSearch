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

<?php
include_once('config/database.php');

try{
    // if(isset($_GET['code']) and isset($_GET['name'])){
    //     $sql = "SELECT semester,registers,a,b,c,d,f FROM theology WHERE code=? AND name=? ";
    // }
    if(isset($_GET['code'])){
        $subject_code = $_GET['code'];
        $sql = "SELECT semester,name,registers,a,b,c,d,f FROM theology WHERE code=? ";
    }
    else if(isset($_GET['name'])){
        $subject_name = $_GET['name'];
        $sql = "SELECT code,semester,registers,a,b,c,d,f FROM theology WHERE name=? ";
    }

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$username","$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare($sql);
    $data[] = $subject_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $subject_semester = $rec['semester'];
    $subject_name = $rec['name'];
    $subject_registers = $rec['registers'];
    $subject_a = $rec['a'];
    $subject_b = $rec['b'];
    $subject_c = $rec['c'];
    $subject_d = $rec['d'];
    $subject_f = $rec['f'];

    $pdo = null;
}
catch(PDOException $e){
    print 'ただいま通信障害により大変ご迷惑をおかけしております。';
    exit();
}
?>

科目名<br>
<?php print $subject_name ?><br>
<?php print $subject_semester ?><br>
<?php print $subject_registers ?><br>
<?php print $subject_a ?>,
<?php print $subject_b ?>,
<?php print $subject_c ?>,
<?php print $subject_d ?>,
<?php print $subject_f ?><br>
<a href='index.php'>検索画面に戻る</a>

<script>
    var subject_name = '<?php echo htmlspecialchars($subject_name, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_semester = '<?php echo htmlspecialchars($subject_semester, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_registers = '<?php echo htmlspecialchars($subject_registers, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_a = '<?php echo htmlspecialchars($subject_a, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_b = '<?php echo htmlspecialchars($subject_b, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_c = '<?php echo htmlspecialchars($subject_c, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_d = '<?php echo htmlspecialchars($subject_d, ENT_QUOTES, 'UTF-8'); ?>';
    var subject_f = '<?php echo htmlspecialchars($subject_f, ENT_QUOTES, 'UTF-8'); ?>';

    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['A', 'B', 'C', 'D', 'F'],
            datasets: [
                {
                    label: 'あいうえお',
                    data: [subject_a, subject_b, subject_c, subject_d, subject_f],
                    backgroundColor: "rgba(219,39,91,0.5)"
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
            }
        }
    });
</script>
</body>