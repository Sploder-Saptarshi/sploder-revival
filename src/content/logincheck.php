<?php
session_start();
if (!isset($_SESSION['username'])) {
    session_destroy();
    header('Location: /accounts/login.php');
}