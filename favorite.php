<?php
session_start();
session_regenerate_id(true);
function show_fav(){
    if(isset($_SESSION['favorite'])==true){
        $favorite[]=$_SESSION['favorite'];
    }
    echo $favorite;
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
        <link rel="stylesheet" href="assets/css/heart.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
        <script src="https://kit.fontawesome.com/57b4dccf18.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <br>
        <h2 id="top-title">科目検索システム for 同志社</h2>
        <h1 id="top-title">Do-Search </h1>
        <br>
        <a href='javascript:history.back()' id = 'backbutton_result'>検索結果一覧に戻る</a><br>
        <a href='index.php' id = 'backbutton_index'>検索機能に戻る</a>
        <div class="border col-11" id="main">
            <br>
            <h2><i class="fas fa-heart"></i> お気に入り一覧</h2>
        <?php 
            try{
                show_fav();
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