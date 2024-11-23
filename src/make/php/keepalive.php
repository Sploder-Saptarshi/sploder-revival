<?php
session_Start();
if (isset($_SESSION['username'])) {
    $t = time();
    include('../../database/connect.php');
    $db = connectToDatabase();
    $qs = "UPDATE members SET lastlogin=:t WHERE username=:username";
    $statement = $db->prepare($qs);
    $statement->execute([':t' => $t,
        ':username' => $_SESSION['username']
    ]);
    $qs = "UPDATE members SET status='creating' WHERE username=:username";
    $statement = $db->prepare($qs);
    $statement->execute([':username' => $_SESSION['username']
    ]);
    echo "keepalive=1";
} else {
    echo "keepalive=0";
}