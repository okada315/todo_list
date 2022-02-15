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
    header('Location:todo_login.php');
    exit;
}

if (isset($_SESSION['login_failure']) && $_SESSION['login_failure'] >= 3) {
    $_SESSION['msg']['err'] = Config::MSG_USER_LOGIN_TRY_TIMES_OVER;
    header('Location:todo_error.php');
    exit;
}

$_SESSION['login'] = $post;

try {

    $db = new Users();

    $user = $db->getUser($post['email'], $post['pass']);

    if (empty($user)) {
        if (isset($_SESSION['login_failure'])) {
            $_SESSION['login_failure']++;
        } else {
            $_SESSION['login_failure'] = 1;
        }

        $_SESSION['msg']['err'] = Config::MSG_USER_LOGIN_FAILURE;
        header('Location: todo_login.php');
        exit;
    }

    unset($_SESSION['login_failure']);

    $_SESSION['user'] = $user;

    unset($_SESSION['msg']['err']);
    header('Location: todo_index.php');
    exit;
   
} catch (Exception $e) {
    
    $_SESSION['msg']['err'] = Config::MSG_EXCEPTION;
    header("Location:todo_error.php");
    exit;
}
