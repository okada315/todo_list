<?php

session_start();
session_regenerate_id();

require_once('Config.php');
require_once('Base.php');
require_once('SafetyUtil.php');
require_once('Validation.php');
require_once('TodoItems.php');

$post = SafetyUtil::sanitize($_POST);

if(!SafetyUtil::isValidToken($post['token'])) {
    $_SESSION['msg']['err'] = Config::MSG_INVALID_PROCESS;
    header('Location: todo_login.php');
    exit;
}

$_SESSION['post'] = $post;
$_SESSION['post']['finished'] = !empty($post['finished']) ? $post['finished'] : null;

if ($post['item_name'] == '') {
    $_SESSION['msg']['error'] = "項目名を入力してください。";
    header("Location: todo_edit.php");
    exit;
}

if (!Validation::isValidItemName($post['item_name'])) {
    $_SESSION['msg']['error'] = "項目名は100文字以下にしてください。";
    header("Location: todo_edit.php");
    exit;
}

if (!Validation::isDate($post['expire_date'])) {
    $_SESSION['msg']['error'] = "期限日の日付が正しくありません。";
    header("Location: todo_edit.php");
    exit;
}

if (!empty($post['finished']) && $post['finished'] != 1) {
    $_SESSION['msg']['error'] = "完了のチェックボックスの値が正しくありません。";
    header("Location: todo_edit.php");
    exit;
}

$_SESSION['msg']['error'] = '';

$data = array(
    'id' => $post['id'],
    'item_name' => $post['item_name'],
    'registration_date' => date('Y-m-d'),
    'expire_date' => $post['expire_date'],
    'finished_date' => isset($post['finished']) && $post['finished'] == 1 ? date('Y-m-d') : null,
);
    
try {

    $db = new TodoItems();
    $db->updateTodoItemById($data);
    
    unset($_SESSION['login']);
    unset($_SESSION['msg']['err']);
    
    header('Location: todo_index.php');
    exit;

} catch (Exception $e) {
var_dump($e);
exit;
    header('Location: todo_error.php');
    exit;
}