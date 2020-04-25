<?php
session_start();
session_regenerate_id(true);
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Do-Search</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
</head>
 
<body>
<br>
    <h2 id="top-title">科目検索システム for 同志社</h2>
    <h1 id="top-title">Do-Search </h1>
    <br>
    <a href='favorite.php'>お気に入り一覧を見る</a>
    <br>
    <div class="border col-11" id="main">
        <br>
        <h2><i class="fas fa-search"></i> データ検索</h2>
        <br>
        <div class="row">
            <div class="col-md">
                <form action='result.php' method="get">
                    <div class="form-group">
                        <label>年度：</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="year">
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>学部：</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="course">
                            <option>神学部</option>
                            <option>文学部</option>
                            <option>法学部</option>
                            <option>経済学部</option>
                            <option>商学部</option>
                            <option>政策学部</option>
                            <option>文化情報学部</option>
                            <option>社会学部</option>
                            <option>生命医科学部</option>
                            <option>スポーツ健康科学部</option>
                            <option>理工学部</option>
                            <option>心理学部</option>
                            <option>グローバル・コミュニケーション学部</option>
                            <option>グローバル地域言語学部</option>
                            <option>一般教養科目</option>
                            <option>保健体育科目</option>
                            <option>外国語科目</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>科目コード：</label>
                        <input type="text" class="form-control" placeholder="01234567" name="code">
                    </div>
                    <div class="form-group">
                        <label>科目名：</label>
                        <input type="text" class="form-control" placeholder="あいうえお" name="name">
                    </div>
                    <div class="row center-block text-center">
                        <div class="col-1">
                        </div>
                        <div class="col-5">
                            <input type="submit" class="btn btn-outline-primary btn-block" value="検索">
                        </div>
                        <div class="col-5">
                            <input type="reset" class="btn btn-outline-secondary btn-block" value="クリア">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
 
</html>