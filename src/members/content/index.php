<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('../database/connect.php');
$username = $_GET['u'];

require_once('../content/timeelapsed.php');

$db = getDatabase();
$userParam = [':username' => $username];
$publicgames = " AND isdeleted=0 AND ispublished=1 AND isprivate=0";

// Fetch friends
$friends = $db->queryFirst("SELECT id FROM friends WHERE user1 = :username", $userParam);
if ($friends == false) {
    $friends = [];
}

// Fetch total games
$totalgames = $db->queryFirstColumn("SELECT COUNT(g_id) FROM games WHERE author = :username $publicgames", 0, $userParam);

// Fetch user details
$result = $db->queryFirst("SELECT userid, level, perms, joindate, lastlogin FROM members WHERE username = :username", $userParam);
$exists = isset($result['userid']) ? 1 : 0;
$user_id = $exists ? $result['userid'] : null;

// Fetch total plays
$plays = $db->queryFirstColumn("SELECT COUNT(1) FROM leaderboard WHERE pubkey IN (SELECT g_id FROM games WHERE author = :username $publicgames)", 0, $userParam);

// Fetch total playtime
$playtime = gmdate("i:s", round($db->queryFirstColumn("SELECT SUM(gtm) FROM leaderboard WHERE pubkey IN (SELECT g_id FROM games WHERE author = :username $publicgames)", 0, $userParam) / max(1, $plays)));

// Fetch total votes
$votes = $db->queryFirstColumn("SELECT COUNT(1) FROM votes WHERE g_id IN (SELECT g_id FROM games WHERE author = :username $publicgames)", 0, $userParam);

// Fetch average difficulty
$difficulty = min(100, round($db->queryFirstColumn("SELECT AVG(difficulty) FROM games WHERE author = :username $publicgames", 0, $userParam) * 10));

//Get feedback in percentage by calculating average vote of games (0-5)
if ($result['lastlogin'] > (time() - 30)) {
    $result['lastlogin'] = time();
}
$total = $totalgames;
