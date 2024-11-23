<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../database/connect.php');
$db = connectToDatabase();
$time = time();
$last = $time - 30;
$pagechange = $time - 900;
$qs2 = "SELECT lastlogin,lastpagechange,status FROM members WHERE username=:username";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':username' => $_GET['u']
    ]
);
$result3 = $statement2->fetchAll();
if ($result3[0]['lastlogin'] < $last) {
    $status = "offline";
} elseif ($result3[0]['status'] == "online") {
    if ($result3[0]['lastpagechange'] > $pagechange) {
        $status = "online";
    } else {
        $status = "idle";
    }
} elseif ($result3[0]['status'] == "creating") {
    $status = "making";
} elseif ($result3[0]['status'] == "playing") {
    $status = "playing";
}
echo file_get_contents('../images/profile_status_' . $status . '.gif');