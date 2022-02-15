<?php
session_start();
session_regenerate_id();

require_once('Config.php');
require_once('SafetyUtil.php');
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">TODOリスト</span>
    </nav>
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3"></div>
        </div>
        <?php if (isset($_SESSION['msg']['err'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['msg']['err'] ?>
            </div>
            <?php endif ?>
        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form action="todo_register_check.php" method="post">
                    <input type="hidden" name="token" value="<?= SafetyUtil::generateToken() ?>">
                    <div class="form-group">
                        <label for="family_name">姓</label>
                        <input type="text" name="family_name" value="<?php if (isset($_SESSION['login']['family_name'])) echo $_SESSION['login']['family_name'] ?>" class="form-control" id="family_name">
                    </div>
                    <div class="form-group">
                        <label for="first_name">名</label>
                        <input type="text" name="first_name" value="<?php if (isset($_SESSION['login']['first_name'])) echo $_SESSION['login']['first_name'] ?>" class="form-control" id="first_name">
                    </div>
                    <div class="form-group">
                        <label for="email">ユーザー名(Email)</label>
                        <input type="text" name="email" value="<?php if (isset($_SESSION['login']['email'])) echo $_SESSION['login']['email'] ?>" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pass">パスワード</label>
                        <input type="password" name="pass" class="form-control" id="pass">
                    </div>
                    <button type="submit" class="btn btn-primary">登録</button>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>