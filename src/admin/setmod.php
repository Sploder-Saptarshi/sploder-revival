<?php
session_start();
$ownerusername = $_SESSION['username'];
if ($ownerusername == "saptarshi12345") {
    $type = $_GET['type'];
    $username = $_GET['username'];
    $db = new PDO('sqlite:../database/members.db');
    $qs = "UPDATE members SET perms=:perms WHERE username=:username";
    $statement = $db->prepare($qs);
    if ($statement->execute([
        ':perms' => $type,
        ':username' => $username
    ])) {
        echo "Permissions changed";
    } else {
        echo "There was an error while changing the permissions";
    }
}