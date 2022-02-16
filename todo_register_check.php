<?php

session_start();
session_regenerate_id(true);

require_once('Base.php');
require_once('Users.php');
require_once('Config.php');
require_once('SafetyUtil.php');

$post = SafetyUtil::sanitize($_POST);

if (!SafetyUtil::isValidToken($post['token'])) {
    $_SESSION['msg']['err'] = Config::MSG_INVALID_PROCESS;
    header('Location:index.php');
    exit;
}

$_SESSION['login'] = $post;

try {
    $db = new Users();

    $ret = $db->addUser($post['email'], $post['pass'], $post['family_name'], $post['first_name']);
    if (!$ret) {
        $_SESSION['msg']['err'] = Config::MSG_USER_DUPLICATE;
        header('Location:index.php');
        exit;
    }

    unset($_SESSION['login']);
    unset($_SESSION['msg']['err']);
    header('Location:todo_login.php');
    exit;
} catch (Exception $e) {
    $_SESSION['msg']['err'] = Config::MSG_EXCEPTION;
    header("Location:todo_error.php");
    exit;
}
