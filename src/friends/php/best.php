<?php
session_start();

include('../../database/connect.php');
$db = connectToDatabase('friends');
$qs2 = "UPDATE friends SET bested=true WHERE (user1=:sender_id AND user2=:receiver_id)";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':sender_id' => $_SESSION['username'],
        ':receiver_id' => $_GET['u']
    ]
);
include("../../content/webhook.php");
log_data("Friend Bested", $_SESSION['username'] . " has bested " . $_GET['u'], 1);

header('Location: ../index.php');