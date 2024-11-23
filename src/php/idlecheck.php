<?php
session_Start();
if (isset($_SESSION['username'])) {
    $t = time();
    include_once('../database/connect.php');
    $db = connectToDatabase('members');
    $qs = "UPDATE members SET lastpagechange=:t WHERE username=:username";
    $statement = $db->prepare($qs);
    $statement->execute([':t' => $t,
        ':username' => $_SESSION['username']
    ]);
}