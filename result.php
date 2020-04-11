<?php
function get_record($course ,$subject_code, $subject_name){
    // コードと名前の両方が入力された際は、コードを優先すればよい
    // PDO::prepare→PDOStatement::bindValue→PDOStatement::executeの3ステップでクエリを実行
    if($subject_code!=''){
        
        $sql = "SELECT * FROM $course WHERE code LIKE :code ";

        require_once('config/database.php');
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$username","$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':code', '%'.$subject_code.'%', PDO::PARAM_STR);
    }
    if($subject_name!=''){
        $sql = "SELECT * FROM $course WHERE name LIKE :name ";

        require_once('config/database.php');
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$username","$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', '%'.$subject_name.'%', PDO::PARAM_STR);
    }
    $stmt->execute();

    $pdo = null;

    return $stmt;
}
function make_datalist($course, $stmt){
    while($record = $stmt->fetch()){
        echo '<div class="border row col-11 items">';
        echo '<div class="col-md-10">';
        echo '<br>';
        echo '<div class="col-md-10">';
        echo '<h4>'.$record['name'].'</h4>';
        echo '科目コード:'.$record['code'].'<br>';
        echo '単位取得率:'.$record['get_point'].'%<br>';
        echo '<form method="get" action="data.php">';
        echo '<input type="hidden" name="code" value="'.$record['code'].'">';
        echo '<input type="hidden" name="course" value="'.$course.'">';
        echo '<input type="submit" value="詳細を見る">';
        echo '</form>';
        echo '</div>';
        echo '<br>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
    }
}
function show_data(){
    header('Location:data.php');
    exit();
}
function sort_get_point($order){
    if($order==''){

    }
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
        <link rel="stylesheet" href="assets/css/result.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    </head>

    <body>
        <br>
        <h2 id="top-title">科目検索システム for 同志社</h2>
        <h1 id="top-title">Do-Search </h1>
        <br>
        <a href='index.php' id = 'backbutton'>検索画面に戻る</a>
        <div class="border col-11" id="main">
            <br>
            <h2><i class="fas fa-search"></i> 検索結果一覧</h2>
        <?php 
            try{
                $subject_year = $_GET['year'];
                if(isset($_GET['course'])){
                    switch($_GET['course']){
                        case '神学部':
                            $course = 'theology'.$subject_year;
                            break;
                        case '文学部':
                            $course = 'literature'.$subject_year;
                            break;
                        case '法学部':
                            $course = 'law'.$subject_year;
                            break;
                        case '経済学部':
                            $course = 'economics'.$subject_year;
                            break;
                        case '商学部':
                            $course = 'commerce'.$subject_year;
                            break;
                        case '政策学部':
                            $course = 'policy'.$subject_year;
                            break;
                        case '文化情報学部':
                            $course = 'culture_info'.$subject_year;
                            break;
                        case '社会学部':
                            $course = 'social'.$subject_year;
                            break;
                        case '生命医科学部':
                            $course = 'biology'.$subject_year;
                            break;
                        case 'スポーツ健康科学部':
                            $course = 'sport'.$subject_year;
                            break;
                        case '理工学部':
                            $course = 'engineering'.$subject_year;
                            break;
                        case '心理学部':
                            $course = 'psychology'.$subject_year;
                            break;
                        case 'グローバル・コミュニケーション学部':
                            $course = 'glo_com'.$subject_year;
                            break;
                        case 'グローバル＿地域文化学部':
                            $course = 'glo_rigion'.$subject_year;
                            break;
                        case '一般教養科目':
                            $course = 'general'.$subject_year;
                            break;
                        case '保健体育科目':
                            $course = 'health'.$subject_year;
                            break;
                        case '外国語科目':
                            $course = 'language'.$subject_year;
                            break;
                    }
                }
                if(isset($_GET['code'])){
                    $subject_code = $_GET['code'];
                }
                if(isset($_GET['name'])){
                    $subject_name = $_GET['name'];
                }
                
                $stmt = get_record($course, $subject_code, $subject_name);
                
                $count = $stmt->rowCount();
                echo '<h3>'.$subject_year.'年度 '.$count.'件</h3>';
                make_datalist($course ,$stmt);
            }
            catch(PDOException $e){
                print '接続に失敗しました。';
                exit();
            }
        ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>