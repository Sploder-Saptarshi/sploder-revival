<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$u = mb_strtolower($_GET['u']);
$db = new PDO('sqlite:../database/originalmembers.db');
#$qs = "UPDATE sploder SET isprivate=" . $isprivate . " WHERE g_id = " . $id;
$qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':user' => mb_strtolower($u)
    ]
);

$result2 = $statement2->fetchAll();
include_once('../database/connect.php');
$db = connectToDatabase('members');
#$qs = "UPDATE sploder SET isprivate=" . $isprivate . " WHERE g_id = " . $id;
$qs2 = "SELECT username FROM members WHERE username=:user LIMIT 1";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':user' => $u
    ]
);
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
        $status = file_get_contents('../images/alert.png');
    } elseif ($status == "green") {
        $length = strlen($u);
        if ((2 < $length) && ($length < 17) && (ctype_alnum($u))) {
            $status = file_get_contents('../images/check.png');
        } else {
            $status = file_get_contents('../images/ex.png');
        }
    }
} else {
    $status = file_get_contents('../images/ex.png');
}
echo $status;