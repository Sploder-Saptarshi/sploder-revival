<?php

include('verify.php');
$username = $_POST['username'];
$reason = $_POST['reason'];
$banned_by = $_SESSION['username'];
$bandate = time();
$autounbandate = time() + $_POST['time'] * 24 * 60 * 60;


// Check whether the user exists
$sql = "SELECT COUNT(*) FROM members WHERE username=:username";
$statement = $db_old->prepare($sql);
$statement->execute([':username' => $username
]);
$count = $statement->fetchColumn();
if ($count == 0) {
    header("Location: ../index.php?err=User does not exist");
    die();
}

// Check whether user banned is not a moderator
$sql = "SELECT perms FROM members WHERE username=:username";
$statement = $db_old->prepare($sql);
$statement->execute([':username' => $username
]);
$perms = $statement->fetch();
if (str_contains($perms['perms'], 'M')) {
    header("Location: ../index.php?err=You cannot ban a moderator");
    die();
}

// Check whether user is already banned

include(__DIR__ . '/../../../content/checkban.php');
if (checkBan($username)) {
    header("Location: ../index.php?err=User is already banned");
    die();
}

$sql = "INSERT INTO banned_members (username, banned_by, reason, bandate, autounbandate) VALUES (:username, :banned_by, :reason, :bandate, :autounbandate)";
$statement = $db_old->prepare($sql);
if ($statement->execute([
    ':username' => $username,
    ':banned_by' => $banned_by,
    ':reason' => $reason,
    ':bandate' => $bandate,
    ':autounbandate' => $autounbandate
])) {
    include('log.php');
    logModeration('banned', $username . ' for ' . $_POST['time'] . " days because of " . $reason, 3);
    header("Location: ../index.php?msg=User banned successfully");
} else {
    header("Location: ../index.php?err=There was an error while banning the user");
}