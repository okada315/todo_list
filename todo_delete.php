<?php

session_start();
session_regenerate_id();

require_once('Config.php');
require_once('Base.php');
require_once('SafetyUtil.php');
require_once('Validation.php');
require_once('TodoItems.php');

if (empty($_SESSION['user'])) {
    header('Location: todo_login.php');
} else {
    $user = $_SESSION['user'];
}

$item_name = $_SESSION['post']['item_name'];
$expire_date = $_SESSION['post']['expire_date'];

$id = $_GET['item_id'];
$name = $_GET['item_name'];
$token = SafetyUtil::generateToken();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>削除確認</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">TODOリスト</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="todo_index.php">作業一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="todo_entry.php">作業登録 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $user['family_name'] . $user['first_name'] ?>さん
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="todo_logout.php">ログアウト</a>
                    </div>
                </li>
            </ul>
            
        </div>
    </nav>
  
    <div class="container">
        <div class="row my-2 justify-content-center">
            <div class="col-sm-6 alert alert-info">
                下記の項目を削除します。よろしいですか？
            </div>
        </div>

        <div class="row my-2 justify-content-center">
            <div class="col-sm-6">
                <form action="todo_delete_check.php" method="post">
                    <input type="hidden" name="token" value="<?= $token ?>">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="item_name">項目名</label>
                        <p name="item_name" id="item_name" class="form-control"><?= $name ?></p>
                    </div>
                    <div class="form-group">
                        <label for="expire_date">期限</label>
                        <p class="form-control" id="expire_date" name="expire_date"><?= $expire_date ?>
                    </div>

                    <input type="submit" value="削除" class="btn btn-danger">
                    <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='todo_index.php';">
                </form>
            </div>
        </div>

    </div>

    <script src="jquery-3.4.1.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

</body>

</html>