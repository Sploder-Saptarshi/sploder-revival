<?php

include('verify.php');
$url = $_REQUEST['url'];
$page = $_REQUEST['return'];
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
$sql = "SELECT COUNT(*) FROM games WHERE g_id=:id";
$statement = $db_old->prepare($sql);
$statement->execute([':id' => $gameId]);
$count = $statement->fetchColumn();

if ($count == 0) {
    header("Location: ../" . $page . "?err=Game does not exist");
    die();
}


$sql = "SELECT deleter FROM pending_deletions WHERE g_id=:g_id";
$statement = $db_old->prepare($sql);
$statement->execute([':g_id' => $gameId]);
$deleter = $statement->fetchColumn();

if ($deleter == $_SESSION['username']) {
    header("Location: ../" . $page . "?err=You have already requested deletion of this game. Please wait for another moderator.");
    die();
}

// Check pending deletions
$sql = "SELECT COUNT(*) FROM pending_deletions WHERE g_id=:g_id";
$statement = $db_old->prepare($sql);
$statement->execute([':g_id' => $gameId]);
$count = $statement->fetchColumn();

// Proceed if 3 moderators opt to delete the game
if ($count >= 3) {
    $db->beginTransaction();
    try {
        $sql = "DELETE FROM pending_deletions WHERE g_id=:g_id";
        $statement = $db_old->prepare($sql);
        $statement->execute([':g_id' => $gameId]);

        $sql = "DELETE FROM games WHERE g_id=:id";
        $statement = $db_old->prepare($sql);
        $statement->execute([':id' => $gameId]);

        $db->commit();
        $title = getGameName($gameId);

        include_once('log.php');
        logModeration('made a delete request', 'on ' . $title . ' and deleted it because of ' . $reason, 3);


        header("Location: ../" . $page . "?msg=Game deleted successfully");
    } catch (Exception $e) {
        $db->rollBack();
        header("Location: ../" . $page . "?err=Failed to delete game");
    }
} else {
    // Insert new deletion request
    $sql = "INSERT INTO pending_deletions (g_id, timestamp, deleter, reason) VALUES (:g_id, NOW(), :deleter, :reason)";
    $statement = $db_old->prepare($sql);
    $statement->execute([':g_id' => $gameId, ':deleter' => $_SESSION['username'], ':reason' => $reason]);

    // Count total number of deletion requests
    $sql = "SELECT COUNT(*) FROM pending_deletions WHERE g_id=:g_id";
    $statement = $db_old->prepare($sql);
    $statement->execute([':g_id' => $gameId]);
    $count = $statement->fetchColumn();

    $title = getGameName($gameId);

    include_once('log.php');
    logModeration('made a delete request', 'on ' . $title . ' because of ' . $reason, 3);
    header("Location: ../" . $page . "?msg=Game deletion request submitted successfully. Total requests: " . $count . "/3");
}