<?php
session_Start();
if (isset($_SESSION['username'])) {
    $t = time();
    $status = $_GET['status'];
    if (!isset($status)) {
        $status = "online";
    }
    include_once('../database/connect.php');
    $db = connectToDatabase('members');
    $qs = "UPDATE members SET lastlogin=:t, status=:status WHERE username=:username";
    $statement = $db->prepare($qs);
    $statement->execute([
        ':t' => $t,
        ':username' => $_SESSION['username'],
        ':status' => $status
    ]);
}