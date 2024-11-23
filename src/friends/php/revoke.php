<?php
session_start();
include('../../database/connect.php');
$db = connectToDatabase('friend_requests');
$qs2 = "DELETE FROM friend_requests WHERE sender_id=:sender_id AND receiver_username = :receiver_username";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':receiver_username' => $_GET['u'],
        ':sender_id' => $_SESSION['userid']
    ]
);
include("../../content/webhook.php");
log_data("Friend Request Revoked", $_SESSION['username'] . " has revoked a friend request to " . $_GET['u'], 1);

header('Location: ../index.php')