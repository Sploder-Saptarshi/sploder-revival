<?php

include('verify.php');
$username = $_REQUEST['username'];

include(__DIR__ . '/../../../content/checkban.php');
if (!checkBan($username)) {
    header("Location: ../index.php?err=User not banned");
    die();
}

$sql = "DELETE FROM banned_members WHERE username=:username";
$statement = $db_old->prepare($sql);
if ($statement->execute([
    ':username' => $username,
])) {
    include('log.php');
    logModeration('unbanned', $username, 1);
    header("Location: ../index.php?msg=User unbanned successfully");
} else {
    header("Location: ../index.php?err=There was an error while unbanning the user");
}