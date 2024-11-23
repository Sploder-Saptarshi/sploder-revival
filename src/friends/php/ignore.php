<?php
session_start();
include('../../database/connect.php');
$db = connectToDatabase('friend_requests');

$qs2 = "DELETE FROM friend_requests WHERE (sender_username=:sender_id AND receiver_username = :receiver_username) OR (receiver_username=:sender_id AND sender_username = :receiver_username)";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':receiver_username' => $_GET['u'],
        ':sender_id' => $_SESSION['username']
    ]
);
include("../../content/webhook.php");
log_data("Friend Request Ignored", $_SESSION['username'] . " has ignored " . $_GET['u'] . "'s friend request", 1);

header('Location: ../index.php');