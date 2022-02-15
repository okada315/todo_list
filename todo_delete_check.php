<?php

session_start();
session_regenerate_id();

require_once('Config.php');
require_once('Base.php');
require_once('SafetyUtil.php');
require_once('Validation.php');
require_once('TodoItems.php');

$post = SafetyUtil::sanitize($_POST);

if (!SafetyUtil::isValidToken($post['token'])) {
    $_SESSION['msg']['err'] = Config::MSG_INVALID_PROCESS;
    header('Location: todo_login.php');
    exit;
}

$_SESSION['post'] = $post;
$_SESSION['post']['finished'] = !empty($post['finished']) ? $post['finished'] : null;

$id = $post['id'];

try {

    $db = new TodoItems();
    $db->deleteTodoItemById($id);

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
