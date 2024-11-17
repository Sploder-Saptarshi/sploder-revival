<?php
require_once(__DIR__ . "/../database/connect.php");

$ownerusername = $_SESSION['username'];
if($ownerusername=="saptarshi12345"){
    $type = $_GET['amt'];
    $username = $_GET['username'];
    $db = getSqliteMembers();
    $qs = "UPDATE members SET boostpoints=:perms WHERE username=:username";
    if($db->execute($qs, [
        ':perms'=>$type,
        ':username'=>$username
    ])){
        echo "Boost points changed";
    } else {
        echo "There was an error while changing the boost points";
    }
}
?>
