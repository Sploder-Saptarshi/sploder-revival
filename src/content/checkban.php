<?php
function checkBan($username)
{
    if (!isset($db)) {
        include_once(__DIR__ . '/../database/connect.php');
        $db = getDatabase();
    }
    $sql = "SELECT autounbandate FROM banned_members WHERE username=:username ORDER BY autounbandate DESC LIMIT 1";
    $user = $db->queryFirst($sql, [
        ':username' => $username
    ]);
    if (!$user) {
        return false;
    } else {
        if (time() > $user['autounbandate']) {
            return false;
        } else {
            return true;
        }
    }
}