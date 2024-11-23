<?php
include('../../content/logincheck.php');
include('../../database/connect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
$username = $_GET['username'];
$db = connectToDatabase('friends');
$qs2 = "SELECT id FROM friends WHERE (user1=:sender_id AND user2=:receiver_id)";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':sender_id' => $_SESSION['username'],
        ':receiver_id' => $username

    ]
);
$exists = $statement2->fetchAll();

if (!isset($exists[0]['id'])) {
    $db = connectToDatabase('members');
    $qs2 = "SELECT userid FROM members WHERE username=:user";
    $statement2 = $db->prepare($qs2);
    $statement2->execute(
        [
            ':user' => $username
        ]
    );
    $receiver = $statement2->fetchAll();
    if (isset($receiver[0]['userid'])) {
        print_r($receiver);
        $receiver = $receiver[0]['userid'];
    } else {
        header('Location: ../index.php?err=no');
        exit;
    }
    $db = connectToDatabase('friend_requests');
    $qs2 = "SELECT request_id FROM friend_requests WHERE (sender_username=:sender_id AND receiver_username = :receiver_id) OR ((receiver_username=:sender_id AND sender_username = :receiver_id))";
    $statement2 = $db->prepare($qs2);
    $statement2->execute(
        [
            ':receiver_id' => $username,
            ':sender_id' => $_SESSION['username']
        ]
    );
    $exists = $statement2->fetchAll();
    if (isset($exists[0]['request_id'])) {
        header('Location: ../index.php?err=sent');
    } elseif ($receiver == $_SESSION['userid']) {
        header('Location: ../index.php?err=you');
    } elseif ($receiver != $_SESSION['userid']) {
        print_r($receiver);
        print_r($_SESSION['userid']);

        $db = connectToDatabase('friend_requests');
        $qs2 = 'INSERT INTO friend_requests (sender_id, receiver_id, sender_username, receiver_username) VALUES (:sender_id, :receiver_id, :sender_username, :receiver_username)';
        $statement2 = $db->prepare($qs2);
        $statement2->execute(
            [
                ':sender_id' => $_SESSION['userid'],
                ':receiver_id' => $receiver,
                ':sender_username' => $_SESSION['username'],
                ':receiver_username' => $_GET['username']
            ]
        );
        include("../../content/webhook.php");
        log_data("Friend Request Attempt", $_SESSION['username'] . " has sent a friend request to " . $_GET['username'], 1);
        header('Location: ../index.php?err=suc');
    }
} else {
    header('Location: ../index.php?err=that');
}