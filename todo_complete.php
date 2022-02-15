<?php

session_start();
session_regenerate_id();

require_once('Config.php');
require_once('Base.php');
require_once('SafetyUtil.php');
require_once('Validation.php');
require_once('TodoItems.php');

if (!SafetyUtil::isValidToken($_POST['token'])) {
    $_SESSION['msg']['err'] = Config::MSG_INVALID_PROCESS;
    header('Location: todo_login.php');
    exit;
}

try {
    $db = new TodoItems(); 
    $db->makeTodoItemComplete($_POST['item_id']);
   
    header('Location: todo_index.php');
} catch (Exception $e) {
    header('Location: todo_error.php');
    exit;
}