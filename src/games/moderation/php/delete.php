<?php

include('verify.php');
require_once("../../../database/connect.php");

$db = getDatabase();

$url = $_REQUEST['url'];
$page = $_REQUEST['return'];

require_once("../../../database/connect.php");

$db = getDatabase();

// Get the game id from the URL by parsing it and getting the 'id' parameter
function getIdFromUrl($url)
{
    // Parse the URL and extract the query string
    $parsedUrl = parse_url($url);
    $queryString = $parsedUrl['query'] ?? '';
    parse_str($queryString, $queryParams);

    // Extract the 'id' parameter and return it
    if (isset($queryParams['id'])) {
        return $queryParams['id'];
    }

    return null;
}

function getGameName($g_id)
{
    include_once('../../../database/connect.php');
    $db = getDatabase();
    $sql = "SELECT title FROM games WHERE g_id=:id";
    return $db->queryFirstColumn($sql, 0, [':id' => $g_id]);
}


$gameId = getIdFromUrl($url);

if (isset($_POST['reason'])) {
    $reason = $_POST['reason'];
} else {
    $reason = "Delete request from pending deletion page";
}
if ($gameId === null) {
    header("Location: ../" . $page . "?err=Invalid game URL, " . $gameId . " " . $url);
    die();
}

// Check whether the game exists in the database
$count = $db->queryFirstColumn("SELECT COUNT(*) FROM games WHERE g_id=:id", 0, [
    ':id' => $gameId
]);
if ($count == 0) {
    header("Location: ../" . $page . "?err=Game does not exist");
    die();
}


$deleter = $db->queryFirstColumn("SELECT deleter FROM pending_deletions WHERE g_id=:g_id", 0, [
    ':g_id' => $gameId
]);

if ($deleter == $_SESSION['username']) {
    header("Location: ../" . $page . "?err=You have already requested deletion of this game. Please wait for another moderator.");
    die();
}

// Check pending deletions
$count = $db->queryFirstColumn("SELECT COUNT(*) FROM pending_deletions WHERE g_id=:g_id", 0, [
    ':g_id' => $gameId
]);

// Proceed if 3 moderators opt to delete the game
// TODO: merge transaciton scope
if ($count >= 3) {
    try {
        $db->useTransactionScope(function () use ($db, $gameId) {
            $db->execute("DELETE FROM pending_deletions WHERE g_id=:g_id", [
                ':g_id' => $gameId
            ]);
            $db->execute("DELETE FROM games WHERE g_id=:id", [
                ':id' => $gameId
            ]);
        });

        $title = getGameName($gameId);
        include_once('log.php');
        logModeration('made a delete request', 'on ' . $title . ' and deleted it because of ' . $reason, 3);
        header("Location: ../" . $page . "?msg=Game deleted successfully");
    } catch (Exception $e) {
        header("Location: ../" . $page . "?err=Failed to delete game");
    }
} else {
    // Insert new deletion request
    $db->execute("INSERT INTO pending_deletions
        (g_id, timestamp, deleter, reason) 
        VALUES (:g_id, NOW(), :deleter, :reason)", [
        ':g_id' => $gameId,
        ':deleter' => $_SESSION['username'],
        ':reason' => $reason]);

    // Count total number of deletion requests
    $count = $db->queryFirstColumn("SELECT COUNT(*) FROM pending_deletions WHERE g_id=:g_id", 0, [
        ':g_id' => $gameId
    ]);

    $title = getGameName($gameId);

    include_once('log.php');
    logModeration('made a delete request', 'on ' . $title . ' because of ' . $reason, 3);
    http_response_code(204);
    header("Location: ../" . $page . "?msg=Game deletion request submitted successfully. Total requests: " . $count . "/3");
}
