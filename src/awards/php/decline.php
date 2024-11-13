<?php

include('../../content/logincheck.php');
require_once('../../database/connect.php');
$db = connectToDatabase();
// Check if author is actually the receiver, if not, die
$sql = "SELECT membername FROM awards WHERE id = :id";
$statement = $db->prepare($sql);
$statement->execute([':id' => $_GET['id']]);
$result = $statement->fetchAll();
if ($result[0]['membername'] != $_SESSION['username']) {
    header("Location: ../index.php");
    die();
}
// Delete the award off award_requests
$sql = "DELETE FROM award_requests WHERE id = :id";
$statement = $db->prepare($sql);
$statement->execute([':id' => $_GET['id']]);
header("Location: ../index.php");

