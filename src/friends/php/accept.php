<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('../../database/connect.php');
include('../../content/logincheck.php');


$db = connectToDatabase('friends');
if (!$db) {
    die("Database connection failed: " . $db->errorInfo());
}

$qs2 = "SELECT id FROM friends WHERE (user1=:sender_id AND user2=:receiver_id)";
$statement2 = $db->prepare($qs2);
$statement2->execute(
    [
        ':sender_id' => $_SESSION['username'],
        ':receiver_id' => $_GET['u']

    ]
);
$exists = $statement2->fetchAll();

if (!isset($exists[0]['id'])) {
    $db = connectToDatabase('friend_requests');
    $qs2 = "SELECT request_id FROM friend_requests WHERE (sender_username=:sender_id AND receiver_username = :receiver_username) OR (receiver_username=:sender_id AND sender_username = :receiver_username)";
    $statement2 = $db->prepare($qs2);
    $statement2->execute(
        [
            ':receiver_username' => $_GET['u'],
            ':sender_id' => $_SESSION['username']
        ]
    );
    $exists = $statement2->fetchAll();


    if (isset($exists[0]['request_id'])) {


        $db = connectToDatabase('friend_requests');
        $qs2 = "DELETE FROM friend_requests WHERE (sender_username=:sender_id AND receiver_username = :receiver_username) OR (receiver_username=:sender_id AND sender_username = :receiver_username)";
        $statement2 = $db->prepare($qs2);
        $statement2->execute(
            [
                ':receiver_username' => $_GET['u'],
                ':sender_id' => $_SESSION['username']
            ]
        );
        $db = connectToDatabase('friends');
        $qs2 = "INSERT INTO friends (user1,user2,bested) VALUES (:user1,:user2,false)";
        $statement2 = $db->prepare($qs2);
        $statement2->execute(
            [
                ':user1' => $_SESSION['username'],
                ':user2' => $_GET['u']
            ]
        );
        $statement2->execute(
            [
                ':user1' => $_GET['u'],
                ':user2' => $_SESSION['username']
            ]
        );
        $db = connectToDatabase('members');
        $qs = "SELECT boostpoints FROM members WHERE username=:username";
        $statement = $db->prepare($qs);
        $statement->execute([
            ':username' => $_SESSION['username']
        ]);
        $user1bp = $statement->fetchAll();
        $statement->execute([
            ':username' => $_GET['u']
        ]);
        $user2bp = $statement->fetchAll();
        $newuser1bp = $user1bp[0]['boostpoints'] + 5;
        $newuser2bp = $user2bp[0]['boostpoints'] + 5;
        $qs = "UPDATE members SET boostpoints=:bp WHERE username=:username";
        $statement = $db->prepare($qs);
        $statement->execute([
            ':bp' => $newuser1bp,
            ':username' => $_SESSION['username']
        ]);
        $statement->execute([
            ':bp' => $newuser2bp,
            ':username' => $_GET['u']
        ]);
        include("../../content/webhook.php");
        log_data("Friend Request Accepted", $_SESSION['username'] . " is now friends with " . $_GET['u'], 1);

        header('Location: ../index.php');
    } else {
        header('Location: ../index.php?err=before');
    }
} else {
    header('Location: ../index.php?err=that');
}