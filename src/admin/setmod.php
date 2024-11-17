<?php
require_once(__DIR__ . "/../database/connect.php");

session_start();
$ownerusername = $_SESSION['username'];
if($ownerusername=="saptarshi12345"){
    $type = $_GET['type'];
    $username = $_GET['username'];
    $db = getSqliteMembers();
    $qs = "UPDATE members SET perms=:perms WHERE username=:username";
    if($db->execute($qs, [
        ':perms'=>$type,
        ':username'=>$username
    ])){
        echo "Permissions changed";
    } else {
        echo "There was an error while changing the permissions";
    }
}
?>
