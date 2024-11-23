<?php
if ($_GET['PHPSESSID'] != "demo") {
    session_id($_GET['PHPSESSID']);
    session_start();
    $user_id = $_SESSION['userid'];
    $g_id = (int)filter_var($_GET['p'], FILTER_SANITIZE_NUMBER_INT);
    $xml = file_get_contents("../users/user" . $user_id . "/projects/proj" . $g_id . "/unpublished.xml");
    echo $xml;
} else header('HTTP/1.0 404 Not Found');