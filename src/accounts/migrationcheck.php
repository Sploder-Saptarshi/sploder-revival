<?php
session_Start();
session_destroy();
session_Start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
$u = mb_strtolower($_POST['username']);
$db = new PDO('sqlite:../database/originalmembers.db');
#$qs = "UPDATE sploder SET isprivate=" . $isprivate . " WHERE g_id = " . $id;
$qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
$statement2 = $db->prepare($qs2);
$statement2->execute([':user' => $u]);

$result2 = $statement2->fetchAll();
include_once('../database/connect.php');
$db = connectToDatabase('members');
#$qs = "UPDATE sploder SET isprivate=" . $isprivate . " WHERE g_id = " . $id;
$qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
$statement2 = $db->prepare($qs2);
$statement2->execute([':user' => $u]);
$result3 = $statement2->fetchAll();
if (isset($result3[0]['username'])) {
    $status1 = "cant";
} else {
    $status1 = "can";
}
if ($status1 == "can") {
    if (isset($result2[0]['username'])) {
        $status = "alert";
    } else {
        $status = "green";
    }
    if ($status == "alert") {
        require __DIR__ . "/functions.php";
        require __DIR__ . "/discord.php";
        require __DIR__ . "/config.php";
        $auth_url = url($client_id, $redirect_url, $scopes);
        $_SESSION['enteredusername'] = $u;
        header('Location: ' . $auth_url);
    } elseif ($status == "green") {
        $length = strlen($u);
        if ((2 < $length) && ($length < 17) && (ctype_alnum($u))) {
            header('Location: registerpassword.php');
            $_SESSION['usermigrate'] = "false";
            $_SESSION['enteredusername'] = $u;
        } else {
            header('Location: register.php?err=inv');
        }
    }
} else {
    header('Location: register.php?err=acc');
}