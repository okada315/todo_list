<?php

session_start();
session_regenerate_id();

if (empty($_SESSION['user'])) {
    header('Location: todo_login.php');
} else {
    $user = $_SESSION['user'];
}

require_once('Config.php');
require_once('Base.php');
require_once('TodoItems.php');
require_once('SafetyUtil.php');

$id = $_SESSION['user']['id'];

try {
    $db = new TodoItems();
    $items = $db->getTodoItemById($id);
    
} catch (Exception $e) {
    $_SESSION['msg']['err'] = Config::MSG_EXCEPTION;
    header('Location: todo_error.php');
    exit;
}

$token = SafetyUtil::generateToken();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>作業一覧</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        form {
            display: inline-block;
        }

        tr.del>td {
            text-decoration: line-through;
        }

        tr.del>td.button {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">TODOリスト</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="todo_index.php">作業一覧 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="todo_entry.php">作業登録</a>
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

        <table class="table table-striped table-hover table-sm my-2">
            <thead>
                <tr>
                    <th scope="col">項目名</th>
                    <th scope="col">登録日</th>
                    <th scope="col">期限日</th>
                    <th scope="col">完了日</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>

            <tbody>
                <?php
                
                foreach ($items as $item) {
                    if ($item['expire_date'] < date('Y-m-d') && is_null($item['finished_date'])) {
                        $class = ' class="text-danger"';
                    } elseif (!is_null($item['finished_date'])) {
                        $class = ' class="del"';
                    } else {
                        $class = '';
                    }
                ?>
                    <tr<?= $class ?>>
                        <td class="align-middle">
                            <?= $item['item_name'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $item['registration_date'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $item['expire_date'] ?>
                        </td>
                        <td class="align-middle">
                            <?php
                            if (empty($item['finished_date'])) {
                                print '未';
                            } else {
                                print $item['finished_date'];
                            }
                            ?>
                        </td>
                        <td class="align-middle button">
                            <form action="todo_complete.php" method="post" class="my-sm-1">
                                <input type="hidden" name="token" value="<?= $token ?>">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                <button class="btn btn-primary my-0" type="submit">完了</button>
                            </form>
                            <a href="todo_edit.php?item_id=<?= $item['id'] ?> & item_name=<?= $item['item_name'] ?>" class="btn btn-success my-0">修正</a>
                            <a href="todo_delete.php?item_id=<?= $item['id'] ?> & item_name=<?= $item['item_name'] ?>" class="btn btn-danger my-0">削除</a>
                        </td>
                        </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>

    </div>

    <script src="jquery-3.4.1.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

</body>

</html>