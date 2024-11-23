<?php
$PHPSESSID = $_GET['PHPSESSID'];
if ($PHPSESSID == "demo") {
    echo '1';
} else {
    session_id($PHPSESSID);
    session_start();
    if (isset($_SESSION['username'])) {
        echo '1';
    } else {
        echo '0';
    }
}