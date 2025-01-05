<?php

session_start();
header('Content-Type: text/xml');

$id = (int)filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

require_once('../database/connect.php');

$db = getDatabase();
$result2 = $db->query("SELECT author FROM games WHERE g_id=:id", [
    ':id' => $id
]);

if ($_SESSION["username"] == $result2[0]["author"]) {
    $db->execute("UPDATE games SET isdeleted=1, ispublished=0 WHERE g_id=:id", [
        ':id' => $id
    ]);
    http_response_code(204);
    header('Location: ../dashboard/my-games.php');
} else {
    http_response_code(500);
    echo "There was an error while deleting your game.";
}
