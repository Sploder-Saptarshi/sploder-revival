<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../content/logincheck.php');
session_start();
require_once('../../database/connect.php');
$db = connectToDatabase();
// Check if author is actually the receiver, if not, die
$sql = "SELECT membername FROM award_requests WHERE id = :id";
$statement = $db->prepare($sql);
$statement->execute([':id' => $_GET['id']]);
$result = $statement->fetchAll();
if ($result[0]['membername'] != $_SESSION['username']) {
    echo $result[0]['membername'];
    echo $_SESSION['username'];
    //header("Location: ../index.php");
    die();
}
// Transfer the award off award_requests to awards and remove it from award_requests in only 1 sql query
$sql = "INSERT INTO awards (username, membername, level, category, style, material, icon, color, message) SELECT username, membername, level, category, style, material, icon, color, message FROM award_requests WHERE id = :id";
$statement = $db->prepare($sql);
$statement->execute([':id' => $_GET['id']]);
$sql = "DELETE FROM award_requests WHERE id = :id";
$statement = $db->prepare($sql);
$statement->execute([':id' => $_GET['id']]);
header("Location: ../index.php");

